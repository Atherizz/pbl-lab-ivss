<?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<style>
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

@keyframes pulse-glow {
  0%, 100% { opacity: 0.5; transform: scale(1); }
  50% { opacity: 0.8; transform: scale(1.05); }
}

@keyframes scan-line {
  0% { transform: translateY(-100%); }
  100% { transform: translateY(100%); }
}

@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes grid-pulse {
  0%, 100% { opacity: 0.1; }
  50% { opacity: 0.3; }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-pulse-glow {
  animation: pulse-glow 3s ease-in-out infinite;
}

.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out forwards;
  opacity: 0;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }

.grid-pattern {
  background-image: 
    linear-gradient(rgba(6, 182, 212, 0.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(6, 182, 212, 0.1) 1px, transparent 1px);
  background-size: 50px 50px;
  animation: grid-pulse 4s ease-in-out infinite;
}

.scan-line {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.8), transparent);
  animation: scan-line 3s linear infinite;
}
</style>

<body class="bg-slate-900 text-slate-300">

  <section class="relative bg-gradient-to-tr from-slate-900 via-slate-800 to-slate-800 px-6 pt-20 pb-24 lg:pt-28 lg:pb-32 overflow-hidden">
    <!-- Animated Grid Background -->
    <div class="absolute inset-0 grid-pattern opacity-50"></div>
    
    <!-- Floating Orbs -->
    <div class="absolute top-20 left-10 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl animate-pulse-glow"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse-glow" style="animation-delay: 1.5s;"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-12 lg:gap-16">
      <div class="flex-1 flex flex-col gap-6">
        <h1 class="font-extrabold leading-tight text-white animate-fade-in-up" style="font-size: 42px; line-height: 1.2;">
          Explore the Future <br>
          <span class="text-cyan-400">of Vision & Systems</span>
        </h1>
         <p class="text-slate-300 text-left animate-fade-in-up delay-200" style="font-size: 18px; font-weight: 500; line-height: 1.7;">
          <span class="text-cyan-400 font-semibold">Laboratorium Visi Cerdas dan Sistem Cerdas</span> 
          merupakan pusat riset dan pengembangan di bawah Jurusan Teknologi Informasi Politeknik Negeri Malang yang berfokus pada bidang intelligent vision dan smart system. 
          <br><br>
          Penelitian di laboratorium ini mengintegrasikan computer vision, AI, dan IoT untuk menciptakan solusi inovatif.
        </p>
      </div>
      <div class="relative animate-fade-in-up delay-300">
        <img src="<?= BASE_URL ?>/assets/logo.webp" 
             alt="IVSS Lab Logo" 
             class="relative w-full max-w-md animate-float" 
             style="filter: drop-shadow(0 0 30px rgba(6, 182, 212, 0.3));" />
      </div>
    </div>
  </section>

  <section id="visi-misi" class="scroll-mt-[100px] max-w-7xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-8 lg:p-10 animate-fade-in-up delay-100 hover:border-cyan-500/50 transition-all duration-500 hover:shadow-cyan-500/20 hover:shadow-2xl group">
      <div class="relative overflow-hidden rounded-2xl mb-5">
        <h2 class="text-cyan-400 text-3xl font-bold text-center group-hover:scale-105 transition-transform duration-300">Visi</h2>
      </div>
      <p class="text-slate-300 text-lg leading-relaxed text-justify">
        Menjadi laboratorium unggulan dalam pengembangan teknologi penglihatan cerdas (Intelligent Vision) dan sistem cerdas terintegrasi (Smart Systems) yang inovatif, aplikatif, serta berdaya saing nasional dan internasional.
      </p>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-lg p-8 lg:p-10 animate-fade-in-up delay-200 hover:border-cyan-500/50 transition-all duration-500 hover:shadow-cyan-500/20 hover:shadow-2xl group">
      <div class="relative overflow-hidden rounded-2xl mb-5">
        <h2 class="text-cyan-400 text-3xl font-bold text-center group-hover:scale-105 transition-transform duration-300">Misi</h2>
      </div>
      <ul class="list-disc list-inside text-slate-300 text-lg leading-relaxed space-y-3">
        <li class="hover:text-cyan-400 transition-colors duration-300">Melaksanakan penelitian dan inovasi di bidang computer vision, artificial intelligence, dan smart systems.</li>
        <li class="hover:text-cyan-400 transition-colors duration-300">Menyediakan fasilitas riset dan pelatihan bagi dosen dan mahasiswa Polinema.</li>
        <li class="hover:text-cyan-400 transition-colors duration-300">Mendorong kolaborasi akademik dan industri dalam penerapan teknologi intelligent vision.</li>
        <li class="hover:text-cyan-400 transition-colors duration-300">Menghasilkan publikasi ilmiah, prototipe, dan produk inovatif.</li>
      </ul>
    </div>
  </section>

  <!-- dokumentasi kegiatan -->
  <section class="relative max-w-7xl mx-auto px-6 py-16 lg:py-24 bg-slate-900 border-t border-slate-700 overflow-hidden">
    
    <!-- Animated background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl animate-pulse-glow"></div>
    
    <div class="relative z-10 text-center mb-12 animate-fade-in-up">
        <span class="text-cyan-400 font-semibold tracking-wider uppercase text-sm">Galeri</span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mt-2">
            Dokumentasi Kegiatan
        </h2>
    </div>

    <div class="relative w-full max-w-4xl mx-auto group animate-fade-in-up delay-200" data-carousel="slide">
        
        <div class="relative overflow-hidden rounded-2xl shadow-2xl border border-slate-700 aspect-video hover:border-cyan-500/50 transition-all duration-500">
            <div class="scan-line"></div>
            <div class="flex transition-transform duration-700 ease-in-out h-full" data-carousel-body>
                
                <div class="w-full flex-shrink-0 h-full relative">
                  <img src="gallery/photo-1.webp" 
                  class="w-full h-full object-cover" alt="Dokumentasi 2">
                  <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                    <p class="text-white font-semibold text-lg">Workshop Pengolahan Citra Dan Vision</p>
                    </div>
                  </div>
                  
                  <div class="w-full flex-shrink-0 h-full relative">
                    <img src="gallery/photo-2.webp"  
                    class="w-full h-full object-cover" alt="Dokumentasi 1">
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                       <p class="text-white font-semibold text-lg">Fasilitas Lab IVSS</p>
                    </div>
                </div>

                <div class="w-full flex-shrink-0 h-full relative">
                    <img src="gallery/photo-3.webp" 
                         class="w-full h-full object-cover" alt="Dokumentasi 3">
                     <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                        <p class="text-white font-semibold text-lg">Perangkat komputer untuk pemrosesan data, pengujian, dan riset.</p>
                    </div>
                </div>

                    <div class="w-full flex-shrink-0 h-full relative">
                    <img src="gallery/photo-4.webp" 
                         class="w-full h-full object-cover" alt="Dokumentasi 3">
                     <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6 pt-20">
                        <p class="text-white font-semibold text-lg">Fasilitas Musholla</p>
                    </div>
                </div>

            </div>
        </div>

        <button type="button" data-carousel-prev 
                class="absolute top-1/2 left-4 -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 text-white hover:bg-cyan-500 hover:text-white backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 focus:outline-none">
            <i class="fas fa-chevron-left"></i>
        </button>

        <button type="button" data-carousel-next 
                class="absolute top-1/2 right-4 -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 text-white hover:bg-cyan-500 hover:text-white backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 focus:outline-none">
            <i class="fas fa-chevron-right"></i>
        </button>

    </div>
  </section>
 <section id="riset-penelitian" class="relative max-w-7xl mx-auto px-6 py-16 lg:py-24 bg-slate-800 border-y border-slate-700 overflow-hidden">
    <!-- Animated grid background -->
    <div class="absolute inset-0 grid-pattern opacity-30"></div>
    
    <div class="relative z-10 text-center mb-12 animate-fade-in-up">
      <h2 class="text-4xl font-bold text-cyan-400 mb-3">Riset dan Penelitian</h2>
      <p class="text-slate-400 text-lg">Publikasi dan kontribusi ilmiah dari dosen dan peneliti Laboratorium IVSS</p>
    </div>

    <div class="relative z-10 flex flex-wrap justify-center gap-4 mb-10 animate-fade-in-up delay-100">
      <button class="px-6 py-2.5 bg-slate-700 border border-slate-600 text-slate-300 rounded-lg font-semibold hover:border-cyan-500 hover:text-cyan-400 hover:shadow-lg hover:shadow-cyan-500/20 transition-all transform hover:scale-105">Latest</button>
      <button class="px-6 py-2.5 bg-slate-700 border border-slate-600 text-slate-300 rounded-lg font-semibold hover:border-cyan-500 hover:text-cyan-400 hover:shadow-lg hover:shadow-cyan-500/20 transition-all transform hover:scale-105">Oldest</button>
    </div>

    <div class="relative z-10 grid md:grid-cols-3 gap-8">
      <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/20 hover:border-cyan-500/50 transition-all duration-500 group animate-fade-in-up delay-200">
        <div class="flex items-start justify-between mb-4">
          <span class="bg-purple-900/30 text-purple-300 border border-purple-800 text-xs font-bold px-3 py-1 rounded-full group-hover:scale-110 transition-transform">Computer Vision</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2020</span>
        </div>
        <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Comparison of Viola-Jones Haar Cascade Classifier and Histogram of Oriented Gradients (HOG)
        </h3>
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-2 text-slate-400 group-hover:text-cyan-400 transition-colors">
            <i class="fas fa-quote-right text-xs"></i>
            <span class="text-sm font-semibold">145 citations</span>
          </div>
        </div>
        <a href="research-detail.html?id=1" class="block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm transform hover:scale-105">Baca Selengkapnya</a>
      </div>

      <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/20 hover:border-cyan-500/50 transition-all duration-500 group animate-fade-in-up delay-300">
        <div class="flex items-start justify-between mb-4">
          <span class="bg-blue-900/30 text-blue-300 border border-blue-800 text-xs font-bold px-3 py-1 rounded-full group-hover:scale-110 transition-transform">Data Science</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2017</span>
        </div>
        <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Study of Hoax News Detection using Naïve Bayes Classifier in Indonesian Language
        </h3>
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-2 text-slate-400 group-hover:text-cyan-400 transition-colors">
            <i class="fas fa-quote-right text-xs"></i>
            <span class="text-sm font-semibold">111 citations</span>
          </div>
        </div>
        <a href="research-detail.html?id=2" class="block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm transform hover:scale-105">Baca Selengkapnya</a>
      </div>

      <div class="bg-slate-700 border border-slate-600 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/20 hover:border-cyan-500/50 transition-all duration-500 group animate-fade-in-up delay-400">
        <div class="flex items-start justify-between mb-4">
          <span class="bg-indigo-900/30 text-indigo-300 border border-indigo-800 text-xs font-bold px-3 py-1 rounded-full group-hover:scale-110 transition-transform">AI Decision System</span>
          <span class="text-xs text-slate-500 font-bold group-hover:text-cyan-400 transition-colors">2020</span>
        </div>
        <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors">
          Pengembangan Sistem Penunjang Keputusan Penentuan UKT Mahasiswa (Metode MOORA)
        </h3>
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-2 text-slate-400 group-hover:text-cyan-400 transition-colors">
            <i class="fas fa-quote-right text-xs"></i>
            <span class="text-sm font-semibold">85 citations</span>
          </div>
        </div>
        <a href="research-detail.html?id=3" class="block text-center bg-slate-600 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm transform hover:scale-105">Baca Selengkapnya</a>
      </div>
    </div>

    <div class="relative z-10 text-center mt-12 animate-fade-in-up delay-500">
      <a href="<?= BASE_URL ?? '.' ?>/publikasi" class="inline-flex items-center gap-2 px-8 py-3 bg-cyan-600 text-white font-semibold rounded-lg shadow-lg hover:bg-cyan-500 hover:shadow-xl hover:shadow-cyan-500/30 transition-all transform hover:scale-105 hover:-translate-y-1">
        Lihat Semua Riset
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </section>

