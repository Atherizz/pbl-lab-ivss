<?php
$pageTitle = 'Katalog Peralatan';
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
                                $statusClass = 'bg-green-200 text-green-800';
                                break;
                            case 'in_use':
                                $statusClass = 'bg-blue-200 text-blue-800';
                                break;
                            case 'maintenance':
                                $statusClass = 'bg-yellow-200 text-yellow-900';
                                break;
                            case 'broken':
                                $statusClass = 'bg-red-200 text-red-800';
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

                        <p class="text-gray-700 text-sm mb-4"><?= htmlspecialchars($equipment['description'] ?? 'Deskripsi tidak tersedia.') ?></p>

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

                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> sampai <?= $endItem ?? 0 ?> dari <?= $totalItems ?? 0 ?> entri</span>
                            <div class="flex space-x-1">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog?page=<?= $currentPage - 1 ?>"
                                       class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </a>
                                <?php else : ?>
                                    <button class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed" disabled>
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </button>
                                <?php endif; ?>

                                <div class="flex space-x-1">
                                    <?php
                                    $maxPages = 7;
                                    $startPage = max(1, $currentPage - floor($maxPages / 2));
                                    $endPage = min($totalPages, $startPage + $maxPages - 1);

                                    if ($endPage - $startPage < $maxPages - 1) {
                                        $startPage = max(1, $endPage - $maxPages + 1);
                                    }

                                    if ($startPage > 1) : ?>
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog?page=1"
                                           class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            1
                                        </a>
                                        <?php if ($startPage > 2) : ?>
                                            <span class="px-3 py-2">...</span>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                                        <?php if ($i == $currentPage) : ?>
                                            <button class="px-3 py-2 border rounded-md bg-blue-600 text-white font-semibold">
                                                <?= $i ?>
                                            </button>
                                        <?php else : ?>
                                            <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog?page=<?= $i ?>"
                                               class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                                <?= $i ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                    <?php
                                    if ($endPage < $totalPages) : ?>
                                        <?php if ($endPage < $totalPages - 1) : ?>
                                            <span class="px-3 py-2">...</span>
                                        <?php endif; ?>
                                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog?page=<?= $totalPages ?>"
                                           class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/katalog?page=<?= $currentPage + 1 ?>"
                                       class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php else : ?>
                                    <button class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed" disabled>
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>