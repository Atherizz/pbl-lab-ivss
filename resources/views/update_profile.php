<?php
$current_name = $current_name ?? 'Nama Pengguna'; 
$is_mahasiswa = $is_mahasiswa ?? true; 
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="flex-1 flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-slate-800 rounded-3xl shadow-2xl overflow-hidden border border-slate-700">
        
        <div class="w-full p-8 md:p-12">
            
            <div class="mb-8 text-center">
                <span class="text-2xl font-bold text-cyan-400 brand-font block mb-1">IVSS LAB</span>
                <h2 class="text-3xl font-bold text-white mb-2">Pengaturan Profil</h2>
                <p class="text-slate-400">Perbarui informasi nama dan kata sandi akun Anda.</p>
            </div>

            <?php 
            if (isset($_SESSION['error'])): ?>
                <div class="mb-4 p-3 text-sm text-red-200 bg-red-900/50 border border-red-800 rounded-xl flex items-center gap-2">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                    <span><?= $_SESSION['error']; ?></span>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="mb-4 p-3 text-sm text-green-200 bg-green-900/50 border border-green-800 rounded-xl flex items-center gap-2">
                    <i class="fas fa-check-circle text-lg"></i>
                    <span><?= $_SESSION['success']; ?></span>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL ?? '.' ?>/update-profile" method="POST" class="space-y-6">
                
                <div class="border border-slate-700 p-6 rounded-xl bg-slate-700/30">
                    <h3 class="text-xl font-semibold text-slate-100 mb-4 flex items-center gap-2">
                        <i class="fas fa-user text-cyan-400"></i> Ubah Nama Pengguna
                    </h3>
                    
                    <div>
                        <label for="current_name_display" class="block text-sm font-medium text-slate-300 mb-2">Nama Saat Ini</label>
                        <input type="text" id="current_name_display" value="<?= htmlspecialchars($current_name) ?>" disabled
                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-400 placeholder-slate-600 cursor-not-allowed shadow-inner">
                    </div>
                    
                    <div class="mt-4">
                        <label for="new_name" class="block text-sm font-medium text-slate-300 mb-2">Nama Baru (Kosongkan jika tidak diubah)</label>
                        <input type="text" id="new_name" name="new_name" placeholder="Masukkan nama lengkap baru"
                            class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                    </div>
                </div>


                <div class="border border-slate-700 p-6 rounded-xl bg-slate-700/30 <?= $is_mahasiswa ? 'opacity-60 pointer-events-none' : '' ?>">
                    <h3 class="text-xl font-semibold text-slate-100 mb-4 flex items-center gap-2">
                        <i class="fas fa-lock text-cyan-400"></i> Ubah Kata Sandi
                    </h3>

                    <?php if ($is_mahasiswa): ?>
                        <div class="mb-4 p-3 text-sm text-red-200 bg-red-900/50 border border-red-800 rounded-xl flex items-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Perubahan kata sandi tidak diizinkan untuk Akun Mahasiswa.</span>
                        </div>
                    <?php endif; ?>

                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-slate-300 mb-2">Kata Sandi Lama</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password" placeholder="Wajib diisi jika ganti password"
                                    class="w-full px-4 pr-12 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                                <button type="button" onclick="togglePassword('current_password', 'current_password_icon')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                                    <i class="fas fa-eye" id="current_password_icon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-slate-300 mb-2">Kata Sandi Baru (Minimal 6 karakter)</label>
                            <div class="relative">
                                <input type="password" id="new_password" name="new_password" placeholder="Kata sandi baru"
                                    class="w-full px-4 pr-12 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                                <button type="button" onclick="togglePassword('new_password', 'new_password_icon')"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                                    <i class="fas fa-eye" id="new_password_icon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Kata Sandi Baru</label>
                            <div class="relative">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Ulangi kata sandi baru"
                                    class="w-full px-4 pr-12 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                                <button type="button" onclick="togglePassword('confirm_password', 'confirm_password_icon')"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                                    <i class="fas fa-eye" id="confirm_password_icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" name="submit"
                    class="w-full py-3 px-4 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/20 transition-all duration-200 transform hover:scale-[1.01] flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perubahan Profil
                </button>
            </form>
        </div>

    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>