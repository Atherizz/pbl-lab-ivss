<?php
$pageTitle = 'All Research Directory';
$activeMenu = 'semua-research';

$currentStatus = $currentStatus ?? 'all';
$currentSearch = $currentSearch ?? '';

$statuses = [
    'all' => 'All Statuses',
    'pending_approval' => 'Pending Approval',
    'approved_by_dospem' => 'Approved by Dospem',
    'approved_by_head' => 'Approved by Head',
    'active' => 'Active',
    'completed' => 'Completed',
    'rejected' => 'Rejected',
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

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publication Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publication Link</th>
                                <?php if ($_SESSION['user']['role'] === 'admin_lab'): ?>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            if (!empty($research)) :
                            ?>
                                <?php
                                foreach ($research as $row) :
                                ?>
                                    <?php
                                    $statusClass = match ($row['status'] ?? 'Draft') {
                                        'Published', 'active'     => 'bg-green-100 text-green-800',
                                        'pending_approval'        => 'bg-yellow-100 text-yellow-800',
                                        'supervisor_approved'     => 'bg-indigo-100 text-indigo-800',
                                        'completed'               => 'bg-blue-100 text-blue-800',
                                        'rejected'                => 'bg-red-100 text-red-800',
                                        default                   => 'bg-gray-100 text-gray-800',
                                    };
                                    ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($row['id']) ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <div class="font-medium"><?= htmlspecialchars($row['title'] ?? 'N/A') ?></div>
                                            <?php if (isset($row['abstract'])) : ?>
                                                <p class="text-xs text-gray-500 mt-1 truncate max-w-sm"><?= htmlspecialchars($row['abstract']) ?></p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <?= htmlspecialchars($row['author_name'] ?? 'N/A') ?>
                                            <p class="text-xs text-gray-500">
                                                <?php
                                                echo match ($row['author_role']) {
                                                    'admin_lab' => 'Admin Lab',
                                                    'admin_berita' => 'Admin Berita',
                                                    'anggota_lab' => 'Anggota Lab',
                                                    'mahasiswa' => 'Mahasiswa Lab',
                                                    default => 'User'
                                                };
                                                ?>

                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <?= date('d M Y', strtotime($row['publication_date'] ?? date('Y-m-d'))) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                                <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status'] ?? 'Draft'))) ?>
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <?php if (!empty($row['publication_url'])) : ?>
                                                <a href="<?= htmlspecialchars($row['publication_url']) ?>" target="_blank" class="text-indigo-600 hover:text-indigo-900 truncate max-w-xs block">
                                                    View Link
                                                </a>
                                            <?php else : ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <?php if ($_SESSION['user']['role'] === 'admin_lab'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900"
                                                    title="Delete Proposal"
                                                    onclick="return confirm('Are you sure you want to delete this proposal: <?= htmlspecialchars($row['title'], ENT_QUOTES) ?>?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No research found in the directory.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing <?= !empty($research) ? '1 to ' . count($research) . ' of ' . count($research) : '0' ?> entries</span>
                        <div class="flex space-x-1">
                            <button class="px-3 py-1 border rounded-md" disabled>Previous</button>
                            <button class="px-3 py-1 border rounded-md bg-blue-600 text-white">1</button>
                            <button class="px-3 py-1 border rounded-md" disabled>Next</button>
                        </div>
                    </nav>
                </div>

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