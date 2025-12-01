<?php
// --- PHP SETUP & VARIABLE MAPPING ---
$pageTitle = 'Dashboard Anggota Lab';
$activeMenu = 'dashboard';

// Ambil nama user dari session
$userName = htmlspecialchars($_SESSION['user']['name'] ?? 'Anggota Lab');
$userRole = $_SESSION['user']['role'] ?? ''; // Ambil role untuk logika Quick Action

// Pastikan variabel dari Controller tersedia, jika tidak set default array kosong
$stats = $stats ?? [];
$activeBorrowings = $activeBorrowings ?? [];
// $recentResearch & $recentActivities tersedia jika ingin ditampilkan nanti

// Mapping Data dari DashboardModel::getAnggotaLabStats()
// Kunci array di sini HARUS sama persis dengan return di Model
$risetAktif = $stats['active_research'] ?? 0;
$peminjamanAktif = $stats['active_borrowings'] ?? 0;
$kontribusiPublikasi = $stats['publications'] ?? 0;
$totalAktivitas = $stats['total_activities'] ?? 0;
$researchChange = $stats['research_change'] ?? 0;
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="p-6">

    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl p-8 mb-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Selamat Datang, <?= $userName ?>! 👋</h2>
                <p class="text-slate-300">Kelola riset dan peminjaman peralatan lab Anda dalam satu tempat.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-5xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-flask text-cyan-400 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Active</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Riset Aktif</h3>
            <p id="anggota-riset-aktif" class="text-3xl font-bold text-gray-900"><?= $risetAktif ?></p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hand-holding text-orange-600 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-2 py-1 rounded-full">In Use</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Peminjaman Aktif</h3>
            <p id="anggota-pinjam-aktif" class="text-3xl font-bold text-gray-900"><?= $peminjamanAktif ?></p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-book text-purple-600 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-gray-500">Completed</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Kontribusi Publikasi</h3>
            <p id="anggota-publikasi" class="text-3xl font-bold text-gray-900"><?= $kontribusiPublikasi ?></p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-green-600 text-xl"></i>
                </div>
                <span id="badge-research-change"
                    class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">
                    +<?= $researchChange ?>
                </span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Aktivitas</h3>
            <p id="anggota-total-aktivitas" class="text-3xl font-bold text-gray-900"><?= $totalAktivitas ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                <span class="text-sm text-gray-400">Riwayat Gabungan</span>
            </div>

            <div class="divide-y divide-gray-100">
                <?php if (!empty($recentActivities)): ?>
                    <?php foreach ($recentActivities as $activity):
                        // 1. Setup Data
                        $isResearch = ($activity['type'] === 'research');
                        $statusRaw = $activity['status'];

                        // 2. FIX ERROR: Cek apakah tanggal ada isinya sebelum diformat
                        $dateRaw = $activity['created_at'] ?? null;
                        if (!empty($dateRaw)) {
                            $dateDisplay = date('d M Y, H:i', strtotime($dateRaw));
                        } else {
                            $dateDisplay = 'Menunggu Jadwal'; // Teks default jika tanggal kosong
                        }

                        // 3. Icon & Label
                        if ($isResearch) {
                            $icon = 'fa-flask';
                            $bgIconClass = 'bg-cyan-500/10 text-cyan-600';
                            $typeLabel = 'Riset Lab';
                        } else {
                            $icon = 'fa-hand-holding';
                            $bgIconClass = 'bg-orange-500/10 text-orange-600';
                            $typeLabel = 'Peminjaman Alat';
                        }

                        // 4. Warna Status
                        $statusClass = match ($statusRaw) {
                            'approved', 'active', 'approved_by_dospem', 'approved_by_head' => 'bg-green-100 text-green-800',
                            'completed', 'returned' => 'bg-blue-100 text-blue-800',
                            'rejected', 'canceled' => 'bg-red-100 text-red-800',
                            default => 'bg-yellow-100 text-yellow-800'
                        };

                        $statusText = ucwords(str_replace('_', ' ', $statusRaw));
                        ?>
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div
                                    class="w-12 h-12 <?= $bgIconClass ?> rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas <?= $icon ?> text-lg"></i>
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span
                                            class="text-xs font-semibold text-gray-500 uppercase tracking-wider"><?= $typeLabel ?></span>
                                        <span class="text-xs text-gray-400"><?= $dateDisplay ?></span>
                                    </div>

                                    <h4 class="text-sm text-gray-900 font-bold mb-2">
                                        <?= htmlspecialchars($activity['description'] ?? $activity['title'] ?? 'Aktivitas Tanpa Judul') ?>
                                    </h4>

                                    <div class="flex items-center gap-2">
                                        <span class="px-2.5 py-0.5 <?= $statusClass ?> text-xs font-medium rounded-full">
                                            <?= $statusText ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-8 text-center text-gray-500">
                        <div class="mb-3"><i class="fas fa-history text-4xl text-gray-300"></i></div>
                        <p>Belum ada aktivitas terbaru.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="space-y-6">

            <?php if ($userRole == 'mahasiswa'): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/create"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-flask"></i> <span class="font-medium text-sm">Ajukan Riset Baru</span>
                        </a>
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-hands"></i> <span class="font-medium text-sm">Pinjam Peralatan</span>
                        </a>
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-list-alt"></i> <span class="font-medium text-sm">Lihat Katalog</span>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/approval/anggota"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-users-cog"></i> <span class="font-medium text-sm">Pendaftaran Anggota</span>
                        </a>
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/approval/publikasi"
                            class="w-full flex items-center gap-3 px-4 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-file-signature"></i> <span class="font-medium text-sm">Publikasi
                                Penelitian</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl shadow-sm p-6 text-white">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-clock text-2xl"></i>
                    <h3 class="text-lg font-semibold">Jam Operasional Lab</h3>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-300">Senin - Jumat</span>
                        <span class="font-medium">08:00 - 17:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-300">Sabtu</span>
                        <span class="font-medium">09:00 - 14:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-300">Minggu</span>
                        <span class="font-medium text-slate-300">Tutup</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const API_STATS_URL_ANGGOTA = '<?= BASE_URL ?? '.' ?>/api/dashboard/refreshStats';
    const INTERVAL_MS_ANGGOTA = 10000; // 10 Detik

    function updateAnggotaLabStats() {
        fetch(API_STATS_URL_ANGGOTA)
            .then(response => response.json())
            .then(stats => {
                // Pastikan response tidak error
                if (stats && !stats.error) {

                    // 1. Update Angka Statistik (Sesuai Key JSON dari Model)
                    const elements = {
                        'anggota-riset-aktif': stats.active_research,
                        'anggota-pinjam-aktif': stats.active_borrowings,
                        'anggota-publikasi': stats.publications,
                        'anggota-total-aktivitas': stats.total_activities
                    };

                    for (const [id, value] of Object.entries(elements)) {
                        const el = document.getElementById(id);
                        if (el) el.textContent = value ?? 0;
                    }

                    // 2. Update Badge (+N)
                    const badgeEl = document.getElementById('badge-research-change');
                    if (badgeEl) {
                        badgeEl.textContent = '+' + (stats.research_change ?? 0);
                    }
                }
            })
            .catch(error => {
                console.error('[Dashboard API] Error fetching stats:', error);
            });
    }

    // Jalankan pertama kali saat load, lalu set interval
    updateAnggotaLabStats();
    setInterval(updateAnggotaLabStats, INTERVAL_MS_ANGGOTA); 
</script>