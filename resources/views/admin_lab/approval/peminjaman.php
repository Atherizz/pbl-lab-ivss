<?php 
$pageTitle = 'Booking Approval';
$activeMenu = 'approval-peminjaman';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Booking Approvals</h2>
                        <p class="text-sm text-gray-500">List of equipment booking requests awaiting approval</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equipment</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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
                                        title="View Details">
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
                                        <p class="text-sm font-medium">No pending approvals</p>
                                        <p class="text-xs mt-1">All booking requests have been processed</p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing 1 to 1 of 1 entries</span>
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

<?php if (!empty($equipmentBooking)): ?>
    <?php foreach ($equipmentBooking as $row): ?>
    <div id="modal-<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('modal-<?= $row['id'] ?>')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full" onclick="event.stopPropagation()">
                
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">Booking Details</h3>
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
                            <p class="text-sm text-gray-600">Booking ID: <?= htmlspecialchars($row['id']) ?></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Requested By</label>
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
                                <label class="text-sm font-medium text-gray-700">Start Date</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['start_date']) ?></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700">End Date</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['end_date']) ?></p>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-700">Notes / Purpose</label>
                            <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($row['notes'] ?? 'No notes provided.') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
                    <button onclick="closeModal('modal-<?= $row['id'] ?>')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Close
                    </button>
                    <form method="POST" action="<?= BASE_URL ?>/admin-lab/approval/peminjaman/reject/<?= $row['id'] ?>" class="inline">
                        <button type="submit"
                            onclick="return confirm('Reject this booking?')"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-2"></i>Reject
                        </button>
                    </form>
                    <form method="POST" action="<?= BASE_URL ?>/admin-lab/approval/peminjaman/approve/<?= $row['id'] ?>" class="inline">
                        <button type="submit"
                            onclick="return confirm('Approve this booking?')"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-2"></i>Approve
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

    // Menutup modal dengan tombol Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modals = document.querySelectorAll('[id^="modal-"]');
            modals.forEach(modal => modal.classList.add('hidden'));
            document.body.style.overflow = 'auto';
        }
    });
</script>