<section id="anggota-lab" class="relative px-6 py-20 lg:py-28 bg-slate-900 overflow-hidden">
    
    <!-- Animated background elements -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-cyan-500/5 rounded-full blur-[100px] -z-0 pointer-events-none animate-pulse-glow"></div>
    <div class="absolute inset-0 grid-pattern opacity-20"></div>

    <div class="relative z-10 max-w-7xl mx-auto">

      <div class="text-center mb-16 animate-fade-in-up">
        <span class="text-cyan-400 font-semibold tracking-wider uppercase text-sm">Tim Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-white mt-2 mb-4">
          Anggota Laboratorium
        </h2>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">
          Para peneliti dan ahli yang berdedikasi mengembangkan inovasi di bidang visi komputer dan sistem cerdas.
        </p>
      </div>

      <?php 
        // Ambil Kepala Lab (user dengan role 'admin_lab')
        $headOfLab = null;
        $researchers = [];
        
        foreach($members as $member) {
            if($member['user_role'] === 'admin_lab') {
                $headOfLab = $member;
            } else {
                $researchers[] = $member;
            }
        }
      ?>

      <?php if($headOfLab): ?>
      <div class="mb-16 animate-fade-in-up delay-200">
        <div class="group relative bg-slate-800/50 border border-slate-700 hover:border-cyan-500/50 rounded-3xl p-8 transition-all duration-500 hover:shadow-2xl hover:shadow-cyan-500/10 max-w-2xl mx-auto backdrop-blur-sm">
          
          <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <div class="relative shrink-0">
              <div class="w-48 h-48 rounded-full p-1 bg-gradient-to-br from-slate-700 to-slate-800 group-hover:from-cyan-400 group-hover:to-blue-600 transition-all duration-500 group-hover:scale-105">
                <img class="w-full h-full rounded-full object-cover border-4 border-slate-800" 
                     src="<?= !empty($headOfLab['profile_photo']) ? BASE_URL . '/' . $headOfLab['profile_photo'] : 'https://ui-avatars.com/api/?name=' . urlencode($headOfLab['user_name']) ?>" 
                     alt="<?= htmlspecialchars($headOfLab['user_name']) ?>" />
              </div>
              <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-cyan-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border border-slate-900 group-hover:scale-110 transition-transform">
                HEAD OF LAB
              </div>
            </div>

            <div class="text-center md:text-left flex-1">
              <h3 class="text-[20px] font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                <?= htmlspecialchars($headOfLab['user_name']) ?>
              </h3>
              <p class="text-slate-400 mb-6 text-lg leading-relaxed">
                NIP: <?= htmlspecialchars($headOfLab['nip'] ?? $headOfLab['nidn'] ?? '-') ?>
              </p>
              
              <a href="<?= BASE_URL ?>/profile/<?= $headOfLab['slug'] ?>" 
                 class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-700 text-white font-medium hover:bg-cyan-600 transition-all duration-300 group-hover:pl-8 transform hover:scale-105">
                Lihat Profil Lengkap
                <i class="fas fa-arrow-right text-sm"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php 
        $delay = 300;
        foreach($researchers as $member): 
        ?>
        <div class="group bg-slate-800 border border-slate-700/50 rounded-2xl p-6 hover:-translate-y-2 hover:border-cyan-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/20 animate-fade-in-up delay-<?= $delay ?>">
          <div class="flex items-center gap-4 mb-4">
            <div class="relative w-16 h-16 shrink-0">
               <img class="w-full h-full rounded-full object-cover border-2 border-slate-600 group-hover:border-cyan-400 transition-colors group-hover:scale-110 duration-300" 
                   src="<?= !empty($member['profile_photo']) ? BASE_URL . '/' . $member['profile_photo'] : 'https://ui-avatars.com/api/?name=' . urlencode($member['user_name']) ?>" 
                   alt="<?= htmlspecialchars($member['user_name']) ?>" />
            </div>
            <div>
              <h4 class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors line-clamp-1">
                <?= htmlspecialchars($member['user_name']) ?>
              </h4>
              <p class="text-slate-400 mb-6 text-lg leading-relaxed">
                NIP: <?= htmlspecialchars($member['nip']) ?>
              </p>
            </div>
          </div>
          
          <div class="border-t border-slate-700/50 my-4"></div>
          
          <div class="flex justify-between items-center">
            <span class="text-sm text-slate-400 bg-slate-700/50 px-3 py-1 rounded-full group-hover:bg-cyan-500/20 group-hover:text-cyan-400 transition-colors">Researcher</span>
            <a href="<?= BASE_URL ?>/profile/<?= $member['slug'] ?>" class="text-cyan-400 hover:text-white text-sm font-medium transition-colors flex items-center gap-1 transform group-hover:translate-x-1">
              Detail <i class="fas fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>
        <?php 
        $delay += 100;
        if($delay > 500) $delay = 300;
        endforeach; 
        ?>

      </div>
    </div>
  </section>

  <script>
    // Intersection Observer for scroll-triggered animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, observerOptions);

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
      observer.observe(el);
    });

    // Carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
      const carousel = document.querySelector('[data-carousel="slide"]');
      if (!carousel) return;

      const carouselBody = carousel.querySelector('[data-carousel-body]');
      const prevButton = carousel.querySelector('[data-carousel-prev]');
      const nextButton = carousel.querySelector('[data-carousel-next]');
      const slides = carouselBody.querySelectorAll('.w-full');
      
      let currentIndex = 0;
      let autoplayInterval;

      function updateCarousel() {
        const offset = -currentIndex * 100;
        carouselBody.style.transform = `translateX(${offset}%)`;
      }

      function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateCarousel();
      }

      function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateCarousel();
      }

      function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 5000); // Ganti slide setiap 5 detik
      }

      function stopAutoplay() {
        clearInterval(autoplayInterval);
      }

      // Event listeners untuk tombol
      nextButton.addEventListener('click', () => {
        nextSlide();
        stopAutoplay();
        startAutoplay(); // Restart autoplay setelah klik manual
      });

      prevButton.addEventListener('click', () => {
        prevSlide();
        stopAutoplay();
        startAutoplay(); // Restart autoplay setelah klik manual
      });

      // Pause saat hover
      carousel.addEventListener('mouseenter', stopAutoplay);
      carousel.addEventListener('mouseleave', startAutoplay);

      // Mulai autoplay
      startAutoplay();
    });
  </script>

</body>
</html>

</div> <?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>