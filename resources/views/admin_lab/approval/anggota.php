<?php
$pageTitle = 'Persetujuan Anggota';
$activeMenu = 'approval-anggota';

$successMessage = flash('success'); 
$errorMessage = flash('error');
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php';
$userRole = $_SESSION['user']['role'];
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    <h2 class="text-2xl font-semibold text-gray-700">Persetujuan Anggota</h2>
                    <div class="text-sm text-gray-500">Tinjau dan setujui permintaan registrasi baru</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen Pembimbing</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($userRequest)): ?>
                                <?php foreach ($userRequest as $row): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($row['nim'] ?? $row['id']) ?>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <span class="text-blue-600 font-semibold text-sm">
                                                        <?= strtoupper(substr($row['name'], 0, 1)) ?>
                                                    </span>
                                                </div>
                                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['name']) ?></span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <?= htmlspecialchars($row['dospem_name'] ?? '-') ?>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    onclick="openModal('modal-<?= $row['id'] ?>')"
                                                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors"
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-400">
                                            <i class="fas fa-inbox text-5xl mb-3"></i>
                                            <p class="text-sm font-medium">Tidak ada persetujuan tertunda</p>
                                            <p class="text-xs mt-1">Semua permintaan registrasi telah diproses</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <?php 
                        $baseApprovalPath = BASE_URL . '/' . (match ($userRole) {
                            'admin_lab'   => 'admin-lab',
                            'anggota_lab' => 'anggota-lab',
                            default       => ''
                        }) . '/approval/anggota';
                    ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> hingga <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                            
                            <div class="flex space-x-1">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= $baseApprovalPath ?>?page=<?= $currentPage - 1 ?>" 
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
                                        <a href="<?= $baseApprovalPath ?>?page=1" 
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
                                            <a href="<?= $baseApprovalPath ?>?page=<?= $i ?>" 
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
                                        <a href="<?= $baseApprovalPath ?>?page=<?= $totalPages ?>" 
                                            class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= $baseApprovalPath ?>?page=<?= $currentPage + 1 ?>" 
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

<?php if (!empty($userRequest)): ?>
    <?php foreach ($userRequest as $row): ?>
        <div id="modal-<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('modal-<?= $row['id'] ?>')"></div>
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full" onclick="event.stopPropagation()">
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900">Detail Registrasi</h3>
                        <button onclick="closeModal('modal-<?= $row['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 font-bold text-2xl">
                                    <?= strtoupper(substr($row['name'], 0, 1)) ?>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($row['name']) ?></h4>
                                <p class="text-sm text-gray-600">NIM: <?= htmlspecialchars($row['nim'] ?? $row['id']) ?></p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Dosen Pembimbing</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['dospem_name'] ?? '-') ?></p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">Tujuan Registrasi</label>
                                <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($row['registration_purpose']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
                        <button onclick="closeModal('modal-<?= $row['id'] ?>')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Tutup
                        </button>
                        <form method="POST" action="<?= BASE_URL . '/' . (match ($userRole) {
                                    'admin_lab'   => 'admin-lab',
                                    'anggota_lab' => 'anggota-lab',
                                    default       => ''
                                  }) . '/approval/anggota/reject/' . $row['id'] ?>" class="inline">
                            <button type="submit"
                                onclick="return confirm('Tolak registrasi ini?')"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                <i class="fas fa-times mr-2"></i>Tolak
                            </button>
                        </form>
                        <form method="POST" action="<?= BASE_URL . '/' . (match ($userRole) {
                                    'admin_lab'   => 'admin-lab',
                                    'anggota_lab' => 'anggota-lab',
                                    default       => ''
                                  }) . '/approval/anggota/approve/' . $row['id'] ?>" class="inline">
                            <button type="submit"
                                onclick="return confirm('Setujui registrasi ini?')"
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