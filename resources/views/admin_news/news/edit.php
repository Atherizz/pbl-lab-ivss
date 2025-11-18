<?php 
$pageTitle = 'Edit Berita';
$activeMenu = 'news';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Berita</h2>

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <ul class="list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= (BASE_URL ?? '.') . '/admin-berita/news/' . urlencode($news['id']) ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Judul <span class="text-red-500">*</span>
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
                                Konten <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="content"
                                name="content"
                                rows="8"
                                required
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"><?= htmlspecialchars($news['content'] ?? '', ENT_QUOTES) ?></textarea>
                        </div>

                        <div>
                            <label for="image_file" class="block text-sm font-medium text-gray-700">
                                Gambar Berita
                            </label>
                            
                            <?php if (!empty($news['image_url'])) : ?>
                                <div class="mt-2 mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                                    <img src="<?= BASE_URL . '/' . htmlspecialchars($news['image_url']) ?>" alt="Gambar saat ini" class="h-32 w-auto rounded-md border border-gray-300">
                                </div>
                            <?php endif; ?>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m-11.828-11.828L28 28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Unggah file baru</span>
                                            <input id="image_file" name="image_file" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF hingga 5MB (opsional - biarkan kosong untuk mempertahankan gambar saat ini)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700">
                                Tanggal Terbit <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                required
                                value="<?= isset($news['published_at']) ? date('Y-m-d\TH:i', strtotime($news['published_at'])) : '' ?>"
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 bg-gray-100">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news"
                           class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                 class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Perbarui Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>