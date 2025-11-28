<?php
require BASE_PATH . '/resources/views/layouts/navbar.php';

// Data news dari controller
$newsList = $newsList ?? [];

// Ambil berita terbaru untuk featured (berita pertama)
$featuredNews = !empty($newsList) ? $newsList[0] : null;

// Sisa berita untuk grid
$otherNews = !empty($newsList) ? array_slice($newsList, 1) : [];

// Function untuk format tanggal
function formatNewsDate($date) {
    if (empty($date)) return '-';
    $timestamp = strtotime($date);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    return date('d', $timestamp) . ' ' . $months[date('n', $timestamp) - 1] . ' ' . date('Y', $timestamp);
}

// Function untuk excerpt/ringkasan
function getExcerpt($content, $length = 150) {
    $content = strip_tags($content);
    if (strlen($content) <= $length) return $content;
    return substr($content, 0, $length) . '...';
}
?>

<body class="bg-slate-900 text-slate-300 selection:bg-cyan-500 selection:text-white">

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

    <?php if ($featuredNews): ?>
    <!-- Featured News (Berita Terbaru) -->
    <div class="mb-16">
      <div class="group relative bg-slate-800 border border-slate-700 rounded-3xl overflow-hidden hover:border-cyan-500/50 transition-all duration-300 shadow-lg hover:shadow-cyan-500/10">
        <div class="grid grid-cols-1 lg:grid-cols-2">
          
          <div class="relative h-64 lg:h-full overflow-hidden">
            <div class="absolute top-4 left-4 z-10">
                <span class="bg-cyan-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg uppercase tracking-wide">Terbaru</span>
            </div>
            <?php if (!empty($featuredNews['image_url'])): ?>
              <img src="<?= BASE_URL . '/' . htmlspecialchars($featuredNews['image_url']) ?>" 
                   alt="<?= htmlspecialchars($featuredNews['title']) ?>" 
                   class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
            <?php else: ?>
              <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
                <i class="fas fa-newspaper text-6xl text-slate-600"></i>
              </div>
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent lg:bg-gradient-to-r"></div>
          </div>

          <div class="p-8 lg:p-12 flex flex-col justify-center">
            <div class="flex items-center gap-3 text-sm text-cyan-400 mb-3">
              <i class="far fa-calendar-alt"></i>
              <span><?= formatNewsDate($featuredNews['published_at']) ?></span>
              <span class="text-slate-600">•</span>
              <span>Riset</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight group-hover:text-cyan-400 transition-colors">
              <?= htmlspecialchars($featuredNews['title']) ?>
            </h2>
            <p class="text-slate-400 mb-6 line-clamp-3">
              <?= getExcerpt($featuredNews['content'], 200) ?>
            </p>
            <div>
              <a href="<?= BASE_URL ?>/berita/<?= $featuredNews['id'] ?>" class="inline-flex items-center gap-2 text-white bg-cyan-600 hover:bg-cyan-500 px-6 py-3 rounded-xl font-medium transition-all shadow-lg shadow-cyan-500/20">
                Baca Selengkapnya
                <i class="fas fa-arrow-right text-sm"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Filter Section -->
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

    <!-- News Grid -->
    <?php if (!empty($otherNews)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      <?php foreach ($otherNews as $news): ?>
      <article class="group bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
        <div class="relative h-48 overflow-hidden">
          <?php if (!empty($news['image_url'])): ?>
            <img src="<?= BASE_URL . '/' . htmlspecialchars($news['image_url']) ?>" 
                 alt="<?= htmlspecialchars($news['title']) ?>" 
                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
          <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
              <i class="fas fa-newspaper text-4xl text-slate-600"></i>
            </div>
          <?php endif; ?>
          <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-sm text-cyan-400 text-xs font-bold px-3 py-1 rounded-md border border-slate-700">
            Riset
          </div>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
            <i class="far fa-clock"></i> <?= formatNewsDate($news['published_at']) ?>
          </div>
          <h3 class="text-xl font-bold text-white mb-3 leading-snug group-hover:text-cyan-400 transition-colors line-clamp-2">
            <?= htmlspecialchars($news['title']) ?>
          </h3>
          <p class="text-slate-400 text-sm line-clamp-3 mb-4 flex-grow">
            <?= getExcerpt($news['content'], 120) ?>
          </p>
          <a href="<?= BASE_URL ?>/news/<?= $news['id'] ?>" class="inline-flex items-center text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors mt-auto">
            Baca Artikel <i class="fas fa-arrow-right ml-2 text-xs"></i>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <!-- Empty State jika tidak ada berita lain -->
    <div class="text-center py-20">
      <div class="bg-slate-800/30 border border-slate-700 rounded-3xl p-12 max-w-2xl mx-auto">
        <i class="fas fa-newspaper text-6xl text-slate-600 mb-6"></i>
        <h3 class="text-2xl font-semibold text-white mb-3">Belum Ada Berita Lainnya</h3>
        <p class="text-slate-400">Nantikan berita dan artikel menarik lainnya dari IVSS Lab.</p>
      </div>
    </div>
    <?php endif; ?>

    <?php if (empty($newsList)): ?>
    <!-- Empty State jika tidak ada berita sama sekali -->
    <div class="text-center py-20">
      <div class="bg-slate-800/30 border border-slate-700 rounded-3xl p-12 max-w-2xl mx-auto">
        <i class="fas fa-newspaper text-6xl text-slate-600 mb-6"></i>
        <h3 class="text-2xl font-semibold text-white mb-3">Belum Ada Berita</h3>
        <p class="text-slate-400">Belum ada berita yang dipublikasikan saat ini.</p>
      </div>
    </div>
    <?php endif; ?>

    <!-- Pagination (akan diaktifkan nanti setelah implementasi pagination) -->
    <!-- <div class="flex justify-center items-center gap-2">
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
    </div> -->

  </main>

  <footer class="bg-slate-900 border-t border-slate-800 py-8 text-center">
    <p class="text-slate-500 text-sm">
      &copy; 2025 Laboratorium Intelligent Vision and Smart System (IVSS). <br>Politeknik Negeri Malang.
    </p>
  </footer>

</body>
</html>