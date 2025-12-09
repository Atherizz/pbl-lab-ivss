<?php
$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<?php


$userName = htmlspecialchars($_SESSION['user']['name'] ?? 'Admin Lab');
$stats = $stats ?? [];
$totalApproval = $stats['total_approval'] ?? 0;
?>

<div class="p-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl p-8 mb-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome back, <?= $userName ?>! 👋</h2>
                <p class="text-slate-300">Here's what's happening with your lab today.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-5xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards (Menggunakan data dari $stats) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <!-- Total Equipment -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-cyan-500/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-desktop text-cyan-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Equipment</h3>
            <p id="admin-total-alat" class="text-3xl font-bold text-gray-900"><?= $stats['total_alat'] ?? 0 ?></p>
        </div>

        <!-- Total Approval -->
        <div id="card-admin-approval"
            class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow"
            style="border: <?= $totalApproval > 0 ? '2px solid #fb923c' : '1px solid #334155' ?>">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-500/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-orange-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Approval</h3>
            <p id="admin-total-approval" class="text-3xl font-bold text-orange-400"><?= $totalApproval ?></p>
        </div>

        <!-- Publikasi -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-book text-purple-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Publikasi</h3>
            <p id="admin-riset-publik" class="text-3xl font-bold text-gray-900"><?= $stats['riset_publik'] ?? 0 ?></p>
        </div>

        <!-- Anggota Lab -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-green-400 text-xl"></i>
                </div>
                <span class="text-xs font-semibold text-gray-500">Active</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Anggota Lab</h3>
            <p id="admin-anggota-lab" class="text-3xl font-bold text-gray-900"><?= $stats['anggota_lab'] ?? 0 ?></p>
        </div>
    </div>

    <!-- Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Activity (Aktivitas Terbaru Lab) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
            </div>
            <div class="divide-y divide-gray-100" id="admin-recent-activities-list">
                <?php if (!empty($recentActivities ?? [])): ?>
                    <?php foreach ($recentActivities as $activity): ?>
                        <div class="p-4 hover:bg-gray-50 transition-colors flex gap-4">
                            <div
                                class="w-8 h-8 <?= $activity['type'] === 'research' ? 'bg-purple-500/10' : 'bg-cyan-500/10' ?> rounded-full flex items-center justify-center flex-shrink-0">
                                <i
                                    class="fas <?= $activity['type'] === 'research' ? 'fa-flask text-purple-400' : 'fa-hand-holding text-cyan-400' ?> text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-medium mb-1">
                                    <?= htmlspecialchars($activity['description']) ?></p>
                                <p class="text-xs text-gray-500">Status: <?= htmlspecialchars($activity['status']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-6 text-center text-gray-500">Tidak ada aktivitas terbaru.</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment/create"
                        class="w-full flex items-center gap-3 px-4 py-3 bg-cyan-500/10 text-cyan-700 rounded-lg hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-plus-circle"></i>
                        <span class="font-medium text-sm">Add Equipment</span>
                    </a>
                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/create"
                        class="w-full flex items-center gap-3 px-4 py-3 bg-purple-500/10 text-purple-700 rounded-lg hover:bg-purple-500/20 transition-colors">
                        <i class="fas fa-book"></i>
                        <span class="font-medium text-sm">Propose Research</span>
                    </a>
                    <a href="<?= BASE_URL ?? '.' ?>/admin-lab/members"
                        class="w-full flex items-center gap-3 px-4 py-3 bg-orange-500/10 text-orange-700 rounded-lg hover:bg-orange-500/20 transition-colors">
                        <i class="fas fa-users"></i>
                        <span class="font-medium text-sm">Manage Members</span>
                    </a>
                </div>
            </div>

            <!-- Pending Approvals Detail -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Approval Breakdown</h3>
                <div class="space-y-3 text-sm text-gray-700">
                    <p>Pendaftaran Anggota: <span
                            class="font-bold text-orange-600"><?= count($pendingMembers ?? []) ?></span></p>
                    <p>Publikasi Penelitian: <span
                            class="font-bold text-orange-600"><?= count($pendingPublications ?? []) ?></span></p>
                    <p>Peminjaman Barang: <span
                            class="font-bold text-orange-600"><?= count($pendingBorrowings ?? []) ?></span></p>
                </div>
                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/approval/anggota"
                    class="text-cyan-700 text-sm mt-4 block">View All Approvals</a>
            </div>

        </div>
    </div>

</div>

<!-- Skrip Real-time untuk Admin Lab -->
<script>
    const API_STATS_URL_ADMIN = '<?= BASE_URL ?? '.' ?>/api/dashboard/refreshStats';
    const INTERVAL_MS_ADMIN = 10000;

    function updateAdminLabStats() {
        fetch(API_STATS_URL_ADMIN)
            .then(response => response.json())
            .then(stats => {
                if (stats && !stats.error && stats.total_alat !== undefined) {
                    document.getElementById('admin-total-alat').textContent = stats.total_alat;
                    document.getElementById('admin-riset-publik').textContent = stats.riset_publik;
                    document.getElementById('admin-anggota-lab').textContent = stats.anggota_lab;
                    document.getElementById('admin-total-approval').textContent = stats.total_approval;

                    const approvalCard = document.getElementById('card-admin-approval');
                    approvalCard.style.border = stats.total_approval > 0 ? '2px solid #fb923c' : '1px solid #334155';
                }
            })
            .catch(error => {
                console.error('[Admin Lab API] Error fetching stats:', error);
            });
    }

    updateAdminLabStats();
    setInterval(updateAdminLabStats, INTERVAL_MS_ADMIN); 
</script>