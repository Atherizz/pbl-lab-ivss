<?php
$pageTitle = 'Direktori Semua Riset';
$activeMenu = 'direktori-riset';

// MODIFIKASI: Ambil pesan flash menggunakan helper flash()
$successMessage = flash('success'); 
$errorMessage = flash('error'); 

$statuses = [
    'all' => 'Semua Status',
    'pending_approval' => 'Menunggu Persetujuan',
    'approved_by_dospem' => 'Disetujui Dosen Pembimbing',
    'approved_by_head' => 'Disetujui Kepala Lab',
    'active' => 'Aktif',
    'completed' => 'Selesai',
    'rejected' => 'Ditolak',
];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Direktori Riset</h2>
                </div>

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

                <form method="GET" id="filterForm" action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/direktori' ?>" class="mb-4 flex space-x-4 items-center">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                        <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <?php foreach ($statuses as $key => $label) : ?>
                                <option value="<?= $key ?>" <?= ($currentStatus === $key) ? 'selected' : '' ?>>
                                    <?= $label ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex-grow">
                        <label for="search" class="block text-sm font-medium text-gray-700">Cari Judul</label>
                        <input type="text" name="search" id="search" placeholder="Masukkan judul riset..."
                            value="<?= htmlspecialchars($currentSearch) ?>"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    </div>
                </form>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (!empty($research)) : ?>
                        <?php foreach ($research as $row) : ?>
                            <?php
                            $statusClass = match ($row['status'] ?? 'Draft') {
                                'active'             => 'bg-green-100 text-green-800',
                                'completed'          => 'bg-blue-100 text-blue-800',
                                'approved_by_head'   => 'bg-teal-100 text-teal-800', 
                                'approved_by_dospem' => 'bg-indigo-100 text-indigo-800',
                                'pending_approval'   => 'bg-yellow-100 text-yellow-800',
                                'rejected'           => 'bg-red-100 text-red-800',
                                default              => 'bg-gray-100 text-gray-800',
                            };
                            
                            $authorRole = match ($row['author_role'] ?? 'user') {
                                'admin_lab'    => 'Admin Lab',
                                'admin_berita' => 'Admin Berita',
                                'anggota_lab'  => 'Anggota Lab',
                                'mahasiswa'    => 'Mahasiswa Lab',
                                default        => 'User'
                            };
                            ?>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
                                
                                <div class="p-4 flex-grow">
                                    <div>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                            <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status'] ?? 'Draf'))) ?>
                                        </span>
                                    </div>

                                    <h3 class="mt-2 text-lg font-semibold text-gray-800 line-clamp-2">
                                        <?= htmlspecialchars($row['title'] ?? 'N/A') ?>
                                    </h3>

                                    <div class="mt-2 text-sm text-gray-600">
                                        <p>
                                            oleh <strong><?= htmlspecialchars($row['author_name'] ?? 'N/A') ?></strong> (<?= $authorRole ?>)
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Dipublikasikan: <?= date('d M Y', strtotime($row['publication_date'] ?? date('Y-m-d'))) ?>
                                        </p>
                                    </div>

                                    <?php if (isset($row['abstract'])) : ?>
                                        <p class="mt-3 text-sm text-gray-700 line-clamp-3">
                                            <?= htmlspecialchars($row['abstract']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="p-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                                    <a href="<?= htmlspecialchars($row['publication_url']) ?>" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                        Lihat Detail
                                    </a>
                                    
                                    <?php if (($_SESSION['user']['role'] ?? '') === 'admin_lab'): ?>
                                    <div>
                                        <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 text-sm"
                                                title="Hapus Proposal"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus proposal ini: <?= htmlspecialchars($row['title'] ?? 'N/A', ENT_QUOTES) ?>?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <p class="text-center py-10 text-gray-500">
                                Tidak ada riset ditemukan di direktori.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($totalPages > 1) : ?>
                    <?php
                    $basePath = (BASE_URL ?? '.') . '/anggota-lab/research/direktori';
                    
                    function buildPaginationUrl($basePath, $page, $currentStatus, $currentSearch) {
                        $url = $basePath . '?page=' . $page;
                        if ($currentStatus !== 'all') {
                            $url .= '&status=' . urlencode($currentStatus);
                        }
                        if (!empty($currentSearch)) {
                            $url .= '&search=' . urlencode($currentSearch);
                        }
                        return $url;
                    }
                    ?>

                <div class="mt-6">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Menampilkan <?= $startItem ?? 0 ?> sampai <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                        <div class="flex space-x-1">
                            <?php if ($currentPage > 1) : ?>
                                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori?page=<?= $currentPage - 1 ?>" 
                                class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </a>
                            <?php else : ?>
                                <button class="px-3 py-2 border rounded-md text-gray-400 cursor-not-allowed" disabled>
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
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori?page=1" 
                                    class="px-3 py-2 border rounded-md hover:bg-blue-50 text-blue-600 transition">
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
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori?page=<?= $i ?>" 
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
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori?page=<?= $totalPages ?>" 
                                    class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        <?= $totalPages ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <?php if ($currentPage < $totalPages) : ?>
                                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research/direktori?page=<?= $currentPage + 1 ?>" 
                                class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                    Berikutnya <i class="fas fa-chevron-right ml-1"></i>
                                </a>
                            <?php else : ?>
                                <button class="px-3 py-2 border rounded-md text-gray-400 cursor-not-allowed" disabled>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const statusSelect = document.getElementById('status');
        const form = document.getElementById('filterForm');

        const hiddenButtonsContainer = document.querySelector('.hidden-buttons');
        if (hiddenButtonsContainer) {
             hiddenButtonsContainer.remove();
        }

        const submitForm = () => {
            const currentUrl = new URL(window.location.href);

            // Selalu reset ke halaman 1 saat filter/search berubah
            currentUrl.searchParams.set('page', 1);

            // Hapus parameter yang sudah ada dari URL untuk menghindari duplikasi
            currentUrl.searchParams.delete('search');
            currentUrl.searchParams.delete('status');

            const searchValue = searchInput.value.trim();
            if (searchValue !== '') {
                currentUrl.searchParams.set('search', searchValue);
            }

            const statusValue = statusSelect.value;
            if (statusValue !== 'all') {
                currentUrl.searchParams.set('status', statusValue);
            }

            window.location.href = currentUrl.href;
        };

        let debounceTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimeout);
        
            debounceTimeout = setTimeout(submitForm, 1000); 
        });

        statusSelect.addEventListener('change', function() {
            submitForm();
        });
    });
</script>