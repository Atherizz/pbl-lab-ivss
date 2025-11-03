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
                        <h2 class="text-2xl font-bold mb-2">Welcome back, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?>! 👋</h2>
                        <p class="text-blue-100">Here's what's happening with your lab today.</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-5xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-desktop text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+12%</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Equipment</h3>
                    <p class="text-3xl font-bold text-gray-900">24</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">75%</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Available</h3>
                    <p class="text-3xl font-bold text-gray-900">18</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+8</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Publikasi</h3>
                    <p class="text-3xl font-bold text-gray-900">42</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-orange-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">Active</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Anggota Lab</h3>
                    <p class="text-3xl font-bold text-gray-900">16</p>
                </div>
            </div>

            <!-- Activity & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-plus text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 font-medium mb-1">New equipment added</p>
                                    <p class="text-xs text-gray-500">NVIDIA Jetson Nano Developer Kit</p>
                                    <span class="text-xs text-gray-400 mt-1 inline-block">2 hours ago</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-file-alt text-purple-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 font-medium mb-1">Publication published</p>
                                    <p class="text-xs text-gray-500">Deep Learning for Object Detection</p>
                                    <span class="text-xs text-gray-400 mt-1 inline-block">5 hours ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/equipment/create'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-plus-circle"></i>
                                <span class="font-medium text-sm">Add Equipment</span>
                            </button>
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/publikasi/create'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                                <i class="fas fa-book"></i>
                                <span class="font-medium text-sm">Add Publication</span>
                            </button>
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/anggota/create'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition-colors">
                                <i class="fas fa-user-plus"></i>
                                <span class="font-medium text-sm">Add Member</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>