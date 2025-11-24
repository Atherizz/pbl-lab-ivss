<?php $title = 'Laboratorium Intelligent Vision and Smart System (IVSS)'; ?>
    <?php require BASE_PATH . '/resources/views/layouts/navbar.php'; ?>

<div class="relative bg-slate-950 text-slate-100 overflow-hidden">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute inset-0 opacity-20" style="background-image: linear-gradient(rgba(6,182,212,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(6,182,212,0.06) 1px, transparent 1px); background-size: 36px 36px;"></div>
        <div class="absolute -top-24 -left-24 w-[36rem] h-[36rem] rounded-full blur-3xl opacity-20 bg-cyan-600/30"></div>
        <div class="absolute -bottom-24 -right-24 w-[36rem] h-[36rem] rounded-full blur-3xl opacity-20 bg-blue-500/30"></div>
        <div id="cv-layer" class="absolute inset-0">
            <span class="cv-box"></span>
            <span class="cv-box delay-100 left-1/3 top-1/4"></span>
            <span class="cv-box delay-300 left-2/3 top-2/3"></span>
            <span class="cv-line left-1/5 top-1/2"></span>
            <span class="cv-line left-2/3 top-1/3"></span>
        </div>
    </div>

    <button id="themeToggle" title="Ubah tema" class="fixed z-40 right-4 top-4 p-2 rounded-full border border-slate-700 bg-slate-900/70 backdrop-blur hover:bg-slate-800 transition">
        <i class="fa-solid fa-moon text-cyan-400" id="themeIcon"></i>
    </button>

    <section class="relative pt-28 md:pt-36 pb-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7">
                    <p class="text-cyan-400 font-semibold tracking-wide mb-4">Laboratorium Intelligent Vision & Smart System</p>
                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                        Mengembangkan
                        <span class="from-cyan-400 to-blue-500 bg-clip-text text-transparent bg-gradient-to-r drop-shadow-[0_0_20px_rgba(34,211,238,0.25)]">Visi Komputer</span>
                        &
                        <span class="from-blue-400 to-cyan-400 bg-clip-text text-transparent bg-gradient-to-r">Sistem AI</span>
                    </h1>
                    <p class="mt-6 text-lg md:text-xl text-slate-300 max-w-2xl">
                        IVSS berfokus pada riset mutakhir di bidang visi komputer, pembelajaran mendalam, dan sistem otonom cerdas untuk dampak akademik dan industri.
                    </p>
                    <div class="mt-6 flex items-center gap-3 text-slate-300">
                        <span class="text-slate-400">Fokus:</span>
                        <span class="inline-flex items-center rounded-full bg-slate-800/70 px-3 py-1 border border-slate-700">
                            <span id="typing" class="font-semibold text-cyan-300"></span>
                            <span class="caret ml-1 h-6 w-0.5 bg-cyan-400"></span>
                        </span>
                    </div>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="<?= BASE_URL ?? '.' ?>/register" class="px-6 py-3 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow-lg shadow-cyan-600/20 hover:from-cyan-400 hover:to-blue-500 transition">Daftar Penelitian</a>
                        <a href="#tentang" class="px-6 py-3 rounded-lg border border-slate-700/80 bg-slate-900/50 hover:bg-slate-800/60 transition">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <div class="relative aspect-[4/3] rounded-2xl border border-slate-800 bg-slate-900/40 shadow-xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581092921461-8a6e67c134ff?q=80&w=1600&auto=format&fit=crop" alt="Laboratorium Visi Komputer" class="w-full h-full object-cover opacity-80" onerror="this.src='https://placehold.co/1200x900/0b1220/e2e8f0?text=IVSS+Lab';">
                        <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500/10 via-transparent to-blue-500/10"></div>
                        <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-cyan-400 via-blue-500 to-cyan-400 animate-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-20 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-5">
                    <h2 class="text-3xl md:text-4xl font-bold">Tentang IVSS</h2>
                    <p class="mt-4 text-slate-300">Kami melakukan riset fundamental dan terapan di bidang visi komputer, persepsi mesin, serta sistem otonom cerdas melalui kolaborasi akademik dan industri.</p>
                </div>
                <div class="lg:col-span-7 grid sm:grid-cols-2 gap-6">
                    <div class="glass p-6 rounded-xl border border-slate-800 hover:-translate-y-1 transition">
                        <p class="text-cyan-300 font-semibold">Visi</p>
                        <p class="mt-2 text-sm text-slate-300">Menjadi pusat riset unggulan yang diakui secara internasional dalam inovasi visi cerdas dan sistem pintar.</p>
                    </div>
                    <div class="glass p-6 rounded-xl border border-slate-800 hover:-translate-y-1 transition">
                        <p class="text-cyan-300 font-semibold">Misi</p>
                        <ul class="mt-2 text-sm text-slate-300 list-disc list-inside space-y-1">
                            <li>Riset berkualitas di CV, ML, dan otonomi</li>
                            <li>Solusi berdampak bagi industri dan masyarakat</li>
                            <li>Publikasi di konferensi dan jurnal bereputasi</li>
                            <li>Kolaborasi strategis dan pengembangan talenta</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fokus" class="py-20 bg-slate-900/60 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-end justify-between flex-wrap gap-4">
                <h2 class="text-3xl md:text-4xl font-bold">Fokus Riset</h2>
            </div>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $focus = [
                    ['title' => 'Deteksi Objek', 'desc' => 'YOLO, DETR, inferensi tepi real-time', 'icon' => 'fa-bullseye'],
                    ['title' => 'Segmentasi Semantik', 'desc' => 'Kendaraan otonom, citra udara', 'icon' => 'fa-layer-group'],
                    ['title' => 'Pengenalan & Pelacakan', 'desc' => 'ReID, pelacakan multi-objek, SLAM', 'icon' => 'fa-route'],
                    ['title' => 'Sistem Cerdas', 'desc' => 'Robotika, kontrol, sistem siber-fisik', 'icon' => 'fa-robot'],
                ];
                foreach ($focus as $f): ?>
                    <div class="group p-6 rounded-xl border border-slate-800 bg-slate-900/40 hover:bg-slate-900/60 transition hover:-translate-y-1">
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 flex items-center justify-center">
                            <i class="fa-solid <?= htmlspecialchars($f['icon']) ?> text-cyan-300"></i>
                        </div>
                        <h3 class="mt-4 font-semibold text-lg"><?= htmlspecialchars($f['title']) ?></h3>
                        <p class="mt-2 text-sm text-slate-300"><?= htmlspecialchars($f['desc']) ?></p>
                        <div class="mt-4 h-px bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="py-20 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold">Fasilitas</h2>
            <div class="mt-10 grid md:grid-cols-3 gap-6">
                <?php
                $fac = [
                    ['img' => 'https://images.unsplash.com/photo-1633555774810-70430678b43c?q=80&w=1600&auto=format&fit=crop', 'title' => 'Server GPU', 'desc' => 'Klaster NVIDIA A100/H100 untuk pelatihan skala besar'],
                    ['img' => 'https://images.unsplash.com/photo-1567443024551-f3e3cc2be874?q=80&w=1600&auto=format&fit=crop', 'title' => 'Laboratorium Robotik', 'desc' => 'Lengan robot, drone, dan sensor LiDAR'],
                    ['img' => 'https://images.unsplash.com/photo-1535016120720-40c646be5580?q=80&w=1600&auto=format&fit=crop', 'title' => 'Studio XR', 'desc' => 'Perangkat VR/AR dan motion capture'],
                ];
                foreach ($fac as $c): ?>
                    <article class="rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 hover:bg-slate-900/60 transition shadow-xl">
                        <img src="<?= htmlspecialchars($c['img']) ?>" alt="<?= htmlspecialchars($c['title']) ?>" class="h-48 w-full object-cover" onerror="this.src='https://placehold.co/1200x480/0b1220/e2e8f0?text=Fasilitas';">
                        <div class="p-6">
                            <h3 class="font-semibold text-lg"><?= htmlspecialchars($c['title']) ?></h3>
                            <p class="mt-2 text-sm text-slate-300"><?= htmlspecialchars($c['desc']) ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="peralatan" class="py-20 bg-slate-900/60 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-end justify-between flex-wrap gap-4">
                <h2 class="text-3xl md:text-4xl font-bold">Peralatan</h2>
                <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/equipment/bookings/katalog" class="text-cyan-300 hover:text-cyan-200">Lihat Katalog →</a>
            </div>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($equipment_showcase ?? null)): foreach (($equipment_showcase ?? []) as $eq): ?>
                    <div class="rounded-xl border border-slate-800 bg-slate-900/40 hover:bg-slate-900/60 transition">
                        <div class="p-6">
                            <h3 class="font-semibold"><?= htmlspecialchars($eq['name'] ?? 'Peralatan') ?></h3>
                            <p class="mt-2 text-sm text-slate-300 line-clamp-2"><?= htmlspecialchars($eq['description'] ?? '') ?></p>
                        </div>
                    </div>
                <?php endforeach; else: ?>
                    <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Kamera Resolusi Tinggi</h3>
                        <p class="mt-2 text-sm text-slate-300">Sensor global shutter untuk robotika dan HRI.</p>
                    </div>
                    <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Perangkat Edge AI</h3>
                        <p class="mt-2 text-sm text-slate-300">Jetson Orin Nano dengan pipeline CV teroptimasi.</p>
                    </div>
                    <div class="rounded-xl border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Pemindai LiDAR</h3>
                        <p class="mt-2 text-sm text-slate-300">Pemetaan 3D untuk navigasi dan pemahaman adegan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="anggota" class="py-20 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold">Anggota Lab</h2>
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <?php if (!empty($anggota_lab ?? null)): foreach (($anggota_lab ?? []) as $m): ?>
                    <div class="text-center bg-slate-900/40 p-5 rounded-xl border border-slate-800 hover:bg-slate-900/60 transition">
                        <img class="w-24 h-24 rounded-full mx-auto object-cover object-center" src="<?= htmlspecialchars($m['photo'] ?? 'https://placehold.co/128x128/334155/E0F2FE?text=Foto') ?>" alt="<?= htmlspecialchars($m['name'] ?? 'Anggota') ?>">
                        <h4 class="mt-3 text-base font-medium text-white"><?= htmlspecialchars($m['name'] ?? '') ?></h4>
                        <p class="text-sm font-medium text-cyan-400"><?= htmlspecialchars($m['role'] ?? '') ?></p>
                    </div>
                <?php endforeach; else: ?>
                    <div class="text-center bg-slate-900/40 p-5 rounded-xl border border-slate-800">
                        <img class="w-24 h-24 rounded-full mx-auto object-cover object-center" src="https://placehold.co/128x128/334155/E0F2FE?text=Foto" alt="Anggota">
                        <h4 class="mt-3 text-base font-medium text-white">Savero Athallah</h4>
                        <p class="text-sm font-medium text-cyan-400">Research Assistant</p>
                    </div>
                    <div class="text-center bg-slate-900/40 p-5 rounded-xl border border-slate-800">
                        <img class="w-24 h-24 rounded-full mx-auto object-cover object-center" src="https://placehold.co/128x128/334155/E0F2FE?text=Foto" alt="Anggota">
                        <h4 class="mt-3 text-base font-medium text-white">Budi Doremi</h4>
                        <p class="text-sm font-medium text-cyan-400">Junior Researcher</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="penelitian" class="py-20 bg-slate-900/60 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold">Penelitian</h2>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($penelitian ?? null)): foreach (($penelitian ?? []) as $p): ?>
                    <article class="rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 hover:bg-slate-900/60 transition">
                        <div class="p-6">
                            <h3 class="font-semibold"><?= htmlspecialchars($p['title'] ?? 'Judul Penelitian') ?></h3>
                            <p class="mt-2 text-xs text-slate-400">Pembimbing: <?= htmlspecialchars($p['supervisor'] ?? '-') ?></p>
                            <p class="mt-2 text-sm text-slate-300 line-clamp-3"><?= htmlspecialchars($p['excerpt'] ?? '') ?></p>
                            <?php if (!empty($p['url'] ?? null)): ?>
                                <a class="mt-4 inline-block text-cyan-300 hover:text-cyan-200" href="<?= htmlspecialchars($p['url']) ?>">Detail →</a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; else: ?>
                    <article class="rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Deteksi Objek Real-time di Perangkat Edge</h3>
                        <p class="mt-2 text-xs text-slate-400">Pembimbing: Dr. A. Budi</p>
                        <p class="mt-2 text-sm text-slate-300">Optimasi YOLOv8 untuk inferensi cepat pada perangkat low-power.</p>
                    </article>
                    <article class="rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Segmentasi Semantik untuk Kendaraan Otonom</h3>
                        <p class="mt-2 text-xs text-slate-400">Pembimbing: Prof. C. Dewi</p>
                        <p class="mt-2 text-sm text-slate-300">Pemetaan kelas piksel pada lingkungan tropis.</p>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="berita" class="py-20 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold">Berita Terbaru</h2>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($latest_news ?? null)): foreach (($latest_news ?? []) as $n): ?>
                    <article class="group rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 hover:bg-slate-900/60 transition">
                        <div class="p-6">
                            <h3 class="font-semibold group-hover:text-cyan-300 transition"><?= htmlspecialchars($n['title'] ?? 'Berita') ?></h3>
                            <p class="mt-2 text-sm text-slate-300 line-clamp-3"><?= htmlspecialchars($n['excerpt'] ?? '') ?></p>
                            <?php if (!empty($n['url'] ?? null)): ?>
                                <a class="mt-4 inline-block text-cyan-300 hover:text-cyan-200" href="<?= htmlspecialchars($n['url']) ?>">Selengkapnya →</a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; else: ?>
                    <article class="rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Paper Diterima di CVPR Workshop</h3>
                        <p class="mt-2 text-sm text-slate-300">Karya kami tentang domain adaptation untuk segmentasi.</p>
                    </article>
                    <article class="rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/40 p-6">
                        <h3 class="font-semibold">Robot Arm Baru Tiba</h3>
                        <p class="mt-2 text-sm text-slate-300">Robot kolaboratif terbaru untuk riset manipulasi.</p>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-20 bg-slate-900/60 reveal">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 items-start">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold">Kontak</h2>
                    <p class="mt-4 text-slate-300">Untuk kolaborasi dan informasi penerimaan anggota, hubungi kami.</p>
                    <ul class="mt-6 space-y-3 text-slate-300">
                        <li><i class="fa-solid fa-envelope text-cyan-400 mr-2"></i> ivss.lab@example.edu</li>
                        <li><i class="fa-solid fa-location-dot text-cyan-400 mr-2"></i> Departemen Informatika, Universitas Anda</li>
                    </ul>
                </div>
                <div class="glass p-6 rounded-2xl border border-slate-800">
                    <p class="text-sm text-slate-400">Bagian ini statis. Integrasikan formulir kontak bila diperlukan.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.glass { background: radial-gradient(1200px 200px at 0% 0%, rgba(94,234,212,0.06), transparent 40%), rgba(2,6,23,0.5); }
