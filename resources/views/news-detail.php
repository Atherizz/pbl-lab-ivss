<?php
require BASE_PATH . '/resources/views/layouts/navbar.php';

// Data news dari controller
$news = $news ?? null;
$recentNews = $recentNews ?? [];

// Function untuk format tanggal
function formatNewsDate($date) {
    if (empty($date)) return '-';
    $timestamp = strtotime($date);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    return date('d', $timestamp) . ' ' . $months[date('n', $timestamp) - 1] . ' ' . date('Y', $timestamp);
}

// Function untuk format tanggal lengkap
function formatFullDate($date) {
    if (empty($date)) return '-';
    $timestamp = strtotime($date);
    $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return date('d', $timestamp) . ' ' . $months[date('n', $timestamp) - 1] . ' ' . date('Y', $timestamp);
}

if (!$news) {
    header('Location: ' . BASE_URL . '/news');
    exit;
}
?>

<body class="bg-slate-900 text-slate-300 selection:bg-cyan-500 selection:text-white">


  <main class="max-w-7xl mx-auto px-6 py-12">

    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm font-medium text-slate-400">
      <a href="<?= BASE_URL ?>/" class="hover:text-cyan-400">Home</a>
      <span class="mx-2">/</span>
      <a href="<?= BASE_URL ?>/news" class="hover:text-cyan-400">Berita</a>
      <span class="mx-2">/</span>
      <span class="text-cyan-400 truncate max-w-xs"><?= htmlspecialchars(substr($news['title'], 0, 30)) ?>...</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

      <!-- Main Article -->
      <article class="lg:col-span-2">
        
        <div class="mb-6">
            <span class="bg-cyan-500/10 text-cyan-400 border border-cyan-500/30 text-xs font-bold px-3 py-1 rounded-full mb-4 inline-block">
                Riset
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-4">
                <?= htmlspecialchars($news['title']) ?>
            </h1>
            
            <div class="flex items-center gap-6 text-sm text-slate-400 border-b border-slate-700 pb-6">
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($news['author_name'] ?? 'Author') ?>&background=0891b2&color=fff" 
                         class="w-8 h-8 rounded-full" alt="Author">
                    <span class="text-slate-200 font-medium"><?= htmlspecialchars($news['author_name'] ?? 'Admin') ?></span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-calendar-alt"></i>
                    <span><?= formatFullDate($news['published_at']) ?></span>
                </div>
            </div>
        </div>

        <!-- Featured Image -->
        <?php if (!empty($news['image_url'])): ?>
        <div class="mb-8 rounded-2xl overflow-hidden shadow-2xl border border-slate-700">
            <img src="<?= BASE_URL . '/' . htmlspecialchars($news['image_url']) ?>" 
                 alt="<?= htmlspecialchars($news['title']) ?>" 
                 class="w-full h-auto object-cover">
            <div class="bg-slate-800 p-3 text-center text-xs text-slate-500 italic border-t border-slate-700">
                Gambar artikel: <?= htmlspecialchars($news['title']) ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Article Content -->
        <div class="article-content text-slate-300 prose prose-invert max-w-none">
            <?= nl2br($news['content']) ?>
        </div>

        <!-- Share Section -->
        <div class="mt-10 pt-8 border-t border-slate-700">
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="text-sm font-semibold text-slate-400 mr-2">Tags:</span>
                <a href="#" class="px-3 py-1 bg-slate-800 hover:bg-cyan-900 text-cyan-400 text-xs rounded-full transition-colors">#IVSS</a>
                <a href="#" class="px-3 py-1 bg-slate-800 hover:bg-cyan-900 text-cyan-400 text-xs rounded-full transition-colors">#Riset</a>
                <a href="#" class="px-3 py-1 bg-slate-800 hover:bg-cyan-900 text-cyan-400 text-xs rounded-full transition-colors">#Teknologi</a>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="font-bold text-white">Bagikan artikel ini:</span>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . '/news/' . $news['id']) ?>" 
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-500 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(BASE_URL . '/news/' . $news['id']) ?>&text=<?= urlencode($news['title']) ?>" 
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-400 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text=<?= urlencode($news['title'] . ' - ' . BASE_URL . '/news/' . $news['id']) ?>" 
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-500 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(BASE_URL . '/news/' . $news['id']) ?>" 
                       target="_blank"
                       class="w-10 h-10 rounded-full bg-blue-700 text-white flex items-center justify-center hover:bg-blue-600 transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>

      </article>

      <!-- Sidebar -->
      <aside class="lg:col-span-1 space-y-8">
        
        <!-- Search Box -->
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-bold text-white mb-4">Cari Artikel</h3>
            <form action="<?= BASE_URL ?>/news" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Kata kunci..." 
                           class="w-full bg-slate-900 border border-slate-600 text-slate-200 rounded-lg pl-4 pr-10 py-3 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-cyan-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Categories (Static untuk sementara) -->
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-bold text-white mb-4">Kategori</h3>
            <ul class="space-y-2">
                <li>
                    <a href="<?= BASE_URL ?>/news?category=riset" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2 border-b border-slate-700/50">
                        <span>Riset</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">-</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/news?category=kegiatan" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2 border-b border-slate-700/50">
                        <span>Kegiatan</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">-</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/news?category=prestasi" class="flex justify-between items-center text-slate-400 hover:text-cyan-400 transition-colors py-2">
                        <span>Prestasi</span>
                        <span class="bg-slate-700 text-xs px-2 py-1 rounded-full">-</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Recent News -->
        <?php if (!empty($recentNews)): ?>
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-lg">
            <h3 class="text-lg font-bold text-white mb-4">Berita Terbaru</h3>
            <div class="space-y-6">
                <?php foreach ($recentNews as $recent): ?>
                <a href="<?= BASE_URL ?>/news/<?= $recent['id'] ?>" class="group flex gap-4 items-start">
                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                        <?php if (!empty($recent['image_url'])): ?>
                            <img src="<?= BASE_URL . '/' . htmlspecialchars($recent['image_url']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" 
                                 alt="<?= htmlspecialchars($recent['title']) ?>">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-700 flex items-center justify-center">
                                <i class="fas fa-newspaper text-slate-600"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-200 group-hover:text-cyan-400 transition-colors line-clamp-2 leading-snug">
                            <?= htmlspecialchars($recent['title']) ?>
                        </h4>
                        <span class="text-xs text-slate-500 mt-1 block"><?= formatNewsDate($recent['published_at']) ?></span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

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

<style>
/* Styling untuk content artikel agar lebih readable */
.article-content p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
}

.article-content h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #fff;
    margin-top: 2.5rem;
    margin-bottom: 1rem;
}

.article-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    margin-top: 2rem;
    margin-bottom: 0.75rem;
}

.article-content ul, .article-content ol {
    margin-left: 1.5rem;
    margin-bottom: 1.5rem;
    line-height: 1.8;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content strong {
    color: #06b6d4;
    font-weight: 600;
}

.article-content blockquote {
    border-left: 4px solid #06b6d4;
    padding-left: 1.5rem;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #94a3b8;
    background-color: rgba(15, 23, 42, 0.5);
    border-radius: 0 0.5rem 0.5rem 0;
}

.article-content a {
    color: #06b6d4;
    text-decoration: underline;
}

.article-content a:hover {
    color: #22d3ee;
}
</style>