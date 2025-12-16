<?php 
$pageTitle = 'Profil Peneliti';

// Data profil
$profile = $profile ?? [];
if (!is_array($profile)) {
    $profile = [];
}


$fullName = $user['name'] ?? 'Peneliti';
$email = $profile['email'] ?? '-';
$photo_url = htmlspecialchars($profile['profile_photo'] ?? 'https://placehold.co/220x300/e5e7eb/4b5563?text=No+Photo');
$social_links = $profile['social_links'] ?? [];
$research_focus = $profile['research_focus'] ?? [];
$educations = $profile['educations'] ?? [];
$certifications = $profile['certifications'] ?? [];

if (is_string($social_links)) { $social_links = json_decode($social_links, true) ?? []; }
if (is_string($research_focus)) { $research_focus = json_decode($research_focus, true) ?? []; }
if (is_string($educations)) { $educations = json_decode($educations, true) ?? []; }
if (is_string($certifications)) { $certifications = json_decode($certifications, true) ?? []; }

// Data penelitian dari database
$research = $research ?? [];

$socialIconMap = [
    'linkedin' => 'fab fa-linkedin-in',
    'google_scholar' => 'fas fa-graduation-cap',
    'sinta' => 'fas fa-book',
    'cv' => 'fas fa-file-pdf',
    'website' => 'fas fa-globe',
    'email' => 'fas fa-envelope',
];

// Function untuk format tanggal
function formatDate($date) {
    if (empty($date)) return '-';
    $timestamp = strtotime($date);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'];
    return date('d', $timestamp) . ' ' . $months[date('n', $timestamp) - 1] . ' ' . date('Y', $timestamp);
}

// Function untuk extract year dari date
function getYear($date) {
    if (empty($date)) return '-';
    return date('Y', strtotime($date));
}

