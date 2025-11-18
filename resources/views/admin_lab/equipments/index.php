<?php 
$pageTitle = 'Manajemen Peralatan';
$activeMenu = 'equipment';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <?php if (isset($success) && $success) : ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($success) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error) && $error) : ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Kelola Peralatan Lab</h2>
                    <div class="flex items-center gap-4">
                        <?php 
                        $equipmentCount = $totalItems ?? 0;
                        ?>
                        <p class="text-sm text-gray-500 mt-1">Total: <?= $equipmentCount ?> peralatan</p>
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment/create"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-plus mr-2"></i> Tambah Peralatan
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($equipments)) : ?>
                                <?php foreach($equipments as $row) : ?>
                                    <?php
                                    $statusText = htmlspecialchars($row['status'] ?? 'unknown');
                                    $statusClass = match ($row['status']) {
                                        'available'   => 'bg-green-200 text-green-800',
                                        'in use'      => 'bg-blue-200 text-blue-800',
                                        'maintenance' => 'bg-yellow-200 text-yellow-800',
                                        'broken'      => 'bg-red-200 text-red-800',
                                        'approved'    => 'bg-green-200 text-green-800',
                                        'rejected'    => 'bg-red-200 text-red-800',
                                        'returned'    => 'bg-blue-200 text-blue-800',
                                        default       => 'bg-yellow-200 text-yellow-800',
                                    };
                                    ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($row['id']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <div class="font-medium"><?= htmlspecialchars($row['name']) ?></div>
                                        <p class="text-xs text-gray-500"><?= htmlspecialchars($row['description']) ?></p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                            <?= ucwords(str_replace('_', ' ', $statusText)) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="<?= (BASE_URL ?? '.') . '/admin-lab/equipment/' . $row['id'] . '/edit' ?>" 
                                            class="text-indigo-600 hover:text-indigo-900" title="Ubah">
                                            <i class="fas fa-edit"></i>
                                        </a> 
                                        <form action="<?= (BASE_URL ?? '.') . '/admin-lab/equipment/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900" 
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus <?= htmlspecialchars($row['name'], ENT_QUOTES) ?>?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <i class="fas fa-toolbox text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-600 font-medium">Tidak ada peralatan ditemukan.</p>
                                        <p class="text-xs text-gray-400 mt-1">Klik "Tambah Peralatan" untuk menambahkan peralatan baru.</p>
                                    </td>
                                </tr> 
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> hingga <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                            
                            <div class="flex space-x-1">
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment?page=<?= $currentPage - 1 ?>" 
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
                                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment?page=1" 
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
                                            <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment?page=<?= $i ?>" 
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
                                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment?page=<?= $totalPages ?>" 
                                           class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/admin-lab/equipment?page=<?= $currentPage + 1 ?>" 
                                       class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        Berikutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php else : ?>
                                    <button class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed" disabled>
                                        Berikutnya <i class="fas fa-chevron-right ml-1"></i>
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