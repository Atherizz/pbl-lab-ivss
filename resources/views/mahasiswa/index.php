<?php 
$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

            <!-- Dashboard Content -->
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-8 mb-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Selamat Datang, <?= htmlspecialchars($_SESSION['user']['nama'] ?? 'Mahasiswa') ?>! 👋</h2>
                        <p class="text-blue-100">Kelola riset dan peminjaman peralatan lab Anda.</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-5xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-flask text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Active</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Riset Aktif</h3>
                    <p class="text-3xl font-bold text-gray-900">2</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-hand-holding text-orange-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-2 py-1 rounded-full">In Use</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Peminjaman Aktif</h3>
                    <p class="text-3xl font-bold text-gray-900">1</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">Total</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Kontribusi Publikasi</h3>
                    <p class="text-3xl font-bold text-gray-900">3</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-green-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+5</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Aktivitas</h3>
                    <p class="text-3xl font-bold text-gray-900">24</p>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Status Peminjaman -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Status Peminjaman Saya</h3>
                        <a href="<?= BASE_URL ?? '.' ?>/mahasiswa/equipment/bookings" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <!-- Peminjaman Aktif -->
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-desktop text-blue-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Sedang Dipinjam</span>
                                    </div>
                                    <h4 class="text-sm text-gray-900 font-medium mb-1">NVIDIA Jetson Nano Developer Kit</h4>
                                    <p class="text-xs text-gray-500 mb-2">Untuk riset: Deep Learning Object Detection</p>
                                    <div class="flex items-center gap-4 text-xs text-gray-600">
                                        <span><i class="fas fa-calendar mr-1"></i>Mulai: 01 Nov 2024</span>
                                        <span><i class="fas fa-calendar-check mr-1"></i>Selesai: 15 Nov 2024</span>
                                    </div>
                                    <div class="mt-3">
                                        <button class="text-xs text-blue-600 hover:text-blue-700 font-medium">
                                            <i class="fas fa-undo mr-1"></i>Kembalikan Peralatan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Peminjaman Selesai -->
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-microchip text-gray-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Dikembalikan</span>
                                    </div>
                                    <h4 class="text-sm text-gray-900 font-medium mb-1">Raspberry Pi 4 Model B</h4>
                                    <p class="text-xs text-gray-500 mb-2">Untuk riset: IoT Smart System</p>
                                    <div class="flex items-center gap-4 text-xs text-gray-600">
                                        <span><i class="fas fa-check-circle mr-1"></i>Dikembalikan: 28 Oct 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- No Equipment -->
                        <div class="p-6 text-center">
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/mahasiswa/equipment/katalog'" 
                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                <i class="fas fa-plus-circle"></i>
                                Ajukan Peminjaman Baru
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/mahasiswa/riset/ajukan'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-flask"></i>
                                <span class="font-medium text-sm">Ajukan Riset Baru</span>
                            </button>
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/mahasiswa/equipment/katalog'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition-colors">
                                <i class="fas fa-hand-holding"></i>
                                <span class="font-medium text-sm">Pinjam Peralatan</span>
                            </button>
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/mahasiswa/equipment/katalog'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                                <i class="fas fa-th-list"></i>
                                <span class="font-medium text-sm">Lihat Katalog</span>
                            </button>
                        </div>
                    </div>

                    <!-- Lab Hours -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
                        <div class="flex items-center gap-3 mb-3">
                            <i class="fas fa-clock text-2xl"></i>
                            <h3 class="text-lg font-semibold">Jam Operasional Lab</h3>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-blue-100">Senin - Jumat</span>
                                <span class="font-medium">08:00 - 17:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-100">Sabtu</span>
                                <span class="font-medium">09:00 - 14:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-100">Minggu</span>
                                <span class="font-medium text-blue-200">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riset & Berita Lab -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Riset Aktif Saya -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Riset Aktif Saya</h3>
                        <a href="<?= BASE_URL ?? '.' ?>/mahasiswa/riset" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-flask text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">Deep Learning for Real-Time Object Detection</h4>
                                    <p class="text-xs text-gray-500 mb-2">Status: Active • Progress: 65%</p>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-2">
                                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: 65%"></div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-gray-600">
                                        <span><i class="fas fa-calendar mr-1"></i>Deadline: 20 Dec 2024</span>
                                        <span><i class="fas fa-users mr-1"></i>3 members</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-flask text-purple-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">IoT-Based Smart Agriculture System</h4>
                                    <p class="text-xs text-gray-500 mb-2">Status: Active • Progress: 40%</p>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-2">
                                        <div class="bg-purple-600 h-1.5 rounded-full" style="width: 40%"></div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-gray-600">
                                        <span><i class="fas fa-calendar mr-1"></i>Deadline: 15 Jan 2025</span>
                                        <span><i class="fas fa-users mr-1"></i>2 members</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Berita & Aktivitas Lab -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Berita & Aktivitas Lab</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-trophy text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">Lab Wins Research Excellence Award 2024</h4>
                                    <p class="text-xs text-gray-500 mb-1">IVSS Lab recognized for outstanding contributions...</p>
                                    <span class="text-xs text-gray-400">2 hours ago</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-purple-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">Workshop: Deep Learning for Beginners</h4>
                                    <p class="text-xs text-gray-500 mb-1">Join our upcoming workshop on January 15th...</p>
                                    <span class="text-xs text-gray-400">5 hours ago</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-box text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">New Equipment Available</h4>
                                    <p class="text-xs text-gray-500 mb-1">NVIDIA RTX 4090 now available for research...</p>
                                    <span class="text-xs text-gray-400">1 day ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>