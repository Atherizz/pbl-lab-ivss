<?php 
$pageTitle = 'Research Approval';
$activeMenu = 'approval-publikasi';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; 
?>

<div class="py-10">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Dikecilin lagi -->
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 bg-white border-b border-gray-200">
				
				<!-- Header -->
				<div class="flex justify-between items-center mb-6">
					<div>
						<h2 class="text-2xl font-semibold text-gray-700">Research Approvals</h2>
						<p class="text-sm text-gray-500">Review and approve research project submissions</p>
					</div>
				</div>

				<!-- Table Wrapper -->
				<div class="overflow-x-auto">
					<div class="inline-block min-w-full align-middle">
						<table class="min-w-[800px] w-[85%] mx-auto divide-y divide-gray-200 border border-gray-100 rounded-lg shadow-sm">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted By</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publication</th>
									<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<?php if (!empty($publication)): ?>
								<?php foreach ($publication as $row): ?>
								<tr>
									<td class="px-4 py-4 text-sm font-medium text-gray-900">1</td>
									<td class="px-4 py-4 text-sm text-gray-700">
										<?=  $row['title'] ?>
										<p class="text-xs text-gray-500 mt-1"><?= $row['description'] ?></p>
									</td>
									<td class="px-4 py-4 text-sm text-gray-700"><?=$row['user_name']  ?></td>
									<td class="px-4 py-4 text-sm text-blue-600">
										<a href="#" class="hover:underline"><?= $row['publication_url'] ?></a>
									</td>
									<td class="px-4 py-4 text-sm font-medium space-x-2">
										<button class="text-green-600 hover:text-green-900">Approve</button>
										<button class="text-red-600 hover:text-red-900">Reject</button>
									</td>
								</tr>
								<?php endforeach; ?>
								  <?php else: ?>
								<tr>
									<td colspan="7" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center text-gray-400">
                      <i class="fas fa-inbox text-5xl mb-3"></i>
                      <p class="text-sm font-medium">No pending approvals</p>
                    </div>
                  </td>
                </tr>
              <?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- Pagination -->
				<div class="mt-6">
					<nav class="flex justify-between items-center text-sm text-gray-500">
						<span>Showing 1 to 1 of 1 entries</span>
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
