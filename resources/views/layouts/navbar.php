<?php
// Pastikan session sudah dimulai (sebaiknya di index.php atau awal script)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                     <a href="<?= BASE_URL ?? '.' ?>/" class="flex items-center gap-2">
                        <i class="fas fa-eye text-blue-600 text-2xl"></i> 
                        <span class="font-bold text-xl text-gray-800">IVSS Lab</span>
                    </a>
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Settings Dropdown (Jika Sudah Login) -->
                    <div class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            
                            <!-- Tampilkan nama user dari session -->
                            <div><?= htmlspecialchars($_SESSION['user']['nama'] ?? 'User') ?></div> 

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen" 
                             @click.away="dropdownOpen = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                             style="display: none;"> 
                            
                             <!-- Profile Link (Placeholder) -->
                            <a href="<?= BASE_URL ?? '.' ?>/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>

                            <a href="<?= BASE_URL ?? '.' ?>/equipment" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Dashboard
                            </a>

                            <!-- Logout Form -->
                            <form method="POST" action="<?= BASE_URL ?? '.' ?>/logout">
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Tombol Login / Register (Jika Belum Login) -->
                    <div class="flex items-center space-x-4">
                        <a href="<?= BASE_URL ?? '.' ?>/login" 
                           class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Log in
                        </a>
                        <a href="<?= BASE_URL ?? '.' ?>/register" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            Register
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden"> ... </div> -->
</nav>

