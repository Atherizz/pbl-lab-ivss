<?php 
$pageTitle = 'Fasilitas dan Peralatan';

// Data equipments dari controller
$equipments = $equipments ?? [];

// Kategorisasi equipments
$mainEquipments = [];
$otherEquipments = [];

foreach ($equipments as $equipment) {
    // Filter berdasarkan status available atau in use
    if (in_array($equipment['status'], ['available', 'in use'])) {
        // Kategorikan berdasarkan nama atau bisa juga pakai kolom category jika ada
        $name = strtolower($equipment['name']);
        if (strpos($name, 'komputer') !== false || strpos($name, 'desktop') !== false || 
            strpos($name, 'meja') !== false || strpos($name, 'kursi') !== false) {
            $mainEquipments[] = $equipment;
        } else {
            $otherEquipments[] = $equipment;
        }
    }
}

// Function untuk mendapatkan icon
function getEquipmentIcon($name) {
    $name = strtolower($name);
    if (strpos($name, 'camera') !== false || strpos($name, 'realsense') !== false) {
        return 'fas fa-camera';
    } elseif (strpos($name, 'ac') !== false || strpos($name, 'pendingin') !== false) {
        return 'fas fa-snowflake';
    } elseif (strpos($name, 'air') !== false || strpos($name, 'mineral') !== false) {
        return 'fas fa-tint';
    } elseif (strpos($name, 'mushola') !== false || strpos($name, 'masjid') !== false) {
        return 'fas fa-mosque';
    } elseif (strpos($name, 'lampu') !== false || strpos($name, 'lighting') !== false) {
        return 'fas fa-lightbulb';
    } elseif (strpos($name, 'box') !== false) {
        return 'fas fa-box-open';
    } elseif (strpos($name, 'openmv') !== false || strpos($name, 'iot') !== false) {
        return 'fas fa-microchip';
    } elseif (strpos($name, 'komputer') !== false || strpos($name, 'desktop') !== false) {
        return 'fas fa-desktop';
    } elseif (strpos($name, 'meja') !== false || strpos($name, 'kursi') !== false) {
        return 'fas fa-chair';
    } else {
        return 'fas fa-tools'; // Icon default
    }
}

require BASE_PATH . '/resources/views/layouts/navbar.php'; 
?>

<body class="bg-slate-900 text-slate-300">

  <header class="py-8 bg-slate-800 border-b border-slate-700 shadow-lg text-center relative">
    <div class="absolute left-6 top-1/2 -translate-y-1/2">
      <a href="<?= BASE_URL ?? '.' ?>/" class="inline-flex items-center justify-center w-10 h-10 bg-slate-700 text-cyan-400 text-lg font-medium rounded-lg hover:bg-cyan-600 hover:text-white transition-all">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
    <h1 class="text-3xl md:text-4xl font-semibold text-cyan-400 tracking-wide">
      Fasilitas dan Peralatan
    </h1>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-16 space-y-20">
    
    <?php if (!empty($mainEquipments)): ?>
    <!-- Main Equipment Section (2 columns) -->
    <section>
      <h2 class="text-2xl font-bold text-white mb-8 flex items-center">
        <i class="fas fa-desktop mr-3 text-cyan-400"></i>
        Peralatan Utama
      </h2>
      <div class="grid md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-10">
        <?php foreach ($mainEquipments as $equipment): ?>
        <div class="bg-slate-800 rounded-3xl shadow-lg p-8 border border-slate-700 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
          <div class="flex items-start gap-6">
            <div class="flex-shrink-0">
              <div class="w-20 h-20 bg-cyan-500/10 rounded-2xl flex items-center justify-center">
                <i class="<?= getEquipmentIcon($equipment['name']) ?> text-3xl text-cyan-400"></i>
              </div>
            </div>
            <div class="flex-1">
              <h3 class="text-2xl font-semibold text-cyan-400 group-hover:text-cyan-300 transition-colors mb-3">
                <?= htmlspecialchars($equipment['name']) ?>
              </h3>
              <p class="text-slate-400 text-base leading-relaxed">
                <?= htmlspecialchars($equipment['description']) ?>
              </p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($otherEquipments)): ?>
    <!-- Other Equipment Section (4 columns) -->
    <section>
<h2 class="text-2xl font-bold text-white mb-8 flex items-center">
        <i class="fas fa-cogs mr-3 text-cyan-400"></i>
        Fasilitas Pendukung
      </h2>
      <div class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-8">
        <?php foreach ($otherEquipments as $equipment): ?>
        <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-center border border-slate-700 
                    transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:border-cyan-500/30 group">
          <div class="w-20 h-20 bg-cyan-500/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="<?= getEquipmentIcon($equipment['name']) ?> text-3xl text-cyan-400"></i>
          </div>
          
          <div class="mb-3">
            <h3 class="text-xl font-semibold text-cyan-400 group-hover:text-cyan-300 transition-colors line-clamp-2 min-h-[3.5rem]">
              <?= htmlspecialchars($equipment['name']) ?>
            </h3>
          </div>
          
          <p class="text-slate-400 text-sm leading-relaxed line-clamp-3">
            <?= htmlspecialchars($equipment['description']) ?>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if (empty($equipments)): ?>
    <!-- Empty State -->
    <section class="text-center py-20">
      <div class="bg-slate-800/30 border border-slate-700 rounded-3xl p-12 max-w-2xl mx-auto">
        <i class="fas fa-toolbox text-6xl text-slate-600 mb-6"></i>
        <h3 class="text-2xl font-semibold text-white mb-3">Belum Ada Peralatan</h3>
        <p class="text-slate-400">Data peralatan laboratorium belum tersedia saat ini.</p>
      </div>
    </section>
    <?php endif; ?>

  </main>

</body>
</html>