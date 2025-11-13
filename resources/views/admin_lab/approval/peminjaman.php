<?php 
$pageTitle = 'Booking Approval';
$activeMenu = 'approval-peminjaman';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
	<div class="max-w-7xl mx-auto px-6 lg:px-10"> <!-- Lebar container dilebarin dikit -->
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 bg-white border-b border-gray-200">
				
				<!-- Header -->
				<div class="flex justify-between items-center mb-6">
					<div>
						<h2 class="text-2xl font-semibold text-gray-700">Booking Approvals</h2>
						<p class="text-sm text-gray-500">List of equipment booking requests awaiting approval</p>
					</div>
				</div>

				<!-- Table Wrapper -->
				<div class="overflow-x-auto">
					<div class="inline-block min-w-full align-middle">
						<table class="min-w-[1000px] w-[95%] mx-auto divide-y divide-gray-200 border border-gray-100 rounded-lg shadow-sm">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equipment</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested By</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
									<th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<?php if (!empty($equipmentBooking)): ?>
								<?php foreach ($equipmentBooking as $row): ?>
								<tr>
									<td class="px-5 py-4 text-sm font-medium text-gray-900"><?= $row['id'] ?></td>
									<td class="px-5 py-4 text-sm text-gray-700"><?= $row['equipment_name'] ?></td>
									<td class="px-5 py-4 text-sm text-gray-700"><?= $row['user_name'] ?></td>
									<td class="px-5 py-4 text-sm text-gray-700"><?= $row['start_date'] ?></td>
									<td class="px-5 py-4 text-sm text-gray-700"><?= $row['end_date'] ?></td>
									<td class="px-5 py-4 text-sm text-gray-500"><?= $row['notes'] ?></td>
									<td class="px-5 py-4 text-sm">
										<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
											pending_approval
										</span>
									</td>
									<td class="px-5 py-4 text-sm font-medium space-x-2">
										<button class="text-green-600 hover:text-green-900">Approve</button>
										<button class="text-red-600 hover:text-red-900">Reject</button>
									</td>
								</tr>
								<?php endforeach; ?>
								              <?php else: ?>
                <tr>
                  <td colspan="4" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center text-gray-400">
                      <i class="fas fa-inbox text-5xl mb-3"></i>
                      <p class="text-sm font-medium">No pending approvals</p>
                      <p class="text-xs mt-1">All registration requests have been processed</p>
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
