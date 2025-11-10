    <?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>
<!-- Konten Form Register -->
    <div class="min-h-[calc(100vh-64px)] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        
        <!-- Box Form -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <h2 class="text-center text-3xl font-bold text-gray-900 mb-2">
                Pendaftaran Anggota Lab
            </h2>
            <p class="text-center text-sm text-gray-600 mb-6">
                Intelligent Vision & Smart System Laboratory
            </p>

            <!-- Form disesuaikan dari kodemu -->
            <!-- Pastikan form action-mu benar -->
            <form action="<?= BASE_URL ?? '.' ?>/register" method="POST">
                
                <!-- Menampilkan Error (jika ada) -->
                <?php if (isset($_SESSION['error'])): ?>
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <?= $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
                <?php endif; ?>

                <!-- Input NIM -->
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                    <input type="text" id="nim" name="nim" required 
                           placeholder="Contoh: 2441720001"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <p class="mt-1 text-xs text-gray-500">Masukkan Nomor Induk Mahasiswa</p>
                </div>

                <!-- Input Nama -->
                <div class="mt-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Input Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                </div>

                <!-- Dropdown Dosen Pembimbing -->
                <div class="mt-4">
                    <label for="dospem_id" class="block text-sm font-medium text-gray-700">Dosen Pembimbing <span class="text-red-500">*</span></label>
                    <select id="dospem_id" name="dospem_id" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">-- Pilih Dosen Pembimbing --</option>
                        <option value="1">Dr. Ahmad Fauzi, S.Kom., M.T.</option>
                        <option value="2">Prof. Siti Nurhaliza, S.T., Ph.D.</option>
                        <option value="3">Dr. Budi Santoso, S.Kom., M.Sc.</option>
                        <option value="4">Ir. Rina Wati, M.Kom.</option>
                        <option value="5">Dr. Eng. Joko Widodo, S.T., M.T.</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Pilih dosen pembimbing Anda</p>
                </div>

                <!-- Tujuan Pendaftaran -->
                <div class="mt-4">
                    <label for="registration_purpose" class="block text-sm font-medium text-gray-700">Tujuan Pendaftaran <span class="text-red-500">*</span></label>
                    <textarea id="registration_purpose" name="registration_purpose" rows="4" required
                              placeholder="Jelaskan tujuan Anda mendaftar di lab IVSS, minat riset, atau project yang ingin dikerjakan..."
                              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    <p class="mt-1 text-xs text-gray-500">Minimal 50 karakter. Jelaskan motivasi dan tujuan Anda bergabung dengan lab.</p>
                </div>

                <!-- Info Note -->
                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                    <p class="text-xs text-blue-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pendaftaran Anda akan diverifikasi oleh Dosen Pembimbing dan Kepala Lab.
                    </p>
                </div>

                <!-- Tombol Submit -->
                <div class="mt-6">
                    <button type="submit" name="submit" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Daftar
                    </button>
                </div>

                <!-- Link ke Login -->
                <div class="text-center mt-4">
                    <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="<?= BASE_URL ?? '.' ?>/login">
                        Already have an account? Log in.
                    </a>
                </div>
            </form>
        </div>
    </div>