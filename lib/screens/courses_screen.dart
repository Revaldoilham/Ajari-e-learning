import 'package:flutter/material.dart';
import 'course_detail_screen.dart';

class CoursesScreen extends StatefulWidget {
  const CoursesScreen({super.key});

  @override
  State<CoursesScreen> createState() => _CoursesScreenState();
}

class _CoursesScreenState extends State<CoursesScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        title: Container(
          padding: const EdgeInsets.symmetric(horizontal: 12.0),
          decoration: BoxDecoration(
            color: const Color(0xFFF5F7FA),
            borderRadius: BorderRadius.circular(8),
            border: Border.all(color: const Color(0xFFEBEEF3)),
          ),
          child: Row(
            children: const [
              Expanded(
                child: TextField(
                  decoration: InputDecoration(
                    hintText: 'Search here',
                    border: InputBorder.none,
                  ),
                ),
              ),
              Icon(Icons.search, color: Colors.grey),
            ],
          ),
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.filter_list, color: Colors.black87),
            onPressed: () {},
          ),
        ],
      ),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Padding(
            padding: EdgeInsets.all(16.0),
            child: Text(
              '46 Courses Found',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.w700),
            ),
          ),
          // Category chips
          SizedBox(
            height: 40,
            child: ListView(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              scrollDirection: Axis.horizontal,
              children: [
                _categoryChip('Design', Icons.draw),
                _categoryChip('Marketing', Icons.trending_up),
                _categoryChip('Business', Icons.business),
                _categoryChip('Work', Icons.work),
              ],
            ),
          ),
          const SizedBox(height: 16),
          Expanded(
            child: ListView(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              children: [
                _courseListItem(
                  tag: 'BUSINESS',
                  title: 'Income Management for Beginner',
                  content: '26 Content',
                  rating: '4.2',
                  price: '5.2',
                  imageUrl: 'https://picsum.photos/seed/income/120',
                ),
                _courseListItem(
                  tag: 'BUSINESS',
                  title: '[ADVANCED] Business Management Part 1',
                  content: '26 Content',
                  rating: '3.6',
                  price: '2.7',
                  imageUrl: 'https://picsum.photos/seed/business1/120',
                ),
                _courseListItem(
                  tag: 'BUSINESS',
                  title: '[ADVANCED] Business Management Part 2',
                  content: '26 Content',
                  rating: '3.6',
                  price: '2.9',
                  imageUrl: 'https://picsum.photos/seed/business2/120',
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _categoryChip(String label, IconData icon) {
    return Container(
      margin: const EdgeInsets.only(right: 8),
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: const Color(0xFFE6EDF7)),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 16, color: const Color(0xFF1665D8)),
          const SizedBox(width: 6),
          Text(label),
        ],
      ),
    );
  }

  Widget _courseListItem({
    required String tag,
    required String title,
    required String content,
    required String rating,
    required String price,
    required String imageUrl,
  }) {
    return GestureDetector(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => CourseDetailScreen(
              title: title,
              category: tag,
              rating: rating,
              reviewCount: '128 reviews',
              joinedCount: '456',
              duration: '4h 24min',
            ),
          ),
        );
      },
      child: Container(
        margin: const EdgeInsets.only(bottom: 16),
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            ClipRRect(
              borderRadius: BorderRadius.circular(8),
              child: Image.network(
                imageUrl,
                width: 72,
                height: 72,
                fit: BoxFit.cover,
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    tag,
                    style: const TextStyle(
                      color: Color(0xFF1665D8),
                      fontSize: 12,
                      fontWeight: FontWeight.w700,
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    title,
                    style: const TextStyle(
                      fontWeight: FontWeight.w600,
                      fontSize: 14,
                    ),
                  ),
                  const SizedBox(height: 8),
                  Row(
                    children: [
                      const Icon(
                        Icons.menu_book_outlined,
                        size: 14,
                        color: Colors.grey,
                      ),
                      const SizedBox(width: 4),
                      Text(
                        content,
                        style: const TextStyle(
                          color: Colors.grey,
                          fontSize: 12,
                        ),
                      ),
                      const SizedBox(width: 12),
                      const Icon(Icons.star, size: 14, color: Colors.orange),
                      const SizedBox(width: 4),
                      Text(
                        rating,
                        style: const TextStyle(
                          color: Colors.grey,
                          fontSize: 12,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
              decoration: BoxDecoration(
                color: const Color(0xFFFF9800),
                borderRadius: BorderRadius.circular(4),
              ),
              child: Text(
                '\$$price',
                style: const TextStyle(
                  color: Colors.white,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
