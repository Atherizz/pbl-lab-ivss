<?php 
$pageTitle = 'Manajemen Galeri';
$activeMenu = 'galery';

// Ambil pesan flash session
$successMessage = flash('success'); 
$errorMessage = flash('error');

// Inisialisasi variabel agar tidak error undefined
$items = $items ?? []; 
$totalItems = $totalItems ?? 0;
$currentPage = $currentPage ?? 1;
$totalPages = $totalPages ?? 1;
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <?php if ($successMessage) : ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
                        <?= htmlspecialchars($successMessage) ?>
                    </div>
                <?php endif; ?>
                <?php if ($errorMessage) : ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Kelola Dokumentasi Kegiatan</h2>
                        <p class="text-sm text-gray-500 mt-1">Total: <?= $totalItems ?> item dokumentasi</p>
                    </div>
                    <a href="<?= BASE_URL ?>/admin-lab/galery/create" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i> Tambah Dokumentasi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Caption</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($items)) : ?>
                                <?php foreach($items as $row) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($row['id']) ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <?php if (!empty($row['image_url'])) : ?>
                                            <img src="<?= BASE_URL . '/' . htmlspecialchars($row['image_url']) ?>" class="h-16 w-24 object-cover rounded border">
                                        <?php else : ?>
                                            <span class="text-gray-400">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate" title="<?= htmlspecialchars($row['caption']) ?>">
                                        <?= htmlspecialchars($row['caption']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?= htmlspecialchars($row['author_name'] ?? '-') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="<?= BASE_URL . '/admin-lab/galery/' . $row['id'] . '/edit' ?>" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-edit"></i> Edit</a>
                                        
                                        <form action="<?= BASE_URL . '/admin-lab/galery/' . $row['id'] . '/destroy' ?>" method="POST" class="inline" onsubmit="return confirm('Hapus dokumentasi ini?');">
                                            <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                        <i class="fas fa-camera text-4xl mb-3 text-gray-300"></i>
                                        <p>Belum ada data galeri.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($totalPages > 1): ?>
                <div class="mt-4 flex justify-end space-x-2">
                    <?php for($i=1; $i<=$totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" class="px-3 py-1 border rounded <?= $i == $currentPage ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>