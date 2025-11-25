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
                                    Return Proof
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($bookings)) : ?>
                                <?php foreach ($bookings as $row) : ?>
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
                                            <?= htmlspecialchars($row['user_name'] ?? 'N/A') ?>
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

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if (!empty($row['return_proof_url'])) : ?>
                                                <img src="<?= BASE_URL . '/' . htmlspecialchars($row['return_proof_url']) ?>" alt="<?= htmlspecialchars($row['equipment_name'] ?? 'Return Proof') ?>" class="h-12 w-12 object-cover rounded border border-gray-200 shadow-sm" loading="lazy">
                                            <?php else : ?>
                                                <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center border border-dashed border-gray-300">
                                                    <i class="fas fa-image text-gray-400 text-lg"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-2">
                                                <?php if ($row['status'] === 'pending_approval' || $row['status'] === 'rejected'): ?>
                                                    <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/equipment/bookings/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center text-red-600 hover:text-red-900"
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this booking for <?= htmlspecialchars($row['equipment_name'] ?? '', ENT_QUOTES) ?>?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                <?php elseif ($row['status'] === 'approved'): ?>
                                                    <button
                                                        type="button"
                                                        onclick="openReturnModal(<?= (int)$row['id'] ?>)"
                                                        class="inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors"
                                                        title="Return Equipment">
                                                        <i class="fas fa-undo mr-1"></i> Return
                                                    </button>

                                                <?php else: ?>
                                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-500 bg-gray-100 rounded">
                                                        <i class="fas fa-ban mr-1"></i> No Action
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <!-- Return Modals -->
                                <?php foreach ($bookings as $row): if ($row['status'] === 'approved'): ?>
                                        <div id="return-modal-<?= (int)$row['id'] ?>" class="fixed inset-0 z-50 hidden">
                                            <div class="fixed inset-0 bg-black bg-opacity-50" onclick="closeReturnModal(<?= (int)$row['id'] ?>)"></div>
                                            <div class="flex items-center justify-center min-h-screen p-4">
                                                <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg" onclick="event.stopPropagation()">
                                                    <div class="flex items-center justify-between p-4 border-b">
                                                        <h3 class="text-lg font-semibold text-gray-800">Upload Return Proof</h3>
                                                        <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeReturnModal(<?= (int)$row['id'] ?>)">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="<?= (BASE_URL ?? '.') . '/anggota-lab/equipment/bookings/return/' . (int)$row['id'] ?>" enctype="multipart/form-data" class="p-6 space-y-4">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div>
                                                            <label for="return_file_<?= (int)$row['id'] ?>" class="block text-sm font-medium text-gray-700 mb-1">Return Proof Image</label>
                                                            <input id="return_file_<?= (int)$row['id'] ?>" name="image_file" type="file" accept="image/*" onchange="previewReturnImage(event, <?= (int)$row['id'] ?>)" class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                                                        </div>
                                                        <div id="preview_wrapper_<?= (int)$row['id'] ?>" class="hidden">
                                                            <p class="text-xs text-gray-500 mb-2">Preview:</p>
                                                            <img id="preview_img_<?= (int)$row['id'] ?>" src="#" alt="Preview" class="max-h-64 rounded border" />
                                                        </div>
                                                        <div class="flex justify-end gap-2 pt-2">
                                                            <button type="button" onclick="closeReturnModal(<?= (int)$row['id'] ?>)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">Cancel</button>
                                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <?php endif;
                                endforeach; ?>
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

<script>
    function openReturnModal(id) {
        const modal = document.getElementById('return-modal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeReturnModal(id) {
        const modal = document.getElementById('return-modal-' + id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            // Optional: reset preview
            const wrapper = document.getElementById('preview_wrapper_' + id);
            const img = document.getElementById('preview_img_' + id);
            if (wrapper && img) {
                wrapper.classList.add('hidden');
                img.src = '#';
            }
            const input = document.getElementById('return_file_' + id);
            if (input) input.value = '';
        }
    }

    function previewReturnImage(event, id) {
        const file = event.target.files[0];
        if (!file) return;
        const wrapper = document.getElementById('preview_wrapper_' + id);
        const img = document.getElementById('preview_img_' + id);
        if (wrapper && img) {
            img.src = URL.createObjectURL(file);
            wrapper.classList.remove('hidden');
        }
    }
    // Close on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^="return-modal-"]').forEach(m => m.classList.add('hidden'));
            document.body.style.overflow = 'auto';
        }
    });
</script>