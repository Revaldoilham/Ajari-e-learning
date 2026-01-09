@extends('admin.layout')

@section('title', 'Edit Course')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Course</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi kursus <span
                        class="text-blue-600 font-semibold">"{{ $course->title }}"</span></p>
            </div>
            <a href="{{ route('admin.courses.index') }}"
                class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.435.29-3.48.804A5.983 5.983 0 012 8.5V15c0 .458.082.896.233 1.307L4.5 14a2 2 0 012-2h1.5V4.804zM11 4.804A7.968 7.968 0 0114.5 4c1.255 0 2.435.29 3.48.804A5.983 5.983 0 0018 8.5V15c0 .458-.082.896-.233 1.307L15.5 14a2 2 0 00-2-2H12V4.804z" />
                            </svg>
                        </span>
                        Informasi Dasar
                    </h2>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <div class="falex justify-between items-center mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Judul Kursus *</label>
                            <button type="button" id="btn-generate-title"
                                class="text-xs text-blue-600 hover:text-blue-800 font-bold flex items-center gap-1 px-2 py-1 rounded-md hover:bg-blue-50 transition-all">
                                ✨ Auto-generate
                            </button>
                        </div>
                        <input type="text" name="title" id="course-title" value="{{ old('title', $course->title) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                            placeholder="Contoh: Mastering Laravel for Beginners" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                            <select name="category"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white transition-all appearance-none cursor-pointer"
                                required>
                                <option value="">Pilih kategori</option>
                                <option value="Design" {{ old('category', $course->category) == 'Design' ? 'selected' : '' }}>
                                    Design</option>
                                <option value="Marketing" {{ old('category', $course->category) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Development" {{ old('category', $course->category) == 'Development' ? 'selected' : '' }}>Development</option>
                                <option value="Business" {{ old('category', $course->category) == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Language" {{ old('category', $course->category) == 'Language' ? 'selected' : '' }}>Language</option>
                                <option value="Data" {{ old('category', $course->category) == 'Data' ? 'selected' : '' }}>Data
                                    Science</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                            placeholder="Jelaskan apa yang akan dipelajari di kursus ini secara detail...">{{ old('description', $course->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Media & Instruktur -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            Media Utama
                        </h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Image URL</label>
                            <input type="url" name="image_url" id="image_url_input"
                                value="{{ old('image_url', $course->image_url) }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                placeholder="https://images.unsplash.com/...">
                            <div id="image_preview" class="mt-4 {{ $course->image_url ? '' : 'hidden' }}">
                                <p class="text-xs text-gray-500 mb-2">Preview Gambar:</p>
                                <img src="{{ $course->image_url }}" alt="Preview"
                                    class="w-full h-40 object-cover rounded-xl border border-gray-100">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            Instruktur & Harga
                        </h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Instructor</label>
                                <input type="text" name="instructor" value="{{ old('instructor', $course->instructor) }}"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                    placeholder="Nama mentor">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Price ($)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">$</span>
                                    <input type="number" name="price" step="0.01" value="{{ old('price', $course->price) }}"
                                        class="w-full pl-8 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                        placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Total Duration *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <input type="text" name="duration" value="{{ old('duration', $course->duration) }}"
                                    class="w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white"
                                    placeholder="Contoh: 5h 30m" required>
                            </div>
                            <p class="text-[11px] text-gray-500 mt-2 px-1 italic leading-relaxed">Durasi ini akan dibagi
                                rata secara otomatis ke setiap materi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Materi Kursus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM11 2a1 1 0 011-1h5a1 1 0 110 2h-5a1 1 0 01-1-1zm0 5a1 1 0 011-1h5a1 1 0 110 2h-5a1 1 0 01-1-1zm0 5a1 1 0 011-1h5a1 1 0 110 2h-5a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Kurikulum Kursus
                    </h2>
                    <button type="button" id="add-lesson"
                        class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Materi
                    </button>
                </div>
                <div id="lessons-container" class="p-6 space-y-4">
                    <!-- Lessons rows will be dynamic -->
                </div>
            </div>

            <!-- Statistik & Visibility -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-wrap gap-6 items-center">
                    <label class="group flex items-center cursor-pointer select-none">
                        <div class="relative">
                            <input type="checkbox" name="is_featured" class="sr-only peer" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>
                            <div
                                class="w-10 h-6 bg-gray-200 rounded-full peer-checked:bg-blue-600 transition-all after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4">
                            </div>
                        </div>
                        <span
                            class="ml-3 text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition-colors">Featured</span>
                    </label>
                    <label class="group flex items-center cursor-pointer select-none">
                        <div class="relative">
                            <input type="checkbox" name="is_popular" class="sr-only peer" {{ old('is_popular', $course->is_popular) ? 'checked' : '' }}>
                            <div
                                class="w-10 h-6 bg-gray-200 rounded-full peer-checked:bg-orange-500 transition-all after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4">
                            </div>
                        </div>
                        <span
                            class="ml-3 text-sm font-semibold text-gray-700 group-hover:text-orange-600 transition-colors">Popular</span>
                    </label>
                </div>

                <div class="bg-gray-50 rounded-xl border border-gray-100 p-6 flex justify-around items-center">
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Rating</p>
                        <p class="text-xl font-bold text-gray-800 flex items-center gap-1 justify-center">
                            <span class="text-orange-400">⭐</span> {{ number_format($course->rating, 1) }}
                        </p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Reviews</p>
                        <p class="text-xl font-bold text-gray-800">{{ $course->review_count }}</p>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Joined</p>
                        <p class="text-xl font-bold text-gray-800">{{ $course->joined_count }}</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-0.5 active:translate-y-0 text-center">
                    💾 Simpan Perubahan Kursus
                </button>
                <a href="{{ route('admin.courses.index') }}"
                    class="px-8 py-3.5 bg-white border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        const btnGenerate = document.getElementById('btn-generate-title');
        const titleInput = document.getElementById('course-title');
        const descInput = document.querySelector('textarea[name="description"]');
        const categorySelect = document.querySelector('select[name="category"]');
        const imageUrlInput = document.getElementById('image_url_input');
        const imagePreview = document.getElementById('image_preview');

        const lessonsContainer = document.getElementById('lessons-container');
        const addLessonBtn = document.getElementById('add-lesson');
        let lessonCount = 0;

        // Image preview logic
        imageUrlInput.addEventListener('input', function () {
            const url = this.value;
            if (url) {
                imagePreview.querySelector('img').src = url;
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.classList.add('hidden');
            }
        });

        function addLessonRow(title = '') {
            const index = lessonCount++;
            const div = document.createElement('div');
            div.className = 'flex gap-3 items-center p-3 bg-gray-50 hover:bg-white hover:shadow-md border border-transparent hover:border-blue-100 rounded-xl transition-all group';
            div.innerHTML = `
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 text-gray-500 text-xs font-bold group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                    ${index + 1}
                </div>
                <div class="flex-1">
                    <input type="text" name="lessons[${index}][title]" value="${title}" 
                        class="w-full px-4 py-2 bg-transparent focus:bg-white border-transparent focus:border-gray-200 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/10 transition-all font-medium text-gray-700" 
                        placeholder="Contoh: Pengenalan Dasar-dasar Sistem..." required>
                </div>
                <button type="button" class="text-gray-300 hover:text-red-500 p-2 remove-lesson transition-colors opacity-0 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            `;
            lessonsContainer.appendChild(div);

            div.querySelector('.remove-lesson').addEventListener('click', () => {
                div.style.opacity = '0';
                div.style.transform = 'translateX(20px)';
                setTimeout(() => {
                    div.remove();
                    reindexLessons();
                }, 300);
            });
        }

        function reindexLessons() {
            const rows = lessonsContainer.querySelectorAll('.flex');
            rows.forEach((row, i) => {
                row.querySelector('.rounded-full').innerText = i + 1;
            });
        }

        addLessonBtn.addEventListener('click', () => addLessonRow());

        const templates = {
            'Development': {
                titles: ['Mastering Flutter & Laravel', 'Zero to Hero in Web Dev', 'Mobile App Revolution', 'API Architecture Design', 'Frontend Masterclass'],
                desc: 'Pelajari cara membangun aplikasi mobile dan web berkualitas tinggi dari awal. Kursus ini mencakup arsitektur modern, manajemen state, dan strategi deployment untuk developer profesional.',
                lessons: ['Pengenalan Ekosistem Development', 'Persiapan Lingkungan Pengembangan', 'Membangun Aplikasi Pertama', 'Deep Dive: State Management', 'Strategi Deployment & CI/CD']
            },
            'Marketing': {
                titles: ['Social Media Viral Strategy', 'Digital Marketing Blueprint', 'SEO Secrets Revealed', 'Copywriting for Sales', 'Ads Optimization Master'],
                desc: 'Tingkatkan pertumbuhan bisnis dengan strategi pemasaran yang terbukti efektif. Kuasai SEO, iklan media sosial, dan pembuatan konten untuk mengubah pengunjung menjadi pelanggan loyal.',
                lessons: ['Fundamental Digital Marketing', 'Memahami Psikologi Audience', 'Strategi Media Sosial Organik', 'Framework Konten Kreatif', 'Analisis & Optimasi Iklan']
            },
            'Design': {
                titles: ['UI/UX Design Essentials', 'Figma Prototyping Workshop', 'Color & Typography Theory', 'Logo Design Fundamentals', 'Modern Web Aesthetics'],
                desc: 'Buka potensi kreatif Anda dan pelajari prinsip desain profesional. Kuasai Figma, riset pengguna, dan storytelling visual untuk menciptakan antarmuka yang memukau.',
                lessons: ['Prinsip Dasar Desain Visual', 'Riset Pengguna & Wireframing', 'Mahir Desain Menggunakan Figma', 'Interaksi & Prototyping Canggih', 'Proyek Portofolio Akhir']
            },
            'Business': {
                titles: ['Startup Growth Hacking', 'Financial Literacy 101', 'Management & Leadership', 'Negotiation Skills Pro', 'Business Strategy Pro'],
                desc: 'Kembangkan bisnis Anda dan pimpin dengan percaya diri. Kursus ini memberikan wawasan praktis tentang manajemen keuangan, keterampilan kepemimpinan, dan perencanaan strategis.',
                lessons: ['Mindset Pengusaha Sukses', 'Analisis Pasar & Kompetisi', 'Perencanaan Keuangan Strategis', 'Memimpin Tim dengan Efektif', 'Scaling: Melipatgandakan Bisnis']
            },
            'Language': {
                titles: ['Fluent in English Fast', 'TOEFL Preparation Expert', 'Conversational Japanese', 'Grammar Masterclass', 'Business Writing Skills'],
                desc: 'Capai kefasihan dan berkomunikasi secara efektif dalam bahasa target Anda. Fokus pada percakapan praktis dan tata bahasa yang dirancang untuk pembelajaran cepat.',
                lessons: ['Abjad & Fonetik Dasar', 'Percakapan Sehari-hari', 'Esensi Tata Bahasa (Grammar)', 'Skill Mendengarkan (Listening)', 'Workshop Menulis Profesional']
            },
            'Data': {
                titles: ['Data Science with Python', 'Machine Learning Masterclass', 'Big Data Analytics', 'Data Visualization Pro', 'Statistics for Data Science'],
                desc: 'Kuasai seni analisis data dan pemodelan prediktif. Pelajari Python, SQL, dan metode statistik canggih untuk mengekstrak wawasan berharga dari dataset kompleks.',
                lessons: ['Python untuk Analisa Data', 'Teknik Data Cleaning', 'Exploratory Data Analysis (EDA)', 'Membangun Model Machine Learning', 'Visualisasi Wawasan Bisnis']
            }
        };

        btnGenerate.addEventListener('click', function () {
            const category = categorySelect.value;
            const template = templates[category] || {
                titles: ['Professional Learning Course', 'Expert Career Guide', 'Success Path Academy'],
                desc: 'Tingkatkan keahlian Anda dengan kursus yang dipandu oleh pakar industri demi masa depan yang lebih cerah.',
                lessons: ['Pengenalan Materi Utama', 'Esensi dan Konsep Dasar', 'Penerapan Praktis', 'Kesimpulan & Langkah Lanjut']
            };

            const randomTitle = template.titles[Math.floor(Math.random() * template.titles.length)];
            titleInput.value = randomTitle;
            descInput.value = template.desc;

            // Clear existing lessons and auto-generate new ones
            lessonsContainer.innerHTML = '';
            template.lessons.forEach(l => addLessonRow(l));

            // Add a small pulse effect
            [titleInput, descInput, lessonsContainer].forEach(el => {
                el.classList.add('ring-2', 'ring-blue-300', 'ring-offset-2');
                setTimeout(() => el.classList.remove('ring-2', 'ring-blue-300', 'ring-offset-2'), 1000);
            });
        });

        // Add existing lessons or initial empty row
        @if(old('lessons'))
            @foreach(old('lessons') as $l)
                addLessonRow("{{ $l['title'] }}");
            @endforeach
        @elseif($course->lessons->count() > 0)
            @foreach($course->lessons as $lesson)
                addLessonRow("{{ $lesson->title }}");
            @endforeach
        @else
            addLessonRow();
        @endif
    </script>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #lessons-container>div {
            animation: slideIn 0.3s ease-out forwards;
        }
    </style>
@endsection