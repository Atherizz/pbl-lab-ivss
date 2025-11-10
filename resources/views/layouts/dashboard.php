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

<div class="flex min-h-screen bg-gray-50" x-data="{ sidebarOpen: true }">
    <aside 
        x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-blue-600 to-blue-700 shadow-xl"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        
        <!-- Logo Section -->
        <div class="flex items-center justify-between h-20 px-6 border-b border-blue-500">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-eye text-blue-600 text-xl"></i>
                </div>
                <div class="text-white">
                    <div class="font-bold text-lg">IVSS Lab</div>
                    <div class="text-xs text-blue-200">
                        <?php 
                        echo match($userRole) {
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

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/publication" 
                   class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'publikasi') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span class="font-medium">Publikasi</span>
                </a>

                <a href="<?= BASE_URL ?? '.' ?>/admin-lab/anggota" 
                   class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'anggota') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-medium">Anggota</span>
                </a>

                <div class="my-4 border-t border-blue-500"></div>

                <div class="px-4 py-2">
                    <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Approval</span>
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

            <!-- MENU UNTUK ANGGOTA LAB -->
            <?php else: ?>
                
                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/dashboard" 
                   class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="my-4 border-t border-blue-500"></div>

                <div class="px-4 py-2">
                    <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Riset</span>
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

                <div class="my-4 border-t border-blue-500"></div>

                <div class="px-4 py-2">
                    <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Peralatan</span>
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

        </nav>

        <div class="border-t border-blue-500 p-4">
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" 
                        class="flex items-center justify-between w-full px-4 py-3 text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold shadow-lg">
                            <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="text-left">
                            <div class="font-medium text-sm"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></div>
                            <div class="text-xs text-blue-200">
                                <?php 
                                echo match($userRole) {
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
                     class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-xl overflow-hidden"
                     style="display: none;">
                    <a href="<?= BASE_URL ?? '.' ?><?= $userRole === 'anggota_lab' ? '/anggota-lab' : '/admin' ?>/profile" 
                       class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                        My Profile
                    </a>
                    <form method="POST" action="<?= BASE_URL ?? '.' ?>/logout">
                        <button type="submit" 
                                class="block w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors border-t border-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
        <!-- Top Bar -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
            <div class="flex items-center justify-between h-16 px-6">
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="lg:hidden text-gray-600 hover:text-gray-900 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="flex-1 lg:flex-none">
                    <?php if (isset($pageTitle)): ?>
                        <h1 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($pageTitle) ?></h1>
                    <?php endif; ?>
                </div>

                <div class="flex items-center gap-4">
                    <button class="relative text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                    </button>

                    <div class="lg:hidden w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)) ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <!-- Content will be inserted here -->