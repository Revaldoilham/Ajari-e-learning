import 'package:flutter/foundation.dart';

class ApiConfig {
  // Use 10.0.2.2 for Android Emulator to access host's localhost
  // Use localhost for Web and iOS Simulator
  static String get baseUrl {
    if (!kIsWeb && defaultTargetPlatform == TargetPlatform.android) {
      return 'http://10.0.2.2:8000/api';
    }
    // Default for Web, iOS, and other platforms
    return 'http://localhost:8000/api';
  }
}
