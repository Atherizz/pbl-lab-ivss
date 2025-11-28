<?php 
$pageTitle = 'Manajemen Berita';
$activeMenu = 'news';

$successMessage = flash('success'); 
$errorMessage = flash('error');
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
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

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Kelola Berita</h2>
                        <?php if (isset($totalItems) && $totalItems > 0) : ?>
                            <p class="text-sm text-gray-500 mt-1">Total: <?= $totalItems ?> artikel berita</p>
                        <?php endif; ?>
                    </div>
                    <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news/create"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i> Tambah Berita
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gambar
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penulis
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Terbit
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($news)) : ?>
                                <?php foreach($news as $row) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($row['id']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="font-medium"><?= htmlspecialchars($row['title']) ?></div>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                            <?= htmlspecialchars(substr($row['content'], 0, 100)) ?><?= strlen($row['content']) > 100 ? '...' : '' ?>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <?php if (!empty($row['image_url'])) : ?>
                                            <img src="<?= BASE_URL . '/' . htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="h-16 w-16 object-cover rounded">
                                        <?php else : ?>
                                            <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-xl"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= htmlspecialchars($row['author_name'] ?? $row['author_id'] ?? 'Tidak Diketahui') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= date('d M Y, H:i', strtotime($row['published_at'])) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                        <a href="<?= (BASE_URL ?? '.') . '/admin-berita/news/' . $row['id'] . '/edit' ?>" 
                                            class="text-indigo-600 hover:text-indigo-900 transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>  
                                        <form action="<?= (BASE_URL ?? '.') . '/admin-berita/news/' . $row['id'] . '/delete' ?>" method="POST" class="inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 transition" 
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini: &quot;<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>&quot;? Aksi ini tidak dapat dibatalkan.');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <i class="fas fa-newspaper text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-600 font-medium">Tidak ada berita ditemukan.</p>
                                        <p class="text-xs text-gray-400 mt-1">Mulai dengan membuat artikel berita pertama Anda.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($totalPages) && $totalPages > 1) : ?>
                <div class="mt-6">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Menampilkan <?= $startItem ?> hingga <?= $endItem ?> dari <?= $totalItems ?> entri</span>
                        <div class="flex space-x-1">
                            
                            <?php if ($currentPage > 1) : ?>
                                <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news?page=<?= $currentPage - 1 ?>" 
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
                                    <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news?page=1" 
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
                                        <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news?page=<?= $i ?>" 
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
                                    <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news?page=<?= $totalPages ?>" 
                                       class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        <?= $totalPages ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            
                            <?php if ($currentPage < $totalPages) : ?>
                                <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news?page=<?= $currentPage + 1 ?>" 
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