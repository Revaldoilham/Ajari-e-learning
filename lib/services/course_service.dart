import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:uas/utils/api_config.dart';

class Lesson {
  final int id;
  final String title;
  final int duration; // In minutes
  final int order;

  Lesson({
    required this.id,
    required this.title,
    required this.duration,
    required this.order,
  });

  factory Lesson.fromJson(Map<String, dynamic> json) {
    return Lesson(
      id: json['id'],
      title: json['title'] ?? '',
      duration: json['duration'] ?? 0,
      order: json['order'] ?? 0,
    );
  }
}

class Course {
  final int id;
  final String title;
  final String category;
  final String? description;
  final String? imageUrl;
  final String? instructor;
  final int lessonsCount;
  final String? duration;
  final double rating;
  final int reviewCount;
  final int joinedCount;
  final bool isFeatured;
  final bool isPopular;
  final double price;
  final bool isPurchased;
  final List<Lesson> lessons;

  Course({
    required this.id,
    required this.title,
    required this.category,
    this.description,
    this.imageUrl,
    this.instructor,
    this.lessonsCount = 0,
    this.duration,
    this.rating = 0,
    this.reviewCount = 0,
    this.joinedCount = 0,
    this.isFeatured = false,
    this.isPopular = false,
    this.price = 0,
    this.isPurchased = false,
    this.lessons = const [],
  });

  factory Course.fromJson(Map<String, dynamic> json) {
    var lessonsList = <Lesson>[];
    if (json['lessons'] != null) {
      lessonsList = (json['lessons'] as List)
          .map((i) => Lesson.fromJson(i))
          .toList();
    }

    return Course(
      id: json['id'],
      title: json['title'] ?? '',
      category: json['category'] ?? '',
      description: json['description'],
      imageUrl: json['image_url'],
      instructor: json['instructor'],
      lessonsCount: json['lessons_count'] ?? 0,
      duration: json['duration'],
      rating: double.tryParse(json['rating']?.toString() ?? '0') ?? 0,
      reviewCount: json['review_count'] ?? 0,
      joinedCount: json['joined_count'] ?? 0,
      isFeatured: json['is_featured'] == true || json['is_featured'] == 1,
      isPopular: json['is_popular'] == true || json['is_popular'] == 1,
      price: double.tryParse(json['price']?.toString() ?? '0') ?? 0,
      isPurchased: json['is_purchased'] == true,
      lessons: lessonsList,
    );
  }
}

class CourseService {
  static final String baseUrl = ApiConfig.baseUrl;

  /// Get all courses
  Future<List<Course>> getCourses({
    String? category,
    bool? featured,
    bool? popular,
    String? search,
    String? token,
  }) async {
    try {
      String url = '$baseUrl/courses';
      List<String> params = [];

      if (category != null) params.add('category=$category');
      if (featured == true) params.add('featured=1');
      if (popular == true) params.add('popular=1');
      if (search != null && search.isNotEmpty) params.add('search=$search');

      if (params.isNotEmpty) {
        url += '?${params.join('&')}';
      }

      final response = await http.get(
        Uri.parse(url),
        headers: {
          'Accept': 'application/json',
          if (token != null) 'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        final List<dynamic> data = json.decode(response.body);
        return data.map((json) => Course.fromJson(json)).toList();
      }
      return [];
    } catch (e) {
      print('Error fetching courses: $e');
      return [];
    }
  }

  /// Get featured courses
  Future<List<Course>> getFeaturedCourses({String? token}) async {
    return getCourses(featured: true, token: token);
  }

  /// Get popular courses
  Future<List<Course>> getPopularCourses({
    String? category,
    String? search,
    String? token,
  }) async {
    return getCourses(
      popular: true,
      category: category,
      search: search,
      token: token,
    );
  }

  /// Get course by category
  Future<List<Course>> getCoursesByCategory(
    String category, {
    String? token,
  }) async {
    return getCourses(category: category, token: token);
  }

  /// Get user's purchased courses
  Future<List<Course>> getMyCourses(String token) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/my-courses'),
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        final List<dynamic> data = json.decode(response.body);
        return data.map((json) => Course.fromJson(json)).toList();
      }
      return [];
    } catch (e) {
      print('Error fetching my courses: $e');
      return [];
    }
  }

  /// Get single course detail
  Future<Course?> getCourse(int id, {String? token}) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/courses/$id'),
        headers: {
          'Accept': 'application/json',
          if (token != null) 'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        return Course.fromJson(json.decode(response.body));
      }
      return null;
    } catch (e) {
      print('Error fetching course: $e');
      return null;
    }
  }

  /// Purchase course
  Future<Map<String, dynamic>> purchaseCourse(
    int courseId,
    String token,
  ) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/purchase'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode({'course_id': courseId}),
      );

      final data = jsonDecode(response.body);
      if (response.statusCode == 200) {
        return {
          'success': true,
          'message': data['message'],
          'new_balance': data['new_balance'],
        };
      } else {
        return {
          'success': false,
          'message': data['message'] ?? 'Pembelian gagal',
        };
      }
    } catch (e) {
      print('Error purchasing course: $e');
      return {'success': false, 'message': 'Koneksi gagal'};
    }
  }

  /// Get user balance
  Future<double?> getBalance(String token) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/balance'),
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        return double.tryParse(data['balance']?.toString() ?? '0');
      }
      return null;
    } catch (e) {
      print('Error fetching balance: $e');
      return null;
    }
  }

  /// Get all categories
  Future<List<String>> getCategories() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/categories'),
        headers: {'Accept': 'application/json'},
      );

      if (response.statusCode == 200) {
        final List<dynamic> data = json.decode(response.body);
        return data.cast<String>();
      }
      return [];
    } catch (e) {
      print('Error fetching categories: $e');
      return [];
    }
  }

  /// Get reviews for a course
  Future<List<Map<String, dynamic>>> getReviews(
    int courseId, {
    String? token,
  }) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/courses/$courseId/reviews'),
        headers: {
          'Accept': 'application/json',
          if (token != null) 'Authorization': 'Bearer $token',
        },
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        return List<Map<String, dynamic>>.from(data['data']);
      }
      return [];
    } catch (e) {
      print('Error fetching reviews: $e');
      return [];
    }
  }

  /// Add a review
  Future<Map<String, dynamic>> addReview(
    int courseId,
    int rating,
    String comment,
    String token,
  ) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/courses/$courseId/reviews'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode({'rating': rating, 'comment': comment}),
      );

      final data = jsonDecode(response.body);
      return {
        'success': response.statusCode == 200,
        'message': data['message'] ?? 'Gagal menambahkan ulasan',
        'data': data['data'],
      };
    } catch (e) {
      return {'success': false, 'message': 'Koneksi error: $e'};
    }
  }

  /// Delete a review
  Future<bool> deleteReview(int reviewId, String token) async {
    try {
      final response = await http.delete(
        Uri.parse('$baseUrl/reviews/$reviewId'),
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      return response.statusCode == 200;
    } catch (e) {
      print('Error deleting review: $e');
      return false;
    }
  }
}
