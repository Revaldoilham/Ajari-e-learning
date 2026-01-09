import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:uas/utils/profile.dart';
import 'package:uas/utils/api_config.dart';

class ApiAuthService {
  static final String baseUrl = ApiConfig.baseUrl;

  String? _token;

  String? get token => _token;

  void setToken(String? token) {
    _token = token;
  }

  Map<String, String> get _headers => {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    if (_token != null) 'Authorization': 'Bearer $_token',
  };

  Future<Map<String, dynamic>> register(
    String fullname,
    String email,
    String password,
  ) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/register'),
        headers: _headers,
        body: jsonEncode({
          'fullname': fullname,
          'email': email,
          'password': password,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 201) {
        return {
          'success': true,
          'message': data['message'] ?? 'Akun berhasil dibuat',
          'user': data['user'],
        };
      } else {
        final errors = data['errors'] as Map<String, dynamic>?;
        String errorMessage = data['message'] ?? 'Registrasi gagal';

        if (errors != null) {
          final firstError = errors.values.first;
          if (firstError is List && firstError.isNotEmpty) {
            errorMessage = firstError.first.toString();
          }
        }

        return {'success': false, 'message': errorMessage};
      }
    } catch (e) {
      return {
        'success': false,
        'message': 'Koneksi gagal. Pastikan server Laravel berjalan.',
      };
    }
  }

  Future<Map<String, dynamic>> login(String email, String password) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/login'),
        headers: _headers,
        body: jsonEncode({'email': email, 'password': password}),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        _token = data['token'];
        return {
          'success': true,
          'message': data['message'] ?? 'Login berhasil',
          'token': data['token'],
          'user': data['user'],
        };
      } else {
        final errors = data['errors'] as Map<String, dynamic>?;
        String errorMessage = data['message'] ?? 'Login gagal';

        if (errors != null) {
          final firstError = errors.values.first;
          if (firstError is List && firstError.isNotEmpty) {
            errorMessage = firstError.first.toString();
          }
        }

        return {'success': false, 'message': errorMessage};
      }
    } catch (e) {
      return {
        'success': false,
        'message': 'Koneksi gagal. Pastikan server Laravel berjalan.',
      };
    }
  }

  Future<void> logout() async {
    if (_token == null) return;

    try {
      await http.post(Uri.parse('$baseUrl/logout'), headers: _headers);
    } catch (e) {
      // Ignore logout errors, just clear token locally
    } finally {
      _token = null;
    }
  }

  Future<Profile?> getProfile() async {
    if (_token == null) return null;

    try {
      final response = await http.get(
        Uri.parse('$baseUrl/user'),
        headers: _headers,
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        return Profile.fromJson(data);
      }
      return null;
    } catch (e) {
      return null;
    }
  }

  Future<Map<String, dynamic>> updateProfile({
    String? fullname,
    String? photoUrl,
  }) async {
    if (_token == null) {
      return {'success': false, 'message': 'Tidak terautentikasi'};
    }

    try {
      final body = <String, dynamic>{};
      if (fullname != null) body['fullname'] = fullname;
      if (photoUrl != null) body['photo_url'] = photoUrl;

      final response = await http.put(
        Uri.parse('$baseUrl/user'),
        headers: _headers,
        body: jsonEncode(body),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        return {
          'success': true,
          'message': data['message'] ?? 'Profil berhasil diperbarui',
          'user': data['user'],
        };
      } else {
        return {
          'success': false,
          'message': data['message'] ?? 'Gagal memperbarui profil',
        };
      }
    } catch (e) {
      return {'success': false, 'message': 'Koneksi gagal'};
    }
  }
}
