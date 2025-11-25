<?php $title = 'Laboratorium Intelligent Vision and Smart System (IVSS)'; ?>
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

    <section id="visi-misi" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Visi & Misi
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Arahan dan tujuan dari IVSS Laboratory.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold text-cyan-400">Visi</h3>
                    <p class="mt-4 text-slate-300">
                        "Menjadi laboratorium riset unggulan di bidang visi komputer dan sistem cerdas yang inovatif dan diakui secara internasional, serta berkontribusi aktif dalam pengembangan teknologi untuk kemajuan masyarakat."
                    </p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-cyan-400">Misi</h3>
                    <ul class="mt-4 space-y-2 text-slate-300 list-disc list-inside">
                        <li>Melaksanakan riset berkualitas tinggi di bidang visi komputer, machine learning, dan sistem cerdas.</li>
                        <li>Mengembangkan solusi teknologi inovatif untuk memecahkan masalah industri dan sosial.</li>
                        <li>Menghasilkan publikasi ilmiah bereputasi di konferensi dan jurnal internasional.</li>
                        <li>Membangun kolaborasi strategis dengan industri, pemerintah, dan institusi akademik lainnya.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="publikasi" class="py-20 bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Publikasi Terbaru
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Hasil riset dan kontribusi kami di dunia ilmiah.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            Real-time Object Detection using Optimized YOLOv8 on Edge Devices
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Penulis: Dr. A. Budi, Savero A., dkk.
                        </p>
                        <p class="mt-4 text-sm font-medium text-cyan-400">
                            Dipublikasikan di: IEEE International Conference on Robotics (ICRA) 2025
                        </p>
                        <a href="#" class="mt-6 inline-block text-base font-medium text-cyan-400 hover:text-cyan-300">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            A Novel Approach for Anomaly Detection in Industrial Manufacturing
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Penulis: Prof. C. Dewi, dkk.
                        </p>
                        <p class="mt-4 text-sm font-medium text-cyan-400">
                            Dipublikasikan di: Journal of Machine Learning Research (JMLR) Vol. 26
                        </p>
                        <a href="#" class="mt-6 inline-block text-base font-medium text-cyan-400 hover:text-cyan-300">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            Semantic Segmentation for Autonomous Driving in Tropical Environments
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Penulis: Dr. E. Fajar, dkk.
                        </p>
                        <p class="mt-4 text-sm font-medium text-cyan-400">
                            Dipublikasikan di: CVPR Workshop 2025
                        </p>
                        <a href="#" class="mt-6 inline-block text-base font-medium text-cyan-400 hover:text-cyan-300">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Tim Riset Kami
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Dosen, peneliti, dan mahasiswa yang berdedikasi.
                </p>
            </div>

            <h3 class="mt-16 text-2xl font-semibold text-white text-center">Dosen & Pembimbing</h3>
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div class="text-center bg-slate-800 p-6 rounded-lg shadow-xl">
                    <img class="w-32 h-32 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/256x256/334155/E0F2FE?text=Foto+Dosen"
                         alt="Foto Dosen 1">
                    <h4 class="mt-4 text-xl font-medium text-white">Prof. Dr. Ir. C. Dewi, M.Sc.</h4>
                    <p class="text-base font-medium text-cyan-400">Kepala Laboratorium</p>
                    <p class="mt-2 text-sm text-slate-400">Keahlian: Deep Learning, AI Ethics</p>
                </div>
                <div class="text-center bg-slate-800 p-6 rounded-lg shadow-xl">
                    <img class="w-32 h-32 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/256x256/334155/E0F2FE?text=Foto+Dosen"
                         alt="Foto Dosen 2">
                    <h4 class="mt-4 text-xl font-medium text-white">A. Budi Santoso, S.Kom., Ph.D.</h4>
                    <p class="text-base font-medium text-cyan-400">Dosen Pembimbing</p>
                    <p class="mt-2 text-sm text-slate-400">Keahlian: Computer Vision, Robotics</p>
                </div>
                </div>

            <h3 class="mt-16 text-2xl font-semibold text-white text-center">Anggota Riset Aktif</h3>
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <div class="text-center bg-slate-800 p-4 rounded-lg shadow-lg">
                    <img class="w-24 h-24 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/128x128/334155/E0F2FE?text=Foto"
                         alt="Foto Anggota 1">
                    <h4 class="mt-3 text-lg font-medium text-white">Savero Athallah</h4>
                    <p class="text-sm font-medium text-cyan-400">Research Assistant</p>
                </div>
                 <div class="text-center bg-slate-800 p-4 rounded-lg shadow-lg">
                    <img class="w-24 h-24 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/128x128/334155/E0F2FE?text=Foto"
                         alt="Foto Anggota 2">
                    <h4 class="mt-3 text-lg font-medium text-white">Budi Doremi</h4>
                    <p class="text-sm font-medium text-cyan-400">Junior Researcher</p>
                </div>
                </div>
        </div>
    </section>

    <section id="fasilitas" class="py-20 bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Fasilitas & Peralatan
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Infrastruktur pendukung riset kelas dunia.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                                        <img class="h-56 w-full object-cover"
                         src="https://images.unsplash.com/photo-1633555774810-70430678b43c?q=80&w=2070&auto=format&fit=crop"
                         alt="GPU Server">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            High-Performance GPU Server
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Dilengkapi dengan NVIDIA A100 & H100 untuk training model deep learning skala besar.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                                        <img class="h-56 w-full object-cover"
                         src="https://images.unsplash.com/photo-1567443024551-f3e3cc2be874?q=80&w=2070&auto=format&fit=crop"
                         alt="Robotic Arm">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            Robotics & Automation Set
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Lengan robot industri, drone, dan sensor LiDAR untuk riset autonomous systems.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                                        <img class="h-56 w-full object-cover"
                         src="https://images.unsplash.com/photo-1535016120720-40c646be5580?q=80&w=2070&auto=format&fit=crop"
                         alt="VR/AR Equipment">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            VR/AR Development Kit
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Perangkat Meta Quest 3 dan HoloLens 2 untuk pengembangan aplikasi mixed reality.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div> <?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>