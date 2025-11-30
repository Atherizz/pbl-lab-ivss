<?php
$pageTitle = 'Publikasi Saya';
$activeMenu = 'publikasi-saya';

$successMessage = flash('success');
$errorMessage = flash('error');

// Pagination & Search
$currentPage = $currentPage ?? 1;
$totalPages = $totalPages ?? 1;
$totalItems = $totalItems ?? 0;
$itemsPerPage = $itemsPerPage ?? 10;
$startItem = $startItem ?? 0;
$endItem = $endItem ?? 0;
$currentSearch = $currentSearch ?? '';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<?php if ($successMessage) : ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span>&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if ($errorMessage) : ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($errorMessage) ?></span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <span>&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Publikasi Saya</h1>
            <p class="text-slate-400">Kelola publikasi akademik Anda melalui integrasi Google Scholar</p>
        </div>

        <?php if (empty($scholarUrl)): ?>
            <!-- Empty State - Belum Setup Google Scholar -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-12 text-center shadow-xl">
                <div class="max-w-2xl mx-auto">
                    <div class="w-24 h-24 bg-cyan-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-5xl text-cyan-400"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-white mb-4">Integrasi Google Scholar</h2>
                    <p class="text-slate-400 mb-8 leading-relaxed">
                        Untuk menampilkan publikasi Anda, silakan masukkan URL profil Google Scholar Anda.
                        Sistem akan otomatis mengambil dan menampilkan daftar publikasi terbaru Anda.
                    </p>

                    <button
                        onclick="openScholarModal()"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-cyan-500/20 hover:shadow-cyan-500/40">
                        <i class="fas fa-link"></i>
                        <span>Hubungkan Google Scholar</span>
                    </button>

                    <div class="mt-8 pt-8 border-t border-slate-700">
                        <p class="text-sm text-slate-500 mb-3">Contoh URL Google Scholar:</p>
                        <code class="text-xs bg-slate-900 text-cyan-400 px-4 py-2 rounded-lg inline-block">
                            https://scholar.google.com/citations?user=XXXXXXXXX
                        </code>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Sudah Setup - Tampilkan Publikasi -->
            <div class="space-y-6">

                <!-- Scholar Profile Info -->
                <div class="bg-gradient-to-r from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-cyan-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-2xl text-cyan-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Google Scholar Connected</h3>
                                <a href="<?= htmlspecialchars($scholarUrl) ?>" target="_blank" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    Lihat Profil di Scholar
                                </a>
                            </div>
                        </div>
                        <button
                            onclick="openScholarModal()"
                            class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm font-medium rounded-lg transition-all border border-slate-600">
                            <i class="fas fa-edit mr-2"></i>
                            Ubah URL
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-cyan-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-cyan-400"></i>
                            </div>
                            <div>
                                <?php 
                                $totalAllPublications = isset($allPublications) ? count($allPublications) : $totalItems;
                                ?>
                                <div class="text-2xl font-bold text-white"><?= $totalAllPublications ?></div>
                                <div class="text-sm text-slate-400">Total Publikasi</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-quote-right text-green-400"></i>
                            </div>
                            <div>
                                <?php
                                $totalCitations = 0;
                                $publicationsForStats = isset($allPublications) ? $allPublications : $publications;
                                foreach ($publicationsForStats as $pub) {
                                    $totalCitations += $pub['cited_by_count'] ?? 0;
                                }
                                ?>
                                <div class="text-2xl font-bold text-white"><?= number_format($totalCitations) ?></div>
                                <div class="text-sm text-slate-400">Total Sitasi</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar text-purple-400"></i>
                            </div>
                            <div>
                                <?php
                                $latestYear = 0;
                                $publicationsForStats = isset($allPublications) ? $allPublications : $publications;
                                foreach ($publicationsForStats as $pub) {
                                    $year = $pub['year'] ?? 0;
                                    if ($year > $latestYear) $latestYear = $year;
                                }
                                ?>
                                <div class="text-2xl font-bold text-white"><?= $latestYear > 0 ? $latestYear : '-' ?></div>
                                <div class="text-sm text-slate-400">Publikasi Terbaru</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search & Filter -->
                <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
                    <form method="GET" id="searchForm" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-slate-300 mb-2">Cari Publikasi</label>
                            <input
                                type="text"
                                name="search"
                                id="search"
                                placeholder="Cari berdasarkan judul atau penulis..."
                                value="<?= htmlspecialchars($currentSearch) ?>"
                                class="w-full px-4 py-2.5 bg-slate-900 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/50 transition-all">
                        </div>
                        <div class="pt-7 hidden-buttons" style="display: none;">
                            <button type="submit" class="px-4 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white font-medium rounded-lg transition-all">
                                <i class="fas fa-search mr-2"></i>Cari
                            </button>
                            <?php if (!empty($currentSearch)): ?>
                                <a href="<?= BASE_URL ?>/anggota-lab/publikasi" class="ml-2 px-4 py-2.5 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-all inline-block">
                                    <i class="fas fa-times mr-2"></i>Clear
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <!-- Publications List -->
                <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
                <div class="p-6 border-b border-slate-700 bg-gradient-to-r from-slate-800 to-slate-900">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white">Daftar Publikasi</h2>
                        <div class="flex gap-2">
                            <form method="POST" action="<?= BASE_URL ?>/anggota-lab/publikasi/synchronize">
                                <input type="hidden" name="scholar_url" value="<?= htmlspecialchars($scholarUrl ?? '') ?>">
                                <button type="submit" name="submit" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-medium rounded-lg transition-all">
                                    <i class="fas fa-sync-alt mr-2"></i>
                                    Sinkronisasi
                                </button>
                            </form>
                            <?php if ($totalItems > 0): ?>
                            <form method="POST" action="<?= BASE_URL ?>/anggota-lab/publikasi/destroy-all" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA publikasi? Tindakan ini tidak dapat dibatalkan!');">
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-lg transition-all">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Hapus Semua
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>                    <div class="p-6">
                        <?php if (empty($publications)): ?>
                            <!-- No Publications Yet -->
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-file-alt text-3xl text-slate-500"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-white mb-2">Belum Ada Publikasi</h3>
                                <p class="text-slate-400 text-sm">
                                    Klik tombol Sinkronisasi untuk mengambil data publikasi dari Google Scholar
                                </p>
                            </div>
                        <?php else: ?>
                            <!-- Publications Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-slate-700">
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300 w-12">#</th>
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Judul Publikasi</th>
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Penulis</th>
                                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Venue</th>
                                            <th class="text-center py-3 px-4 text-sm font-semibold text-slate-300 w-20">Tahun</th>
                                            <th class="text-center py-3 px-4 text-sm font-semibold text-slate-300 w-24">Sitasi</th>
                                            <th class="text-center py-3 px-4 text-sm font-semibold text-slate-300 w-32">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50">
                                        <?php foreach ($publications as $index => $pub): ?>
                                            <tr class="hover:bg-slate-900/30 transition-colors">
                                                <td class="py-4 px-4">
                                                    <div class="w-8 h-8 bg-cyan-500/20 rounded-lg flex items-center justify-center text-cyan-400 text-sm font-bold">
                                                        <?= $startItem + $index ?>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-4">
                                                    <h3 class="text-sm font-semibold text-white mb-1">
                                                        <?= htmlspecialchars($pub['title'] ?? 'Untitled') ?>
                                                    </h3>
                                                    <?php if (!empty($pub['citation_id'])): ?>
                                                        <p class="text-xs text-cyan-400 font-mono">
                                                            #<?= htmlspecialchars($pub['citation_id']) ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="py-4 px-4">
                                                    <p class="text-sm text-slate-300">
                                                        <?= htmlspecialchars($pub['authors'] ?? '-') ?>
                                                    </p>
                                                </td>
                                                <td class="py-4 px-4">
                                                    <p class="text-sm text-slate-400">
                                                        <?= htmlspecialchars($pub['publication_venue'] ?? '-') ?>
                                                    </p>
                                                </td>
                                                <td class="py-4 px-4 text-center">
                                                    <?php if (!empty($pub['year'])): ?>
                                                        <span class="inline-block px-2 py-1 bg-slate-700 text-cyan-400 text-xs font-semibold rounded">
                                                            <?= htmlspecialchars($pub['year']) ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-slate-500 text-xs">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="py-4 px-4 text-center">
                                                    <div class="flex flex-col items-center gap-1">
                                                        <span class="text-green-400 font-bold">
                                                            <?= number_format($pub['cited_by_count'] ?? 0) ?>
                                                        </span>
                                                        <span class="text-xs text-slate-500">sitasi</span>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-4">
                                                    <div class="flex gap-2 justify-center">
                                                        <?php if (!empty($pub['scholar_link'])): ?>
                                                            <a href="<?= htmlspecialchars($pub['scholar_link']) ?>" target="_blank"
                                                                class="px-3 py-1.5 bg-cyan-600/20 hover:bg-cyan-600/30 text-cyan-400 text-xs font-medium rounded transition-all border border-cyan-500/30"
                                                                title="Lihat di Google Scholar">
                                                                <i class="fas fa-graduation-cap"></i>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($pub['cited_by_link'])): ?>
                                                            <a href="<?= htmlspecialchars($pub['cited_by_link']) ?>" target="_blank"
                                                                class="px-3 py-1.5 bg-green-600/20 hover:bg-green-600/30 text-green-400 text-xs font-medium rounded transition-all border border-green-500/30"
                                                                title="Lihat Sitasi">
                                                                <i class="fas fa-quote-right"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <?php if ($totalPages > 1): ?>
                                <div class="mt-6 pt-6 border-t border-slate-700">
                                    <nav class="flex justify-between items-center">
                                        <div class="text-sm text-slate-400">
                                            Menampilkan <?= $startItem ?> - <?= $endItem ?> dari <?= $totalItems ?> publikasi
                                        </div>

                                        <div class="flex gap-1">
                                            <?php if ($currentPage > 1): ?>
                                                <a href="?page=<?= $currentPage - 1 ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                                                    class="px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-lg transition-all border border-slate-600">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="px-3 py-2 bg-slate-800 text-slate-600 text-sm rounded-lg border border-slate-700 cursor-not-allowed">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            <?php endif; ?>

                                            <?php
                                            $startPage = max(1, $currentPage - 2);
                                            $endPage = min($totalPages, $currentPage + 2);

                                            if ($startPage > 1): ?>
                                                <a href="?page=1<?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                                                    class="px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-lg transition-all border border-slate-600">
                                                    1
                                                </a>
                                                <?php if ($startPage > 2): ?>
                                                    <span class="px-3 py-2 text-slate-500 text-sm">...</span>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                                <?php if ($i == $currentPage): ?>
                                                    <span class="px-3 py-2 bg-cyan-600 text-white text-sm font-semibold rounded-lg border border-cyan-500">
                                                        <?= $i ?>
                                                    </span>
                                                <?php else: ?>
                                                    <a href="?page=<?= $i ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                                                        class="px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-lg transition-all border border-slate-600">
                                                        <?= $i ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endfor; ?>

                                            <?php if ($endPage < $totalPages): ?>
                                                <?php if ($endPage < $totalPages - 1): ?>
                                                    <span class="px-3 py-2 text-slate-500 text-sm">...</span>
                                                <?php endif; ?>
                                                <a href="?page=<?= $totalPages ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                                                    class="px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-lg transition-all border border-slate-600">
                                                    <?= $totalPages ?>
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($currentPage < $totalPages): ?>
                                                <a href="?page=<?= $currentPage + 1 ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                                                    class="px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white text-sm rounded-lg transition-all border border-slate-600">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="px-3 py-2 bg-slate-800 text-slate-600 text-sm rounded-lg border border-slate-700 cursor-not-allowed">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </div>
