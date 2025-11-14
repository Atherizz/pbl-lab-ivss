<?php 
$pageTitle = 'Research Approval';
$activeMenu = 'approval-publikasi';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; 
$userRole = $_SESSION['user']['role'];
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Research Approvals</h2>
                        <p class="text-sm text-gray-500">Review and approve research project submissions</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200 border border-gray-100 rounded-lg shadow-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted By</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publication</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($publication)): ?>
                            <?php foreach ($publication as $key => $row): ?>
                            <tr>
                                <td class="px-5 py-4 text-sm font-medium text-gray-900"><?= $key + 1 ?></td>
                                <td class="px-5 py-4 text-sm text-gray-700">
                                    <?= htmlspecialchars($row['title']) ?>
                                    <p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($row['description']) ?></p>
                                </td>
                                <td class="px-5 py-4 text-sm text-gray-700"><?= htmlspecialchars($row['user_name']) ?></td>
                                <td class="px-5 py-4 text-sm text-blue-600">
                                    <a href="<?= htmlspecialchars($row['publication_url']) ?>" target="_blank" class="hover:underline">View Publication</a>
                                </td>
                                <td class="px-5 py-4 text-sm font-medium space-x-2">
                                    
                                    <form method="POST" action="<?= BASE_URL . '/' . (match ($userRole) {
                                        'admin_lab'   => 'admin-lab',
                                        'anggota_lab' => 'anggota-lab',
                                        default       => ''
                                        }) . '/approval/publikasi/approve/' . $row['id'] ?>" class="inline">
                                        <button type="submit" 
                                            onclick="return confirm('Approve this registration?')"
                                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-green-600 hover:text-green-800 hover:bg-green-50 rounded-md transition-colors"
                                            title="Approve">
                                            <i class="fas fa-check mr-1"></i> Approve
                                        </button>
                                    </form>

                                    <button type="button" 
                                        onclick="openModal('reject-modal-<?= $row['id'] ?>')"
                                        class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors"
                                        title="Reject">
                                        <i class="fas fa-times mr-1"></i> Reject
                                    </button>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
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

            <div class="mt-6 p-6"> <nav class="flex justify-between items-center text-sm text-gray-500">
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

<?php if (!empty($publication)): ?>
  <?php foreach ($publication as $row): ?>
    <div id="reject-modal-<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
      <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('reject-modal-<?= $row['id'] ?>')"></div>
      
      <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-xl shadow-xl max-w-lg w-full" onclick="event.stopPropagation()">
          
          <form method="POST" action="<?= BASE_URL . '/' . (match ($userRole) {
                'admin_lab'   => 'admin-lab',
                'anggota_lab' => 'anggota-lab',
                default       => ''
            }) . '/approval/publikasi/reject/' . $row['id'] ?>">

            <div class="flex items-center justify-between p-6 border-b border-gray-200">
              <h3 class="text-xl font-semibold text-gray-900">Reason for Rejection</h3>
              <button type="button" onclick="closeModal('reject-modal-<?= $row['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
              </button>
            </div>
    
            <div class="p-6 space-y-4">
              <div>
                <label for="reason-<?= $row['id'] ?>" class="block text-sm font-medium text-gray-700">
                    Rejection Reason
                </label>
                <p class="text-xs text-gray-500 mb-2">This reason will be shown to the user.</p>
                <textarea 
                    id="reason-<?= $row['id'] ?>" 
                    name="reason" 
                    rows="4" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Please provide a reason for rejecting this publication..."
                    required
                ></textarea>
              </div>
            </div>
    
            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
              <button type="button" onclick="closeModal('reject-modal-<?= $row['id'] ?>')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Close
              </button>
              
              <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-times mr-2"></i>Submit Rejection
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>


<script>
  function openModal(modalId) {
    // Sembunyikan semua modal yang mungkin terbuka
    const allModals = document.querySelectorAll('.fixed.inset-0.z-50');
    allModals.forEach(modal => modal.classList.add('hidden'));

    // Tampilkan modal yang dituju
    const targetModal = document.getElementById(modalId);
    if (targetModal) {
        targetModal.classList.remove('hidden');
    }
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    const targetModal = document.getElementById(modalId);
    if (targetModal) {
        targetModal.classList.add('hidden');
    }
    
    // Cek apakah masih ada modal lain yang terbuka
    const anyModalOpen = document.querySelector('.fixed.inset-0.z-50:not(.hidden)');
    if (!anyModalOpen) {
        document.body.style.overflow = 'auto';
    }
  }

  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      const modals = document.querySelectorAll('.fixed.inset-0.z-50'); // Ambil semua modal
      modals.forEach(modal => modal.classList.add('hidden'));
      document.body.style.overflow = 'auto';
    }
  });
</script>