<footer class="bg-gradient-to-b from-slate-900 to-slate-950 text-slate-300 border-t border-slate-800">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            
            <!-- Tentang Section -->
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-eye text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">IVSS Lab</h3>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Laboratorium Visi Cerdas dan Sistem Cerdas Politeknik Negeri Malang, berdedikasi dalam inovasi computer vision, artificial intelligence, dan riset smart system.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <a href="https://instagram.com" target="_blank" rel="noopener" 
                       class="w-10 h-10 bg-slate-800 hover:bg-cyan-500 rounded-lg flex items-center justify-center transition-all duration-300 group">
                        <i class="fab fa-instagram text-slate-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener" 
                       class="w-10 h-10 bg-slate-800 hover:bg-cyan-500 rounded-lg flex items-center justify-center transition-all duration-300 group">
                        <i class="fab fa-linkedin-in text-slate-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener" 
                       class="w-10 h-10 bg-slate-800 hover:bg-cyan-500 rounded-lg flex items-center justify-center transition-all duration-300 group">
                        <i class="fab fa-twitter text-slate-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="https://github.com" target="_blank" rel="noopener" 
                       class="w-10 h-10 bg-slate-800 hover:bg-cyan-500 rounded-lg flex items-center justify-center transition-all duration-300 group">
                        <i class="fab fa-github text-slate-400 group-hover:text-white transition-colors"></i>
                    </a>
                </div>
            </div>

            <!-- Tautan Cepat -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-3">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/#visi-misi" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Visi & Misi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/#riset-penelitian" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Riset & Penelitian</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/#anggota-lab" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Anggota Laboratorium</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/berita" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Berita & Kegiatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/fasilitas" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Fasilitas</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak Informasi -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-3">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-map-marker-alt text-cyan-400 text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <p class="text-slate-400 leading-relaxed">
                                Politeknik Negeri Malang<br>
                                Jl. Soekarno Hatta No. 9<br>
                                Malang, Jawa Timur 65141
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-cyan-400 text-sm"></i>
                        </div>
                        <a href="mailto:ivss@polinema.ac.id" class="text-sm text-slate-400 hover:text-cyan-400 transition-colors">
                            ivss@polinema.ac.id
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-cyan-400 text-sm"></i>
                        </div>
                        <a href="tel:+6234140447" class="text-sm text-slate-400 hover:text-cyan-400 transition-colors">
                            +62 341 40447
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-800 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-cyan-400 text-sm"></i>
                        </div>
                        <p class="text-sm text-slate-400">
                            Senin - Jumat: 08:00 - 16:00
                        </p>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-slate-800 bg-slate-950/50">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500 text-center md:text-left">
                    &copy; <?= date('Y') ?> Laboratorium Visi Cerdas dan Sistem Cerdas - Politeknik Negeri Malang. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-slate-500 hover:text-cyan-400 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-sm text-slate-500 hover:text-cyan-400 transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</footer>