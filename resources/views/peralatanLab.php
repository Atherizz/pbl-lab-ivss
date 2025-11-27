<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fasilitas dan Peralatan - IVSS Lab</title>
  
  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }
    html {
      scroll-behavior: smooth;
    }
    /* Scrollbar styling untuk dark mode */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #0f172a; 
    }
    ::-webkit-scrollbar-thumb {
      background: #334155; 
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #475569; 
    }

    /* PERUBAHAN DI SINI:
      Filter untuk membalik warna ikon (dari hitam ke putih solid).
      opacity(1) membuatnya menjadi putih pekat.
    */
    .dark-icon-filter {
      filter: invert(1) opacity(1);
    }
  </style>
</head>
<body class="bg-slate-900 text-slate-300">

  <header class="py-8 bg-slate-800 border-b border-slate-700 shadow-lg text-center relative">
    <div class="absolute left-6 top-1/2 -translate-y-1/2">
      <a href="landingPage.php" class="inline-flex items-center justify-center w-10 h-10 bg-slate-700 text-cyan-400 text-lg font-medium rounded-lg hover:bg-cyan-600 hover:text-white transition-all">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
    <h1 class="text-3xl md:text-4xl font-semibold text-cyan-400 tracking-wide">
      Fasilitas dan Peralatan
    </h1>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-16 space-y-20">
    
    <section class="grid md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-10">
      
      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/komputer.png" alt="Komputer Desktop" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Komputer Desktop</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Perangkat standar untuk pemrosesan data, pengujian, dan riset.
        </p>
      </div>
      
      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/meja-kursi.png" alt="Meja & Kursi" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Meja & Kursi</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Perabot dasar untuk menunjang kenyamanan belajar, praktikum, dan riset.
        </p>
      </div>
    </section>

    <section class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-10">
      
      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/ac.png" alt="AC" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">AC</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Pendingin ruangan untuk menjaga suhu agar tetap nyaman selama proses belajar dan riset.
        </p>
      </div>

      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/air.png" alt="Air Mineral" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Air Mineral</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Air minum untuk menjaga hidrasi dan kenyamanan pengguna fasilitas.
        </p>
      </div>

      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/camera.png" alt="Intel RealSense D415 Camera" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Intel RealSense D415</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Kamera 3D khusus untuk riset di bidang Computer Vision dan Sistem Cerdas.
        </p>
      </div>
      
      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/masjid.png" alt="Masjid" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Area Mushola</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Fasilitas khusus untuk kegiatan ibadah/sholat.
        </p>
      </div>
      
      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/cctv.png" alt="Camera 260fps" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Camera 260fps</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Kamera berkecepatan tinggi untuk analisis gerakan mendetail.
        </p>
      </div>

      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/lampu.png" alt="Peralatan Lampu" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Peralatan Lampu</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Pencahayaan optimal untuk memastikan kondisi pengambilan data visual yang konsisten.
        </p>
      </div>

      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/box-card.png" alt="Box Pengambilan Data" class="w-20 h-20 object-contain mx-auto mb-3 dark-icon-filter">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">Box Pengambilan Data</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Wadah khusus untuk mengontrol lingkungan selama pengumpulan data riset.
        </p>
      </div>
      
      <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                  transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
        <img src="Assets_Lab/IOT.png" alt="OpenMVCamH7" class="w-20 h-20 object-contain mx-auto mb-3">
        <h3 class="text-2xl font-semibold text-cyan-400 mt-4 group-hover:text-cyan-300 transition-colors">OpenMVCamH7</h3>
        <p class="mt-2 text-slate-400 text-base leading-relaxed">
          Modul kamera mikrokontroler untuk Computer Vision pada sistem embedded.
        </p>
      </div>
    </section>
  </main>

</body>
</html>