    <?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>
    <div class="min-h-[calc(100vh-64px)] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-900">
        
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-slate-800 shadow-md overflow-hidden sm:rounded-lg border border-slate-700">
            
            <h2 class="text-center text-3xl font-bold text-white mb-6">
                Log In
            </h2>

            <form action="<?= BASE_URL ?? '.' ?>/login" method="POST">
                
                <!-- Success Message -->
                <?php if (isset($_SESSION['success'])): ?>
                <div class="p-4 mb-4 text-sm text-green-400 bg-green-900/30 border border-green-700 rounded-lg" role="alert">
                    <i class="fas fa-check-circle mr-1"></i>
                    <?= $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
                <?php endif; ?>
                
                <!-- Error Message -->
                <?php if (isset($_SESSION['error'])): ?>
                <div class="p-4 mb-4 text-sm text-red-400 bg-red-900/30 border border-red-700 rounded-lg" role="alert">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    <?= $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
                <?php endif; ?>

                <div>
                    <label for="reg_number" class="block text-sm font-medium text-slate-300">NIM / NIP:</label>
                    <input type="text" id="reg_number" name="reg_number" required 
                           placeholder="Masukkan NIM / NIP"
                           class="block w-full mt-1 bg-slate-900 text-slate-100 placeholder-slate-500 border-slate-700 rounded-md shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-slate-300">Password:</label>
                    <input type="password" id="password" name="password" required 
                           class="block w-full mt-1 bg-slate-900 text-slate-100 placeholder-slate-500 border-slate-700 rounded-md shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                </div>

                <div class="mt-6">
                    <button type="submit" name="submit" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-slate-900 bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-cyan-500">
                        Log in
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a class="text-sm text-slate-400 hover:text-slate-200 underline" href="<?= BASE_URL ?? '.' ?>/register">
                        Don't have an account? Register here.
                    </a>
                </div>
            </form>
        </div>
    </div>
