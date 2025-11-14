<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<div class="bg-slate-900 text-slate-100">

    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-slate-900 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-slate-900 transform translate-x-1/2"
                     fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8"></div>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Explore the Future of</span>
                            <span class="block text-cyan-400 xl:inline">Vision & Systems</span>
                        </h1>
                        <p class="mt-3 text-base text-slate-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Welcome to the Intelligent Vision and Smart System (IVSS) Laboratory. Access cutting-edge resources, manage research projects, and collaborate on innovative solutions.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="<?= BASE_URL ?? '.' ?>/register"
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-cyan-500 hover:bg-cyan-600 md:py-4 md:text-lg md:px-10">
                                    Join Research
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#team"
                                   class="w-full flex items-center justify-center px-8 py-3 border border-slate-500 text-base font-medium rounded-md text-slate-300 hover:bg-slate-800 md:py-4 md:text-lg md:px-10">
                                    Our Team
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                 src="https://images.unsplash.com/photo-1581092921461-8a6e67c134ff?q=80&w=2070&auto=format&fit=crop" 
                 alt="Intelligent Vision System"
                 onerror="this.src='https://placehold.co/1000x800/e2e8f0/94a3b8?text=IVSS+Lab+Image';">
        </div>
    </div>

    <section id="visi-misi" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Visi & Misi
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Arahan dan tujuan dari IVSS Laboratory.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold text-cyan-400">Visi</h3>
                    <p class="mt-4 text-slate-300">
                        "Menjadi laboratorium riset unggulan di bidang visi komputer dan sistem cerdas yang inovatif dan diakui secara internasional, serta berkontribusi aktif dalam pengembangan teknologi untuk kemajuan masyarakat."
                    </p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-cyan-400">Misi</h3>
                    <ul class="mt-4 space-y-2 text-slate-300 list-disc list-inside">
                        <li>Melaksanakan riset berkualitas tinggi di bidang visi komputer, machine learning, dan sistem cerdas.</li>
                        <li>Mengembangkan solusi teknologi inovatif untuk memecahkan masalah industri dan sosial.</li>
                        <li>Menghasilkan publikasi ilmiah bereputasi di konferensi dan jurnal internasional.</li>
                        <li>Membangun kolaborasi strategis dengan industri, pemerintah, dan institusi akademik lainnya.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="publikasi" class="py-20 bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Publikasi Terbaru
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Hasil riset dan kontribusi kami di dunia ilmiah.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            Real-time Object Detection using Optimized YOLOv8 on Edge Devices
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Penulis: Dr. A. Budi, Savero A., dkk.
                        </p>
                        <p class="mt-4 text-sm font-medium text-cyan-400">
                            Dipublikasikan di: IEEE International Conference on Robotics (ICRA) 2025
                        </p>
                        <a href="#" class="mt-6 inline-block text-base font-medium text-cyan-400 hover:text-cyan-300">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            A Novel Approach for Anomaly Detection in Industrial Manufacturing
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Penulis: Prof. C. Dewi, dkk.
                        </p>
                        <p class="mt-4 text-sm font-medium text-cyan-400">
                            Dipublikasikan di: Journal of Machine Learning Research (JMLR) Vol. 26
                        </p>
                        <a href="#" class="mt-6 inline-block text-base font-medium text-cyan-400 hover:text-cyan-300">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            Semantic Segmentation for Autonomous Driving in Tropical Environments
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Penulis: Dr. E. Fajar, dkk.
                        </p>
                        <p class="mt-4 text-sm font-medium text-cyan-400">
                            Dipublikasikan di: CVPR Workshop 2025
                        </p>
                        <a href="#" class="mt-6 inline-block text-base font-medium text-cyan-400 hover:text-cyan-300">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Tim Riset Kami
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Dosen, peneliti, dan mahasiswa yang berdedikasi.
                </p>
            </div>

            <h3 class="mt-16 text-2xl font-semibold text-white text-center">Dosen & Pembimbing</h3>
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div class="text-center bg-slate-800 p-6 rounded-lg shadow-xl">
                    <img class="w-32 h-32 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/256x256/334155/E0F2FE?text=Foto+Dosen"
                         alt="Foto Dosen 1">
                    <h4 class="mt-4 text-xl font-medium text-white">Prof. Dr. Ir. C. Dewi, M.Sc.</h4>
                    <p class="text-base font-medium text-cyan-400">Kepala Laboratorium</p>
                    <p class="mt-2 text-sm text-slate-400">Keahlian: Deep Learning, AI Ethics</p>
                </div>
                <div class="text-center bg-slate-800 p-6 rounded-lg shadow-xl">
                    <img class="w-32 h-32 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/256x256/334155/E0F2FE?text=Foto+Dosen"
                         alt="Foto Dosen 2">
                    <h4 class="mt-4 text-xl font-medium text-white">A. Budi Santoso, S.Kom., Ph.D.</h4>
                    <p class="text-base font-medium text-cyan-400">Dosen Pembimbing</p>
                    <p class="mt-2 text-sm text-slate-400">Keahlian: Computer Vision, Robotics</p>
                </div>
                </div>

            <h3 class="mt-16 text-2xl font-semibold text-white text-center">Anggota Riset Aktif</h3>
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <div class="text-center bg-slate-800 p-4 rounded-lg shadow-lg">
                    <img class="w-24 h-24 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/128x128/334155/E0F2FE?text=Foto"
                         alt="Foto Anggota 1">
                    <h4 class="mt-3 text-lg font-medium text-white">Savero Athallah</h4>
                    <p class="text-sm font-medium text-cyan-400">Research Assistant</p>
                </div>
                 <div class="text-center bg-slate-800 p-4 rounded-lg shadow-lg">
                    <img class="w-24 h-24 rounded-full mx-auto object-cover object-center"
                         src="https://placehold.co/128x128/334155/E0F2FE?text=Foto"
                         alt="Foto Anggota 2">
                    <h4 class="mt-3 text-lg font-medium text-white">Budi Doremi</h4>
                    <p class="text-sm font-medium text-cyan-400">Junior Researcher</p>
                </div>
                </div>
        </div>
    </section>

    <section id="fasilitas" class="py-20 bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Fasilitas & Peralatan
                </h2>
                <p class="mt-4 text-lg leading-6 text-slate-400">
                    Infrastruktur pendukung riset kelas dunia.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                                        <img class="h-56 w-full object-cover"
                         src="https://images.unsplash.com/photo-1633555774810-70430678b43c?q=80&w=2070&auto=format&fit=crop"
                         alt="GPU Server">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            High-Performance GPU Server
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Dilengkapi dengan NVIDIA A100 & H100 untuk training model deep learning skala besar.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                                        <img class="h-56 w-full object-cover"
                         src="https://images.unsplash.com/photo-1567443024551-f3e3cc2be874?q=80&w=2070&auto=format&fit=crop"
                         alt="Robotic Arm">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            Robotics & Automation Set
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Lengan robot industri, drone, dan sensor LiDAR untuk riset autonomous systems.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-slate-700">
                                        <img class="h-56 w-full object-cover"
                         src="https://images.unsplash.com/photo-1535016120720-40c646be5580?q=80&w=2070&auto=format&fit=crop"
                         alt="VR/AR Equipment">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white">
                            VR/AR Development Kit
                        </h3>
                        <p class="mt-3 text-base text-slate-400">
                            Perangkat Meta Quest 3 dan HoloLens 2 untuk pengembangan aplikasi mixed reality.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div> <?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>