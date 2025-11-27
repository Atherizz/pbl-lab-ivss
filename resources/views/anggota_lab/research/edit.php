<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6"><?= htmlspecialchars($header) ?></h2>

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

                <?php 
                // Cek apakah status adalah pending_approval
                $isPendingApproval = ($research['status'] ?? 'pending_approval') === 'pending_approval';
                
                // Cek role user
                $userRole = $_SESSION['user']['role'] ?? '';
                $isMahasiswa = ($userRole === 'mahasiswa');
                ?>

                <?php if (!$isPendingApproval): ?>
                    <div class="mb-6 p-4 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded">
                        <p class="font-medium flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Penelitian ini sudah diproses. Hanya kolom URL Publikasi yang dapat diedit.
                        </p>
                    </div>
                <?php endif; ?>

                <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . ($research['id'] ?? '') ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="space-y-6">

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Judul Penelitian <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required
                                   value="<?= htmlspecialchars($old['title'] ?? $research['title'] ?? '', ENT_QUOTES) ?>"
                                   <?= !$isPendingApproval ? 'readonly' : '' ?>
                                   class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= !$isPendingApproval ? 'bg-gray-100 cursor-not-allowed' : '' ?> <?= isset($errors['title']) ? 'border-red-500' : '' ?>">
                            <?php if (isset($errors['title'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['title']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($isMahasiswa): ?>
                        <div>
                            <label for="dospem_id" class="block text-sm font-medium text-gray-700">
                                Supervisor (Dosen Pembimbing) <span class="text-red-500">*</span>
                            </label>
                            <?php
                            // Tentukan nilai yang dipilih (dari data 'old' jika ada, jika tidak, dari '$research')
                            $selectedDospemId = $old['dospem_id'] ?? $research['dospem_id'] ?? null;
                            ?>
                            
                            <?php if (!$isPendingApproval): ?>
                                <!-- Tampilkan sebagai text biasa jika sudah diproses -->
                                <input type="text" 
                                       value="<?= htmlspecialchars($research['dospem_name'] ?? 'N/A') ?>" 
                                       readonly
                                       class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed">
                                <!-- Hidden input untuk mengirim nilai dospem_id -->
                                <input type="hidden" name="dospem_id" value="<?= htmlspecialchars($selectedDospemId ?? '') ?>">
                            <?php else: ?>
                                <!-- Select dropdown jika masih pending -->
                                <select id="dospem_id" name="dospem_id" required
                                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['dospem_id']) ? 'border-red-500' : '' ?>">
                                    <option value="">-- Pilih Supervisor --</option>
                                    <?php if (!empty($dospemList)): ?>
                                        <?php foreach($dospemList as $dospem): ?>
                                            <option value="<?= $dospem['id'] ?>" <?= ($selectedDospemId == $dospem['id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($dospem['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            <?php endif; ?>
                            
                             <?php if (isset($errors['dospem_id'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['dospem_id']) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                            <!-- Jika bukan mahasiswa, kirim null untuk dospem_id -->
                            <input type="hidden" name="dospem_id" value="">
                        <?php endif; ?>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                      <?= !$isPendingApproval ? 'readonly' : '' ?>
                                      class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= !$isPendingApproval ? 'bg-gray-100 cursor-not-allowed' : '' ?> <?= isset($errors['description']) ? 'border-red-500' : '' ?>"><?= htmlspecialchars($old['description'] ?? $research['description'] ?? '', ENT_QUOTES) ?></textarea>
                            <?php if (isset($errors['description'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['description']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="publication_url" class="block text-sm font-medium text-gray-700">
                                Link Publikasi <?= !$isPendingApproval ? '<span class="text-green-600">(Dapat diedit)</span>' : '(Opsional)' ?>
                            </label>
                            <input type="url" id="publication_url" name="publication_url"
                                   value="<?= htmlspecialchars($old['publication_url'] ?? $research['publication_url'] ?? '', ENT_QUOTES) ?>"
                                   placeholder="https://ieeexplore.ieee.org/..."
                                   class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <?php if (!$isPendingApproval): ?>
                                <p class="mt-1 text-xs text-gray-500">
                                    <i class="fas fa-check-circle text-green-600"></i> Anda dapat memperbarui URL publikasi setelah penelitian disetujui.
                                </p>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <?= $isPendingApproval ? 'Update Proposal' : 'Update Link Publikasi' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>