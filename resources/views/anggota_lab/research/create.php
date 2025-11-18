<?php
$pageTitle = 'Ajukan Riset';
$activeMenu = 'ajukan-riset';

require BASE_PATH . '/resources/views/layouts/dashboard.php';

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded">
                        <p class="font-bold">Mohon perbaiki kesalahan berikut:</p>
                        <ul class="list-disc pl-5 mt-2">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?? '.' ?>/anggota-lab/research" method="POST">
                    <div class="space-y-6">

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Judul Riset <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required
                                       value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['title']) ? 'border-red-500' : '' ?>">
                            <?php if (isset($errors['title'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['title']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($_SESSION['user']['role'] === 'mahasiswa'): ?>
                        <div>
                            <label for="dospem_id" class="block text-sm font-medium text-gray-700">
                                Dosen Pembimbing <span class="text-red-500">*</span>
                            </label>
                            <select id="dospem_id" name="dospem_id" required
                                     class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['dospem_id']) ? 'border-red-500' : '' ?>">
                                <option value="">-- Pilih Dosen Pembimbing --</option>
                                <?php if (!empty($dospemList)): ?>
                                    <?php foreach($dospemList as $dospem): ?>
                                        <option value="<?= $dospem['id'] ?>" <?= (isset($old['dospem_id']) && $old['dospem_id'] == $dospem['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($dospem['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                             <?php if (isset($errors['dospem_id'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['dospem_id']) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Deskripsi / Abstrak <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['description']) ? 'border-red-500' : '' ?>"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                            <?php if (isset($errors['description'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['description']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="publication_url" class="block text-sm font-medium text-gray-700">
                                URL Publikasi (Opsional)
                            </label>
                            <input type="url" id="publication_url" name="publication_url"
                                       value="<?= htmlspecialchars($old['publication_url'] ?? '') ?>"
                                       placeholder="https://ieeexplore.ieee.org/..."
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research"
                           class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                 class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Ajukan Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>