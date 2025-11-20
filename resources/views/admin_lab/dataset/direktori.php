<?php
$pageTitle = 'Direktori Dataset';
$activeMenu = 'direktori-dataset';

?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Direktori Dataset</h2>
                </div>
                
                <!-- Search Bar -->
                <form method="GET" id="filterForm" class="mb-4 flex space-x-4 items-center">
                    <div class="flex-grow">
                        <label for="search" class="block text-sm font-medium text-gray-700">Search Dataset</label>
                        <input type="text" name="search" id="search" placeholder="Cari judul, deskripsi, atau tag..."
                            value="<?= htmlspecialchars($currentSearch ?? '') ?>"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            Search
                        </button>
                        <?php if (!empty($currentSearch)) : ?>
                            <a href="<?= (BASE_URL ?? '.') . '/dataset/direktori' ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 ml-2">
                                Clear
                            </a>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Daftar Kartu Dataset -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (!empty($datasets)) : ?>
                        <?php foreach ($datasets as $row) : ?>
                            <?php
                                // Decode JSON
                                $urls = json_decode($row['urls'] ?? '[]', true);
                                $source_url = $urls[0] ?? null;
                                // Format Tags
                                $tags = $row['tags'] ?? '{}';
                                $tags = str_replace(['{', '}'], '', $tags);
                                $tagList = !empty($tags) ? explode(',', $tags) : [];
                            ?>
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
                                <div class="p-4 flex-grow">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        <?= htmlspecialchars($row['title'] ?? 'N/A') ?>
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-700 line-clamp-3">
                                        <?= htmlspecialchars($row['description'] ?? 'No description available.') ?>
                                    </p>
                                    
                                    <?php if (!empty($tagList)): ?>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <?php foreach($tagList as $tag): ?>
                                            <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                                <?= htmlspecialchars($tag) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                                    <!-- Link Download (File URL) -->
                                    <a href="<?= htmlspecialchars($row['file_url']) ?>" target="_blank" class="text-sm text-white bg-blue-600 hover:bg-blue-700 font-medium px-3 py-1 rounded-md">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                    <!-- Link Sumber (Source URL) -->
                                    <?php if (!empty($source_url)) : ?>
                                        <a href="<?= htmlspecialchars($source_url) ?>" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                            View Source <i class="fas fa-external-link-alt ml-1"></i>
                                        </a>
                                    <?php else : ?>
                                        <span class="text-sm text-gray-400">No Source</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <p class="text-center py-10 text-gray-500">
                                No datasets found matching your criteria.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>