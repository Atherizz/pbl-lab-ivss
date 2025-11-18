<?php 
$pageTitle = 'Edit Peralatan';
$activeMenu = 'equipment';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Peralatan</h2>

                <form action="<?= (BASE_URL ?? '.') . '/admin-lab/equipment/' . urlencode($equipment['id']) ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                value="<?= htmlspecialchars($equipment['name'] ?? '', ENT_QUOTES) ?>"
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Deskripsi
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($equipment['description'] ?? '', ENT_QUOTES) ?></textarea>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="status"
                                name="status"
                                required
                                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <?php $current = $equipment['status'] ?? ''; ?>
                                <option value="available"   <?= $current === 'available'   ? 'selected' : '' ?>>Tersedia</option>
                                <option value="in_use"      <?= $current === 'in_use'      ? 'selected' : '' ?>>Sedang Digunakan</option>
                                <option value="maintenance" <?= $current === 'maintenance' ? 'selected' : '' ?>>Perawatan</option>
                                <option value="broken"      <?= $current === 'broken'      ? 'selected' : '' ?>>Rusak</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment"
                           class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                 class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Perbarui Peralatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>