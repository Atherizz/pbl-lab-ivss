<?php 
$pageTitle = 'Member Approval';
$activeMenu = 'approval-anggota';
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-semibold text-gray-700">Member Approvals</h2>
          <div class="text-sm text-gray-500">Review and approve new registration requests</div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen Pembimbing</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
              <?php if (!empty($userRequest)): ?>
                <?php foreach ($userRequest as $row): ?> 
                  <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                      <?= htmlspecialchars($row['nim'] ?? $row['id']) ?>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                          <span class="text-blue-600 font-semibold text-sm">
                            <?= strtoupper(substr($row['name'], 0, 1)) ?>
                          </span>
                        </div>
                        <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['name']) ?></span>
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                      <?= htmlspecialchars($row['dospem_name'] ?? '-') ?>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center justify-center gap-2">
                        <button 
                          onclick="openModal('modal-<?= $row['id'] ?>')"
                          class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors"
                          title="View Details">
                          <i class="fas fa-eye mr-1"></i> Detail
                        </button>

                        <form method="POST" action="<?= BASE_URL ?>/admin/approval/anggota/approve/<?= $row['id'] ?>" class="inline">
                          <button type="submit" 
                                  onclick="return confirm('Approve this registration?')"
                                  class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-green-600 hover:text-green-800 hover:bg-green-50 rounded-md transition-colors"
                                  title="Approve">
                            <i class="fas fa-check mr-1"></i> Approve
                          </button>
                        </form>

                        <form method="POST" action="<?= BASE_URL ?>/admin/approval/anggota/reject/<?= $row['id'] ?>" class="inline">
                          <button type="submit" 
                                  onclick="return confirm('Reject this registration?')"
                                  class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors"
                                  title="Reject">
                            <i class="fas fa-times mr-1"></i> Reject
                          </button>
                        </form>
                      </div>
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

        <!-- Pagination -->
        <?php if (!empty($userRequest)): ?>
          <div class="mt-4">
            <nav class="flex justify-between items-center text-sm text-gray-500">
              <span>
                Showing <span class="font-medium">1</span> to 
                <span class="font-medium"><?= count($userRequest) ?></span> of 
                <span class="font-medium"><?= count($userRequest) ?></span> entries
              </span>
              <div class="flex space-x-1">
                <button class="px-3 py-1 border rounded-md" disabled>Previous</button>
                <button class="px-3 py-1 border rounded-md bg-blue-600 text-white">1</button>
                <button class="px-3 py-1 border rounded-md" disabled>Next</button>
              </div>
            </nav>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<!-- Modals (logic tetap) -->
<?php if (!empty($userRequest)): ?>
  <?php foreach ($userRequest as $row): ?>
    <div id="modal-<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden overflow-y-auto">
      <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('modal-<?= $row['id'] ?>')"></div>
      <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full" onclick="event.stopPropagation()">
          <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Registration Details</h3>
            <button onclick="closeModal('modal-<?= $row['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
              <i class="fas fa-times text-xl"></i>
            </button>
          </div>

          <div class="p-6 space-y-4">
            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
              <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-blue-600 font-bold text-2xl">
                  <?= strtoupper(substr($row['name'], 0, 1)) ?>
                </span>
              </div>
              <div>
                <h4 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($row['name']) ?></h4>
                <p class="text-sm text-gray-600">NIM: <?= htmlspecialchars($row['nim'] ?? $row['id']) ?></p>
              </div>
            </div>

            <div class="space-y-4">
              <div>
                <label class="text-sm font-medium text-gray-700">Dosen Pembimbing</label>
                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['dospem_name'] ?? '-') ?></p>
              </div>

              <div>
                <label class="text-sm font-medium text-gray-700">Registration Purpose</label>
                <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                  <p class="text-sm text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($row['registration_purpose']) ?></p>
                </div>
              </div>

              <div>
                <label class="text-sm font-medium text-gray-700">Submitted Date</label>
                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($row['created_at'] ?? '-') ?></p>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
            <button onclick="closeModal('modal-<?= $row['id'] ?>')" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
              Close
            </button>
            <form method="POST" action="<?= BASE_URL ?>/admin/approval/anggota/reject/<?= $row['id'] ?>" class="inline">
              <button type="submit" 
                      onclick="return confirm('Reject this registration?')"
                      class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-times mr-2"></i>Reject
              </button>
            </form>
            <form method="POST" action="<?= BASE_URL ?>/admin/approval/anggota/approve/<?= $row['id'] ?>" class="inline">
              <button type="submit" 
                      onclick="return confirm('Approve this registration?')"
                      class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-check mr-2"></i>Approve
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<script>
  function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
  }
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      const modals = document.querySelectorAll('[id^="modal-"]');
      modals.forEach(modal => modal.classList.add('hidden'));
      document.body.style.overflow = 'auto';
    }
  });
</script>
