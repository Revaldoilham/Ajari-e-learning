import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:uas/utils/api_config.dart';

class TransactionService {
  final String baseUrl = ApiConfig.baseUrl;

  Future<Map<String, dynamic>> createInvoice(
    String token,
    double amount,
  ) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/topup'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode({'amount': amount}),
      );

      return json.decode(response.body);
    } catch (e) {
      return {'success': false, 'message': e.toString()};
    }
  }

  Future<Map<String, dynamic>> checkStatus(
    String token,
    String externalId,
  ) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/transactions/$externalId/check'),
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      return json.decode(response.body);
    } catch (e) {
      return {'success': false, 'message': e.toString()};
    }
  }
}
