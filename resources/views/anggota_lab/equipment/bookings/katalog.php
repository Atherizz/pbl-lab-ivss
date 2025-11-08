<?php 
$pageTitle = 'Equipment Catalog';
$activeMenu = 'equipment';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Manage Lab Equipment</h2>
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
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($equipments as $row) : ?>
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
                            </tr>
                            <?php endforeach ?>
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