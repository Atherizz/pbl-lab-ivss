<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Direktori Riset - IVSS Lab</title>

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
  </style>
</head>

<body class="bg-slate-900 text-slate-300 selection:bg-cyan-500 selection:text-white">

  <header class="px-6 py-4 bg-slate-800 border-b border-slate-700 flex justify-between items-center sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto flex justify-between items-center w-full">
      <div class="text-cyan-400 text-4xl font-extrabold">IVSS</div>
      <nav class="hidden md:flex items-center gap-8 text-[16px] font-medium text-slate-300">
        <a href="home.php" class="hover:text-cyan-400 transition-colors">Home</a>
        <a href="#" class="text-cyan-400 font-bold transition-colors">Publikasi</a>
        <div class="flex items-center gap-4 ml-8">
          <a href="login.php" class="px-5 py-2 text-cyan-400 border border-cyan-500 rounded-full hover:bg-cyan-500 hover:text-white transition-all">Login</a>
        </div>
      </nav>
    </div>
  </header>

  <section class="relative bg-slate-800 py-16 border-b border-slate-700">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 to-slate-800"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
      <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
        Direktori <span class="text-cyan-400">Riset & Publikasi</span>
      </h1>
      <p class="text-slate-400 text-lg max-w-2xl mx-auto">
        Jelajahi koleksi penelitian, jurnal, dan inovasi teknologi yang telah dikembangkan oleh anggota Laboratorium IVSS.
      </p>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-6 py-12">

    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 mb-10 shadow-lg">
      <form action="" class="flex flex-col lg:flex-row gap-4">
        
        <div class="flex-1 relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-search text-slate-500"></i>
          </div>
          <input type="text" placeholder="Cari judul penelitian atau nama peneliti..." 
                 class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-600 rounded-xl text-slate-200 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
        </div>

        <div class="w-full lg:w-48">
          <select class="w-full px-4 py-3 bg-slate-900 border border-slate-600 rounded-xl text-slate-300 focus:outline-none focus:border-cyan-500 cursor-pointer">
            <option value="">Semua Tahun</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
          </select>
        </div>

        <div class="w-full lg:w-56">
          <select class="w-full px-4 py-3 bg-slate-900 border border-slate-600 rounded-xl text-slate-300 focus:outline-none focus:border-cyan-500 cursor-pointer">
            <option value="">Semua Topik</option>
            <option value="cv">Computer Vision</option>
            <option value="ai">Artificial Intelligence</option>
            <option value="nlp">Natural Language Processing</option>
            <option value="ds">Data Science</option>
          </select>
        </div>

        <button type="button" class="px-8 py-3 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-cyan-500/20">
          Terapkan
        </button>
      </form>
    </div>

    <div class="flex flex-wrap gap-4 mb-8 text-sm font-medium text-slate-400">
        <span>Menampilkan <span class="text-white">1-9</span> dari <span class="text-white">42</span> publikasi</span>
        <span class="hidden sm:inline">•</span>
        <span class="text-cyan-400 cursor-pointer hover:underline">Reset Filter</span>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

      <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
        <div class="flex justify-between items-start mb-4">
          <span class="bg-purple-900/30 text-purple-300 border border-purple-800 text-xs font-bold px-3 py-1 rounded-full">Computer Vision</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2024</span>
        </div>
        <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Real-time Object Detection for Autonomous Vehicle using YOLOv8
        </h3>
        <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
          Penelitian ini berfokus pada optimasi algoritma YOLOv8 untuk mendeteksi objek lalu lintas secara real-time pada kendaraan otonom dengan akurasi tinggi di kondisi minim cahaya.
        </p>
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Oleh: <span class="text-slate-300">Mamluatul H.</span></span>
                <a href="#" class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors">Detail <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>
      </div>

      <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
        <div class="flex justify-between items-start mb-4">
          <span class="bg-blue-900/30 text-blue-300 border border-blue-800 text-xs font-bold px-3 py-1 rounded-full">NLP</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2023</span>
        </div>
        <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Sentiment Analysis on Indonesian Public Policy using BERT Model
        </h3>
        <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
          Analisis sentimen masyarakat terhadap kebijakan publik di media sosial Twitter (X) menggunakan model BERT yang telah di-finetune dengan dataset bahasa Indonesia.
        </p>
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Oleh: <span class="text-slate-300">Rosa Andrie A.</span></span>
                <a href="#" class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors">Detail <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>
      </div>

      <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
        <div class="flex justify-between items-start mb-4">
          <span class="bg-indigo-900/30 text-indigo-300 border border-indigo-800 text-xs font-bold px-3 py-1 rounded-full">Decision System</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2020</span>
        </div>
        <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Pengembangan Sistem Penunjang Keputusan Penentuan UKT Mahasiswa (Metode MOORA)
        </h3>
        <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
          Sistem pendukung keputusan untuk menentukan kategori Uang Kuliah Tunggal (UKT) mahasiswa baru dengan metode Multi-Objective Optimization on the basis of Ratio Analysis.
        </p>
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Oleh: <span class="text-slate-300">Tim Peneliti</span></span>
                <a href="#" class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors">Detail <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>
      </div>

      <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
        <div class="flex justify-between items-start mb-4">
          <span class="bg-green-900/30 text-green-300 border border-green-800 text-xs font-bold px-3 py-1 rounded-full">IoT & AI</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2022</span>
        </div>
        <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Smart Agriculture: Deteksi Hama Tanaman Padi dengan Edge Computing
        </h3>
        <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
          Implementasi sistem pertanian pintar menggunakan Raspberry Pi dan kamera untuk mendeteksi hama wereng secara otomatis di lahan pertanian.
        </p>
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Oleh: <span class="text-slate-300">Mungki A.</span></span>
                <a href="#" class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors">Detail <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>
      </div>

      <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
        <div class="flex justify-between items-start mb-4">
          <span class="bg-orange-900/30 text-orange-300 border border-orange-800 text-xs font-bold px-3 py-1 rounded-full">Data Mining</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2021</span>
        </div>
        <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Prediksi Kelulusan Mahasiswa Tepat Waktu Menggunakan Algoritma C4.5
        </h3>
        <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
          Analisis data akademik mahasiswa menggunakan teknik data mining pohon keputusan (C4.5) untuk memprediksi potensi kelulusan tepat waktu.
        </p>
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Oleh: <span class="text-slate-300">Wilda Imama S.</span></span>
                <a href="#" class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors">Detail <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>
      </div>

      <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
        <div class="flex justify-between items-start mb-4">
          <span class="bg-teal-900/30 text-teal-300 border border-teal-800 text-xs font-bold px-3 py-1 rounded-full">Network Security</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2021</span>
        </div>
        <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Analisis Serangan DDoS pada Jaringan Software Defined Network (SDN)
        </h3>
        <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
          Simulasi dan mitigasi serangan Distributed Denial of Service (DDoS) pada arsitektur jaringan modern SDN menggunakan controller POX.
        </p>
        <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-500">Oleh: <span class="text-slate-300">Dr. Ulla Delfana</span></span>
                <a href="#" class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors">Detail <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>
      </div>

    </div>

    <div class="flex justify-center items-center gap-2">
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-500 hover:bg-slate-800 hover:text-white transition-colors disabled:opacity-50">
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

  <footer class="bg-slate-800 border-t border-slate-700 py-8 text-center">
    <p class="text-slate-500 text-sm">
      &copy; 2025 Laboratorium Intelligent Vision and Smart System (IVSS). <br>Politeknik Negeri Malang.
    </p>
  </footer>

</body>
</html>