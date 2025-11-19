<?php
$pageTitle = 'Riset Anggota Lab';
$activeMenu = 'riset-saya';

$successMessage = flash('success'); 
$errorMessage = flash('error');

$status_classes = [
    'pending_approval' => 'bg-yellow-100 text-yellow-800',
    'approved_by_dospem' => 'bg-blue-100 text-blue-800',
    'approved_by_head' => 'bg-teal-100 text-teal-800',
    'active' => 'bg-green-100 text-green-800',
    'completed' => 'bg-green-100 text-green-800',
    'rejected' => 'bg-red-100 text-red-800',
];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
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
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Proyek Riset Saya</h2>
                        <?php if (isset($totalItems) && $totalItems > 0) : ?>
                            <p class="text-sm text-gray-500 mt-1">Total: <?= $totalItems ?> proyek riset</p>
                        <?php endif; ?>
                    </div>
                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/create"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i> Ajukan Riset Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul & Pembimbing
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($researchList)) : ?>
                                <?php foreach ($researchList as $research) : ?>
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <div class="font-medium"><?= htmlspecialchars($research['title']) ?></div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Pembimbing: <?= htmlspecialchars($research['dospem_name'] ?? 'N/A') ?>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                                <?= htmlspecialchars(substr($research['description'], 0, 100)) ?><?= strlen($research['description']) > 100 ? '...' : '' ?>
                                            </p>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_classes[$research['status']] ?? 'bg-gray-100 text-gray-800' ?>">
                                                <?= htmlspecialchars(ucwords(str_replace('_', ' ', $research['status'] ?? 'pending_approval'))) ?>
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                            <button
                                                onclick="openModal('modal-<?= $research['id'] ?>')"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye mr-1"></i> Detail
                                            </button>
                                            <?php $st = $research['status'] ?? 'pending_approval'; ?>
                                            <?php if ($st === 'pending_approval'): ?>
                                                <a href="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $research['id'] . '/edit' ?>"
                                                    class="text-indigo-600 hover:text-indigo-900" title="Ubah Proposal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $research['id'] . '/delete' ?>" method="POST" class="inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900"
                                                        title="Hapus Proposal"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus proposal ini: <?= htmlspecialchars($research['title'], ENT_QUOTES) ?>?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            <?php elseif ($st === 'rejected'): ?>
                                                <span class="text-gray-400" title="Aksi dikunci (status ditolak)">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            <?php else: ?>
                                                <a href="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $research['id'] . '/edit' ?>"
                                                    class="text-indigo-600 hover:text-indigo-900" title="Ubah URL Publikasi">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <i class="fas fa-flask text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-600 font-medium">Anda belum mengajukan proyek riset apa pun.</p>
                                        <p class="text-xs text-gray-400 mt-1">Klik "Ajukan Riset Baru" untuk memulai proyek baru.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> sampai <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                            <div class="flex space-x-1">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research?page=<?= $currentPage - 1 ?>"
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
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research?page=1"
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
                                            <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research?page=<?= $i ?>"
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
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research?page=<?= $totalPages ?>"
                                            class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research?page=<?= $currentPage + 1 ?>"
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

<?php if (!empty($researchList)): ?>
    <?php foreach ($researchList as $research): ?>
        <div id="modal-<?= $research['id'] ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('modal-<?= $research['id'] ?>')"></div>
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full" onclick="event.stopPropagation()">

                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900">Detail Riset</h3>
                        <button onclick="closeModal('modal-<?= $research['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-1"><?= htmlspecialchars($research['title']) ?></h4>
                            <p class="text-sm text-gray-600">Pembimbing: <?= htmlspecialchars($research['dospem_name'] ?? 'N/A') ?></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Status</label>
                                <p class="mt-1 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_classes[$research['status']] ?? 'bg-gray-100 text-gray-800' ?>">
                                        <?= htmlspecialchars(ucwords(str_replace('_', ' ', $research['status'] ?? 'pending_approval'))) ?>
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tautan Publikasi</label>
                                <p class="mt-1 text-sm text-blue-700">
                                    <?php if (!empty($research['publication_url'])): ?>
                                        <a href="<?= htmlspecialchars($research['publication_url']) ?>" target="_blank" class="underline break-words">Buka Tautan</a>
                                    <?php else: ?>
                                        <span class="text-gray-500">-</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                <p class="mt-1 text-sm text-gray-900"><?= !empty($research['start_date']) ? date('d M Y', strtotime($research['start_date'])) : '-' ?></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                <p class="mt-1 text-sm text-gray-900"><?= !empty($research['end_date']) ? date('d M Y', strtotime($research['end_date'])) : '-' ?></p>
                            </div>
                        </div>
                        <?php if ($research['rejection_reason'] !== null): ?>
                            <div>
                                <label class="text-sm font-medium text-gray-700">Alasan Penolakan</label>
                                <p class="mt-1 text-sm text-blue-700">
                                <p class="text-sm text-gray-600"><?= htmlspecialchars($research['rejection_reason'])  ?></p>
                                </p>
                            </div>
                        <?php endif; ?>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                            <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($research['description'] ?? '-') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
                        <button onclick="closeModal('modal-<?= $research['id'] ?>')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Tutup
                        </button>
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