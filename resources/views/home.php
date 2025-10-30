<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

    <!-- Hero Section -->
 <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <!-- SVG Miring (Efek Desain) -->
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                     fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8"></div>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Explore the Future of</span>
                            <span class="block text-blue-600 xl:inline">Vision & Systems</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Welcome to the Intelligent Vision and Smart System (IVSS) Laboratory. Access cutting-edge resources, manage research projects, and collaborate on innovative solutions.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="<?= BASE_URL ?? '.' ?>/register"
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                   Join Research
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- Gambar Hero -->
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
             
             <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                  src="https://images.unsplash.com/photo-1581092921461-8a6e67c134ff?q=80&w=2070&auto=format&fit=crop" 
                  alt="Intelligent Vision System"
                  onerror="this.src='https://placehold.co/1000x800/e2e8f0/94a3b8?text=IVSS+Lab+Image';">
        </div>
    </div>

    <!-- Bagian "How it works" / "Lab Access" -->
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Lab Access & Resources</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Your Gateway to Innovation
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <!-- Step 1 -->
                    <div class="relative text-center">
                        <dt>
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto">
                                <!-- Ganti ikon -->
                                <i class="fas fa-user-plus"></i> 
                            </div>
                            <p class="mt-5 text-lg leading-6 font-medium text-gray-900">1. Register & Log In</p>
                        </dt>
                        <dd class="mt-2 text-base text-gray-500">
                           Create an account or log in using your institutional credentials to access lab resources.
                        </dd>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative text-center">
                        <dt>
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto">
                                <!-- Ganti ikon -->
                                <i class="fas fa-cogs"></i>
                            </div>
                            <p class="mt-5 text-lg leading-6 font-medium text-gray-900">2. Explore & Book Resources</p>
                        </dt>
                        <dd class="mt-2 text-base text-gray-500">
                            Browse available equipment, software licenses, and datasets. Book resources for your projects.
                        </dd>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative text-center">
                        <dt>
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white mx-auto">
                                <!-- Ganti ikon -->
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <p class="mt-5 text-lg leading-6 font-medium text-gray-900">3. Conduct Research</p>
                        </dt>
                        <dd class="mt-2 text-base text-gray-500">
                           Utilize the booked resources, manage your project progress, and collaborate with peers.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>