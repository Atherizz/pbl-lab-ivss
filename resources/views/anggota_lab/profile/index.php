<?php 
$pageTitle = 'Profil Lab User';
$activeMenu = 'profile-user-lab';

$profile = $profile ?? [];
if (!is_array($profile)) {
    $profile = [];
}

$fullName = $fullName ?? 'Pengguna Lab';
$email = $profile['email'] ?? ($_SESSION['user']['email'] ?? '-');
$photo_url = htmlspecialchars($profile['photo_url'] ?? 'https://placehold.co/220x300/e5e7eb/4b5563?text=No+Photo');
$social_links = $profile['social_links'] ?? [];
$research_focus = $profile['research_focus'] ?? [];
$educations = $profile['educations'] ?? [];
$certifications = $profile['certifications'] ?? [];

if (is_string($research_focus)) { $research_focus = json_decode($research_focus, true) ?? []; }
if (is_string($educations)) { $educations = json_decode($educations, true) ?? []; }
if (is_string($certifications)) { $certifications = json_decode($certifications, true) ?? []; }

$isProfileExists = !empty($profile) && (!empty($profile['nip']) || !empty($profile['nidn']) || !empty($research_focus));
$buttonText = $isProfileExists ? 'Edit Profil' : 'Buat Profil';
$iconClass = $isProfileExists ? 'fas fa-edit' : 'fas fa-plus-circle';

$socialIconMap = [
    'linkedin' => 'fab fa-linkedin-in',
    'google_scholar' => 'fas fa-graduation-cap',
    'sinta' => 'fas fa-book',
    'cv' => 'fas fa-file-pdf',
    'website' => 'fas fa-globe',
    'email' => 'fas fa-envelope',
];

require BASE_PATH . '/resources/views/layouts/dashboard.php';
?>

<div class="content">

    <?php $successMessage = flash('success'); if ($successMessage) : ?>
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
        </div>
    <?php endif; ?>

    <div class="space-y-8">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                
                <div class="p-6 w-full lg:w-64 border-b lg:border-b-0 lg:border-r border-gray-200 bg-gray-50 flex flex-col items-center">
                    
                    <div class="w-56 h-72 rounded-xl overflow-hidden shadow-md bg-white mb-6 border border-gray-100">
                        <img src="<?= $photo_url ?>" alt="Profile Photo" class="w-full h-full object-cover">
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($fullName) ?></h3>

                    <div class="space-y-4 w-full">
                        <?php 
                        $basicData = [
                            'NIP' => $profile['nip'] ?? '-',
                            'NIDN' => $profile['nidn'] ?? '-',
                            'Program Studi' => $profile['major'] ?? '-',
                            'Kontak' => $email,
                        ];
                        foreach ($basicData as $label => $value):
                        ?>
                            <div>
                                <h4 class="text-xs font-semibold text-gray-500 tracking-wider uppercase"><?= $label ?></h4>
                                <p class="text-sm font-medium text-gray-900 break-all">
                                    <?php if ($label === 'Kontak' && $value !== '-'): ?>
                                        <a href="mailto:<?= htmlspecialchars($value) ?>" class="text-sky-600 hover:underline"><?= htmlspecialchars($value) ?></a>
                                    <?php else: ?>
                                        <?= htmlspecialchars($value) ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-6 w-full">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/profile/edit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition shadow-md">
                            <i class="<?= $iconClass ?> mr-2"></i> <?= $buttonText ?>
                        </a>
                    </div>
                </div>
                
                <div class="flex-1 p-6">

                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">Fokus Riset</h2>
                    <div class="flex flex-wrap gap-2 mb-8">
                        <?php if (!empty($research_focus)): ?>
                            <?php foreach ($research_focus as $focus): ?>
                                <span class="px-4 py-1 rounded-full bg-sky-50 text-sky-700 text-sm border border-sky-300">
                                    <?= htmlspecialchars($focus) ?>
                                </span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-500 italic">Belum ada fokus riset yang ditambahkan.</p>
                        <?php endif; ?>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">Tautan Sosial & Akademik</h2>
                    <div class="space-y-3 mb-8">
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
                                <div class="text-sm flex items-center gap-3">
                                    <i class="<?= $iconClass ?> text-gray-500 w-5 text-center"></i>
                                    <span class="text-gray-600 capitalize font-medium w-32"><?= $label ?>:</span>
                                    <a href="<?= htmlspecialchars($link_href) ?>" target="_blank" class="text-blue-600 hover:underline break-all flex-1" title="<?= htmlspecialchars($url) ?>">
                                        <?= htmlspecialchars(substr($display_url, 0, 50) . (strlen($display_url) > 50 ? '...' : '')) ?>
                                    </a>
                                </div>
                            <?php endif; 
                        endforeach; 
                        if (!$has_links): ?>
                            <p class="text-sm text-gray-500 italic">Belum ada tautan yang ditambahkan.</p>
                        <?php endif; ?>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Riwayat Akademik</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-university mr-2 text-sky-600"></i> Pendidikan</h3>
                            <ul class="space-y-4">
                                <?php if (!empty($educations)): ?>
                                    <?php foreach ($educations as $edu): ?>
                                        <li class="border-l-4 border-sky-400 pl-3">
                                            <p class="font-semibold text-gray-800 text-sm">
                                                <?= htmlspecialchars($edu['level'] ?? '') ?> – <?= htmlspecialchars($edu['degree'] ?? 'Gelar tidak diketahui') ?>
                                            </p>
                                            <p class="text-xs text-gray-600 font-medium"><?= htmlspecialchars($edu['institution'] ?? 'Institusi tidak diketahui') ?></p>
                                            <p class="text-xs text-gray-500 italic">
                                                <?= htmlspecialchars($edu['start_year'] ?? '-') ?>–<?= htmlspecialchars($edu['end_year'] ?? 'Sekarang') ?>
                                            </p>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-sm text-gray-500 italic">Data pendidikan belum tersedia.</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-certificate mr-2 text-sky-600"></i> Sertifikasi</h3>
                            <ul class="space-y-4">
                                <?php if (!empty($certifications)): ?>
                                    <?php foreach ($certifications as $cert): ?>
                                        <li class="border-l-4 border-sky-400 pl-3">
                                            <p class="font-semibold text-gray-800 text-sm"><?= htmlspecialchars($cert['name'] ?? 'Nama Sertifikasi tidak diketahui') ?></p>
                                            <p class="text-xs text-gray-600 font-medium"><?= htmlspecialchars($cert['issuer'] ?? 'Issuer tidak diketahui') ?></p>
                                            <p class="text-xs text-gray-500 italic">
                                                Terbit: <?= htmlspecialchars($cert['issued_on'] ?? '-') ?>
                                            </p>
                                            <?php if (!empty($cert['credential_url'])): ?>
                                                <a href="<?= htmlspecialchars($cert['credential_url']) ?>" target="_blank" class="text-xs text-blue-500 hover:underline">Lihat Kredensial <i class="fas fa-external-link-alt ml-1"></i></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-sm text-gray-500 italic">Data sertifikasi belum tersedia.</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>