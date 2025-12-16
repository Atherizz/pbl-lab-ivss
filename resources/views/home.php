<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<style>
  /* ... (STYLE LAMA ANDA TETAP SAMA) ... */
  @keyframes float {

    0%,
    100% {
      transform: translateY(0px);
    }

    50% {
      transform: translateY(-20px);
    }
  }

  @keyframes pulse-glow {

    0%, 
    100% {
      opacity: 0.5;
      transform: scale(1);
    }

    50% {
      opacity: 0.8;
      transform: scale(1.05);
    }
  }

  @keyframes scan-line {
    0% {
      transform: translateY(-100%);
    }

    100% {
      transform: translateY(100%);
    }
  }

  @keyframes fade-in-up {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes grid-pulse {

    0%,
    100% {
      opacity: 0.1;
    }

    50% {
      opacity: 0.3;
    }
  }

  .animate-float {
    animation: float 6s ease-in-out infinite;
  }

  .animate-pulse-glow {
    animation: pulse-glow 3s ease-in-out infinite;
  }

  .animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
    opacity: 0;
  }

  .delay-100 {
    animation-delay: 0.1s;
  }

  .delay-200 {
    animation-delay: 0.2s;
  }

  .delay-300 {
    animation-delay: 0.3s;
  }

  .delay-400 {
    animation-delay: 0.4s;
  }

  .delay-500 {
    animation-delay: 0.5s;
  }

  .grid-pattern {
    background-image: linear-gradient(rgba(6, 182, 212, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(6, 182, 212, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: grid-pulse 4s ease-in-out infinite;
  }

  .scan-line {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.8), transparent);
    animation: scan-line 3s linear infinite;
  }
</style>

<body class="bg-slate-900 text-slate-300">

  <section
    class="relative bg-slate-900 px-4 sm:px-6 pt-16 sm:pt-20 pb-20 sm:pb-24 lg:pt-28 lg:pb-32 overflow-hidden">
    <div class="absolute inset-0 grid-pattern opacity-50"></div>

    <div class="absolute top-20 left-10 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl animate-pulse-glow"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse-glow"
      style="animation-delay: 1.5s;"></div>

    <div
      class="relative z-10 max-w-7xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-8 sm:gap-12 lg:gap-16">
      <div class="flex-1 flex flex-col gap-4 sm:gap-6 text-center lg:text-left">
        <h1 class="font-extrabold leading-tight text-white animate-fade-in-up text-3xl sm:text-4xl lg:text-5xl xl:text-[42px]">
          Explore the Future <br>
          <span class="text-cyan-400">of Vision & Systems</span>
        </h1>
        <p class="text-slate-300 animate-fade-in-up delay-200 text-base sm:text-lg leading-relaxed"
          style="font-weight: 500;">
          <span class="text-cyan-400 font-semibold">Laboratorium Visi Cerdas dan Sistem Cerdas</span>
          merupakan pusat riset dan pengembangan di bawah Jurusan Teknologi Informasi Politeknik Negeri Malang yang
          berfokus pada bidang intelligent vision dan smart system.
          <br><br class="hidden sm:block">
          Penelitian di laboratorium ini mengintegrasikan computer vision, AI, dan IoT untuk menciptakan solusi
          inovatif.
        </p>
      </div>
      <div class="relative animate-fade-in-up delay-300 w-full max-w-xs sm:max-w-sm lg:max-w-md">
        <img src="<?= BASE_URL ?>/assets/logo.webp" alt="IVSS Lab Logo" class="relative w-full animate-float"
          style="filter: drop-shadow(0 0 30px rgba(6, 182, 212, 0.3));" />
      </div>
    </div>
  </section>

  <section id="visi-misi"
    class="scroll-mt-[100px] bg-slate-900 border-t border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10">
    <div
      class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-8 lg:p-10 animate-fade-in-up delay-100 hover:border-cyan-500/50 transition-all duration-500 hover:shadow-cyan-500/20 hover:shadow-2xl group">
      <div class="relative overflow-hidden rounded-2xl mb-5">
        <h2
          class="text-cyan-400 text-3xl font-bold text-center group-hover:scale-105 transition-transform duration-300">
          Visi</h2>
      </div>
      <p class="text-slate-300 text-lg leading-relaxed text-justify">
        Menjadi laboratorium unggulan dalam pengembangan teknologi penglihatan cerdas (Intelligent Vision) dan sistem
        cerdas terintegrasi (Smart Systems) yang inovatif, aplikatif, serta berdaya saing nasional dan internasional.
      </p>
    </div>

    <div
      class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-8 lg:p-10 animate-fade-in-up delay-200 hover:border-cyan-500/50 transition-all duration-500 hover:shadow-cyan-500/20 hover:shadow-2xl group">
      <div class="relative overflow-hidden rounded-2xl mb-5">
        <h2
          class="text-cyan-400 text-3xl font-bold text-center group-hover:scale-105 transition-transform duration-300">
          Misi</h2>
      </div>
      <ul class="list-disc list-inside text-slate-300 text-lg leading-relaxed space-y-3">
        <li class="hover:text-cyan-400 transition-colors duration-300">Melaksanakan penelitian dan inovasi di bidang
          computer vision, artificial intelligence, dan smart systems.</li>
        <li class="hover:text-cyan-400 transition-colors duration-300">Menyediakan fasilitas riset dan pelatihan bagi
          dosen dan mahasiswa Polinema.</li>
        <li class="hover:text-cyan-400 transition-colors duration-300">Mendorong kolaborasi akademik dan industri dalam
          penerapan teknologi intelligent vision.</li>
        <li class="hover:text-cyan-400 transition-colors duration-300">Menghasilkan publikasi ilmiah, prototipe, dan
          produk inovatif.</li>
      </ul>
    </div>
    </div>
  </section>

  <section
    class="relative bg-slate-900 border-t border-slate-800 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 relative z-10">
    <div class="relative z-10 text-center mb-12 animate-fade-in-up">
      <span class="text-cyan-400 font-semibold tracking-wider uppercase text-sm">Galeri</span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">Dokumentasi Kegiatan</h2>
    </div>

    <div class="relative w-full max-w-4xl mx-auto group animate-fade-in-up delay-200" data-carousel="slide">
      <div
        class="relative overflow-hidden rounded-2xl shadow-2xl border border-slate-700 aspect-video hover:border-cyan-500/50 transition-all duration-500">

        <div class="scan-line"></div>

        <div class="flex transition-transform duration-700 ease-in-out h-full" data-carousel-body>
          <?php if (!empty($galeryItems)): ?>
            <?php foreach ($galeryItems as $item): ?>
              <div class="w-full flex-shrink-0 h-full relative">
                <img src="<?= BASE_URL . '/' . htmlspecialchars($item['image_url']) ?>" class="w-full h-full object-cover"
                  alt="Dokumentasi">

                <div
                  class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent p-6 pt-24">
                  <p class="text-white font-semibold text-lg drop-shadow-md">
                    <?= htmlspecialchars($item['caption']) ?>
                  </p>
                  <p class="text-cyan-400 text-xs mt-1 font-mono">
                    <i class="fas fa-calendar-alt mr-1"></i> <?= date('d M Y', strtotime($item['created_at'])) ?>
                  </p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-800 text-slate-500">
              <i class="fas fa-images text-5xl mb-4 text-slate-600"></i>
              <p>Belum ada dokumentasi kegiatan.</p>
            </div>
          <?php endif; ?>
        </div>

      </div>

      <button type="button" data-carousel-prev
        class="absolute top-1/2 left-4 -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-black/30 text-white hover:bg-cyan-500 hover:text-white backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 focus:outline-none border border-white/10">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button type="button" data-carousel-next
        class="absolute top-1/2 right-4 -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-black/30 text-white hover:bg-cyan-500 hover:text-white backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 focus:outline-none border border-white/10">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
    </div>
  </section>

  <section id="produk" class="py-20 bg-gradient-to-b from-slate-900 to-slate-800 border-t border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <?php 
        // --- DEFINISI MAP WARNA TAG (Disesuaikan LIGHT MODE) ---
        // Kelas background disesuaikan untuk mode gelap (bg-X00)
        $tagColorMap = [
            // [Badge BG/Dark, Text, Hover Border, Hover Shadow, Hover Title Color, Button Hover BG, Button Hover Border, Feature Icon Color]
            'iot'          => ['bg-cyan-600 dark:bg-cyan-700', 'text-white', 'hover:border-cyan-500/50', 'hover:shadow-cyan-500/10', 'group-hover:text-cyan-400', 'hover:bg-cyan-600', 'hover:border-cyan-600', 'text-cyan-500'],
            'monitoring'   => ['bg-cyan-600 dark:bg-cyan-700', 'text-white', 'hover:border-cyan-500/50', 'hover:shadow-cyan-500/10', 'group-hover:text-cyan-400', 'hover:bg-cyan-600', 'hover:border-cyan-600', 'text-cyan-500'],
            'ai'           => ['bg-purple-600 dark:bg-purple-700', 'text-white', 'hover:border-purple-500/50', 'hover:shadow-purple-500/10', 'group-hover:text-purple-400', 'hover:bg-purple-600', 'hover:border-purple-600', 'text-purple-500'],
            'vision'       => ['bg-purple-600 dark:bg-purple-700', 'text-white', 'hover:border-purple-500/50', 'hover:shadow-purple-500/10', 'group-hover:text-purple-400', 'hover:bg-purple-600', 'hover:border-purple-600', 'text-purple-500'],
            'smart'        => ['bg-purple-600 dark:bg-purple-700', 'text-white', 'hover:border-purple-500/50', 'hover:shadow-purple-500/10', 'group-hover:text-purple-400', 'hover:bg-purple-600', 'hover:border-purple-600', 'text-purple-500'],
            'riset'        => ['bg-green-600 dark:bg-green-700', 'text-white', 'hover:border-green-500/50', 'hover:shadow-green-500/10', 'group-hover:text-green-400', 'hover:bg-green-600', 'hover:border-green-600', 'text-green-500'],
            'inovasi'      => ['bg-green-600 dark:bg-green-700', 'text-white', 'hover:border-green-500/50', 'hover:shadow-green-500/10', 'group-hover:text-green-400', 'hover:bg-green-600', 'hover:border-green-600', 'text-green-500'],
            
            // Default warna
            'default'      => ['bg-gray-600 dark:bg-gray-700', 'text-white', 'hover:border-gray-500/50', 'hover:shadow-gray-500/10', 'group-hover:text-gray-400', 'hover:bg-gray-600', 'hover:border-gray-600', 'text-gray-500'],
        ];
        // --- AKHIR DEFINISI MAP ---


        // Ambil hanya dua produk pertama untuk ditampilkan di home page
        $displayedProducts = $products ?? []; 
        $delay = 100;
        ?>
        
        <div class="text-center mb-16 animate-fade-in-up">
            <span class="text-cyan-400 font-bold tracking-wider uppercase text-sm">Hilirisasi Riset</span>
            <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">Produk & <span class="text-blue-500">Inovasi</span></h2>
            <p class="text-slate-400 max-w-2xl mx-auto mt-2">Solusi teknologi tepat guna hasil pengembangan riset laboratorium IVSS.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            
            <?php 
            if (!empty($displayedProducts)) :
                foreach ($displayedProducts as $product) : 
                    // Logika untuk menafsirkan data JSON (produk_type & features)
                    $tags = is_string($product['produk_type'] ?? '[]') ? json_decode($product['produk_type'], true) : ($product['produk_type'] ?? []);
                    $features = is_string($product['features'] ?? '[]') ? json_decode($product['features'], true) : ($product['features'] ?? []);
                    if (!is_array($tags)) $tags = [];
                    if (!is_array($features)) $features = [];

                    $firstTag = $tags[0] ?? 'Inovasi';
                    $tagLower = strtolower($firstTag);

                    // --- MENGAMBIL WARNA DARI MAP ---
                    $colorKey = $tagColorMap[$tagLower] ?? $tagColorMap['default'];
                    list($bgColor, $textColor, $hoverBorder, $hoverShadow, $hoverTitleColor, $hoverButtonBg, $hoverButtonBorder, $featureColor) = $colorKey;
                    // --- AKHIR PENGAMBILAN WARNA ---
            ?>

            <div class="group bg-slate-900 rounded-2xl border border-slate-700 overflow-hidden 
                <?= $hoverBorder ?> transition-all duration-300 hover:shadow-xl <?= $hoverShadow ?> 
                animate-fade-in-up delay-<?= $delay ?>00">
                <div class="relative h-56 overflow-hidden">
                    <?php if (!empty($product['image_url'])) : ?>
                        <img src="<?= BASE_URL . '/' . htmlspecialchars($product['image_url'] ?? '') ?>" alt="<?= htmlspecialchars($product['judul'] ?? 'Produk') ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <?php endif; ?>
                    
                    <?php if (!empty($tags)) : ?>
                        <div class="absolute top-3 right-3 
                            <?= $bgColor ?> 
                            <?= $textColor ?> 
                            text-xs font-bold px-3 py-1 rounded-full shadow-lg
                            ring-2 ring-white/50 dark:ring-gray-900/50"> <?= htmlspecialchars($firstTag) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-white mb-2 <?= $hoverTitleColor ?> transition-colors"><?= htmlspecialchars($product['judul'] ?? 'Judul Produk') ?></h3>
                    <p class="text-slate-400 text-sm mb-4 leading-relaxed">
                        <?= htmlspecialchars($product['deskripsi'] ?? 'Deskripsi produk belum tersedia.') ?>
                    </p>
                    <ul class="text-sm text-slate-500 space-y-2 mb-6">
                        <?php foreach (array_slice($features, 0, 3) as $feature) : ?>
                            <?php $featureTitle = htmlspecialchars($feature['judul'] ?? 'Fitur'); ?>
                            <li class="flex items-center gap-2"><i class="fas fa-check <?= $featureColor ?>"></i> <?= $featureTitle ?></li>
                        <?php endforeach; ?>
                        <?php if (count($features) > 3) : ?>
                            <li class="flex items-center gap-2 text-xs text-slate-500">+<?= count($features) - 3 ?> fitur lainnya</li>
                        <?php endif; ?>
                    </ul>
                    <a href="<?= htmlspecialchars($product['produk_url'] ?? '#') ?>"
                        target="_blank" 
                        class="w-full py-3 border border-slate-600 text-slate-300 rounded-xl <?= $hoverButtonBg ?> hover:text-white <?= $hoverButtonBorder ?> transition-all text-sm font-bold block text-center">
                        Lihat Detail Produk
                    </a>
                </div>
            </div>

            <?php 
                $delay++; 
                endforeach; 
            else : 
            ?>
            
            <div class="md:col-span-2 text-center py-10 text-slate-400">
                <i class="fas fa-box text-5xl mb-3 text-slate-700"></i>
                <p>Belum ada produk inovasi yang terdaftar saat ini.</p>
            </div>

            <?php endif; ?>

        </div>
        
        <?php if (!empty($products) && count($products) > 2) : ?>
        <div class="text-center mt-12">
            <a href="<?= BASE_URL . '/produk' ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition duration-150">
                Lihat Semua Inovasi <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
  </section>



  <section id="pelatihan" class="py-20 bg-gradient-to-b from-slate-800 to-slate-900 border-t border-slate-800 relative overflow-hidden">

    <div class="absolute left-0 top-1/2 -translate-x-1/2 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
      <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4 animate-fade-in-up">
        <div class="text-center md:text-left">
          <span class="text-cyan-400 font-bold tracking-wider uppercase text-sm">Edukasi</span>
          <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">Program <span
              class="text-cyan-400">Pelatihan</span></h2>
          <p class="text-slate-400 mt-2">Tingkatkan skill Anda bersama para ahli dari Laboratorium IVSS.</p>
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-6">

        <?php if (!empty($courses)): ?>
          <?php
          $delay = 100; // Untuk animasi delay bertingkat
          foreach ($courses as $index => $course):
            // Logika Variasi Warna (Ganjil: Cyan, Genap: Blue/Purple) biar tidak monoton
            $isEven = $index % 2 == 0;
            $themeColor = $isEven ? 'cyan' : 'blue';

            // Bersihkan nama icon dari database (misal: 'brain-icon' jadi 'brain')
            $iconName = str_replace('-icon', '', $course['icon_name'] ?? 'layer-group');
            ?>

            <div
              class="bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-<?= $themeColor ?>-500 transition-all group relative flex flex-col animate-fade-in-up delay-<?= $delay ?>">

              <div
                class="w-14 h-14 bg-<?= $themeColor ?>-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-<?= $themeColor ?>-500/20 transition-colors">
                <i class="fas fa-<?= $iconName ?> text-<?= $themeColor ?>-400 text-2xl"></i>
              </div>

              <h3 class="text-2xl font-bold text-white mb-3"><?= htmlspecialchars($course['title']) ?></h3>

              <p class="text-slate-400 text-sm mb-6 flex-grow leading-relaxed">
                <?= htmlspecialchars($course['description']) ?>
              </p>

              <div class="flex items-center justify-between pt-6 border-t border-slate-700">
                <div class="flex gap-4 text-xs text-slate-500 font-mono">
                  <span>
                    <i class="fas fa-layer-group mr-1"></i>
                    <?= htmlspecialchars($course['level']) ?>
                  </span>
                  <span>
                    <i class="far fa-clock mr-1"></i>
                    <?= htmlspecialchars($course['total_sessions']) ?> Pertemuan
                  </span>
                </div>
                <a href="<?= htmlspecialchars($course['action_url']) ?>"
                  class="text-<?= $themeColor ?>-400 text-sm font-bold hover:underline">
                  Daftar Sekarang <i class="fas fa-arrow-right ml-1"></i>
                </a>
              </div>

            </div>

            <?php
            // Increment delay agar animasi muncul satu per satu
            $delay += 100;
          endforeach;
          ?>

        <?php else: ?>
          <div class="col-span-2 text-center py-12 border border-dashed border-slate-700 rounded-2xl">
            <i class="fas fa-folder-open text-slate-600 text-4xl mb-4"></i>
            <p class="text-slate-400">Belum ada program pelatihan yang tersedia saat ini.</p>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>


  <section id="riset-penelitian"
    class="relative bg-slate-900 border-t border-slate-800 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 relative z-10">
    <div class="absolute inset-0 grid-pattern opacity-30"></div>

    <div class="relative z-10 text-center mb-12 animate-fade-in-up">
      <h2 class="text-4xl font-bold text-cyan-400 mb-3">Riset dan Penelitian</h2>
      <p class="text-slate-400 text-lg">Publikasi dan kontribusi ilmiah dari dosen dan peneliti Laboratorium IVSS</p>
    </div>
    <div class="relative z-10 grid md:grid-cols-3 gap-8">

      <?php foreach ($publications as $publication): ?>
        <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 
              hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/20 
              hover:border-cyan-500/50 transition-all duration-500 group 
              animate-fade-in-up delay-200 flex flex-col h-full">

          <div class="flex items-start justify-between mb-4">
            <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">
              <?= $publication['year'] ?>
            </span>
          </div>

          <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
            <?= $publication['title'] ?>
          </h3>

          <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2 text-slate-400 group-hover:text-cyan-400 transition-colors">
              <i class="fas fa-quote-right text-xs"></i>
              <span class="text-sm font-semibold"><?= $publication['cited_by_count'] ?> citations</span>
            </div>
          </div>

          <a href="<?= $publication['scholar_link'] ?>" class="mt-auto block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg 
                font-semibold hover:bg-cyan-600 hover:text-white transition-all 
                shadow-sm transform hover:scale-105">
            Baca Selengkapnya
          </a>

        </div>
      <?php endforeach; ?>

    </div>

    <div class="relative z-10 text-center mt-12 animate-fade-in-up delay-500">
      <a href="<?= BASE_URL ?? '.' ?>/publikasi"
        class="inline-flex items-center gap-2 px-8 py-3 bg-cyan-600 text-white font-semibold rounded-lg shadow-lg hover:bg-cyan-500 hover:shadow-xl hover:shadow-cyan-500/30 transition-all transform hover:scale-105 hover:-translate-y-1">
        Lihat Semua Riset
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    </div>
  </section>

  <section id="anggota-lab" class="relative px-6 py-20 lg:py-28 bg-gradient-to-b from-slate-900 to-slate-800 border-t border-slate-800 overflow-hidden">

    <div
      class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-cyan-500/5 rounded-full blur-[100px] -z-0 pointer-events-none animate-pulse-glow">
    </div>
    <div class="absolute inset-0 grid-pattern opacity-20"></div>

    <div class="relative z-10 max-w-7xl mx-auto">

      <div class="text-center mb-16 animate-fade-in-up">
        <span class="text-cyan-400 font-semibold tracking-wider uppercase text-sm">Tim Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-white mt-2 mb-4">
          Anggota Laboratorium
        </h2>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">
          Para peneliti dan ahli yang berdedikasi mengembangkan inovasi di bidang visi komputer dan sistem cerdas.
        </p>
      </div>

      <?php
      $headOfLab = null;
      $researchers = [];
      foreach ($members as $member) {
        if ($member['user_role'] === 'admin_lab') {
          $headOfLab = $member;
        } else {
          $researchers[] = $member;
        }
      }
      ?>

      <?php if ($headOfLab): ?>
        <div class="mb-16 animate-fade-in-up delay-200">
          <div
            class="group relative bg-slate-800/50 border border-slate-700 hover:border-cyan-500/50 rounded-3xl p-8 transition-all duration-500 hover:shadow-2xl hover:shadow-cyan-500/10 max-w-2xl mx-auto backdrop-blur-sm">

            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
              <div class="relative shrink-0">
                <div
                  class="w-48 h-48 rounded-full p-1 bg-gradient-to-br from-slate-700 to-slate-800 group-hover:from-cyan-400 group-hover:to-blue-600 transition-all duration-500 group-hover:scale-105">
                  <img class="w-full h-full rounded-full object-cover border-4 border-slate-800"
                    src="<?= !empty($headOfLab['profile_photo']) ? BASE_URL . '/' . $headOfLab['profile_photo'] : 'https://ui-avatars.com/api/?name=' . urlencode($headOfLab['user_name']) ?>"
                    alt="<?= htmlspecialchars($headOfLab['user_name']) ?>" />
                </div>
                <div
                  class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-cyan-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border border-slate-900 group-hover:scale-110 transition-transform">
                  HEAD OF LAB
                </div>
              </div>

              <div class="text-center md:text-left flex-1">
                <h3 class="text-[20px] font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                  <?= htmlspecialchars($headOfLab['user_name']) ?>
                </h3>

                <a href="<?= BASE_URL ?>/profile/<?= $headOfLab['slug'] ?>"
                  class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-700 text-white font-medium hover:bg-cyan-600 transition-all duration-300 group-hover:pl-8 transform hover:scale-105">
                  Lihat Profil Lengkap
                  <i class="fas fa-arrow-right text-sm"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $delay = 300;
        foreach ($researchers as $member):
          ?>
          <div
            class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/20 animate-fade-in-up delay-<?= $delay ?>">
            <div class="flex items-center gap-4 mb-4">
              <div class="relative w-16 h-16 shrink-0">
                <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors group-hover:scale-110 duration-300"
                  src="<?= !empty($member['profile_photo']) ? BASE_URL . $member['profile_photo'] : 'https://ui-avatars.com/api/?name=' . urlencode($member['user_name']) ?>"
                  alt="<?= htmlspecialchars($member['user_name']) ?>" />
              </div>
              <div>
                <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                  <?= htmlspecialchars($member['user_name']) ?>
                </h4>
              </div>
            </div>

            <div class="border-t border-slate-700/50 my-4"></div>

            <div class="flex justify-between items-center">
              <span
                class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full group-hover:bg-cyan-500/20 group-hover:text-cyan-400 transition-colors">Researcher</span>
              <a href="<?= BASE_URL ?>/profile/<?= $member['slug'] ?>"
                class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1 transform group-hover:translate-x-1">
                Detail <i class="fas fa-chevron-right text-xs"></i>
              </a>
            </div>
          </div>
          <?php
          $delay += 100;
          if ($delay > 500)
            $delay = 300;
        endforeach;
        ?>
      </div>
    </div>
  </section>

  <!-- CTA Section: Join IVSS Lab -->
  <?php if (!isset($_SESSION['user'])): ?>
  <section class="relative bg-slate-800 border-t border-slate-700 py-20 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-cyan-900/20 via-slate-900 to-transparent"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
      <!-- Icon -->
      <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl mb-6 shadow-lg shadow-cyan-500/50 animate-pulse-glow">
        <i class="fas fa-user-plus text-white text-3xl"></i>
      </div>
      
      <!-- Heading -->
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
        Tertarik Bergabung dengan IVSS Lab?
      </h2>
      
      <!-- Description -->
      <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto leading-relaxed">
        Jadilah bagian dari komunitas peneliti dan inovator di bidang <span class="text-cyan-400 font-semibold">Computer Vision</span>, 
        <span class="text-cyan-400 font-semibold">Artificial Intelligence</span>, dan 
        <span class="text-cyan-400 font-semibold">Smart Systems</span>. Daftarkan diri Anda sekarang!
      </p>
      
      <!-- Benefits -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-cyan-500/50 transition-all duration-300">
          <div class="w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center mb-4 mx-auto">
            <i class="fas fa-flask text-cyan-400 text-xl"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Riset Berkualitas</h3>
          <p class="text-sm text-slate-400">Akses ke proyek penelitian terdepan dan publikasi ilmiah</p>
        </div>
        
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-cyan-500/50 transition-all duration-300">
          <div class="w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center mb-4 mx-auto">
            <i class="fas fa-users text-cyan-400 text-xl"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Komunitas Solid</h3>
          <p class="text-sm text-slate-400">Kolaborasi dengan mahasiswa dan dosen berpengalaman</p>
        </div>
        
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:border-cyan-500/50 transition-all duration-300">
          <div class="w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center mb-4 mx-auto">
            <i class="fas fa-certificate text-cyan-400 text-xl"></i>
          </div>
          <h3 class="text-white font-semibold mb-2">Pengalaman Berharga</h3>
          <p class="text-sm text-slate-400">Sertifikat dan pengalaman praktis di bidang teknologi</p>
        </div>
      </div>
      
      <!-- CTA Button -->
      <div class="flex items-center justify-center">
        <a href="<?= BASE_URL ?>/register" 
           class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/50 hover:shadow-cyan-500/80 transition-all duration-300 transform hover:scale-105">
          <span>Daftar Sekarang</span>
          <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
      
      <!-- Info Text -->
      <p class="mt-8 text-sm text-slate-500">
        Sudah memiliki akun? 
        <a href="<?= BASE_URL ?>/login" class="text-cyan-400 hover:text-cyan-300 font-medium underline underline-offset-2 transition-colors">
          Login di sini
        </a>
      </p>
    </div>
  </section>
  <?php endif; ?>

  <script>
    // Intersection Observer for animations
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) { entry.target.classList.add('visible'); }
      });
    }, observerOptions);
    document.querySelectorAll('.animate-on-scroll').forEach(el => { observer.observe(el); });

    // Carousel functionality
    document.addEventListener('DOMContentLoaded', function () {
      const carousel = document.querySelector('[data-carousel="slide"]');
      if (!carousel) return;
      const carouselBody = carousel.querySelector('[data-carousel-body]');
      const prevButton = carousel.querySelector('[data-carousel-prev]');
      const nextButton = carousel.querySelector('[data-carousel-next]');
      
      // Hanya hitung slides yang berisi gambar (bukan empty state)
      const slides = carouselBody.querySelectorAll('.w-full.flex-shrink-0');
      const totalSlides = slides.length;
      
      // Jika tidak ada slide atau hanya 1 slide, sembunyikan navigasi
      if (totalSlides <= 1) {
        if (prevButton) prevButton.style.display = 'none';
        if (nextButton) nextButton.style.display = 'none';
        return;
      }

      let currentIndex = 0;
      let autoplayInterval;

      function updateCarousel() {
        const offset = -currentIndex * 100;
        carouselBody.style.transform = `translateX(${offset}%)`;
      }
      
      function nextSlide() { 
        currentIndex = (currentIndex + 1) % totalSlides; 
        updateCarousel(); 
      }
      
      function prevSlide() { 
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; 
        updateCarousel(); 
      }
      
      function startAutoplay() { 
        autoplayInterval = setInterval(nextSlide, 5000); 
      }
      
      function stopAutoplay() { 
        clearInterval(autoplayInterval); 
      }

      nextButton.addEventListener('click', () => { nextSlide(); stopAutoplay(); startAutoplay(); });
      prevButton.addEventListener('click', () => { prevSlide(); stopAutoplay(); startAutoplay(); });
      carousel.addEventListener('mouseenter', stopAutoplay);
      carousel.addEventListener('mouseleave', startAutoplay);
      
      // Mulai autoplay hanya jika ada lebih dari 1 slide
      startAutoplay();
    });
  </script>

</body>

</html>

<?php require BASE_PATH . '/resources/views/layouts/home-footer.php'; ?>