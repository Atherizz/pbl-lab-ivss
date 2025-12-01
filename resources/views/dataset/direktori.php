<?php
$pageTitle = 'Direktori Dataset';
$activeMenu = 'direktori-dataset';
$currentSearch = $currentSearch ?? '';

// Helper function (opsional, biar kode di bawah lebih rapi)
// Memastikan BASE_URL ada slash penutup atau tidak, sesuaikan dengan config kamu
$baseUrl = defined('BASE_URL') ? BASE_URL : ''; 
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Direktori Dataset</h2>
                    <a href="<?= $baseUrl ?>/admin-lab/dataset/create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                        + Tambah Dataset
                    </a>
                </div>
                
                <form method="GET" id="filterForm" class="mb-6 flex space-x-4 items-center">
                    <div class="flex-grow">
                        <label for="search" class="sr-only">Search Dataset</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" 
                                value="<?= htmlspecialchars($currentSearch) ?>"
                                placeholder="Cari judul, deskripsi, atau tag..."
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2">
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Search
                        </button>
                        <?php if (!empty($currentSearch)) : ?>
                            <a href="<?= $baseUrl ?>/admin-lab/dataset" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                                Clear
                            </a>
                        <?php endif; ?>
                    </div>
                </form>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (!empty($datasets)) : ?>
                        <?php foreach ($datasets as $row) : ?>
                            <?php
                                // 1. Proses URLs
                                $urls = json_decode($row['urls'] ?? '[]', true);
                                if (!is_array($urls)) $urls = [];
                                // Siapkan JSON string untuk JavaScript (Modal)
                                $urlsJson = htmlspecialchars(json_encode($urls), ENT_QUOTES, 'UTF-8');

                                // 2. Proses Tags
                                $tags = $row['tags'] ?? '{}';
                                $tags = str_replace(['{', '}', '"'], '', $tags);
                                $tagList = !empty($tags) ? explode(',', $tags) : [];
                            ?>
                            
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col h-full hover:shadow-md transition-shadow duration-200">
                                <div class="p-4 flex-grow">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-bold text-gray-800 leading-tight mb-2">
                                            <?= htmlspecialchars($row['title'] ?? 'Untitled') ?>
                                        </h3>
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                                        <?= htmlspecialchars($row['description'] ?? 'No description available.') ?>
                                    </p>
                                    
                                    <?php if (!empty($tagList) && $tagList[0] !== ""): ?>
                                        <div class="flex flex-wrap gap-2 mt-auto">
                                            <?php foreach($tagList as $tag): ?>
                                                <span class="px-2 py-1 text-xs font-medium rounded-md bg-gray-100 text-gray-600 border border-gray-200">
                                                    <?= htmlspecialchars(trim($tag)) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                                    
                                    <div>
                                        <?php if (!empty($urls)) : ?>
                                            <button type="button" 
                                                onclick="showUrlModal('<?= $urlsJson ?>', '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>')"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                                </svg>
                                                Links
                                            </button>
                                        <?php else : ?>
                                            <span class="text-xs text-gray-400 italic cursor-default">No Links</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <a href="<?= $baseUrl ?>/admin-lab/dataset/edit/<?= $row['id'] ?>" 
                                           class="text-gray-400 hover:text-yellow-600 transition-colors" 
                                           title="Edit Dataset">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="<?= $baseUrl ?>/admin-lab/dataset/delete/<?= $row['id'] ?>" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus dataset ini? Tindakan ini tidak bisa dibatalkan.');">
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors mt-1" title="Hapus Dataset">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <div class="text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada dataset ditemukan</h3>
                                <p class="mt-1 text-sm text-gray-500">Coba kata kunci pencarian lain atau tambahkan dataset baru.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Pagination -->
                <?php if (($totalPages ?? 1) > 1): ?>
                <div class="mt-6">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing <?= $startItem ?> to <?= $endItem ?> of <?= $totalItems ?> entries</span>
                        <div class="flex space-x-1">
                            <?php if ($currentPage > 1): ?>
                                <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($currentSearch) ?>" class="px-3 py-1 border rounded-md hover:bg-gray-100">Previous</a>
                            <?php else: ?>
                                <button class="px-3 py-1 border rounded-md text-gray-400 cursor-not-allowed" disabled>Previous</button>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <?php if ($i == $currentPage): ?>
                                    <button class="px-3 py-1 border rounded-md bg-blue-600 text-white"><?= $i ?></button>
                                <?php else: ?>
                                    <a href="?page=<?= $i ?>&search=<?= urlencode($currentSearch) ?>" class="px-3 py-1 border rounded-md hover:bg-gray-100"><?= $i ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>
                            
                            <?php if ($currentPage < $totalPages): ?>
                                <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($currentSearch) ?>" class="px-3 py-1 border rounded-md hover:bg-gray-100">Next</a>
                            <?php else: ?>
                                <button class="px-3 py-1 border rounded-md text-gray-400 cursor-not-allowed" disabled>Next</button>
                            <?php endif; ?>
                        </div>
                    </nav>
                </div>
                <?php elseif (($totalItems ?? 0) > 0): ?>
                <div class="mt-6">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing <?= $startItem ?> to <?= $endItem ?> of <?= $totalItems ?> entries</span>
                    </nav>
                </div>
                <?php endif; ?>
                
                </div>
        </div>
    </div>
</div>
<div id="linkModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeUrlModal()"></div>
    
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full transform transition-all" onclick="event.stopPropagation()">
            
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900" id="modal-title">Daftar Link Dataset</h3>
                <button onclick="closeUrlModal()" class="text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Dataset</label>
                    <h4 id="modal-dataset-title" class="text-lg font-semibold text-gray-900 mt-1"></h4>
                </div>

                <div class="overflow-hidden border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">No</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="modal-links-body" class="bg-white divide-y divide-gray-200">
                            </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                <button onclick="closeUrlModal()" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    function showUrlModal(urlsJson, title) {
        const modal = document.getElementById('linkModal');
        const tbody = document.getElementById('modal-links-body');
        const titleEl = document.getElementById('modal-dataset-title');

        // Parse data
        let urls = [];
        try { urls = JSON.parse(urlsJson); } catch (e) { urls = []; }

        // Set Title
        titleEl.textContent = title;

        // Reset & Isi Tabel
        tbody.innerHTML = '';
        if (urls.length > 0) {
            urls.forEach((url, index) => {
                const row = document.createElement('tr');
                // Style baris tabel disesuaikan dengan tema terang (light theme)
                row.innerHTML = `
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 text-center">${index + 1}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 max-w-xs truncate" title="${url}">${url}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                        <a href="${url}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-800 inline-flex items-center transition-colors">
                            Buka 
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </td>
                `;
                tbody.appendChild(row);
            });
        } else {
            tbody.innerHTML = '<tr><td colspan="3" class="px-6 py-8 text-center text-gray-500 text-sm bg-gray-50">Tidak ada link tersedia untuk dataset ini.</td></tr>';
        }

        // Tampilkan Modal & Freeze Body Scroll
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeUrlModal() {
        const modal = document.getElementById('linkModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") closeUrlModal();
    });
</script>