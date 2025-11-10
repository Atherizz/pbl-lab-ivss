<?php
$pageTitle = 'Equipment Catalog';
$activeMenu = 'katalog-equipment';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Pilih Peralatan untuk Dipinjam</h2>
                
                <?php if (!empty($equipments)) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($equipments as $equipment) : ?>
                    <?php
                        $statusValue = $equipment['status'] ?? 'N/A';
                        $statusDisplay = htmlspecialchars(ucwords(str_replace('_', ' ', $statusValue)));
                        
                        $isAvailable = $statusValue === 'available';
                        
                        $statusClass = 'bg-gray-200 text-gray-800'; 
                        switch ($statusValue) {
                            case 'available':
                                $statusClass = 'bg-green-100 text-green-800 border-green-400';
                                break;
                            case 'in_use':
                                $statusClass = 'bg-blue-100 text-blue-800 border-blue-400';
                                break;
                            case 'maintenance':
                                $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-400';
                                break;
                            case 'broken':
                                $statusClass = 'bg-red-100 text-red-800 border-red-400';
                                break;
                        }
                    ?>
                    <div class="border rounded-lg p-4 shadow-md hover:shadow-lg transition duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-blue-600">
                                <?= htmlspecialchars($equipment['name'] ?? 'N/A') ?>
                            </h3>
                            
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium border <?= $statusClass ?>">
                                <?= $statusDisplay ?>
                            </span>
                        </div>
                        
                        <p class="text-gray-700 text-sm mb-4"><?= htmlspecialchars($equipment['description'] ?? 'No description available.') ?></p>
                        
                        <?php if ($isAvailable) : ?>
                            <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings/create?equipment_id=<?= htmlspecialchars($equipment['id']) ?>"
                               style="background-color: #235fe7;" 
                               class="inline-block w-full text-center px-4 py-2 text-white rounded-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                                Peminjaman
                            </a>
                        <?php else : ?>
                            <span class="inline-block w-full text-center px-4 py-2 bg-gray-400 text-gray-700 rounded-md cursor-not-allowed">
                                Tidak Tersedia
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                    <p class="text-gray-500">Saat ini tidak ada peralatan yang terdaftar.</p>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>