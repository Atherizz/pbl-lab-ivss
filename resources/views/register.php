<body class="min-h-screen bg-slate-900 flex flex-col">

  <?php include __DIR__ . '/layouts/navbar.php'; ?>

  <div class="flex-1 flex items-center justify-center p-4 py-10">
    <div class="w-full max-w-5xl bg-slate-800 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-700">
      
      <div class="hidden md:block w-5/12 bg-cover bg-center relative" 
            style="background-image: url('<?= BASE_URL ?? '.' ?>/assets/logo-white.webp');">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/40 via-slate-900/60 to-slate-900"></div>
        <div class="absolute bottom-0 left-0 p-10 z-10">
          <h3 class="text-2xl font-bold text-white mb-2 brand-font">
            Join the <br> <span class="text-cyan-400">Innovation</span>
          </h3>
          <p class="text-slate-300 text-xs leading-relaxed">
            Bergabunglah dengan komunitas peneliti dan pengembang teknologi masa depan di IVSS Lab.
          </p>
        </div>
      </div>

      <div class="w-full md:w-7/12 p-8 md:p-10 flex flex-col justify-center">
        
        <div class="mb-6">
          <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-cyan-500/20 rounded-lg flex items-center justify-center text-cyan-400">
              <i class="fas fa-atom text-xl"></i> </div>
            <span class="text-2xl font-bold text-cyan-400 brand-font">IVSS LAB</span>
          </div>
          <h2 class="text-2xl font-bold text-white mb-1">Buat Akun Baru</h2>
          <p class="text-slate-400 text-sm">Lengkapi data untuk mengajukan akses laboratorium.</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-5 p-3 text-sm text-red-200 bg-red-900/50 border border-red-800 rounded-lg flex items-center gap-2">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?= $_SESSION['error']; ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?? '.' ?>/register" method="POST" class="space-y-4">
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
              <div class="relative">
                <input type="text" name="name" required placeholder="Nama Anda"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-600 rounded-lg text-slate-200 text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
              </div>
            </div>
            <div>
              <label class="block text-xs font-medium text-slate-300 mb-1.5">NIM / NIP</label>
              <div class="relative">
                <input type="text" name="nim" required placeholder="Nomor Induk"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-600 rounded-lg text-slate-200 text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
              </div>
            </div>
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-300 mb-1.5">Email</label>
            <div class="relative">
              <input type="email" name="email" required placeholder="email@example.com"
                     class="w-full px-4 py-2.5 bg-slate-900 border border-slate-600 rounded-lg text-slate-200 text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
            </div>
          </div>
          <div>
            <label class="block text-xs font-medium text-slate-300 mb-1.5">Dosen Pembimbing</label>
            <div class="relative">
               <select name="dospem_id" required
                        class="w-full px-4 py-2.5 bg-slate-900 border border-slate-600 rounded-lg text-slate-200 text-sm appearance-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
                    <option value="" disabled selected>-- Pilih Dosen --</option>
                    <?php if (!empty($dospem)): ?>
                        <?php foreach ($dospem as $ds): ?>
                            <option value="<?= $ds['id'] ?>"><?= htmlspecialchars($ds['name']) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Data dosen tidak tersedia</option>
                    <?php endif; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-medium text-slate-300 mb-1.5">Tujuan / Judul Riset (Min. 50 Karakter)</label>
            <textarea name="registration_purpose" required rows="3" placeholder="Jelaskan detail riset atau skripsi yang akan dilakukan..."
                      class="w-full px-4 py-2.5 bg-slate-900 border border-slate-600 rounded-lg text-slate-200 text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500"></textarea>
          </div>

          <button type="submit" name="submit" 
                  class="w-full py-3 px-4 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/20 transition-all duration-200 transform hover:-translate-y-1 mt-2">
            Daftar Sekarang
          </button>

        </form>

        <div class="mt-6 text-center text-sm text-slate-400">
          Sudah punya akun? 
          <a href="login.php" class="font-medium text-cyan-400 hover:text-cyan-300 transition-colors underline">Log in</a>
        </div>
      </div>

    </div>
  </div>

</body>
</html>