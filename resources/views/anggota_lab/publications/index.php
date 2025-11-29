<?php
$pageTitle = 'Publikasi Saya';
$activeMenu = 'publikasi-saya';


// $scholarUrl = 'https://scholar.google.com/citations?user=EXAMPLE';

$publications = [];
// Contoh data publikasi statis (uncomment untuk testing):
/*
$publications = [
    [
        'title' => 'Deep Learning for Computer Vision Applications',
        'authors' => 'John Doe, Jane Smith, Bob Wilson',
        'year' => '2024',
        'citations' => '45',
        'url' => 'https://scholar.google.com/example1'
    ],
    [
        'title' => 'Machine Learning in Healthcare: A Comprehensive Review',
        'authors' => 'Jane Smith, John Doe',
        'year' => '2023',
        'citations' => '78',
        'url' => 'https://scholar.google.com/example2'
    ],
    [
        'title' => 'Smart Systems and IoT Integration',
        'authors' => 'Bob Wilson, Jane Smith, John Doe',
        'year' => '2023',
        'citations' => '32',
        'url' => 'https://scholar.google.com/example3'
    ]
];
*/
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

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
                            <div class="text-2xl font-bold text-white"><?= count($publications) ?></div>
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
                            <div class="text-2xl font-bold text-white">-</div>
                            <div class="text-sm text-slate-400">Total Sitasi</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-400"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-white">-</div>
                            <div class="text-sm text-slate-400">H-Index</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Publications List -->
            <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
                <div class="p-6 border-b border-slate-700 bg-gradient-to-r from-slate-800 to-slate-900">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white">Daftar Publikasi</h2>
                        <button class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-medium rounded-lg transition-all">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Sinkronisasi
                        </button>
                    </div>
                </div>

                <div class="p-6">
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
                    <!-- Publications Grid -->
                    <div class="space-y-4">
                        <?php foreach ($publications as $index => $pub): ?>
                        <div class="border border-slate-700 rounded-xl p-6 hover:border-cyan-500/50 hover:bg-slate-700/30 transition-all group">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center text-cyan-400 font-bold group-hover:bg-cyan-500/20 transition-all">
                                    <?= $index + 1 ?>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                                        <?= htmlspecialchars($pub['title'] ?? 'Untitled') ?>
                                    </h3>
                                    <p class="text-sm text-slate-400 mb-3">
                                        <?= htmlspecialchars($pub['authors'] ?? '-') ?>
                                    </p>
                                    <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500">
                                        <span>
                                            <i class="fas fa-calendar mr-1"></i>
                                            <?= htmlspecialchars($pub['year'] ?? '-') ?>
                                        </span>
                                        <span>
                                            <i class="fas fa-quote-right mr-1"></i>
                                            <?= htmlspecialchars($pub['citations'] ?? '0') ?> sitasi
                                        </span>
                                        <?php if (!empty($pub['url'])): ?>
                                        <a href="<?= htmlspecialchars($pub['url']) ?>" target="_blank" class="text-cyan-400 hover:text-cyan-300 transition-colors">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Lihat Publikasi
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
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
