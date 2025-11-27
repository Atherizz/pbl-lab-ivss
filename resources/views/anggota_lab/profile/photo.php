<?php
$pageTitle = 'Kelola Foto Profil';
$activeMenu = 'profile-user-lab';

$profile = $profile ?? [];
$fullName = $fullName ?? 'Pengguna Lab';
$currentPhoto = $profile['photo_url'] ?? null;
$BASE_URL = $BASE_URL ?? '';

$successMessage = flash('success') ?? null; 
$errorMessage = flash('error') ?? null;

require BASE_PATH . '/resources/views/layouts/dashboard.php';
?>

<div class="content">

<div class="mb-6 flex items-center justify-between">
    <div>
    </div>
    <a href="<?= BASE_URL ?>/anggota-lab/profile" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<?php if ($successMessage) : ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
    </div>
<?php endif; ?>
<?php if ($errorMessage) : ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($errorMessage) ?></span>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
    <!-- Preview Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-image mr-2 text-sky-600"></i>Preview Foto
        </h2>
        
        <div class="flex flex-col items-center">
            <div class="w-64 h-80 rounded-xl overflow-hidden shadow-lg bg-gray-100 mb-4 border-2 border-gray-300 relative">
                <?php if ($currentPhoto): ?>
                    <img id="photo-preview" src="<?= BASE_URL . '/' . htmlspecialchars($currentPhoto) ?>" alt="Profile Photo" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                        <div class="text-center">
                            <i class="fas fa-user text-6xl text-gray-400 mb-3"></i>
                            <p class="text-sm text-gray-500">Belum ada foto</p>
                        </div>
                    </div>
                    <img id="photo-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                <?php endif; ?>
            </div>
            
            <div class="text-center">
                <p class="text-sm font-medium text-gray-700"><?= htmlspecialchars($fullName) ?></p>
                <p class="text-xs text-gray-500 mt-1">
                    <?php if ($currentPhoto): ?>
                        <i class="fas fa-check-circle text-green-500 mr-1"></i>Foto profil aktif
                    <?php else: ?>
                        <i class="fas fa-info-circle text-amber-500 mr-1"></i>Belum ada foto
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Upload/Delete Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-upload mr-2 text-sky-600"></i>Kelola Foto
        </h2>

        <!-- Upload Form -->
        <form action="<?= BASE_URL ?>/anggota-lab/profile/photo/upload" method="POST" enctype="multipart/form-data" class="mb-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <?= $currentPhoto ? 'Ganti Foto Profil' : 'Unggah Foto Profil' ?>
                    </label>
                    <input 
                        id="photo-upload" 
                        name="photo" 
                        type="file" 
                        accept="image/*" 
                        required
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800 
                               file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 
                               file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 
                               hover:file:bg-sky-100 cursor-pointer"
                    />
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Format: JPG, PNG, GIF, WEBP | Maksimal: 5MB
                    </p>
                </div>

                <button 
                    type="submit" 
                    class="w-full inline-flex items-center justify-center px-6 py-3 bg-sky-600 text-white rounded-lg hover:bg-sky-700 
                           focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition shadow-md font-medium"
                >
                    <i class="fas fa-cloud-upload-alt mr-2"></i>
                    <?= $currentPhoto ? 'Perbarui Foto' : 'Unggah Foto' ?>
                </button>
            </div>
        </form>

        <?php if ($currentPhoto): ?>
        <!-- Delete Form -->
        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Hapus Foto</h3>
            <p class="text-xs text-gray-600 mb-4">
                Tindakan ini akan menghapus foto profil Anda secara permanen.
            </p>
            <form action="<?= BASE_URL ?>/anggota-lab/profile/photo/delete" method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto profil?');">
                <button 
                    type="submit" 
                    class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 
                           focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition font-medium"
                >
                    <i class="fas fa-trash-alt mr-2"></i>
                    Hapus Foto Profil
                </button>
            </form>
        </div>
        <?php endif; ?>

        <!-- Info Tips -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="text-sm font-semibold text-blue-800 mb-2 flex items-center">
                <i class="fas fa-lightbulb mr-2"></i>Tips Foto Profil
            </h4>
            <ul class="text-xs text-blue-700 space-y-1">
                <li><i class="fas fa-check mr-1"></i>Gunakan foto dengan pencahayaan yang baik</li>
                <li><i class="fas fa-check mr-1"></i>Wajah terlihat jelas dan menghadap kamera</li>
                <li><i class="fas fa-check mr-1"></i>Latar belakang bersih dan profesional</li>
                <li><i class="fas fa-check mr-1"></i>Hindari foto yang terlalu gelap atau blur</li>
            </ul>
        </div>
    </div>
</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const photoUpload = document.getElementById('photo-upload');
    const photoPreview = document.getElementById('photo-preview');
    
    if (photoUpload) {
        photoUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (file) {
                // Validasi ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    photoUpload.value = '';
                    return;
                }
                
                // Validasi tipe file
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar!');
                    photoUpload.value = '';
                    return;
                }
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(event) {
                    photoPreview.src = event.target.result;
                    photoPreview.classList.remove('hidden');
                    
                    // Hide placeholder if exists
                    const placeholder = photoPreview.previousElementSibling;
                    if (placeholder && placeholder.classList.contains('flex')) {
                        placeholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
