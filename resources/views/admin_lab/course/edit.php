<?php 
$pageTitle = 'Edit Course';
$activeMenu = 'course';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Data Course</h2>

                <form action="<?= (BASE_URL ?? '.') . '/admin-lab/course/' . urlencode($course['id']) ?>" method="POST">
                    <!-- Method Spoofing untuk UPDATE -->
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="space-y-6">
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Nama Course (Title) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required 
                                   value="<?= htmlspecialchars($old['title'] ?? $course['title']) ?>" 
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Deskripsi
                            </label>
                            <textarea id="description" name="description" rows="4"
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($old['description'] ?? $course['description']) ?></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Icon Name -->
                            <div>
                                <label for="icon_name" class="block text-sm font-medium text-gray-700">
                                    Nama Icon/File
                                </label>
                                <input type="text" id="icon_name" name="icon_name" 
                                       value="<?= htmlspecialchars($old['icon_name'] ?? $course['icon_name']) ?>"
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Total Sessions -->
                            <div>
                                <label for="total_sessions" class="block text-sm font-medium text-gray-700">
                                    Total Pertemuan <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="total_sessions" name="total_sessions" required
                                       value="<?= htmlspecialchars($old['total_sessions'] ?? $course['total_sessions']) ?>"
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Level -->
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700">
                                Level <span class="text-red-500">*</span>
                            </label>
                            <select id="level" name="level" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <?php $currentLevel = $old['level'] ?? $course['level']; ?>
                                <option value="Beginner" <?= $currentLevel == 'Beginner' ? 'selected' : '' ?>>Beginner</option>
                                <option value="Intermediate" <?= $currentLevel == 'Intermediate' ? 'selected' : '' ?>>Intermediate</option>
                                <option value="Advanced" <?= $currentLevel == 'Advanced' ? 'selected' : '' ?>>Advanced</option>
                            </select>
                        </div>

                        <!-- Action URL -->
                        <div>
                            <label for="action_url" class="block text-sm font-medium text-gray-700">
                                Link Pendaftaran
                            </label>
                            <input type="text" id="action_url" name="action_url"
                                   value="<?= htmlspecialchars($old['action_url'] ?? $course['action_url']) ?>"
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/course" 
                           class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Perbarui Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>