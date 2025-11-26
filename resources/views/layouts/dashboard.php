<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: ' . (BASE_URL ?? '.') . '/login');
    exit;
}

$userRole = $_SESSION['user']['role'] ?? 'anggota_lab';
?>

<style>
/* Scoped dark slate + cyan theme overrides without changing structure */
.theme-slate { background-color: #0f172a; color: #e2e8f0; }
.theme-slate .bg-gray-50, .theme-slate .bg-gray-100 { background-color: #0f172a !important; }
.theme-slate .bg-white { background-color: #1f2937 !important; }
.theme-slate .text-gray-900, .theme-slate .text-gray-800 { color: #e2e8f0 !important; }
.theme-slate .text-gray-700 { color: #cbd5e1 !important; }
.theme-slate .text-gray-600 { color: #a3b2c5 !important; }
.theme-slate .text-gray-500, .theme-slate .text-gray-400 { color: #94a3b8 !important; }
.theme-slate .border-gray-100, .theme-slate .border-gray-200 { border-color: #334155 !important; }
.theme-slate .hover\:bg-gray-50:hover { background-color: #111827 !important; }
.theme-slate .bg-blue-50 { background-color: rgba(8, 145, 178, 0.12) !important; }
.theme-slate .text-blue-700 { color: #22d3ee !important; }
.theme-slate .bg-purple-50 { background-color: rgba(168, 85, 247, 0.12) !important; }
.theme-slate .text-purple-700 { color: #c084fc !important; }
.theme-slate .bg-orange-50 { background-color: rgba(251, 146, 60, 0.12) !important; }
.theme-slate .text-orange-700 { color: #fb923c !important; }
.theme-slate .text-red-600 { color: #f87171 !important; }
.theme-slate .hover\:bg-red-50:hover { background-color: rgba(248, 113, 113, 0.12) !important; }
/* Form focus accents to cyan */
.theme-slate .focus\:ring-blue-500:focus { --tw-ring-color: #06b6d4 !important; }
.theme-slate .focus\:border-blue-500:focus { border-color: #06b6d4 !important; }
/* Badges */
.theme-slate .bg-green-50 { background-color: rgba(34, 197, 94, 0.12) !important; }
.theme-slate .text-green-600 { color: #34d399 !important; }
.theme-slate .bg-red-100 { background-color: rgba(248, 113, 113, 0.18) !important; }
.theme-slate .text-red-700 { color: #ef4444 !important; }
.theme-slate .bg-green-100 { background-color: rgba(34, 197, 94, 0.18) !important; }
.theme-slate .text-green-700 { color: #22c55e !important; }
/* Universal form controls for contrast + consistent sizing */
.theme-slate input[type="text"],
.theme-slate input[type="password"],
.theme-slate input[type="email"],
.theme-slate input[type="url"],
.theme-slate input[type="tel"],
.theme-slate input[type="number"],
.theme-slate input[type="date"],
.theme-slate input[type="time"],
.theme-slate input[type="search"],
.theme-slate select,
.theme-slate textarea {
    background-color: #0b1220 !important; /* slightly darker than page */
    color: #e2e8f0 !important;
    border: 1px solid #334155 !important;
    border-radius: 0.5rem; /* md rounding */
    padding: 0.5rem 0.75rem !important; /* py-2 px-3 */
    line-height: 1.5rem !important; /* leading-6 */
    min-height: 2.75rem; /* ~44px for alignment */
}
.theme-slate input::placeholder,
.theme-slate textarea::placeholder { color: #64748b !important; }
.theme-slate input:focus,
.theme-slate select:focus,
.theme-slate textarea:focus {
    outline: none !important;
    border-color: #06b6d4 !important;
    box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.25) !important; /* emulate ring */
}
.theme-slate select { background-image: none; }
.theme-slate fieldset { border-color: #334155 !important; }
.theme-slate label { color: #cbd5e1 !important; }
/* Add subtle border to cards if none provided */
.theme-slate .bg-white { border: 1px solid #334155; }
/* Map legacy blue accents to cyan across theme */
.theme-slate .bg-blue-600 { background-color: #0891b2 !important; }
.theme-slate .bg-blue-700 { background-color: #0e7490 !important; }
.theme-slate .bg-blue-500 { background-color: #06b6d4 !important; }
.theme-slate .hover\:bg-blue-600:hover { background-color: #0891b2 !important; }
.theme-slate .hover\:bg-blue-700:hover { background-color: #0e7490 !important; }
.theme-slate .text-blue-600 { color: #22d3ee !important; }
.theme-slate .text-blue-700 { color: #2dd4bf !important; }
.theme-slate .hover\:text-blue-700:hover { color: #2dd4bf !important; }
.theme-slate .border-blue-500 { border-color: #06b6d4 !important; }
.theme-slate .ring-blue-500 { --tw-ring-color: #06b6d4 !important; }
</style>

<div class="theme-slate flex min-h-screen bg-slate-900" x-data="{ sidebarOpen: false }">
    
    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
         style="display: none;">
    </div>
    
    <aside
        x-show="sidebarOpen || window.innerWidth >= 1024"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-slate-800 to-slate-900 shadow-xl"
        style="display: none;"
        x-init="$watch('sidebarOpen', value => { if (window.innerWidth >= 1024) $el.style.display = 'block'; })">
        
        <div class="flex flex-col h-full">

        <!-- Logo Section -->
        <div class="flex items-center justify-between h-20 px-6 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-eye text-cyan-400 text-xl"></i>
                </div>
                <div class="text-white">
                    <div class="font-bold text-lg">IVSS Lab</div>
                    <div class="text-xs text-slate-300">
                        <?php
                        echo match ($userRole) {
                            'admin_lab' => 'Admin Dashboard',
                            'admin_berita' => 'News Admin',
                            'anggota_lab' => 'Anggota Lab Dashboard',
                            default => 'Dashboard'
                        };
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">

            <!-- MENU UNTUK ADMIN LAB -->
            <?php if ($userRole === 'admin_lab'): ?>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/dashboard"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-th-large w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'equipment') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-desktop w-5 text-center"></i>
                    <span class="font-medium">Equipment</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'riset-saya') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-flask w-5 text-center"></i>
                    <span class="font-medium">Riset Saya</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'direktori-riset') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-folder-open w-5 text-center"></i>
                    <span class="font-medium">Direktori Riset Lab</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/anggota"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'anggota') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-medium">Anggota</span>
                </a>

                <!-- TAMBAHAN: DATASET (ADMIN) -->
                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/dataset"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'direktori-dataset') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-folder w-5 text-center"></i>
                    <span class="font-medium">Direktori Dataset</span>
                </a>

                <div class="my-4 border-t border-slate-700"></div>

                <div class="px-4 py-2">
                    <span class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Approval</span>
                </div>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/approval/anggota"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-anggota') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-user-check w-5 text-center"></i>
                    <span class="font-medium">Pendaftaran Anggota</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/approval/publikasi"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-publikasi') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-file-alt w-5 text-center"></i>
                    <span class="font-medium">Publikasi Penelitian</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/approval/peminjaman"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-peminjaman') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-hand-holding w-5 text-center"></i>
                    <span class="font-medium">Peminjaman Barang</span>
                </a>

            <!-- MENU UNTUK ADMIN NEWS -->
            <?php elseif ($userRole === 'admin_berita'): ?>

                <a href="<?= BASE_URL ?? '.' ?>/admin-berita/dashboard"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-th-large w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'news') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-newspaper w-5 text-center"></i>
                    <span class="font-medium">News</span>
                </a>

                <!-- TAMBAHAN: DATASET (VIEW ONLY) -->
                <a href="<?= BASE_URL ?? '.' ?>/dataset/direktori"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'direktori-dataset') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-folder w-5 text-center"></i>
                    <span class="font-medium">Direktori Dataset</span>
                </a>

            <!-- MENU UNTUK ANGGOTA LAB -->
            <?php else: ?>

                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/dashboard"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="my-4 border-t border-slate-700"></div>

                <div class="px-4 py-2">
                    <span class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Riset</span>
                </div>

                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'riset-saya') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-flask w-5 text-center"></i>
                    <span class="font-medium">Riset Saya</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/create"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'ajukan-riset') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-plus-circle w-5 text-center"></i>
                    <span class="font-medium">Ajukan Riset Baru</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'direktori-riset') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-folder-open w-5 text-center"></i>
                    <span class="font-medium">Direktori Riset Lab</span>
                </a>

                <!-- TAMBAHAN: DATASET (VIEW ONLY) -->
                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/dataset"
                    class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'direktori-dataset') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-folder w-5 text-center"></i>
                    <span class="font-medium">Direktori Dataset</span>
                </a>

                <?php if ($userRole === 'anggota_lab'): ?>
                    <div class="px-4 py-2">
                        <span class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Approval</span>
                    </div>

                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/approval/anggota"
                        class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-peminjaman') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                        <i class="fas fa-hand-holding w-5 text-center"></i>
                        <span class="font-medium">Pendaftaran Anggota</span>
                    </a>

                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/approval/publikasi"
                        class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-publikasi') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span class="font-medium">Publikasi Penelitian</span>
                    </a>

                <?php else: ?>

                    <div class="my-4 border-t border-slate-700"></div>

                    <div class="px-4 py-2">
                        <span class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Peralatan</span>
                    </div>

                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog"
                        class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'katalog-equipment') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                        <i class="fas fa-th-list w-5 text-center"></i>
                        <span class="font-medium">Katalog Peralatan</span>
                    </a>

                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings"
                        class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'peminjaman-saya') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                        <i class="fas fa-history w-5 text-center"></i>
                        <span class="font-medium">Peminjaman Saya</span>
                    </a>

                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog"
                        class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'bookings') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                        <i class="fas fa-hand-holding w-5 text-center"></i>
                        <span class="font-medium">Ajukan Peminjaman</span>
                    </a>
                <?php endif; ?>

            <?php endif; ?>

        </nav>

        <div class="border-t border-slate-700 p-4">
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen"
                    class="flex items-center justify-between w-full px-4 py-3 text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-cyan-500 rounded-full flex items-center justify-center text-slate-900 font-bold shadow-lg">
                            <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="text-left">
                            <div class="font-medium text-sm"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></div>
                            <div class="text-xs text-slate-300">
                                <?php
                                echo match ($userRole) {
                                    'admin_lab' => 'Admin Lab',
                                    'admin_berita' => 'Admin Berita',
                                    'anggota_lab' => 'Anggota Lab',
                                    'mahasiswa' => 'Mahasiswa Lab',
                                    default => 'User'
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-up text-xs transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="dropdownOpen"
                    @click.away="dropdownOpen = false"
                    x-transition
                    class="absolute bottom-full left-0 right-0 mb-2 bg-slate-800 rounded-lg shadow-xl overflow-hidden"
                    style="display: none;">
                    <?php if ($userRole === 'anggota_lab' || $userRole === 'admin_lab'): ?>
                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/profile"
                        class="block px-4 py-3 text-sm text-slate-200 hover:bg-slate-700 transition-colors">
                        <i class="fas fa-user-circle mr-2 text-slate-400"></i>
                        My Profile
                    </a>
                    <?php endif; ?>
                    <form method="POST" action="<?= BASE_URL ?? '.' ?>/logout">
                        <button type="submit"
                            class="block w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-50 transition-colors border-t border-slate-700">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
        <!-- Top Bar -->
        <header class="bg-slate-800 border-b border-slate-700 sticky top-0 z-30 shadow-sm">
            <div class="flex items-center justify-between h-16 px-6">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="text-slate-300 hover:text-white transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="flex-1 lg:flex-none lg:ml-4">
                    <?php if (isset($pageTitle)): ?>
                        <h1 class="text-xl font-semibold text-slate-100"><?= htmlspecialchars($pageTitle) ?></h1>
                    <?php endif; ?>
                </div>

                <div class="flex items-center gap-4">
                    <button class="relative text-slate-300 hover:text-white transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-cyan-500 rounded-full text-xs text-slate-900 flex items-center justify-center">3</span>
                    </button>

                    <div class="lg:hidden w-9 h-9 bg-cyan-500 rounded-full flex items-center justify-center text-slate-900 font-bold">
                        <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)) ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <!-- Content will be inserted here -->