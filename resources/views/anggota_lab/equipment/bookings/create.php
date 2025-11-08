<?php 
$pageTitle = 'Create Equipment Booking';
$activeMenu = 'bookings'; 
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Booking Details</h2>

                <form action="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings" method="POST">
                    <div class="space-y-6">

                        <div>
                            <label for="equipment_id" class="block text-sm font-medium text-gray-700">
                                Equipment <span class="text-red-500">*</span>
                            </label>
                            <select id="equipment_id" name="equipment_id" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                                <option value="" disabled <?= empty($old_data['equipment_id']) ? 'selected' : '' ?>>Select equipment</option>
                                
                                <?php if (!empty($equipment_list)) : ?>
                                    <?php foreach ($equipment_list as $equipment) : ?>
                                        <option value="<?= htmlspecialchars($equipment['id']) ?>"
                                            <?= ($old_data['equipment_id'] ?? '') == $equipment['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($equipment['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Pilih peralatan yang ingin dipinjam.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">
                                    Start Date <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" id="start_date" name="start_date" required 
                                       value="<?= htmlspecialchars($old_data['start_date'] ?? '') ?>" 
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">
                                    End Date <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" id="end_date" name="end_date" required 
                                       value="<?= htmlspecialchars($old_data['end_date'] ?? '') ?>" 
                                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Notes
                            </label>
                            <textarea id="notes" name="notes" rows="4"
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"><?= htmlspecialchars($old_data['notes'] ?? '') ?></textarea>
                            <p class="mt-1 text-sm text-gray-500">Optional: Tambahkan catatan atau alasan peminjaman.</p>
                        </div>
                        
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?> /anggota-lab/equipment/bookings" 
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