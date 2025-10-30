<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Manage Lab Equipment</h2>
                    <a href="<?= BASE_URL ?? '.' ?>/equipment/create"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i> Add Equipment
                    </a>
                </div>

                <!-- Tabel Equipment -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($data as $row) : ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?=$row['id'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <?=$row['name'] ?>
                                    <p class="text-xs text-gray-500"><?=$row['description'] ?></p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <?=$row['status'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="<?= (BASE_URL ?? '.') . '/equipment/' . $row['id'] . '/edit' ?>" 
                                        class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>  
                                    <form action="<?= (BASE_URL ?? '.') . '/equipment/' . $row['id'] . '/delete' ?>"  method="POST" class="inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900" 
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars($row['name'], ENT_QUOTES) ?>?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <!-- Baris jika tidak ada data -->
                            <!-- 
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No equipment found.
                                </td>
                            </tr> 
                            -->
                        </tbody>
                    </table>
                </div>
                 <!-- Pagination Placeholder -->
                 <div class="mt-4">
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Showing 1 to 3 of 3 entries</span>
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