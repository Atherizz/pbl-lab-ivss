    <?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>
<!-- Konten Form Register -->
    <div class="min-h-[calc(100vh-64px)] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        
        <!-- Box Form -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <h2 class="text-center text-3xl font-bold text-gray-900 mb-6">
                Create Account
            </h2>

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

                <!-- Input Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" id="name" name="nama" required 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Input Email -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" required 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Input Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required 
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Tombol Submit -->
                <div class="mt-6">
                    <button type="submit" name="submit" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Register
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