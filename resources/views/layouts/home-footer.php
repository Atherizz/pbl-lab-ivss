<footer class="bg-gradient-to-b from-slate-900 to-slate-950 text-slate-300 border-t border-slate-800">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- About Section -->
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-eye text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">IVSS Lab</h3>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">
                    The Intelligent Vision and Smart System Laboratory at Malang State Polytechnic, dedicated to innovation in computer vision, artificial intelligence, and smart system research.
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

            <!-- Quick Links -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-3">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/news" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>News & Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/research" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Research</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/dataset" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Dataset Directory</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/gallery" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?? '.' ?>/about" class="flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors duration-200 group">
                            <i class="fas fa-chevron-right text-xs text-slate-600 group-hover:text-cyan-400 transition-colors"></i>
                            <span>About Us</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-3">Contact Info</h3>
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
                            Mon - Fri: 08:00 - 16:00
                        </p>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-3">Stay Updated</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Subscribe to our newsletter for the latest research updates, news, and events.
                </p>
                <form action="#" method="POST" class="space-y-3">
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               placeholder="Enter your email" 
                               required
                               class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg text-sm text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all">
                    </div>
                    <button type="submit" 
                            class="w-full px-4 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-lg shadow-cyan-500/20 hover:shadow-cyan-500/40 flex items-center justify-center gap-2">
                        <span>Subscribe</span>
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-slate-800 bg-slate-950/50">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500 text-center md:text-left">
                    &copy; <?= date('Y') ?> Intelligent Vision & Smart System Laboratory - Politeknik Negeri Malang. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-slate-500 hover:text-cyan-400 transition-colors">Privacy Policy</a>
                    <a href="#" class="text-sm text-slate-500 hover:text-cyan-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>