<?php 
$pageTitle = 'News Dashboard';
$activeMenu = 'dashboard';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

            <!-- Dashboard Content -->
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-8 mb-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Welcome back, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?>! 👋</h2>
                        <p class="text-blue-100">Manage and publish lab news & updates.</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-5xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+5</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total News</h3>
                    <p class="text-3xl font-bold text-gray-900">48</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">Active</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Published</h3>
                    <p class="text-3xl font-bold text-gray-900">42</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-orange-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">Pending</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Draft</h3>
                    <p class="text-3xl font-bold text-gray-900">6</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-eye text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+24%</span>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Views</h3>
                    <p class="text-3xl font-bold text-gray-900">2.5K</p>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent News -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Recent News</h3>
                        <a href="<?= BASE_URL ?? '.' ?>/admin/news" class="text-sm text-blue-600 hover:text-blue-700">View All</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Published</span>
                                        <span class="text-xs text-gray-400">2 hours ago</span>
                                    </div>
                                    <h4 class="text-sm text-gray-900 font-medium mb-1">Lab Wins Research Excellence Award 2024</h4>
                                    <p class="text-xs text-gray-500">IVSS Lab recognized for outstanding contributions in computer vision research...</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-400">
                                        <span><i class="fas fa-eye mr-1"></i>234 views</span>
                                        <span><i class="fas fa-heart mr-1"></i>45 likes</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-newspaper text-purple-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Published</span>
                                        <span class="text-xs text-gray-400">5 hours ago</span>
                                    </div>
                                    <h4 class="text-sm text-gray-900 font-medium mb-1">Workshop: Deep Learning for Beginners</h4>
                                    <p class="text-xs text-gray-500">Join our upcoming workshop on January 15th to learn the fundamentals...</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-400">
                                        <span><i class="fas fa-eye mr-1"></i>189 views</span>
                                        <span><i class="fas fa-heart mr-1"></i>38 likes</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-newspaper text-orange-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Draft</span>
                                        <span class="text-xs text-gray-400">1 day ago</span>
                                    </div>
                                    <h4 class="text-sm text-gray-900 font-medium mb-1">New Equipment Arrival Announcement</h4>
                                    <p class="text-xs text-gray-500">We're excited to announce the arrival of new NVIDIA GPUs for our lab...</p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <button class="text-xs text-blue-600 hover:text-blue-700">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                        <button class="text-xs text-green-600 hover:text-green-700">
                                            <i class="fas fa-check mr-1"></i>Publish
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Stats -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/admin/news/create'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-plus-circle"></i>
                                <span class="font-medium text-sm">Create New Post</span>
                            </button>
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/admin/news?status=draft'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-700 rounded-lg hover:bg-orange-100 transition-colors">
                                <i class="fas fa-edit"></i>
                                <span class="font-medium text-sm">View Drafts</span>
                            </button>
                            <button onclick="window.location.href='<?= BASE_URL ?? '.' ?>/admin/news/analytics'" 
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                                <i class="fas fa-chart-line"></i>
                                <span class="font-medium text-sm">View Analytics</span>
                            </button>
                        </div>
                    </div>

                    <!-- Popular Posts -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Most Popular</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-trophy text-yellow-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">Research Paper Published in IEEE</p>
                                    <p class="text-xs text-gray-500 mt-0.5">1,234 views</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-gray-600">2</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">Student Competition Winners</p>
                                    <p class="text-xs text-gray-500 mt-0.5">876 views</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-gray-600">3</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">Lab Facility Upgrade</p>
                                    <p class="text-xs text-gray-500 mt-0.5">654 views</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>