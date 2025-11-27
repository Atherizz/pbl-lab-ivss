<?php 
$pageTitle = 'Tambah Anggota Lab Baru';
$activeMenu = 'members';

$old = $old ?? [];
$errors = $errors ?? [];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Tambah Anggota Lab</h2>

                <?php if (!empty($errors)): ?>
                    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                        <p class="text-sm font-medium text-red-800">Mohon koreksi kesalahan berikut sebelum menyimpan:</p>
                        <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?? '.' ?>/admin-lab/members" method="POST">
                    <div class="space-y-6">
                        
                        <?php 
                            $nameError = $errors['name'] ?? null; 
                        ?>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required 
                                value="<?= htmlspecialchars($old['name'] ?? '') ?>" 
                                class="block w-full mt-1 p-2 border <?= $nameError ? 'border-red-500' : 'border-gray-300' ?> rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            
                            <?php if ($nameError): ?>
                                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($nameError) ?></p>
                            <?php endif; ?>
                        </div>

                        <?php 
                            $regNumberError = $errors['reg_number'] ?? null; 
                        ?>
                        <div>
                            <label for="reg_number" class="block text-sm font-medium text-gray-700">
                                NIM / NIP <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="reg_number" name="reg_number" required 
                                value="<?= htmlspecialchars($old['reg_number'] ?? '') ?>" 
                                class="block w-full mt-1 p-2 border <?= $regNumberError ? 'border-red-500' : 'border-gray-300' ?> rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            
                            <?php if ($regNumberError): ?>
                                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($regNumberError) ?></p>
                            <?php endif; ?>

                            <p class="mt-2 text-xs text-gray-500">
                                Password awal untuk anggota ini akan otomatis diatur sama dengan NIM / NIP.
                            </p>
                        </div>

                        <input type="hidden" name="role" value="anggota_lab">

                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/members" 
                            class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Simpan Anggota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>