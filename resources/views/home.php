<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laboratorium IVSS</title>

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

<body class="bg-slate-900 text-slate-300">

  <section class="bg-gradient-to-tr from-slate-900 via-slate-800 to-slate-800 px-6 pt-20 pb-24 lg:pt-28 lg:pb-32">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-12 lg:gap-16">
      <div class="flex-1 flex flex-col gap-6">
        <h1 class="font-extrabold leading-tight text-white" style="font-size: 42px; line-height: 1.2;">
          Explore the Future <br>
          <span class="text-cyan-400">of Vision & Systems</span>
        </h1>
         <p class="text-slate-300 text-left" style="font-size: 18px; font-weight: 500; line-height: 1.7;">
          <span class="text-cyan-400 font-semibold">Laboratorium Visi Cerdas dan Sistem Cerdas</span> 
          merupakan pusat riset dan pengembangan di bawah Jurusan Teknologi Informasi Politeknik Negeri Malang yang berfokus pada bidang intelligent vision dan smart system. 
          <br><br>
          Penelitian di laboratorium ini mengintegrasikan computer vision, AI, dan IoT untuk menciptakan solusi inovatif.
        </p>
      </div>
      <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=800" 
           alt="Robot AI" class="w-full max-w-md rounded-xl shadow-xl opacity-100" />
    </div>
  </section>

  <section id="visi-misi" class="scroll-mt-[100px] max-w-7xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-8 lg:p-10">
      <h2 class="text-cyan-400 text-3xl font-bold mb-5 text-center">Visi</h2>
      <p class="text-slate-300 text-lg leading-relaxed text-justify">
        Menjadi laboratorium unggulan dalam pengembangan teknologi penglihatan cerdas (Intelligent Vision) dan sistem cerdas terintegrasi (Smart Systems) yang inovatif, aplikatif, serta berdaya saing nasional dan internasional.
      </p>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-8 lg:p-10">
      <h2 class="text-cyan-400 text-3xl font-bold mb-5 text-center">Misi</h2>
      <ul class="list-disc list-inside text-slate-300 text-lg leading-relaxed space-y-3">
        <li>Melaksanakan penelitian dan inovasi di bidang computer vision, artificial intelligence, dan smart systems.</li>
        <li>Menyediakan fasilitas riset dan pelatihan bagi dosen dan mahasiswa Polinema.</li>
        <li>Mendorong kolaborasi akademik dan industri dalam penerapan teknologi intelligent vision.</li>
        <li>Menghasilkan publikasi ilmiah, prototipe, dan produk inovatif.</li>
      </ul>
    </div>
  </section>

  <!-- dokumentasi kegiatan -->
  <section class="max-w-7xl mx-auto px-6 py-16 lg:py-24 bg-slate-900 border-t border-slate-700">
    
    <div class="text-center mb-12">
        <span class="text-cyan-400 font-semibold tracking-wider uppercase text-sm">Galeri</span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">
            Dokumentasi Kegiatan
        </h2>
    </div>

    <div class="relative w-full max-w-4xl mx-auto group" data-carousel="slide">
        
        <div class="relative overflow-hidden rounded-2xl shadow-2xl border border-slate-700 aspect-video">
            <div class="flex transition-transform duration-700 ease-in-out h-full" data-carousel-body>
                
                <div class="w-full flex-shrink-0 h-full relative">
                  <img src="img/Workshop.jpg" 
                  class="w-full h-full object-cover" alt="Dokumentasi 2">
                  <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                    <p class="text-white font-semibold text-lg">Workshop Pengolahan Citra Dan Vision</p>
                    </div>
                  </div>
                  
                  <div class="w-full flex-shrink-0 h-full relative">
                    <img src="img/Cam-IntelRealSense.jpg" 
                    class="w-full h-full object-cover" alt="Dokumentasi 1">
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                       <p class="text-white font-semibold text-lg">Kamera 3D Khusus Riset</p>
                    </div>
                </div>

                <div class="w-full flex-shrink-0 h-full relative">
                    <img src="img/Komputer.jpg" 
                         class="w-full h-full object-cover" alt="Dokumentasi 3">
                     <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                        <p class="text-white font-semibold text-lg">Perangkat komputer untuk pemrosesan data, pengujian, dan riset.</p>
                    </div>
                </div>

            </div>
        </div>

        <button type="button" data-carousel-prev 
                class="absolute top-1/2 left-4 -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 text-white hover:bg-cyan-500 hover:text-white backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 focus:outline-none">
            <i class="fas fa-chevron-left"></i>
        </button>

        <button type="button" data-carousel-next 
                class="absolute top-1/2 right-4 -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 text-white hover:bg-cyan-500 hover:text-white backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 focus:outline-none">
            <i class="fas fa-chevron-right"></i>
        </button>

    </div>
  </section>
  <section id="riset-penelitian" class="max-w-7xl mx-auto px-6 py-16 lg:py-24 bg-slate-800 border-y border-slate-700">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-cyan-400 mb-3">Riset dan Penelitian</h2>
      <p class="text-slate-400 text-lg">Publikasi dan kontribusi ilmiah dari dosen dan peneliti Laboratorium IVSS</p>
    </div>

    <div class="flex flex-wrap justify-center gap-4 mb-10">
      <button class="px-6 py-2.5 bg-cyan-600 text-white font-semibold rounded-lg shadow-md hover:bg-cyan-500 transition-all">Most Cited</button>
      <button class="px-6 py-2.5 bg-slate-700 border border-slate-600 text-slate-300 rounded-lg font-semibold hover:border-cyan-500 hover:text-cyan-400 transition-all">Latest</button>
      <button class="px-6 py-2.5 bg-slate-700 border border-slate-600 text-slate-300 rounded-lg font-semibold hover:border-cyan-500 hover:text-cyan-400 transition-all">Oldest</button>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group">
        <div class="flex items-start justify-between mb-4">
          <span class="bg-purple-900/30 text-purple-300 border border-purple-800 text-xs font-bold px-3 py-1 rounded-full">Computer Vision</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2020</span>
        </div>
        <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Comparison of Viola-Jones Haar Cascade Classifier and Histogram of Oriented Gradients (HOG)
        </h3>
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-2 text-slate-400">
            <i class="fas fa-quote-right text-xs"></i>
            <span class="text-sm font-semibold">145 citations</span>
          </div>
        </div>
        <a href="#" class="block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm">BACA</a>
      </div>

      <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group">
        <div class="flex items-start justify-between mb-4">
          <span class="bg-blue-900/30 text-blue-300 border border-blue-800 text-xs font-bold px-3 py-1 rounded-full">Data Science</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2017</span>
        </div>
        <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Study of Hoax News Detection using Naïve Bayes Classifier in Indonesian Language
        </h3>
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-2 text-slate-400">
            <i class="fas fa-quote-right text-xs"></i>
            <span class="text-sm font-semibold">111 citations</span>
          </div>
        </div>
        <a href="#" class="block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm">BACA</a>
      </div>

      <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group">
        <div class="flex items-start justify-between mb-4">
          <span class="bg-indigo-900/30 text-indigo-300 border border-indigo-800 text-xs font-bold px-3 py-1 rounded-full">AI Decision System</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2020</span>
        </div>
        <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Pengembangan Sistem Penunjang Keputusan Penentuan UKT Mahasiswa (Metode MOORA)
        </h3>
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-2 text-slate-400">
            <i class="fas fa-quote-right text-xs"></i>
            <span class="text-sm font-semibold">85 citations</span>
          </div>
        </div>
        <a href="#" class="block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm">BACA</a>
      </div>
    </div>
  </section>

  <section id="anggota-lab" class="relative px-6 py-20 lg:py-28 bg-slate-900 overflow-hidden">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-cyan-500/5 rounded-full blur-[100px] -z-0 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto">

      <div class="text-center mb-16">
        <span class="text-cyan-400 font-semibold tracking-wider uppercase text-sm">Tim Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-white mt-2 mb-4">
          Anggota Laboratorium
        </h2>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">
          Para peneliti dan ahli yang berdedikasi mengembangkan inovasi di bidang visi komputer dan sistem cerdas.
        </p>
      </div>

      <div class="mb-16">
        <div class="group relative bg-slate-800/50 border border-slate-700 hover:border-cyan-500/50 rounded-3xl p-8 transition-all duration-500 hover:shadow-2xl hover:shadow-cyan-500/10 max-w-2xl mx-auto backdrop-blur-sm">
          
          <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <div class="relative shrink-0">
              <div class="w-48 h-48 rounded-full p-1 bg-gradient-to-br from-slate-700 to-slate-800 group-hover:from-cyan-400 group-hover:to-blue-600 transition-all duration-500">
                <img class="w-full h-full rounded-full object-cover border-4 border-slate-800" 
                     src="Anggota_Lab/Ulla_Delfana.jpg" 
                     alt="Ulla Delfana" />
              </div>
              <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-cyan-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border border-slate-900">
                HEAD OF LAB
              </div>
            </div>

            <div class="text-center md:text-left flex-1">
              <h3 class="text-[20px] font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                Dr. Ulla Delfana Rosiani, ST., MT.
              </h3>
              <p class="text-slate-400 mb-6 text-lg leading-relaxed">
                Memimpin visi dan strategi riset laboratorium dalam pengembangan teknologi kecerdasan buatan terdepan.
              </p>
              
              <a href="./Peneliti/UllaDelfana.php" 
                 class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-700 text-white font-medium hover:bg-cyan-600 transition-all duration-300 group-hover:pl-8">
                Lihat Profil Lengkap
                <i class="fas fa-arrow-right text-sm"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors" 
                   src="Anggota_Lab/Mamluatul_Haniah.jpg" alt="Mamluatul Haniah" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                Mamluatul Hani'ah,
              </h4>
             <p class="text-[16px] text-slate-100 uppercase tracking-wider font-semibold">S.Kom., M.Kom.</p>
            </div>
          </div>
          <div class="border-t border-slate-700/50 my-4"></div>
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Researcher</span>
            <a href="./Peneliti/mamluatulHaniah.php" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>

        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors" 
                   src="Anggota_Lab/Rosa_Andrie_Asmara.jpg" alt="Rosa Andrie" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                Prof. Rosa Andrie A.,
              </h4>
              <p class="text-[16px] text-slate-100 uppercase tracking-wider font-semibold">ST., MT., Dr. Eng</p>
            </div>
          </div>
          <div class="border-t border-slate-700/50 my-4"></div>
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Professor</span>
            <a href="./Peneliti/RosaAndrie.php" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>

        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors" 
                   src="Anggota_Lab/Mungki_Astiningrum.jpg" alt="Mungki Astiningrum" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                Mungki Astiningrum,
              </h4>
              <p class="text-[16px] text-slate-100 uppercase tracking-wider font-semibold">ST., M.Kom.</p>
            </div>
          </div>
          <div class="border-t border-slate-700/50 my-4"></div>
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Researcher</span>
            <a href="./Peneliti/MungkiAstiningrum.php" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>

        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors" 
                   src="Anggota_Lab/Vivi_Nur.jpg" alt="Vivi Nur" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                Vivi Nur W.,
              </h4>
              <p class="text-[16px] text-slate-100 uppercase tracking-wider font-semibold">S.Kom., M.Kom.</p>
            </div>
          </div>
          <div class="border-t border-slate-700/50 my-4"></div>
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Researcher</span>
            <a href="./Peneliti/ViviNur.php" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>

        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors" 
                   src="Anggota_Lab/Ely_Setyo_Astuti.jpg" alt="Ely Setyo" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                Dr. Ely Setyo Astuti,
              </h4>
             <p class="text-[16px] text-slate-100 uppercase tracking-wider font-semibold">ST., MT.</p>
            </div>
          </div>
          <div class="border-t border-slate-700/50 my-4"></div>
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Researcher</span>
            <a href="./Peneliti/ElySetyo.php" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>

        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors" 
                   src="Anggota_Lab/Wilda_Imama_Sabilla.jpg" alt="Wilda Imama" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                Wilda Imama S.,
              </h4>
              <p class="text-[16px] text-slate-100 uppercase tracking-wider font-semibold">S.Kom., M.Kom.</p>
            </div>
          </div>
          <div class="border-t border-slate-700/50 my-4"></div>
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full">Researcher</span>
            <a href="./Peneliti/WildaImama.php" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>
  <script src="carousel.js"></script>

</body>
</html>

</div> <?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>