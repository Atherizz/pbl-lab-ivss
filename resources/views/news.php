<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Berita & Artikel - IVSS Lab</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    html { scroll-behavior: smooth; }
    * { font-family: 'Poppins', sans-serif; }
    
    /* Scrollbar dark mode */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #0f172a; }
    ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: #475569; }

    /* Line Clamp untuk memotong teks panjang */
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .line-clamp-3 {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
</head>

<body class="bg-slate-900 text-slate-300 selection:bg-cyan-500 selection:text-white">

  <header class="px-6 py-4 bg-slate-800 border-b border-slate-700 flex justify-between items-center sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center w-full">
      <div class="text-cyan-400 text-4xl font-extrabold">IVSS</div>

      <nav class="hidden md:flex items-center gap-8 text-[16px] font-medium text-slate-300">
        <a href="landingPage.php#visi-misi" class="hover:text-cyan-400 transition-colors">Visi dan Misi</a>
        <a href="landingPage.php#anggota-lab" class="hover:text-cyan-400 transition-colors">Anggota Laboratorium</a>
        <a href="peralatanLab.php" class="hover:text-cyan-400 transition-colors">Fasilitas</a>
        <a href="landingPage.php#riset-penelitian" class="hover:text-cyan-400 transition-colors">Riset</a>
        <a href="#" class="text-cyan-400 font-semibold transition-colors">Berita</a>

        <div class="flex items-center gap-4 ml-8">
          <a href="login.php" class="px-5 py-2 text-cyan-400 border border-cyan-500 rounded-full hover:bg-cyan-500 hover:text-white transition-all">Login</a>
          <a href="register.php" class="px-5 py-2 text-white bg-cyan-600 rounded-full hover:bg-cyan-500 transition-all">Register</a>
        </div>
      </nav>
    </div>
  </header>

  <section class="relative bg-slate-800 py-16 border-b border-slate-700 overflow-hidden">
    <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-cyan-500/10 rounded-full blur-[80px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
        Berita & <span class="text-cyan-400">Artikel</span>
      </h1>
      <p class="text-slate-400 text-lg max-w-2xl mx-auto">
        Informasi terbaru mengenai kegiatan laboratorium, publikasi riset, dan perkembangan teknologi terkini di IVSS Lab.
      </p>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-6 py-12">

    <div class="mb-16">
      <div class="group relative bg-slate-800 border border-slate-700 rounded-3xl overflow-hidden hover:border-cyan-500/50 transition-all duration-300 shadow-lg hover:shadow-cyan-500/10">
        <div class="grid grid-cols-1 lg:grid-cols-2">
          
          <div class="relative h-64 lg:h-full overflow-hidden">
            <div class="absolute top-4 left-4 z-10">
                <span class="bg-cyan-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg uppercase tracking-wide">Featured</span>
            </div>
            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1200" 
                 alt="Featured News" 
                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent lg:bg-gradient-to-r"></div>
          </div>

          <div class="p-8 lg:p-12 flex flex-col justify-center">
            <div class="flex items-center gap-3 text-sm text-cyan-400 mb-3">
              <i class="far fa-calendar-alt"></i>
              <span>24 November 2025</span>
              <span class="text-slate-600">•</span>
              <span>Workshop</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight group-hover:text-cyan-400 transition-colors">
              Workshop Nasional: Penerapan Deep Learning untuk Deteksi Penyakit Tanaman
            </h2>
            <p class="text-slate-400 mb-6 line-clamp-3">
              Laboratorium IVSS sukses menyelenggarakan workshop nasional yang dihadiri oleh pakar teknologi pertanian. Workshop ini membahas implementasi algoritma CNN terbaru untuk meningkatkan hasil panen melalui deteksi dini.
            </p>
            <div>
              <a href="#" class="inline-flex items-center gap-2 text-white bg-cyan-600 hover:bg-cyan-500 px-6 py-3 rounded-xl font-medium transition-all shadow-lg shadow-cyan-500/20">
                Baca Selengkapnya
                <i class="fas fa-arrow-right text-sm"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-10 pb-8 border-b border-slate-800">
      
      <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 bg-cyan-600 text-white rounded-lg text-sm font-medium shadow-md shadow-cyan-500/20">Semua</button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 border border-slate-700 hover:border-cyan-500 hover:text-cyan-400 rounded-lg text-sm font-medium transition-all">Riset</button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 border border-slate-700 hover:border-cyan-500 hover:text-cyan-400 rounded-lg text-sm font-medium transition-all">Kegiatan</button>
        <button class="px-4 py-2 bg-slate-800 text-slate-300 border border-slate-700 hover:border-cyan-500 hover:text-cyan-400 rounded-lg text-sm font-medium transition-all">Prestasi</button>
      </div>

      <div class="relative w-full md:w-80">
        <input type="text" placeholder="Cari artikel..." 
               class="w-full bg-slate-800 text-slate-200 border border-slate-700 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500">
          <i class="fas fa-search"></i>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=800" alt="News 1" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-cyan-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            Teknologi
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> 20 Nov 2025
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors">
            Pengembangan Drone Cerdas untuk Pemetaan Lahan Gambut
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            Tim peneliti IVSS Lab berhasil mengembangkan prototipe drone yang mampu memetakan lahan gambut dengan akurasi tinggi menggunakan sensor LiDAR.
          </p>
          <a href="#" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800" alt="News 2" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-purple-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            Prestasi
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> 15 Nov 2025
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors">
            Mahasiswa Bimbingan IVSS Raih Gold Medal di GEMASTIK 2025
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            Selamat kepada tim mahasiswa yang telah mengharumkan nama kampus dengan inovasi sistem deteksi kantuk pengemudi berbasis IoT.
          </p>
          <a href="#" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?q=80&w=800" alt="News 3" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-green-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            Tutorial
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> 10 Nov 2025
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors">
            Tutorial Instalasi dan Konfigurasi TensorFlow pada Jetson Nano
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            Panduan lengkap langkah demi langkah untuk mengatur lingkungan pengembangan Deep Learning pada perangkat edge Jetson Nano.
          </p>
          <a href="#" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=800" alt="News 4" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-cyan-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            Kegiatan
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> 05 Nov 2025
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors">
            Rapat Koordinasi Riset Semester Ganjil 2025/2026
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            Agenda rapat membahas roadmap penelitian laboratorium untuk satu semester ke depan serta pembagian tugas asisten peneliti.
          </p>
          <a href="#" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=800" alt="News 5" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-blue-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            Keamanan
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> 01 Nov 2025
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors">
            Analisis Keamanan Jaringan Menggunakan Metode Penetration Testing
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            Studi kasus keamanan jaringan kampus untuk mengidentifikasi kerentanan sistem sebelum dieksploitasi oleh pihak tidak bertanggung jawab.
          </p>
          <a href="#" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1535378437527-95498619047e?q=80&w=800" alt="News 6" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-cyan-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            AI
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> 28 Oct 2025
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors">
            Mengenal Generative AI dan Potensinya di Masa Depan
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            Artikel opini mengenai bagaimana Generative AI mengubah lanskap industri kreatif dan pemrograman dalam 5 tahun terakhir.
          </p>
          <a href="#" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>

    </div>

    <div class="flex justify-center items-center gap-2">
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-400 hover:bg-slate-800 hover:text-white transition-colors disabled:opacity-50">
        <i class="fas fa-chevron-left"></i>
      </a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-500/20">1</a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">2</a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">3</a>
      <span class="text-slate-500 px-2">...</span>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>

  </main>

  <footer class="bg-slate-900 border-t border-slate-800 py-8 text-center">
    <p class="text-slate-500 text-sm">
      &copy; 2025 Laboratorium Intelligent Vision and Smart System (IVSS). <br>Politeknik Negeri Malang.
    </p>
  </footer>

</body>
</html>