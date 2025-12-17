<?php
$pageTitle = 'All Research Directory';
$activeMenu = 'direktori-riset';

$currentStatus = $currentStatus ?? 'all';
$currentSearch = $currentSearch ?? '';

$statuses = [
    'all' => 'All Statuses',
    'pending_approval' => 'Pending Approval',
    'approved_by_dospem' => 'Approved by Dospem',
    'approved_by_head' => 'Approved by Head',
    'active' => 'Active',
    'completed' => 'Completed',
];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Research Directory</h2>
                </div>
                
                <form method="GET" id="filterForm" class="mb-4 flex space-x-4 items-center">
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
                        <label for="search" class="block text-sm font-medium text-gray-700">Search Title</label>
                        <input type="text" name="search" id="search" placeholder="Enter research title..."
                            value="<?= htmlspecialchars($currentSearch) ?>"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    </div>

                    <div class="pt-6 hidden-buttons" style="display: none;">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Apply Filter
                        </button>
                        <?php if ($currentStatus !== 'all' || !empty($currentSearch)) : ?>
                            <a href="<?= (BASE_URL ?? '.') . '/anggota-lab/research/direktori' ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 ml-2">
                                Clear
                            </a>
                        <?php endif; ?>
                    </div>
                </form>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (!empty($research)) : ?>
                        <?php foreach ($research as $row) : ?>
                            <?php
                            // Logika untuk status
                            $statusClass = match ($row['status'] ?? 'Draft') {
                                'Published', 'active'     => 'bg-green-100 text-green-800',
                                'pending_approval'       => 'bg-yellow-100 text-yellow-800',
                                'supervisor_approved'    => 'bg-indigo-100 text-indigo-800',
                                'completed'              => 'bg-blue-100 text-blue-800',
                                'rejected'               => 'bg-red-100 text-red-800',
                                default                  => 'bg-gray-100 text-gray-800',
                            };
                            
                            // Logika untuk role author
                            $authorRole = match ($row['author_role']) {
                                'admin_lab' => 'Admin Lab',
                                'admin_berita' => 'Admin Berita',
                                'anggota_lab' => 'Anggota Lab',
                                'mahasiswa' => 'Mahasiswa Lab',
                                default => 'User'
                            };
                            ?>

                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
                                
                                <div class="p-4 flex-grow">
                                    <div>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                            <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status'] ?? 'Draft'))) ?>
                                        </span>
                                    </div>

                                    <h3 class="mt-2 text-lg font-semibold text-gray-800">
                                        <?= htmlspecialchars($row['title'] ?? 'N/A') ?>
                                    </h3>

                                    <div class="mt-2 text-sm text-gray-600">
                                        <p>
                                            by <strong><?= htmlspecialchars($row['author_name'] ?? 'N/A') ?></strong> (<?= $authorRole ?>)
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Published: <?= date('d M Y', strtotime($row['publication_date'] ?? date('Y-m-d'))) ?>
                                        </p>
                                    </div>

                                    <?php if (isset($row['abstract'])) : ?>
                                        <p class="mt-3 text-sm text-gray-700 line-clamp-3">
                                            <?= htmlspecialchars($row['abstract']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="p-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                                    <div>
                                        <?php if (!empty($row['publication_url'])) : ?>
                                            <a href="<?= htmlspecialchars($row['publication_url']) ?>" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                                View Link
                                            </a>
                                        <?php else : ?>
                                            <span class="text-sm text-gray-400">Belum ada link publikasi</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if ($_SESSION['user']['role'] === 'admin_lab'): ?>
                                    <div>
                                        <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 text-sm"
                                                title="Delete Proposal"
                                                onclick="return confirm('Are you sure you want to delete this proposal: <?= htmlspecialchars($row['title'], ENT_QUOTES) ?>?');">
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
                                No research found in the directory.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Pagination -->
                <?php if (($totalPages ?? 1) > 1): ?>
                <div class="mt-4">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing <?= $startItem ?> to <?= $endItem ?> of <?= $totalItems ?> entries</span>
                        <div class="flex space-x-1">
                            <?php if ($currentPage > 1): ?>
                                <a href="?page=<?= $currentPage - 1 ?>&status=<?= $currentStatus ?>&search=<?= urlencode($currentSearch) ?>" class="px-3 py-1 border rounded-md hover:bg-gray-100">Previous</a>
                            <?php else: ?>
                                <button class="px-3 py-1 border rounded-md text-gray-400 cursor-not-allowed" disabled>Previous</button>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <?php if ($i == $currentPage): ?>
                                    <button class="px-3 py-1 border rounded-md bg-blue-600 text-white"><?= $i ?></button>
                                <?php else: ?>
                                    <a href="?page=<?= $i ?>&status=<?= $currentStatus ?>&search=<?= urlencode($currentSearch) ?>" class="px-3 py-1 border rounded-md hover:bg-gray-100"><?= $i ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>
                            
                            <?php if ($currentPage < $totalPages): ?>
                                <a href="?page=<?= $currentPage + 1 ?>&status=<?= $currentStatus ?>&search=<?= urlencode($currentSearch) ?>" class="px-3 py-1 border rounded-md hover:bg-gray-100">Next</a>
                            <?php else: ?>
                                <button class="px-3 py-1 border rounded-md text-gray-400 cursor-not-allowed" disabled>Next</button>
                            <?php endif; ?>
                        </div>
                    </nav>
                </div>
                <?php else: ?>
                <div class="mt-4">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing <?= $startItem ?> to <?= $endItem ?> of <?= $totalItems ?> entries</span>
                    </nav>
                </div>
                <?php endif; ?>

            </div>
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
            hiddenButtonsContainer.style.display = 'none';
        }

        const submitForm = () => {
            const currentUrl = new URL(window.location.href);

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