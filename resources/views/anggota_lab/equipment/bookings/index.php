<?php
$pageTitle = 'Manajemen Peminjaman Peralatan';
$activeMenu = 'peminjaman-saya';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <?php if (isset($success) && $success) : ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($success) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error) && $error) : ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Kelola Peminjaman Peralatan</h2>
                    <?php if (isset($totalItems) && $totalItems > 0) : ?>
                        <p class="text-sm text-gray-500 mt-1">Total: <?= $totalItems ?> peminjaman</p>
                    <?php elseif (isset($bookings)) : ?>
                        <p class="text-sm text-gray-500 mt-1">Total: <?= count($bookings) ?> peminjaman</p>
                    <?php endif; ?>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Peralatan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Periode
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bukti Kembali
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($bookings)) : ?>
                                <?php foreach ($bookings as $row) : ?>
                                    <?php
                                    $statusClass = match ($row['status']) {
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'returned' => 'bg-blue-100 text-blue-800',
                                        default     => 'bg-yellow-100 text-yellow-800',
                                    };
                                    ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($row['id']) ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <div class="font-medium"><?= htmlspecialchars($row['equipment_name'] ?? 'N/A') ?></div>
                                            <p class="text-xs text-gray-500 mt-1">ID: <?= htmlspecialchars($row['equipment_id']) ?></p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <?= htmlspecialchars($row['user_name'] ?? 'N/A') ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <div class="text-xs text-gray-600">Mulai: <?= date('d M Y, H:i', strtotime($row['start_date'])) ?></div>
                                            <div class="text-xs text-gray-600">Selesai: <?= date('d M Y, H:i', strtotime($row['end_date'])) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                                <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status']))) ?>
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if (!empty($row['return_proof_url'])) : ?>
                                                <img src="<?= BASE_URL . '/' . htmlspecialchars($row['return_proof_url']) ?>" alt="<?= htmlspecialchars($row['equipment_name'] ?? 'Bukti Pengembalian') ?>" class="h-12 w-12 object-cover rounded border border-gray-200 shadow-sm" loading="lazy">
                                            <?php else : ?>
                                                <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center border border-dashed border-gray-300">
                                                    <i class="fas fa-image text-gray-400 text-lg"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-2">
                                                <?php if ($row['status'] === 'pending_approval' || $row['status'] === 'rejected'): ?>
                                                    <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/equipment/bookings/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center text-red-600 hover:text-red-900"
                                                            title="Hapus"
                                                            onclick="return confirm('Anda yakin ingin menghapus peminjaman ini untuk <?= htmlspecialchars($row['equipment_name'] ?? '', ENT_QUOTES) ?>?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                <?php elseif ($row['status'] === 'approved'): ?>
                                                    <button
                                                        type="button"
                                                        onclick="openReturnModal(<?= (int)$row['id'] ?>)"
                                                        class="inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors"
                                                        title="Kembalikan Peralatan">
                                                        <i class="fas fa-undo mr-1"></i> Kembali
                                                    </button>

                                                <?php else: ?>
                                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-500 bg-gray-100 rounded">
                                                        <i class="fas fa-ban mr-1"></i> Tidak Ada Aksi
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php foreach ($bookings as $row): if ($row['status'] === 'approved'): ?>
                                    <div id="return-modal-<?= (int)$row['id'] ?>" class="fixed inset-0 z-50 hidden">
                                        <div class="fixed inset-0 bg-black bg-opacity-50" onclick="closeReturnModal(<?= (int)$row['id'] ?>)"></div>
                                        <div class="flex items-center justify-center min-h-screen p-4">
                                            <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg" onclick="event.stopPropagation()">
                                                <div class="flex items-center justify-between p-4 border-b">
                                                    <h3 class="text-lg font-semibold text-gray-800">Unggah Bukti Pengembalian</h3>
                                                    <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeReturnModal(<?= (int)$row['id'] ?>)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <form method="POST" action="<?= (BASE_URL ?? '.') . '/anggota-lab/equipment/bookings/return/' . (int)$row['id'] ?>" enctype="multipart/form-data" class="p-6 space-y-4">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <div>
                                                        <label for="return_file_<?= (int)$row['id'] ?>" class="block text-sm font-medium text-gray-700 mb-1">Gambar Bukti Pengembalian</label>
                                                        <input id="return_file_<?= (int)$row['id'] ?>" name="image_file" type="file" accept="image/*" onchange="previewReturnImage(event, <?= (int)$row['id'] ?>)" class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                                                    </div>
                                                    <div id="preview_wrapper_<?= (int)$row['id'] ?>" class="hidden">
                                                        <p class="text-xs text-gray-500 mb-2">Pratinjau:</p>
                                                        <img id="preview_img_<?= (int)$row['id'] ?>" src="#" alt="Pratinjau" class="max-h-64 rounded border" />
                                                    </div>
                                                    <div class="flex justify-end gap-2 pt-2">
                                                        <button type="button" onclick="closeReturnModal(<?= (int)$row['id'] ?>)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Batal</button>
                                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                                endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <i class="fas fa-calendar-alt text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-600 font-medium">Tidak ada peminjaman peralatan ditemukan.</p>
                                        <p class="text-xs text-gray-400 mt-1">Kunjungi <a href="<?= BASE_URL ?? '.' ?>/anggota_lab/equipment/bookings/katalog" class="text-blue-500 hover:text-blue-600 font-semibold">Katalog Peralatan</a> untuk membuat peminjaman baru.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> hingga <?= $endItem ?? 0 ?> dari <?= $totalItems ?? 0 ?> entri</span>
                            
                            <div class="flex space-x-1">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings?page=<?= $currentPage - 1 ?>" 
                                        class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </a>
                                <?php else : ?>
                                    <button class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed" disabled>
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </button>
                                <?php endif; ?>

                                <div class="flex space-x-1">
                                    <?php 
                                    $maxPages = 7;
                                    $startPage = max(1, $currentPage - floor($maxPages / 2));
                                    $endPage = min($totalPages, $startPage + $maxPages - 1);
                                    
                                    if ($endPage - $startPage < $maxPages - 1) {
                                        $startPage = max(1, $endPage - $maxPages + 1);
                                    }
                                    
                                    if ($startPage > 1) : ?>
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings?page=1" 
                                            class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            1
                                        </a>
                                        <?php if ($startPage > 2) : ?>
                                            <span class="px-3 py-2">...</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                                        <?php if ($i == $currentPage) : ?>
                                            <button class="px-3 py-2 border rounded-md bg-blue-600 text-white font-semibold">
                                                <?= $i ?>
                                            </button>
                                        <?php else : ?>
                                            <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings?page=<?= $i ?>" 
                                                class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                                <?= $i ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    
                                    <?php 
                                    if ($endPage < $totalPages) : ?>
                                        <?php if ($endPage < $totalPages - 1) : ?>
                                            <span class="px-3 py-2">...</span>
                                        <?php endif; ?>
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings?page=<?= $totalPages ?>" 
                                            class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings?page=<?= $currentPage + 1 ?>" 
                                        class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php else : ?>
                                    <button class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed" disabled>
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function openReturnModal(id) {
        const modal = document.getElementById('return-modal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeReturnModal(id) {
        const modal = document.getElementById('return-modal-' + id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            const wrapper = document.getElementById('preview_wrapper_' + id);
            const img = document.getElementById('preview_img_' + id);
            if (wrapper && img) {
                wrapper.classList.add('hidden');
                img.src = '#';
            }
            const input = document.getElementById('return_file_' + id);
            if (input) input.value = '';
        }
    }

    function previewReturnImage(event, id) {
        const file = event.target.files[0];
        if (!file) return;
        const wrapper = document.getElementById('preview_wrapper_' + id);
        const img = document.getElementById('preview_img_' + id);
        if (wrapper && img) {
            img.src = URL.createObjectURL(file);
            wrapper.classList.remove('hidden');
        }
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^="return-modal-"]').forEach(m => m.classList.add('hidden'));
            document.body.style.overflow = 'auto';
        }
    });
</script>