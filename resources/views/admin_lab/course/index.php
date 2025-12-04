<?php 
$pageTitle = 'Manajemen Course';
$activeMenu = 'course';

$successMessage = flash('success'); 
$errorMessage = flash('error');
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <!-- Flash Messages -->
                <?php if ($successMessage) : ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if ($errorMessage) : ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <span class="block sm:inline"><?= htmlspecialchars($errorMessage) ?></span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Header & Add Button -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Kelola Course & Workshop</h2>
                    <div class="flex items-center gap-4">
                        <p class="text-sm text-gray-500 mt-1">Total: <?= $totalItems ?? 0 ?> course</p>
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/course/create"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-plus mr-2"></i> Tambah Course
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Info Course</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertemuan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($courses)) : ?>
                                <?php foreach($courses as $row) : ?>
                                    <?php
                                    // Warna badge berdasarkan level
                                    $levelClass = match ($row['level']) {
                                        'Beginner' => 'bg-green-100 text-green-800',
                                        'Intermediate' => 'bg-blue-100 text-blue-800',
                                        'Advanced' => 'bg-purple-100 text-purple-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                    ?>
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <!-- Optional: Tampilkan icon kecil jika mau -->
                                                <!-- <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center mr-4">
                                                    <i class="fas fa-book text-gray-500"></i>
                                                </div> -->
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['title']) ?></div>
                                                    <div class="text-sm text-gray-500 truncate w-64"><?= htmlspecialchars(substr($row['description'], 0, 50)) ?>...</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $levelClass ?>">
                                                <?= htmlspecialchars($row['level']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($row['total_sessions']) ?> Pertemuan
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="<?= (BASE_URL ?? '.') . '/admin-lab/course/' . $row['id'] . '/edit' ?>" 
                                               class="text-indigo-600 hover:text-indigo-900" title="Ubah">
                                                <i class="fas fa-edit"></i>
                                            </a> 
                                            <form action="<?= (BASE_URL ?? '.') . '/admin-lab/course/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900" 
                                                        title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus course <?= htmlspecialchars($row['title'], ENT_QUOTES) ?>?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <i class="fas fa-folder-open text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-600 font-medium">Belum ada course terdaftar.</p>
                                    </td>
                                </tr> 
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Logic -->
                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                    <div class="mt-6">
                        <nav class="flex justify-between items-center text-sm text-gray-500">
                            <span>Menampilkan <?= $startItem ?? 0 ?> hingga <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                            
                            <div class="flex space-x-1">
                                <!-- Prev Button -->
                                <?php if ($currentPage > 1) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/admin-lab/course?page=<?= $currentPage - 1 ?>" 
                                       class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        <i class="fas fa-chevron-left mr-1"></i> Prev
                                    </a>
                                <?php else : ?>
                                    <span class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-1"></i> Prev
                                    </span>
                                <?php endif; ?>

                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <?php if ($i == $currentPage) : ?>
                                        <span class="px-3 py-2 border rounded-md bg-blue-600 text-white font-semibold">
                                            <?= $i ?>
                                        </span>
                                    <?php else : ?>
                                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/course?page=<?= $i ?>" 
                                           class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                            <?= $i ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <!-- Next Button -->
                                <?php if ($currentPage < $totalPages) : ?>
                                    <a href="<?= BASE_URL ?? '.' ?>/admin-lab/course?page=<?= $currentPage + 1 ?>" 
                                       class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        Next <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php else : ?>
                                    <span class="px-3 py-2 border rounded-md text-gray-300 cursor-not-allowed">
                                        Next <i class="fas fa-chevron-right ml-1"></i>
                                    </span>
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