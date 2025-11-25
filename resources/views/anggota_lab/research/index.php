<?php
$pageTitle = 'Riset Anggota Lab';
$activeMenu = 'riset-saya';

require BASE_PATH . '/resources/views/layouts/dashboard.php';

$status_classes = [
    'pending_approval' => 'bg-yellow-100 text-yellow-800', // Status 'proposal' diganti
    'approved_by_dospem' => 'bg-blue-100 text-blue-800',
    'approved_by_head' => 'bg-teal-100 text-teal-800',
    'active' => 'bg-green-100 text-green-800', // Dari skema lama
    'completed' => 'bg-green-100 text-green-800', // Dari skema lama
    'rejected' => 'bg-red-100 text-red-800',
];
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">My Research Projects</h2>
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
                                    Title & Supervisor
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($researchList)) : ?>
                                <?php foreach ($researchList as $research) : ?>
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <div class="font-medium"><?= htmlspecialchars($research['title']) ?></div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                Supervisor: <?= htmlspecialchars($research['dospem_name'] ?? 'N/A') ?>
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
                                                title="View Details">
                                                <i class="fas fa-eye mr-1"></i> Detail
                                            </button>
                                            <?php if (($research['status'] ?? '') === 'pending_approval'): ?>
                                                <a href="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $research['id'] . '/edit' ?>"
                                                   class="text-indigo-600 hover:text-indigo-900" title="Edit Proposal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research/' . $research['id'] . '/delete' ?>" method="POST" class="inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-900"
                                                            title="Delete Proposal"
                                                            onclick="return confirm('Are you sure you want to delete this proposal: <?= htmlspecialchars($research['title'], ENT_QUOTES) ?>?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-gray-400" title="Actions locked (not in pending status)">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        You have not proposed any research projects yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing 1 to <?= !empty($researchList) ? count($researchList) : '0' ?> of <?= !empty($researchList) ? count($researchList) : '0' ?> entries</span>
                        <div class="flex space-x-1">
                            <button class="px-3 py-1 border rounded-md" disabled>Previous</button>
                            <button class="px-3 py-1 border rounded-md bg-blue-600 text-white">1</button>
                            <button class="px-3 py-1 border rounded-md">Next</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
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
                    <h3 class="text-xl font-semibold text-gray-900">Research Details</h3>
                    <button onclick="closeModal('modal-<?= $research['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-900 mb-1"><?= htmlspecialchars($research['title']) ?></h4>
                        <p class="text-sm text-gray-600">Supervisor: <?= htmlspecialchars($research['dospem_name'] ?? 'N/A') ?></p>
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
                            <label class="text-sm font-medium text-gray-700">Publication URL</label>
                            <p class="mt-1 text-sm text-blue-700">
                                <?php if (!empty($research['publication_url'])): ?>
                                    <a href="<?= htmlspecialchars($research['publication_url']) ?>" target="_blank" class="underline break-words">Open Link</a>
                                <?php else: ?>
                                    <span class="text-gray-500">-</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Start Date</label>
                            <p class="mt-1 text-sm text-gray-900"><?= !empty($research['start_date']) ? date('d M Y', strtotime($research['start_date'])) : '-' ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">End Date</label>
                            <p class="mt-1 text-sm text-gray-900"><?= !empty($research['end_date']) ? date('d M Y', strtotime($research['end_date'])) : '-' ?></p>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($research['description'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
                    <button onclick="closeModal('modal-<?= $research['id'] ?>')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Close
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