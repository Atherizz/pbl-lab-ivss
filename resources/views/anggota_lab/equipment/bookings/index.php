<?php 
$pageTitle = 'Equipment Bookings Management';
$activeMenu = 'peminjaman-saya'; 
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Manage Equipment Bookings</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Equipment
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Period
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($bookings)) : ?>
                                <?php foreach($bookings as $row) : ?>
                                <?php
                                    $statusClass = match ($row['status']) {
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'returned' => 'bg-blue-100 text-blue-800',
                                        default    => 'bg-yellow-100 text-yellow-800', // pending_approval
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
                                        <?= htmlspecialchars($row['user_username'] ?? 'N/A') ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="text-xs text-gray-600">Start: <?= date('d M Y, H:i', strtotime($row['start_date'])) ?></div>
                                        <div class="text-xs text-gray-600">End: <?= date('d M Y, H:i', strtotime($row['end_date'])) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                            <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['status']))) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        
                                        <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/equipment/bookings/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900" 
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this booking for <?= htmlspecialchars($row['equipment_name'] ?? '', ENT_QUOTES) ?>?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No equipment bookings found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                 <div class="mt-4">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing <?= !empty($bookings) ? '1 to ' . count($bookings) . ' of ' . count($bookings) : '0' ?> entries</span>
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