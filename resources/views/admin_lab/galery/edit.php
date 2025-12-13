<?php 
$pageTitle = 'Edit Dokumentasi Kegiatan';
$galery = $galery ?? [];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Edit Dokumentasi</h2>
                    <a href="<?= BASE_URL ?>/admin-lab/galery" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL . '/admin-lab/galery/' . $galery['id'] . '/update' ?>" method="POST" enctype="multipart/form-data">
                    <div class="space-y-6">
                        <div>
                            <label for="caption" class="block text-sm font-medium text-gray-700">Caption <span class="text-red-500">*</span></label>
                            <textarea id="caption" name="caption" rows="4" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"><?= htmlspecialchars($galery['caption'] ?? '') ?></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Dokumentasi</label>
                            <?php if (!empty($galery['image_url'])): ?>
                                <div class="mt-2 mb-4">
                                    <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                                    <img src="<?= BASE_URL . '/' . $galery['image_url'] ?>" class="h-48 w-auto object-cover rounded-md border border-gray-300">
                                </div>
                            <?php endif; ?>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-image text-gray-400 text-3xl"></i>
                                    <div class="flex text-sm text-gray-600 justify-center mt-2">
                                        <label for="image_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload file baru</span>
                                            <input id="image_file" name="image_file" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?>/admin-lab/galery" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Batal</a>
                        <button type="submit" name="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>