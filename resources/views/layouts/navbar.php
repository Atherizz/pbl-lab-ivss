<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Definisikan BASE_URL jika belum ada (untuk mencegah error)
$base_url = defined('BASE_URL') ? BASE_URL : '.';
?>

<nav x-data="{ mobileMenuOpen: false, dropdownOpen: false }" class="bg-slate-800/95 backdrop-blur-md border-b border-slate-700 sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?= $base_url ?>/" class="text-cyan-400 text-3xl font-extrabold tracking-tight hover:text-cyan-300 transition-colors">
                    IVSS
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center lg:space-x-1">
                <a href="<?= $base_url ?>/#visi-misi" 
                   class="text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    Visi & Misi
                </a>
                
                <a href="<?= $base_url ?>/#anggota-lab" 
                   class="text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    Anggota
                </a>
                
                <a href="<?= $base_url ?>/fasilitas" 
                   class="text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    Fasilitas
                </a>
                
                <a href="<?= $base_url ?>/#riset-penelitian" 
                   class="text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    Riset
                </a>
                
                <a href="<?= $base_url ?>/berita" 
                   class="text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    Berita
                </a>
            </div>

            <!-- Desktop User Menu -->
            <div class="hidden lg:flex lg:items-center lg:space-x-3">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                class="flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-cyan-400 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)) ?>
                            </div>
                            <span class="text-sm font-medium"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="dropdownOpen" 
                             @click.away="dropdownOpen = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 rounded-xl shadow-xl py-2 bg-slate-800 border border-slate-700 z-50"
                             style="display: none;">
                            
                            <?php 
                                $role = $_SESSION['user']['role'] ?? 'anggota_lab';
                                $dashLink = match($role) {
                                    'admin_lab' => '/admin-lab/dashboard',
                                    'admin_berita' => '/admin-berita/dashboard',
                                    default => '/anggota-lab/dashboard'
                                };
                            ?>

                            <a href="<?= $base_url . $dashLink ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400 transition-colors">
                                <i class="fas fa-th-large w-4"></i>
                                <span>Dashboard</span>
                            </a>
                            
                            <a href="<?= $base_url ?>/anggota-lab/profile" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400 transition-colors">
                                <i class="fas fa-user w-4"></i>
                                <span>Profil Saya</span>
                            </a>

                            <div class="border-t border-slate-700 my-2"></div>

                            <form method="POST" action="<?= $base_url ?>/logout">
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors">
                                    <i class="fas fa-sign-out-alt w-4"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- Empty space for non-authenticated users - login is floating button -->
                    <div></div>
                <?php endif; ?>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex lg:hidden items-center gap-2">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Mobile User Avatar -->
                    <button @click="dropdownOpen = !dropdownOpen"
                            class="w-9 h-9 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                        <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)) ?>
                    </button>
                <?php endif; ?>
                
                <!-- Hamburger Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-cyan-400 hover:bg-slate-700/50 transition-all duration-200 focus:outline-none">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg class="h-6 w-6" x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Close icon -->
                    <svg class="h-6 w-6" x-show="mobileMenuOpen" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-slate-700 bg-slate-800"
         style="display: none;">
        
        <div class="px-4 pt-2 pb-4 space-y-1">
            <!-- Navigation Links -->
            <a href="<?= $base_url ?>/#visi-misi" 
               class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                <i class="fas fa-bullseye w-6"></i>
                Visi & Misi
            </a>
            
            <a href="<?= $base_url ?>/#anggota-lab" 
               class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                <i class="fas fa-users w-6"></i>
                Anggota Laboratorium
            </a>
            
            <a href="<?= $base_url ?>/fasilitas" 
               class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                <i class="fas fa-building w-6"></i>
                Fasilitas
            </a>
            
            <a href="<?= $base_url ?>/#riset-penelitian" 
               class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                <i class="fas fa-flask w-6"></i>
                Riset
            </a>
            
            <a href="<?= $base_url ?>/berita" 
               class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                <i class="fas fa-newspaper w-6"></i>
                Berita
            </a>

            <?php if (isset($_SESSION['user'])): ?>
                <!-- Mobile User Menu -->
                <div class="border-t border-slate-700 mt-3 pt-3">
                    <?php 
                        $role = $_SESSION['user']['role'] ?? 'anggota_lab';
                        $dashLink = match($role) {
                            'admin_lab' => '/admin-lab/dashboard',
                            'admin_berita' => '/admin-berita/dashboard',
                            default => '/anggota-lab/dashboard'
                        };
                    ?>
                    
                    <a href="<?= $base_url . $dashLink ?>" 
                       class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                        <i class="fas fa-th-large w-6"></i>
                        Dashboard
                    </a>
                    
                    <a href="<?= $base_url ?>/anggota-lab/profile" 
                       class="block px-4 py-3 rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-slate-700/50 text-sm font-medium transition-all">
                        <i class="fas fa-user w-6"></i>
                        Profil Saya
                    </a>
                    
                    <form method="POST" action="<?= $base_url ?>/logout">
                        <button type="submit" 
                                class="w-full text-left px-4 py-3 rounded-lg text-red-400 hover:text-red-300 hover:bg-slate-700/50 text-sm font-medium transition-all">
                            <i class="fas fa-sign-out-alt w-6"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <!-- Mobile menu untuk non-authenticated users tidak perlu login button -->
            <?php endif; ?>
        </div>
    </div>

    <!-- Mobile Dropdown untuk user yang sudah login -->
    <?php if (isset($_SESSION['user'])): ?>
    <div x-show="dropdownOpen" 
         @click.away="dropdownOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden absolute right-4 mt-2 w-56 rounded-xl shadow-xl py-2 bg-slate-800 border border-slate-700 z-50"
         style="display: none;">
        
        <?php 
            $role = $_SESSION['user']['role'] ?? 'anggota_lab';
            $dashLink = match($role) {
                'admin_lab' => '/admin-lab/dashboard',
                'admin_berita' => '/admin-berita/dashboard',
                default => '/anggota-lab/dashboard'
            };
        ?>

        <div class="px-4 py-3 border-b border-slate-700">
            <p class="text-xs text-slate-400">Signed in as</p>
            <p class="text-sm font-medium text-white truncate"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></p>
        </div>

        <a href="<?= $base_url . $dashLink ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400 transition-colors">
            <i class="fas fa-th-large w-4"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="<?= $base_url ?>/anggota-lab/profile" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400 transition-colors">
            <i class="fas fa-user w-4"></i>
            <span>Profil Saya</span>
        </a>

        <div class="border-t border-slate-700 my-2"></div>

        <form method="POST" action="<?= $base_url ?>/logout">
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors">
                <i class="fas fa-sign-out-alt w-4"></i>
                <span>Log Out</span>
            </button>
        </form>
    </div>
    <?php endif; ?>
</nav>