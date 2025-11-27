<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Definisikan BASE_URL jika belum ada (untuk mencegah error)
$base_url = defined('BASE_URL') ? BASE_URL : '.';
?>

<nav x-data="{ open: false, dropdownOpen: false }" class="bg-slate-800 border-b border-slate-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                     <a href="<?= $base_url ?>/" class="text-cyan-400 text-3xl font-extrabold tracking-tight hover:text-cyan-300 transition-colors">
                        IVSS
                    </a>
                </div>
                
                <div class="hidden sm:ml-8 sm:flex sm:space-x-8 items-center">
                    <a href="<?= $base_url ?>/#visi-misi" 
                    class="text-slate-300 hover:text-cyan-400 px-3 py-2 text-sm font-medium transition-colors">
                    Visi & Misi
                </a>
                
                <a href="<?= $base_url ?>/#anggota-lab" 
                class="text-slate-300 hover:text-cyan-400 px-3 py-2 text-sm font-medium transition-colors">
                Anggota Laboratorium
            </a>
            <a href="<?= $base_url ?>/fasilitas" 
            class="text-slate-300 hover:text-cyan-400 px-3 py-2 text-sm font-medium transition-colors">
            Fasilitas
            </a>
            <a href="<?= $base_url ?>/#riset-penelitian" 
            class="text-slate-300 hover:text-cyan-400 px-3 py-2 text-sm font-medium transition-colors">
            Riset
            </a>
            <a href="<?= $base_url ?>/berita" 
            class="text-slate-300 hover:text-cyan-400 px-3 py-2 text-sm font-medium transition-colors">
            Berita
            </a>
        </div>
    </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <?php if (isset($_SESSION['user'])): ?>
                    
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                class="flex items-center gap-2 text-sm font-medium text-slate-300 hover:text-cyan-400 focus:outline-none transition duration-150 ease-in-out">
                            <span>Halo, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></span>
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
                             class="absolute right-0 mt-2 w-48 rounded-xl shadow-xl py-1 bg-slate-800 border border-slate-700 ring-1 ring-black ring-opacity-5 z-50"
                             style="display: none;"> 
                            
                            <?php 
                                // Tentukan link dashboard berdasarkan role
                                $role = $_SESSION['user']['role'] ?? 'anggota_lab';
                                $dashLink = match($role) {
                                    'admin_lab' => '/admin-lab/dashboard',
                                    'admin_berita' => '/admin-berita/dashboard',
                                    default => '/anggota-lab/dashboard'
                                };
                            ?>

                            <a href="<?= $base_url . $dashLink ?>" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400">
                                <i class="fas fa-th-large mr-2"></i> Dashboard
                            </a>
                            
                            <a href="<?= $base_url ?>/anggota-lab/profile" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-cyan-400">
                                <i class="fas fa-user mr-2"></i> Profil Saya
                            </a>

                            <div class="border-t border-slate-700 my-1"></div>

                            <form method="POST" action="<?= $base_url ?>/logout">
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-slate-700 hover:text-red-300 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="flex items-center space-x-4">
                        <a href="<?= $base_url ?>/login" 
                           class="px-4 py-2 text-sm font-semibold text-cyan-400 border border-cyan-500 rounded-full hover:bg-cyan-500/10 transition-all">
                            Login
                        </a>
                        <a href="<?= $base_url ?>/register" 
                           class="px-4 py-2 text-sm font-semibold text-slate-900 bg-cyan-400 rounded-full hover:bg-cyan-300 transition-all shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                            Register
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>