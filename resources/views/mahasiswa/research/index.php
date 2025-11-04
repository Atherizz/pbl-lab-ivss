<?php 
$pageTitle = 'Riset Mahasiswa';
$activeMenu = 'riset-saya';

require BASE_PATH . '/resources/views/layouts/dashboard.php';

$status_classes = [
    'proposal' => 'bg-gray-100 text-gray-800',
    'pending_approval' => 'bg-yellow-100 text-yellow-800',
    'active' => 'bg-green-100 text-green-800',
    'completed' => 'bg-blue-100 text-blue-800',
    'rejected' => 'bg-red-100 text-red-800',
];
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">My Research Projects</h2>
                    <a href="<?= BASE_URL ?? '.' ?>/mahasiswa/research/create"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i> Propose New Research
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dates
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($researchList)) : ?>
                                <?php foreach($researchList as $research) : ?>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="font-medium"><?= htmlspecialchars($research['title']) ?></div>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                            <?= htmlspecialchars(substr($research['description'], 0, 100)) ?><?= strlen($research['description']) > 100 ? '...' : '' ?>
                                        </p>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_classes[$research['status']] ?? 'bg-gray-100 text-gray-800' ?>">
                                            <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $research['status']))) ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php if (!empty($research['start_date'])): ?>
                                            <div>Start: <?= date('d M Y', strtotime($research['start_date'])) ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($research['end_date'])): ?>
                                            <div>End: <?= date('d M Y', strtotime($research['end_date'])) ?></div>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <?php if ($research['status'] === 'proposal'): 
                                            ?>
                                            <a href="<?= (BASE_URL ?? '.') . '/mahasiswa/research/' . $research['id'] . '/edit' ?>" 
                                               class="text-indigo-600 hover:text-indigo-900" title="Edit Proposal">
                                                <i class="fas fa-edit"></i>
                                            </a> 
                                            <form action="<?= (BASE_URL ?? '.') . '/mahasiswa/research/' . $research['id'] . '/delete' ?>" method="POST" class="inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900" 
                                                        title="Delete Proposal"
                                                        onclick="return confirm('Are you sure you want to delete this proposal: <?= htmlspecialchars($research['title'], ENT_QUOTES) ?>?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-400" title="Actions locked for active/completed projects">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        You have not joined or proposed any research projects yet.
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
