<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - IVSS Lab</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    body { font-family: 'Inter', sans-serif; }
    h1, h2, h3, .brand-font { font-family: 'Poppins', sans-serif; }
  </style>
</head>

<body class="min-h-screen bg-slate-900 flex flex-col">

  <?php include __DIR__ . '/layouts/navbar.php'; ?>

  <div class="flex-1 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-slate-800 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-700">
      
      <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
        
        <div class="mb-6">
          <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-cyan-500/20 rounded-lg flex items-center justify-center text-cyan-400">
              <i class="fas fa-eye text-xl"></i>
            </div>
            <span class="text-2xl font-bold text-cyan-400 brand-font">IVSS LAB</span>
          </div>
          <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang!</h2>
          <p class="text-slate-400">Silakan masuk untuk mengakses dashboard.</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-4 p-3 text-sm text-red-200 bg-red-900/50 border border-red-800 rounded-xl flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= $_SESSION['error']; ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-4 p-3 text-sm text-green-200 bg-green-900/50 border border-green-800 rounded-xl flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span><?= $_SESSION['success']; ?></span>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?? '.' ?>/login" method="POST" class="space-y-5">
          
          <div>
            <label for="reg_number" class="block text-sm font-medium text-slate-300 mb-2">NIM / NIP</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-id-card text-slate-500"></i>
              </div>
              <input type="text" id="reg_number" name="reg_number" required placeholder="Nomor Induk Mahasiswa/Pegawai"
                     class="w-full pl-10 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
            </div>
          </div>

          <div>
            <div class="flex justify-between items-center mb-2">
              <label for="password" class="block text-sm font-medium text-slate-300">Password</label>
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-slate-500"></i>
              </div>
              <input type="password" id="password" name="password" required placeholder="••••••••"
              class="w-full pl-10 pr-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-slate-200 placeholder-slate-600 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
            </div>
            <div class="mt-2 text-right">
                <a href="#" class="text-xs font-medium text-cyan-400 hover:text-cyan-300 transition-colors">Lupa Password?</a>
            </div>
          </div>

          <button type="submit" name="submit"
                  class="w-full py-3 px-4 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/20 transition-all duration-200 transform hover:-translate-y-1">
            Masuk
          </button>

        </form>

        <div class="mt-8 text-center text-sm text-slate-400">
          Belum punya akun? 
          <a href="register.php" class="font-medium text-cyan-400 hover:text-cyan-300 transition-colors underline">Daftar disini</a>
        </div>
      </div>

      <div class="hidden md:block w-1/2 bg-cover bg-center relative" 
          style="background-image: url('img/login-img.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-cyan-900/30"></div>

        <div class="absolute bottom-0 left-0 p-12 z-10">
          <h3 class="text-3xl font-bold text-white mb-2 leading-tight brand-font">
            Intelligent Vision &<br> <span class="text-cyan-400">Smart System</span>
          </h3>
          <p class="text-slate-300 text-sm leading-relaxed">
            Pusat riset dan pengembangan teknologi masa depan berbasis kecerdasan buatan.
          </p>
        </div>
      </div>

    </div>
  </div>

</body>
</html>