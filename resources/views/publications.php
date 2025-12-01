<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<?php
$publications      = $publications      ?? [];
$totalPublications = $totalPublications ?? 0;
$currentPage       = $currentPage       ?? 1;
$totalPages        = $totalPages        ?? 1;
$startItem         = $startItem         ?? 0;
$endItem           = $endItem           ?? 0;
$sortBy            = $sortBy            ?? 'citations';
$searchQuery       = $searchQuery       ?? '';

$baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
?>

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

  <!-- Filter bar: search + sort, tanpa tag / topik dulu -->
  <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 mb-10 shadow-lg">
    <form method="get" action="" class="flex flex-col lg:flex-row gap-4">

      <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fas fa-search text-slate-500"></i>
        </div>
        <input
          type="text"
          name="q"
          placeholder="Cari judul publikasi atau nama penulis..."
          value="<?= htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8') ?>"
          class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-slate-600 rounded-xl text-slate-200 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
      </div>

      <div class="w-full lg:w-56">
        <select
          name="sort"
          class="w-full px-4 py-3 bg-slate-900 border border-slate-600 rounded-xl text-slate-300 focus:outline-none focus:border-cyan-500 cursor-pointer">
          <option value="citations" <?= $sortBy === 'citations' ? 'selected' : '' ?>>
            Paling banyak sitasi
          </option>
          <option value="latest" <?= $sortBy === 'latest' ? 'selected' : '' ?>>
            Terbaru
          </option>
          <option value="oldest" <?= $sortBy === 'oldest' ? 'selected' : '' ?>>
            Terlama
          </option>
        </select>
      </div>

      <button
        type="submit"
        class="px-8 py-3 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-cyan-500/20">
        Terapkan
      </button>
    </form>
  </div>

  <div class="flex flex-wrap gap-4 mb-8 text-sm font-medium text-slate-400">
    <?php if ($totalPublications > 0): ?>
      <span>
        Menampilkan
        <span class="text-white"><?= $startItem ?></span> -
        <span class="text-white"><?= $endItem ?></span>
        dari
        <span class="text-white"><?= $totalPublications ?></span> publikasi
      </span>
    <?php else: ?>
      <span>Tidak ada publikasi yang ditemukan.</span>
    <?php endif; ?>

    <?php if (!empty($searchQuery) || isset($_GET['sort'])): ?>
      <span class="hidden sm:inline">•</span>
      <a
        href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>"
        class="text-cyan-400 cursor-pointer hover:underline">
        Reset Filter
      </a>
    <?php endif; ?>
  </div>

  <?php if (empty($publications)): ?>
    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 text-center text-slate-400">
      Belum ada data publikasi yang dapat ditampilkan.
    </div>
  <?php else: ?>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      <?php foreach ($publications as $pub): ?>
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group flex flex-col h-full">
          <div class="flex justify-between items-start mb-4">
            <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">
              <?= htmlspecialchars($pub['year'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
            </span>
          </div>

          <h3 class="text-lg font-bold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
            <?= htmlspecialchars($pub['title'] ?? '(Tanpa judul)', ENT_QUOTES, 'UTF-8') ?>
          </h3>

          <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-grow">
            <?php if (!empty($pub['publication_venue'])): ?>
              <?= htmlspecialchars($pub['publication_venue'], ENT_QUOTES, 'UTF-8') ?>
            <?php else: ?>
              <span class="italic text-slate-500">Informasi venue belum tersedia.</span>
            <?php endif; ?>
          </p>

          <div class="border-t border-slate-700 pt-4 mt-auto">
            <div class="flex items-center justify-between gap-2">
              <span class="text-xs text-slate-500">
                Oleh:
                <span class="text-slate-300">
                  <?= htmlspecialchars($pub['author_name'] ?? $pub['authors'] ?? '-', ENT_QUOTES, 'UTF-8') ?>
                </span>
              </span>

              <?php if (!empty($pub['cited_by_count'])): ?>
                <span class="text-xs text-slate-500 whitespace-nowrap">
                  Sitasi:
                  <span class="text-slate-300">
                    <?= (int) $pub['cited_by_count'] ?>
                  </span>
                </span>
              <?php endif; ?>
            </div>

            <?php if (!empty($pub['scholar_link'])): ?>
              <div class="mt-2 text-right">
                <a
                  href="<?= htmlspecialchars($pub['scholar_link'], ENT_QUOTES, 'UTF-8') ?>"
                  target="_blank"
                  class="text-sm font-semibold text-cyan-400 hover:text-white transition-colors"
                  rel="noopener noreferrer">
                  Lihat di Google Scholar
                  <i class="fas fa-arrow-up-right-from-square ml-1 text-xs"></i>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  <?php endif; ?>
  <?php if ($totalPages > 1): ?>
    <div class="flex justify-center items-center gap-2">
      <?php
      $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');

      // Prev
      $query = $_GET;
      $query['page'] = max(1, $currentPage - 1);
      $prevUrl = $baseUrl . '?' . http_build_query($query);
      ?>
      <a
        href="<?= $currentPage > 1 ? htmlspecialchars($prevUrl, ENT_QUOTES, 'UTF-8') : 'javascript:void(0)' ?>"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-500 hover:bg-slate-800 hover:text-white transition-colors <?= $currentPage <= 1 ? 'opacity-40 pointer-events-none' : '' ?>">
        <i class="fas fa-chevron-left"></i>
      </a>

      <?php
      // ========== Page 1 & 2 ==========
      $maxFirstPages = min(2, $totalPages);
      for ($page = 1; $page <= $maxFirstPages; $page++):
        $query = $_GET;
        $query['page'] = $page;
        $pageUrl = $baseUrl . '?' . http_build_query($query);
      ?>
        <a
          href="<?= htmlspecialchars($pageUrl, ENT_QUOTES, 'UTF-8') ?>"
          class="w-10 h-10 flex items-center justify-center rounded-lg
        <?= $page == $currentPage
          ? 'bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-500/20'
          : 'border border-slate-700 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors'
        ?>">
          <?= $page ?>
        </a>
      <?php endfor; ?>

      <?php if ($totalPages > 3): ?>
        <span class="text-slate-500 px-2">...</span>
      <?php endif; ?>

      <?php if ($totalPages > 2): ?>
        <?php
        // Halaman terakhir
        $lastPage = $totalPages;
        $query = $_GET;
        $query['page'] = $lastPage;
        $lastUrl = $baseUrl . '?' . http_build_query($query);
        ?>
        <a
          href="<?= htmlspecialchars($lastUrl, ENT_QUOTES, 'UTF-8') ?>"
          class="w-10 h-10 flex items-center justify-center rounded-lg
        <?= $lastPage == $currentPage
          ? 'bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-500/20'
          : 'border border-slate-700 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors'
        ?>">
          <?= $lastPage ?>
        </a>
      <?php endif; ?>

      <?php
      // Next
      $query = $_GET;
      $query['page'] = min($totalPages, $currentPage + 1);
      $nextUrl = $baseUrl . '?' . http_build_query($query);
      ?>
      <a
        href="<?= $currentPage < $totalPages ? htmlspecialchars($nextUrl, ENT_QUOTES, 'UTF-8') : 'javascript:void(0)' ?>"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors <?= $currentPage >= $totalPages ? 'opacity-40 pointer-events-none' : '' ?>">
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>
  <?php endif; ?>


</main>

<footer class="bg-slate-800 border-t border-slate-700 py-8 text-center">
  <p class="text-slate-500 text-sm">
    &copy; 2025 Laboratorium Intelligent Vision and Smart System (IVSS). <br>Politeknik Negeri Malang.
  </p>
</footer>

</body>

</html>