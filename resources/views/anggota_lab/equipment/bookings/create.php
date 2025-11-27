<?php
$pageTitle = 'Create Equipment Booking';
$activeMenu = 'bookings';

$selectedEquipment = $selected_equipment ?? null; 
$equipmentId = $selectedEquipment['id'] ?? null;
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Booking Details for: </h2>

                <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">Please correct the following errors:</span>
                        <ul class="list-disc ml-5 mt-2">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings" method="POST">
                    <div class="space-y-6">

                        <input type="hidden" name="equipment_id" value="<?= htmlspecialchars($equipmentId) ?>">

                        <div class="bg-gray-100 p-4 rounded-md border border-gray-300">
                            <p class="text-sm font-medium text-gray-700">Equipment Selected:</p>
                            <p class="text-lg font-semibold text-blue-700">
                                <?= htmlspecialchars($selectedEquipment['name'] ?? 'N/A') ?>
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">
                                    Start Date <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" id="start_date" name="start_date" required
                                       value="<?= htmlspecialchars($old_data['start_date'] ?? '') ?>"
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 bg-gray-100">
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">
                                    End Date <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" id="end_date" name="end_date" required
                                       value="<?= htmlspecialchars($old_data['end_date'] ?? '') ?>"
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 bg-gray-100">
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Notes
                            </label>
                            <textarea id="notes" name="notes" rows="4"
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 bg-gray-100"><?= htmlspecialchars($old_data['notes'] ?? '') ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Optional: Tambahkan catatan atau alasan peminjaman.</p>
                        </div>
                        
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings/katalog" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Submit Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>