<?php 
$pageTitle = 'Persetujuan Penelitian';
$activeMenu = 'approval-publikasi';

$userRole = $_SESSION['user']['role'];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700">Persetujuan Penelitian</h2>
                        <p class="text-sm text-gray-500">Tinjau dan setujui pengajuan proyek penelitian</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200 border border-gray-100 rounded-lg shadow-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publikasi</th>
                                <th class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($publication)): ?>
                            <?php foreach ($publication as $key => $row): ?>
                            <tr>
                                <td class="px-5 py-4 text-sm font-medium text-gray-900"><?= $key + $startItem ?></td>
                                <td class="px-5 py-4 text-sm text-gray-700">
                                    <?= htmlspecialchars($row['title']) ?>
                                    <p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($row['description']) ?></p>
                                </td>
                                <td class="px-5 py-4 text-sm text-gray-700"><?= htmlspecialchars($row['user_name']) ?></td>
                                <td class="px-5 py-4 text-sm text-blue-600">
                                    <a href="<?= htmlspecialchars($row['publication_url']) ?>" target="_blank" class="hover:underline">Lihat Publikasi</a>
                                </td>
                                <td class="px-5 py-4 text-sm font-medium space-x-2">
                                    
                                    <form method="POST" action="<?= BASE_URL . '/' . (match ($userRole) {
                                        'admin_lab'   => 'admin-lab',
                                        'anggota_lab' => 'anggota-lab',
                                        default       => ''
                                        }) . '/approval/publikasi/approve/' . $row['id'] ?>" class="inline">
                                        <button type="submit" 
                                            onclick="return confirm('Setujui pendaftaran ini?')"
                                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-green-600 hover:text-green-800 hover:bg-green-50 rounded-md transition-colors"
                                            title="Setujui">
                                            <i class="fas fa-check mr-1"></i> Setujui
                                        </button>
                                    </form>

                                    <button type="button" 
                                        onclick="openModal('reject-modal-<?= $row['id'] ?>')"
                                        class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors"
                                        title="Tolak">
                                        <i class="fas fa-times mr-1"></i> Tolak
                                    </button>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center text-gray-400">
                                        <i class="fas fa-inbox text-5xl mb-3"></i>
                                        <p class="text-sm font-medium">Tidak ada persetujuan tertunda</p>
                                        <p class="text-xs mt-1">Semua permintaan pendaftaran telah diproses</p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if (isset($totalPages) && $totalPages > 1) : ?>
                <?php 
                    $baseApprovalPath = BASE_URL . '/' . (match ($userRole) {
                        'admin_lab'   => 'admin-lab',
                        'anggota_lab' => 'anggota-lab',
                        default       => ''
                    }) . '/approval/publikasi';
                ?>
                <div class="mt-6 p-6"> 
                    <nav class="flex justify-between items-center text-sm text-gray-500">
                        <span>Menampilkan <?= $startItem ?? 0 ?> hingga <?= $endItem ?? 0 ?> dari total <?= $totalItems ?? 0 ?> entri</span>
                        
                        <div class="flex space-x-1">
                            <?php if ($currentPage > 1) : ?>
                                <a href="<?= $baseApprovalPath ?>?page=<?= $currentPage - 1 ?>" 
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
                                    <a href="<?= $baseApprovalPath ?>?page=1" 
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
                                        <a href="<?= $baseApprovalPath ?>?page=<?= $i ?>" 
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
                                    <a href="<?= $baseApprovalPath ?>?page=<?= $totalPages ?>" 
                                        class="px-3 py-2 border rounded-md hover:bg-gray-100 transition">
                                        <?= $totalPages ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <?php if ($currentPage < $totalPages) : ?>
                                <a href="<?= $baseApprovalPath ?>?page=<?= $currentPage + 1 ?>" 
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
              <h3 class="text-xl font-semibold text-gray-900">Alasan Penolakan</h3>
              <button type="button" onclick="closeModal('reject-modal-<?= $row['id'] ?>')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
              </button>
            </div>
    
            <div class="p-6 space-y-4">
              <div>
                <label for="reason-<?= $row['id'] ?>" class="block text-sm font-medium text-gray-700">
                    Alasan Penolakan
                </label>
                <p class="text-xs text-gray-500 mb-2">Alasan ini akan ditampilkan kepada pengguna.</p>
                <textarea 
                    id="reason-<?= $row['id'] ?>" 
                    name="reason" 
                    rows="4" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Mohon berikan alasan penolakan publikasi ini..."
                    required
                ></textarea>
              </div>
            </div>
    
            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
              <button type="button" onclick="closeModal('reject-modal-<?= $row['id'] ?>')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Tutup
              </button>
              
              <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-times mr-2"></i>Kirim Penolakan
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
    const allModals = document.querySelectorAll('.fixed.inset-0.z-50');
    allModals.forEach(modal => modal.classList.add('hidden'));

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
    
    const anyModalOpen = document.querySelector('.fixed.inset-0.z-50:not(.hidden)');
    if (!anyModalOpen) {
        document.body.style.overflow = 'auto';
    }
  }

  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      const modals = document.querySelectorAll('.fixed.inset-0.z-50'); 
      modals.forEach(modal => modal.classList.add('hidden'));
      document.body.style.overflow = 'auto';
    }
  });
</script>