<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: ' . (BASE_URL ?? '.') . '/login');
    exit;
}
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
                    <div class="text-xs text-blue-200">Dashboard</div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="<?= BASE_URL ?? '.' ?>/admin/dashboard" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-th-large w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="<?= BASE_URL ?? '.' ?>/admin/equipment" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'equipment') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-desktop w-5 text-center"></i>
                <span class="font-medium">Equipment</span>
            </a>

            <a href="<?= BASE_URL ?? '.' ?>/admin/publication" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'publikasi') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-medium">Publikasi</span>
            </a>

            <a href="<?= BASE_URL ?? '.' ?>/admin/anggota" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'anggota') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-users w-5 text-center"></i>
                <span class="font-medium">Anggota</span>
            </a>

            <!-- Divider -->
            <div class="my-4 border-t border-blue-500"></div>

            <!-- Approval Section -->
            <div class="px-4 py-2">
                <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Approval</span>
            </div>

            <a href="<?= BASE_URL ?? '.' ?>/admin/approval/anggota" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-anggota') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-user-check w-5 text-center"></i>
                <span class="font-medium">Pendaftaran Anggota</span>
            </a>

            <a href="<?= BASE_URL ?? '.' ?>/admin/approval/publikasi" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-publikasi') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-file-alt w-5 text-center"></i>
                <span class="font-medium">Publikasi Penelitian</span>
            </a>

            <a href="<?= BASE_URL ?? '.' ?>/admin/approval/peminjaman" 
               class="flex items-center gap-3 px-4 py-3 text-white rounded-lg transition-all duration-200 <?= (isset($activeMenu) && $activeMenu === 'approval-peminjaman') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' ?>">
                <i class="fas fa-hand-holding w-5 text-center"></i>
                <span class="font-medium">Peminjaman Barang</span>
            </a>


        <!-- User Profile Section -->
        <div class="border-t border-blue-500 p-4">
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" 
                        class="flex items-center justify-between w-full px-4 py-3 text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold shadow-lg">
                            <?= strtoupper(substr($_SESSION['user']['nama'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="text-left">
                            <div class="font-medium text-sm"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></div>
                            <div class="text-xs text-blue-200">Admin</div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-up text-xs transition-transform duration-200" :class="dropdownOpen ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="dropdownOpen" 
                     @click.away="dropdownOpen = false"
                     x-transition
                     class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-xl overflow-hidden"
                     style="display: none;">
                    <a href="<?= BASE_URL ?? '.' ?>/admin/profile" 
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
                        <?= strtoupper(substr($_SESSION['user']['nama'] ?? 'U', 0, 1)) ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <!-- Content will be inserted here -->