</div>

<!-- Modal Setup Google Scholar -->
<div id="scholarModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-2xl w-full shadow-2xl transform transition-all" onclick="event.stopPropagation()">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">Hubungkan Google Scholar</h3>
                <button onclick="closeScholarModal()" class="text-slate-400 hover:text-white transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/anggota-lab/publikasi/setup" class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    URL Profil Google Scholar
                </label>
                <input
                    type="url"
                    name="social_links[google_scholar]"
                    value="<?= htmlspecialchars($scholarUrl ?? '') ?>"
                    placeholder="https://scholar.google.com/citations?user=XXXXXXXXX"
                    required
                    class="w-full px-4 py-3 bg-slate-900 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/50 transition-all">
                <p class="mt-2 text-xs text-slate-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Salin URL profil Google Scholar Anda dan tempelkan di sini
                </p>
            </div>

            <div class="bg-slate-900/50 border border-slate-700 rounded-lg p-4">
                <p class="text-sm text-slate-400 mb-3">
                    <i class="fas fa-question-circle text-cyan-400 mr-2"></i>
                    Cara mendapatkan URL Google Scholar:
                </p>
                <ol class="text-sm text-slate-400 space-y-2 ml-6 list-decimal">
                    <li>Buka <a href="https://scholar.google.com" target="_blank" class="text-cyan-400 hover:text-cyan-300">scholar.google.com</a></li>
                    <li>Cari nama Anda atau klik "My Profile" jika sudah login</li>
                    <li>Salin URL dari address bar browser Anda</li>
                    <li>Pastikan URL mengandung <code class="text-cyan-400 bg-slate-800 px-2 py-0.5 rounded">user=</code></li>
                </ol>


            </div>
            <div class="mt-4 bg-yellow-500/10 border border-yellow-600 rounded-lg p-4">
                <p class="text-sm text-yellow-300 font-semibold mb-2">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Catatan penting sebelum memperbarui URL Scholar:
                </p>
                <p class="text-sm text-yellow-200">
                    Jika Anda mengganti URL Google Scholar, <strong>hapus terlebih dahulu seluruh data publikasi</strong>
                    yang sudah tersimpan. Ini diperlukan agar proses sinkronisasi berjalan bersih tanpa duplikasi
                    atau konflik data lama.
                </p>
            </div>

            <div class="flex gap-3 justify-end pt-4 border-t border-slate-700">
                <button
                    type="button"
                    onclick="closeScholarModal()"
                    class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-all">
                    Batal
                </button>
                <button
                    type="submit"
                    class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-lg transition-all shadow-lg shadow-cyan-500/20">
                    <i class="fas fa-save mr-2"></i>
                    Simpan URL
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openScholarModal() {
        const modal = document.getElementById('scholarModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeScholarModal() {
        const modal = document.getElementById('scholarModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('scholarModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeScholarModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeScholarModal();
        }
    });
</script>