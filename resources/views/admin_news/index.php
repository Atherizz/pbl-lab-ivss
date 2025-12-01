<?php 
// Variabel yang dibutuhkan oleh layout dashboard.php
$pageTitle = 'Admin Berita Dashboard';
$activeMenu = 'dashboard';

// Variabel yang dikirimkan oleh DashboardController::admin_berita():
// $stats, $recentNews, $viewsStats

$stats = $stats ?? [];
$recentNews = $recentNews ?? [];
$viewsStats = $viewsStats ?? []; // viewsStats diasumsikan array kosong/data views

$userName = htmlspecialchars($_SESSION['user']['name'] ?? 'Admin Berita');

// Mengambil nilai statistik dari $stats
$totalDraft = $stats['total_draft'] ?? 0;
$totalPublished = $stats['total_published'] ?? 0;
$totalNews = $totalDraft + $totalPublished;
$totalViews = $stats['total_views'] ?? 'N/A'; // N/A jika data views tidak ada/tidak dihitung
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<!-- Content utama (Mengikuti layouting dari referensi UI yang Anda berikan) -->
<div class="p-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl p-8 mb-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome back, <?= $userName ?>! 👋</h2>
                <p class="text-slate-300">Manage and publish lab news & updates.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-5xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        
        <!-- Total News (Total Draft + Published) -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Total</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total News</h3>
            <p id="news-total" class="text-3xl font-bold text-gray-900"><?= $totalNews ?></p>
        </div>

        <!-- Published -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-gray-500">Active</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Published</h3>
            <p id="news-published" class="text-3xl font-bold text-gray-900"><?= $totalPublished ?></p>
        </div>

        <!-- Draft -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-orange-600 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-gray-500">Pending</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Draft</h3>
            <p id="news-draft" class="text-3xl font-bold text-gray-900"><?= $totalDraft ?></p>
        </div>

        <!-- Total Views -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-purple-600 text-xl"></i>
                </div>
                <!-- Karena data change tidak tersedia, kita pakai badge statis / N/A -->
                <span class="text-xs font-semibold text-gray-500">N/A</span> 
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Views</h3>
            <p class="text-3xl font-bold text-gray-900"><?= $totalViews ?></p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Recent News (Menggunakan data $recentNews) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Recent News</h3>
                <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news" class="text-sm text-cyan-400 hover:text-cyan-300">View All</a>
            </div>
            <div class="divide-y divide-gray-100">
                <?php if (!empty($recentNews ?? [])): ?>
                    <?php foreach ($recentNews as $news): 
                        $isPublished = $news['status'] === 'published';
                        $statusClass = $isPublished ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800';
                        $iconClass = $isPublished ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600';
                    ?>
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 <?= $iconClass ?> rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-newspaper text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 <?= $statusClass ?> text-xs font-medium rounded-full"><?= ucwords($news['status']) ?></span>
                                        <span class="text-xs text-gray-400"><?= $isPublished ? date('d M Y', strtotime($news['published_at'])) : 'Draft' ?></span>
                                    </div>
                                    <h4 class="text-sm text-gray-900 font-medium mb-1"><?= htmlspecialchars($news['title']) ?></h4>
                                    <!-- Detail View, Likes, Views tidak tersedia di model ini, jadi kita gunakan placeholder sederhana -->
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-400">
                                        <span><i class="fas fa-eye mr-1"></i>N/A views</span>
                                        <span><i class="fas fa-heart mr-1"></i>N/A likes</span>
                                    </div>
                                    <?php if (!$isPublished): ?>
                                    <div class="flex items-center gap-3 mt-2">
                                        <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news/<?= $news['id'] ?>/edit" class="text-xs text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <!-- Anda perlu menambahkan logic Publish POST route di sini -->
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-6 text-center text-gray-500">Belum ada berita yang diterbitkan atau di-draft.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Actions & Stats -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news/create" 
                        class="w-full flex items-center gap-3 px-4 py-3 bg-cyan-500/10 text-cyan-700 rounded-lg hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-plus-circle"></i>
                        <span class="font-medium text-sm">Create New Post</span>
                    </a>
                    <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news?status=draft" 
                        class="w-full flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition-colors">
                        <i class="fas fa-edit"></i>
                        <span class="font-medium text-sm">View Drafts</span>
                    </a>
                    <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news/analytics" 
                        class="w-full flex items-center gap-3 px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                        <i class="fas fa-chart-line"></i>
                        <span class="font-medium text-sm">View Analytics</span>
                    </a>
                </div>
            </div>

            <!-- Popular Posts (Menggunakan data $viewsStats jika tersedia, jika tidak placeholder) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Most Popular</h3>
                <div class="space-y-4">
                    <p class="text-gray-500 text-sm">Data popularitas berita tidak tersedia dari Model.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Skrip Real-time untuk Admin Berita -->
<script>
    // Pastikan rute '/api/dashboard/refreshStats' ada di routes.php
    const API_STATS_URL_NEWS = '<?= BASE_URL ?? '.' ?>/api/dashboard/refreshStats';
    const INTERVAL_MS_NEWS = 10000;

    function updateAdminNewsStats() {
        fetch(API_STATS_URL_NEWS)
            .then(response => response.json())
            .then(stats => {
                // Hanya update jika data valid dan role adalah admin berita (ditandai dengan adanya total_draft)
                if (stats && !stats.error && stats.total_draft !== undefined) {
                    const totalNews = stats.total_draft + stats.total_published;
                    
                    document.getElementById('news-total').textContent = totalNews;
                    document.getElementById('news-published').textContent = stats.total_published;
                    document.getElementById('news-draft').textContent = stats.total_draft;
                    // Total views statis, tidak di-refresh
                }
            })
            .catch(error => {
                console.error('[Admin Berita API] Error fetching stats:', error);
            });
    }

    updateAdminNewsStats();
    setInterval(updateAdminNewsStats, INTERVAL_MS_NEWS); 
</script>