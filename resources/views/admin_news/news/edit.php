<?php 
$pageTitle = 'Edit News';
$activeMenu = 'news';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit News</h2>

                <form action="<?= (BASE_URL ?? '.') . '/admin-berita/news/' . urlencode($news['id']) ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                required
                                value="<?= htmlspecialchars($news['title'] ?? '', ENT_QUOTES) ?>"
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="content"
                                name="content"
                                rows="8"
                                required
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"><?= htmlspecialchars($news['content'] ?? '', ENT_QUOTES) ?></textarea>
                        </div>

                        <div>
                            <label for="image_url" class="block text-sm font-medium text-gray-700">
                                Image URL
                            </label>
                            <input
                                type="url"
                                id="image_url"
                                name="image_url"
                                value="<?= htmlspecialchars($news['image_url'] ?? '', ENT_QUOTES) ?>"
                                placeholder="https://example.com/image.jpg"
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            <p class="mt-1 text-sm text-gray-500">Optional: Enter the URL of the news image</p>
                        </div>

                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700">
                                Published Date <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                required
                                value="<?= isset($news['published_at']) ? date('Y-m-d\TH:i', strtotime($news['published_at'])) : '' ?>"
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                           Cancel
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                           Update News
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>