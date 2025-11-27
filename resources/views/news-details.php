<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Berita - IVSS Lab</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    html { scroll-behavior: smooth; }
    * { font-family: 'Poppins', sans-serif; }
    
    /* Typography khusus untuk konten artikel agar enak dibaca */
    .article-content p {
        font-family: 'Merriweather', serif;
        font-size: 1.125rem; /* 18px */
        line-height: 1.8;
        margin-bottom: 1.5rem;
        color: #cbd5e1; /* slate-300 */
    }
    .article-content h2 {
        font-size: 1.875rem; /* 30px */
        font-weight: 700;
        color: #fff;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
    .article-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
        color: #cbd5e1;
    }
    
    /* Scrollbar dark mode */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #0f172a; }
    ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: #475569; }
  </style>
</head>

<body class="bg-slate-900 text-slate-300 selection:bg-cyan-500 selection:text-white">

  <header class="px-6 py-4 bg-slate-800 border-b border-slate-700 flex justify-between items-center sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto flex justify-between items-center w-full">
      <div class="text-cyan-400 text-4xl font-extrabold">IVSS</div>
      <nav class="hidden md:flex items-center gap-8 text-[16px] font-medium text-slate-300">
        <a href="landingPage.php" class="hover:text-cyan-400 transition-colors">Home</a>
        <a href="news.php" class="text-cyan-400 font-bold transition-colors">Berita</a>
        <div class="flex items-center gap-4 ml-8">
          <a href="login.php" class="px-5 py-2 text-cyan-400 border border-cyan-500 rounded-full hover:bg-cyan-500 hover:text-white transition-all">Login</a>
        </div>
      </nav>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-12">

    <nav class="flex mb-8 text-sm font-medium text-slate-400">
      <a href="landingPage.php" class="hover:text-cyan-400">Home</a>
      <span class="mx-2">/</span>
      <a href="news.php" class="hover:text-cyan-400">Berita</a>
      <span class="mx-2">/</span>
      <span class="text-cyan-400 truncate max-w-xs">Pengembangan Drone Cerdas...</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

      <article class="lg:col-span-2">
        
        <div class="mb-6">
            <span class="bg-purple-900/30 text-purple-300 border border-purple-800 text-xs font-bold px-3 py-1 rounded-full mb-4 inline-block">
                Computer Vision
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-4">
                Pengembangan Drone Cerdas untuk Pemetaan Lahan Gambut Menggunakan LiDAR
            </h1>
            
            <div class="flex items-center gap-6 text-sm text-slate-400 border-b border-slate-700 pb-6">
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name=Mamluatul+Haniah&background=0891b2&color=fff" class="w-8 h-8 rounded-full" alt="Author">
                    <span class="text-slate-200 font-medium">Mamluatul Hani'ah</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-calendar-alt"></i>
                    <span>20 November 2025</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-eye"></i>
                    <span>1,245 Views</span>
                </div>
            </div>
        </div>

        <div class="mb-8 rounded-2xl overflow-hidden shadow-2xl border border-slate-700">
            <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=1200" 
                 alt="Drone Mapping" class="w-full h-auto object-cover">
            <div class="bg-slate-800 p-3 text-center text-xs text-slate-500 italic border-t border-slate-700">
                Ilustrasi penggunaan drone untuk pemetaan udara (Sumber: Unsplash)
            </div>
        </div>

        <div class="article-content text-slate-300">
            <p>
                <span class="text-4xl float-left mr-2 mt-[-10px] font-bold text-cyan-400">L</span>aboratorium Intelligent Vision and Smart System (IVSS) kembali membuat terobosan dalam teknologi pertanian presisi. Tim peneliti yang diketuai oleh Mamluatul Hani'ah berhasil mengembangkan prototipe drone otonom yang dilengkapi dengan sensor LiDAR (*Light Detection and Ranging*) untuk memetakan kontur lahan gambut dengan akurasi tinggi.
            </p>
            <p>
                Lahan gambut memiliki karakteristik unik yang seringkali sulit dipetakan menggunakan metode konvensional atau citra satelit biasa karena tertutup vegetasi lebat. Dengan teknologi LiDAR, drone ini mampu "menembus" celah dedaunan dan mendapatkan data topografi permukaan tanah yang presisi.
            </p>

            <h2>Tantangan dan Solusi Teknis</h2>
            <p>
                Salah satu tantangan utama dalam proyek ini adalah stabilisasi penerbangan drone di area dengan angin kencang dan sinyal GPS yang tidak stabil. Tim IVSS menggunakan algoritma *Sensor Fusion* yang menggabungkan data dari IMU (*Inertial Measurement Unit*), GPS, dan Visual Odometry untuk menjaga kestabilan posisi drone.
            </p>
            
            <ul>
                <li><strong>Algoritma SLAM:</strong> Digunakan untuk pemetaan lokasi secara real-time tanpa bergantung sepenuhnya pada GPS.</li>
                <li><strong>Deep Learning:</strong> Model YOLOv8 ditanamkan pada *Edge Device* (Jetson Nano) di drone untuk menghindari rintangan seperti pohon tinggi atau tiang listrik secara otomatis.</li>
                <li><strong>Efisiensi Baterai:</strong> Optimasi path planning berhasil menghemat penggunaan baterai hingga 20% dibandingkan metode terbang manual.</li>
            </ul>

            <h2>Dampak bagi Pertanian Indonesia</h2>
            <p>
                Inovasi ini diharapkan dapat membantu petani dan pemerintah dalam mengelola lahan gambut secara berkelanjutan. Data peta yang akurat sangat krusial untuk mengatur sistem irigasi (tata air) guna mencegah kebakaran lahan gambut yang sering terjadi saat musim kemarau.
            </p>

            <blockquote class="border-l-4 border-cyan-500 pl-6 py-2 my-8 italic text-slate-400 bg-slate-800/50 rounded-r-lg">
                "Teknologi ini bukan hanya tentang drone canggih, tapi tentang bagaimana kita menggunakan data visual untuk menyelamatkan ekosistem gambut Indonesia." - Dr. Ulla Delfana Rosiani (Kepala Lab IVSS)
            </blockquote>

            <p>
                Penelitian ini masih dalam tahap uji coba lapangan tahap kedua di Kalimantan Tengah dan diharapkan dapat diproduksi secara massal pada akhir tahun 2026 bekerja sama dengan mitra industri lokal.
            </p>
        </div>

        <div class="mt-10 pt-8 border-t border-slate-700">
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="text-sm font-semibold text-slate-400 mr-2">Tags:</span>
                <a href="#" class="px-3 py-1 bg-slate-800 hover:bg-cyan-900 text-cyan-400 text-xs rounded-full transition-colors">#Drone</a>
                <a href="#" class="px-3 py-1 bg-slate-800 hover:bg-cyan-900 text-cyan-400 text-xs rounded-full transition-colors">#LiDAR</a>
                <a href="#" class="px-3 py-1 bg-slate-800 hover:bg-cyan-900 text-cyan-400 text-xs rounded-full transition-colors">#SmartFarming</a>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="font-bold text-white">Bagikan artikel ini:</span>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-500 transition-colors"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-400 transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-500 transition-colors"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-700 text-white flex items-center justify-center hover:bg-blue-600 transition-colors"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

      </article>

      <aside class="lg:col-span-1 space-y-8">
        
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-bold text-white mb-4">Cari Artikel</h3>
            <div class="relative">
                <input type="text" placeholder="Kata kunci..." 
                       class="w-full bg-slate-900 border border-slate-600 text-slate-200 rounded-lg pl-4 pr-10 py-3 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-cyan-400">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-bold text-white mb-4">Kategori</h3>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2 border-b border-slate-700/50">
                        <span>Computer Vision</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">12</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2 border-b border-slate-700/50">
                        <span>Artificial Intelligence</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">8</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2 border-b border-slate-700/50">
                        <span>Data Science</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">5</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2">
                        <span>Internet of Things</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">9</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-bold text-white mb-4">Berita Terbaru</h3>
            <div class="space-y-6">
                
                <a href="#" class="group flex gap-4 items-start">
                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=200" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Thumb">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-200 group-hover:text-cyan-400 transition-colors line-clamp-2 leading-snug">
                            Mahasiswa Bimbingan IVSS Raih Gold Medal di GEMASTIK 2025
                        </h4>
                        <span class="text-xs text-slate-500 mt-1 block">15 Nov 2025</span>
                    </div>
                </a>

                <a href="#" class="group flex gap-4 items-start">
                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?q=80&w=200" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Thumb">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-200 group-hover:text-cyan-400 transition-colors line-clamp-2 leading-snug">
                            Tutorial Instalasi TensorFlow pada Jetson Nano
                        </h4>
                        <span class="text-xs text-slate-500 mt-1 block">10 Nov 2025</span>
                    </div>
                </a>

                <a href="#" class="group flex gap-4 items-start">
                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=200" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Thumb">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-200 group-hover:text-cyan-400 transition-colors line-clamp-2 leading-snug">
                            Rapat Koordinasi Riset Semester Ganjil
                        </h4>
                        <span class="text-xs text-slate-500 mt-1 block">05 Nov 2025</span>
                    </div>
                </a>

            </div>
        </div>

      </aside>

    </div>

  </main>

  <footer class="bg-slate-800 border-t border-slate-700 py-8 text-center mt-12">
    <p class="text-slate-500 text-sm">
      &copy; 2025 Laboratorium Intelligent Vision and Smart System (IVSS). <br>Politeknik Negeri Malang.
    </p>
  </footer>

</body>
</html>