require BASE_PATH . '/resources/views/layouts/navbar.php';
?>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    
    <!-- Header Section -->
    <div class="bg-slate-800/50 border-b border-slate-700 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <a href="<?= BASE_URL ?>/#anggota-lab" class="inline-flex items-center text-slate-400 hover:text-cyan-400 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Anggota
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12">
        
        <!-- Profile Card -->
        <div class="bg-slate-800/50 rounded-2xl shadow-2xl border border-slate-700 overflow-hidden backdrop-blur-sm mb-8">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Left Sidebar - Photo & Basic Info -->
                <div class="p-8 w-full lg:w-80 border-b lg:border-b-0 lg:border-r border-slate-700 bg-slate-800/30 flex flex-col items-center">
                    
                    <div class="w-56 h-72 rounded-xl overflow-hidden shadow-xl bg-slate-700 mb-6 border border-slate-600">
                        <?php if (!empty($profile['photo_url'])): ?>
                            <img src="<?= BASE_URL . '/' . htmlspecialchars($profile['photo_url']) ?>" alt="Profile Photo" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-700 to-slate-800">
                                <div class="text-center">
                                    <i class="fas fa-user text-6xl text-slate-500 mb-3"></i>
                                    <p class="text-sm text-slate-400">Belum ada foto</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-2 text-center"><?= htmlspecialchars($fullName) ?></h3>
                    <p class="text-cyan-400 text-sm font-semibold mb-6"><?= htmlspecialchars($profile['major'] ?? 'Teknik Informatika') ?></p>

                    <div class="space-y-4 w-full">
                        <?php 
                        $basicData = [
                            'NIP' => $profile['nip'] ?? '-',
                            'NIDN' => $user['reg_number'] ?? '-',
                            'Program Studi' => $profile['major'] ?? '-',
                            'Kontak' => $email,
                        ];
                        foreach ($basicData as $label => $value):
                        ?>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-400 tracking-wider uppercase mb-1"><?= $label ?></h4>
                                <p class="text-sm font-medium text-slate-200 break-all">
                                    <?php if ($label === 'Kontak' && $value !== '-'): ?>
                                        <a href="mailto:<?= htmlspecialchars($value) ?>" class="text-cyan-400 hover:text-cyan-300 transition-colors"><?= htmlspecialchars($value) ?></a>
                                    <?php else: ?>
                                        <?= htmlspecialchars($value) ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Right Content -->
                <div class="flex-1 p-8">

                    <!-- Fokus Riset -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-microscope mr-3 text-cyan-400"></i>
                            Fokus Riset
                        </h2>
                        <div class="flex flex-wrap gap-3">
                            <?php if (!empty($research_focus)): ?>
                                <?php foreach ($research_focus as $focus): ?>
                                    <span class="px-4 py-2 rounded-full bg-cyan-500/10 text-cyan-400 text-sm border border-cyan-500/30 font-medium">
                                        <?= htmlspecialchars($focus) ?>
                                    </span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-sm text-slate-400 italic">Belum ada fokus riset yang ditambahkan.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Tautan Sosial & Akademik -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-link mr-3 text-cyan-400"></i>
                            Tautan Sosial & Akademik
                        </h2>
                        <div class="space-y-3">
                            <?php 
                            $has_links = false;
                            foreach ($socialIconMap as $key => $iconClass): 
                                $url = $social_links[$key] ?? '';
                                if (!empty($url)):
                                    $has_links = true;
                                    $label = ucwords(str_replace('_',' ', $key));
                                    $link_href = ($key === 'email') ? 'mailto:' . $url : $url;
                                    $display_url = ($key === 'email') ? $url : parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH);
                                    ?>
                                    <div class="flex items-center gap-3 p-3 bg-slate-700/30 rounded-lg hover:bg-slate-700/50 transition-colors border border-slate-700">
                                        <i class="<?= $iconClass ?> text-cyan-400 w-6 text-center text-lg"></i>
                                        <span class="text-slate-300 capitalize font-medium w-32"><?= $label ?>:</span>
                                        <a href="<?= htmlspecialchars($link_href) ?>" target="_blank" class="text-cyan-400 hover:text-cyan-300 transition-colors break-all flex-1" title="<?= htmlspecialchars($url) ?>">
                                            <?= htmlspecialchars(substr($display_url, 0, 50) . (strlen($display_url) > 50 ? '...' : '')) ?>
                                        </a>
                                    </div>
                                <?php endif; 
                            endforeach; 
                            if (!$has_links): ?>
                                <p class="text-sm text-slate-400 italic">Belum ada tautan yang ditambahkan.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Riwayat Akademik -->
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-graduation-cap mr-3 text-cyan-400"></i>
                            Riwayat Akademik
                        </h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            
                            <!-- Pendidikan -->
                            <div class="bg-slate-700/30 border border-slate-600 rounded-xl p-5">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-university mr-2 text-cyan-400"></i> Pendidikan
                                </h3>
                                <ul class="space-y-4">
                                    <?php if (!empty($educations)): ?>
                                        <?php foreach ($educations as $edu): ?>
                                            <li class="border-l-4 border-cyan-400 pl-3">
                                                <p class="font-semibold text-white text-sm">
                                                    <?= htmlspecialchars($edu['level'] ?? '') ?> – <?= htmlspecialchars($edu['degree'] ?? 'Gelar tidak diketahui') ?>
                                                </p>
                                                <p class="text-xs text-slate-300 font-medium"><?= htmlspecialchars($edu['institution'] ?? 'Institusi tidak diketahui') ?></p>
                                                <p class="text-xs text-slate-400 italic">
                                                    <?= htmlspecialchars($edu['start_year'] ?? '-') ?>–<?= htmlspecialchars($edu['end_year'] ?? 'Sekarang') ?>
                                                </p>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-sm text-slate-400 italic">Data pendidikan belum tersedia.</p>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            
                            <!-- Sertifikasi -->
                            <div class="bg-slate-700/30 border border-slate-600 rounded-xl p-5">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-certificate mr-2 text-cyan-400"></i> Sertifikasi
                                </h3>
                                <ul class="space-y-4">
                                    <?php if (!empty($certifications)): ?>
                                        <?php foreach ($certifications as $cert): ?>
                                            <li class="border-l-4 border-cyan-400 pl-3">
                                                <p class="font-semibold text-white text-sm"><?= htmlspecialchars($cert['name'] ?? 'Nama Sertifikasi tidak diketahui') ?></p>
                                                <p class="text-xs text-slate-300 font-medium"><?= htmlspecialchars($cert['issuer'] ?? 'Issuer tidak diketahui') ?></p>
                                                <p class="text-xs text-slate-400 italic">
                                                    Terbit: <?= htmlspecialchars($cert['issued_on'] ?? '-') ?>
                                                </p>
                                                <?php if (!empty($cert['credential_url'])): ?>
                                                    <a href="<?= htmlspecialchars($cert['credential_url']) ?>" target="_blank" class="text-xs text-cyan-400 hover:text-cyan-300 transition-colors">
                                                        Lihat Kredensial <i class="fas fa-external-link-alt ml-1"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-sm text-slate-400 italic">Data sertifikasi belum tersedia.</p>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publikasi -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-white flex items-center">
                    <i class="fas fa-graduation-cap mr-3 text-cyan-400"></i>
                    Publikasi (<?= $totalPublications ?? 0 ?>)
                </h2>
            </div>
            
            <?php if (!empty($publications)): ?>
            <!-- Filtering Buttons -->
            <div class="flex gap-2 mb-6 flex-wrap">
                <a href="?sort=citations" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?= ($sortBy ?? 'citations') === 'citations' ? 'bg-blue-600 text-white' : 'bg-slate-700 text-slate-300 hover:bg-slate-600' ?>">
                    Most Cited
                </a>
                <a href="?sort=latest" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?= ($sortBy ?? '') === 'latest' ? 'bg-blue-600 text-white' : 'bg-slate-700 text-slate-300 hover:bg-slate-600' ?>">
                    Latest
                </a>
                <a href="?sort=oldest" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?= ($sortBy ?? '') === 'oldest' ? 'bg-blue-600 text-white' : 'bg-slate-700 text-slate-300 hover:bg-slate-600' ?>">
                    Oldest
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-6">
                <?php foreach($publications as $item): ?>
                <div class="bg-slate-800/50 border border-slate-700 rounded-2xl shadow-lg p-6 hover:-translate-y-1 hover:shadow-xl hover:border-cyan-500/30 transition-all group">
                    <h3 class="text-lg font-semibold text-slate-100 leading-snug mb-3 group-hover:text-cyan-400 transition-colors min-h-[60px] line-clamp-3">
                        <?= htmlspecialchars($item['title'] ?? 'Untitled') ?>
                    </h3>
                    <div class="flex items-center justify-between text-sm text-slate-400 mb-4">
                        <span class="font-bold"><?= $item['year'] ?? '-' ?></span>
                        <span><?= number_format($item['cited_by_count'] ?? 0) ?> citations</span>
                    </div>
                    <?php if (!empty($item['scholar_link'])): ?>
                    <a href="<?= htmlspecialchars($item['scholar_link']) ?>" target="_blank" class="block text-center bg-slate-700 text-slate-200 py-2.5 rounded-lg font-semibold hover:bg-cyan-600 hover:text-white transition-all shadow-sm">
                        Baca
                    </a>
                    <?php else: ?>
                    <div class="block text-center bg-slate-700/50 text-slate-400 py-2.5 rounded-lg font-semibold cursor-not-allowed">
                        Tidak Tersedia
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <?php if (($totalPages ?? 1) > 1): ?>
            <div class="flex items-center justify-center gap-2 pt-6 border-t border-slate-700">
                <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>&sort=<?= $sortBy ?>" class="px-3 py-2 rounded-lg bg-slate-700 text-white hover:bg-slate-600 transition-all">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
                <?php endif; ?>
                
                <span class="px-4 py-2 text-slate-300">
                    <?= $startItem ?>-<?= $endItem ?> of <?= $totalPublications ?>
                </span>
                
                <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>&sort=<?= $sortBy ?>" class="px-3 py-2 rounded-lg bg-slate-700 text-white hover:bg-slate-600 transition-all">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php else: ?>
            <div class="bg-slate-800/30 border border-slate-700 rounded-xl p-12 text-center">
                <i class="fas fa-folder-open text-6xl text-slate-600 mb-4"></i>
                <p class="text-slate-400 text-lg">Belum ada publikasi yang ditambahkan.</p>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>