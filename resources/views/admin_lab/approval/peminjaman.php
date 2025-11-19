<?php 
$pageTitle = 'Persetujuan Peminjaman';
$activeMenu = 'approval-peminjaman';

$successMessage = flash('success'); 
$errorMessage = flash('error');
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <?php if ($successMessage) : ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if ($errorMessage) : ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($errorMessage) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Persetujuan Peminjaman</h2>
                        <p class="text-sm text-gray-500">Daftar permintaan peminjaman alat yang menunggu persetujuan</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($equipmentBooking)): ?>
                            <?php foreach ($equipmentBooking as $row): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($row['id']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($row['equipment_name']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status'] ?? 'pending_approval'))) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button
                                        onclick="openModal('modal-<?= $row['id'] ?>')"
                                        class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center text-gray-400">
                                        <i class="fas fa-inbox text-5xl mb-3"></i>
                                        <p class="text-sm font-medium">Tidak ada persetujuan yang tertunda</p>
                                        <p class="text-xs mt-1">Semua permintaan peminjaman telah diproses</p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> hingga <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                            
                            <div class="flex space-x-1">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= BASE_URL . '/admin-lab/approval/peminjaman' ?>?page=<?= $currentPage - 1 ?>" 
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
                                        <a href="<?= BASE_URL . '/admin-lab/approval/peminjaman' ?>?page=1" 
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
                                            <a href="<?= BASE_URL . '/admin-lab/approval/peminjaman' ?>?page=<?= $i ?>" 
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
                                        <a href="<?= BASE_URL . '/admin-lab/approval/peminjaman' ?>?page=<?= $totalPages ?>" 
                                            class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= BASE_URL . '/admin-lab/approval/peminjaman' ?>?page=<?= $currentPage + 1 ?>" 
                                        class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        Berikutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php else : ?>
                                    <button class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed" disabled>
                                        Berikutnya <i class="fas fa-chevron-right ml-1"></i>
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

<?php if (!empty($equipmentBooking)): ?>
    <?php foreach ($equipmentBooking as $row): ?>
    <div id="modal-<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('modal-<?= $row['id'] ?>')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full" onclick="event.stopPropagation()">
                
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">Detail Peminjaman</h3>
                    <button onclick="closeModal('modal-<?= $row['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-box-open text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($row['equipment_name']) ?></h4>
                            <p class="text-sm text-gray-600">ID Peminjaman: <?= htmlspecialchars($row['id']) ?></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Diminta Oleh</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['user_name'] ?? '-') ?></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Status</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status'] ?? 'pending_approval'))) ?>
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['start_date']) ?></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['end_date']) ?></p>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-700">Catatan / Tujuan</label>
                            <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($row['notes'] ?? 'Tidak ada catatan yang diberikan.') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
                    <button onclick="closeModal('modal-<?= $row['id'] ?>')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Tutup
                    </button>
                    <form method="POST" action="<?= BASE_URL ?>/admin-lab/approval/peminjaman/reject/<?= $row['id'] ?>" class="inline">
                        <button type="submit"
                            onclick="return confirm('Tolak peminjaman ini?')"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-2"></i>Tolak
                        </button>
                    </form>
                    <form method="POST" action="<?= BASE_URL ?>/admin-lab/approval/peminjaman/approve/<?= $row['id'] ?>" class="inline">
                        <button type="submit"
                            onclick="return confirm('Setujui peminjaman ini?')"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-2"></i>Setujui
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modals = document.querySelectorAll('[id^="modal-"]');
            modals.forEach(modal => modal.classList.add('hidden'));
            document.body.style.overflow = 'auto';
        }
    });
</script>