.caret { animation: blink 1s step-end infinite; }
@keyframes blink { 50% { opacity: 0; } }
.cv-box { position:absolute; width:180px; height:120px; border:2px solid rgba(34,211,238,.5); border-radius:8px; top:15%; left:10%; filter:drop-shadow(0 0 8px rgba(34,211,238,.25)); animation: floatBox 8s ease-in-out infinite; }
.cv-line { position:absolute; width:2px; height:120px; background: linear-gradient(to bottom, rgba(59,130,246,.0), rgba(59,130,246,.6), rgba(59,130,246,.0)); filter:drop-shadow(0 0 6px rgba(59,130,246,.25)); animation: sweep 6s linear infinite; }
.cv-box.delay-100{ animation-delay: .7s; }
.cv-box.delay-300{ animation-delay: 1.4s; }
@keyframes floatBox { 0%,100%{ transform: translateY(0); } 50%{ transform: translateY(14px); } }
@keyframes sweep { 0%{ transform: translateY(-30px);} 100%{ transform: translateY(60px);} }
.reveal{ opacity:0; transform: translateY(16px); transition: all .7s ease; }
.reveal.visible{ opacity:1; transform: translateY(0); }
</style>

<script>
(function(){
  const phrases = ['Visi Komputer', 'Riset AI', 'Pembelajaran Mendalam', 'Sistem Cerdas'];
  const el = document.getElementById('typing');
  let i = 0, j = 0, deleting = false;
  function type(){
    if(!el) return;
    const cur = phrases[i % phrases.length];
    el.textContent = cur.slice(0, j);
    const speed = deleting ? 50 : 90;
    if(!deleting && j === cur.length){ deleting = true; setTimeout(type, 900); return; }
    if(deleting && j === 0){ deleting = false; i++; }
    j += deleting ? -1 : 1;
    setTimeout(type, speed);
  }
  type();

  const io = new IntersectionObserver((entries)=>{
    entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('visible'); io.unobserve(e.target);} });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(n=> io.observe(n));

  const btn = document.getElementById('themeToggle');
  const icon = document.getElementById('themeIcon');
  const key = 'ivss-theme';
  function apply(t){
    const dark = t !== 'light';
    document.documentElement.classList.toggle('dark', dark);
    document.body.classList.toggle('theme-slate', dark);
    icon.className = dark ? 'fa-solid fa-moon text-cyan-400' : 'fa-solid fa-sun text-amber-300';
    localStorage.setItem(key, dark ? 'dark' : 'light');
  }
  const saved = localStorage.getItem(key);
  if(saved){ apply(saved); }
  btn?.addEventListener('click', ()=>{ apply(document.body.classList.contains('theme-slate') ? 'light' : 'dark'); });

  const layer = document.getElementById('cv-layer');
  window.addEventListener('mousemove', (e)=>{
    if(!layer) return;
    const x = (e.clientX / window.innerWidth - 0.5) * 8;
    const y = (e.clientY / window.innerHeight - 0.5) * 8;
    layer.style.transform = `translate(${x}px, ${y}px)`;
  });
})();
</script>