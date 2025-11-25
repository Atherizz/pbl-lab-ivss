<?php 
$pageTitle = 'Profil Lab User';
$activeMenu = 'profile-user-lab';
?>
<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<?php 
$profile = [
    'name' => 'Mamluatul Hani\'ah, S.Kom., M.Kom',
    'nip' => '199002062019032013',
    'nidn' => '0006029003',
    'major' => 'Teknik Informatika',
    'email' => 'hani@example.com',
    'photo_url' => 'https://via.placeholder.com/220x300.png?text=Photo',
    'social_links' => [
        'linkedin' => 'https://linkedin.com/in/dummy',
        'google_scholar' => 'https://scholar.google.com/citations?user=dummy',
        'sinta' => 'https://sinta.kemdikbud.go.id/authors/detail?id=dummy',
        'email' => 'hani@example.com',
        'cv' => '#'
    ],
    'research_focus' => ['Data Science', 'Machine Learning', 'Information Retrieval', 'Artificial Intelligence'],
    'educations' => [
        [
            'level' => 'S2',
            'degree' => 'Teknik Informatika',
            'institution' => 'Institut Teknologi Sepuluh Nopember',
            'start_year' => 2014,
            'end_year' => 2016
        ],
        [
            'level' => 'S1',
            'degree' => 'Ilmu Komputer',
            'institution' => 'Universitas Brawijaya',
            'start_year' => 2009,
            'end_year' => 2014
        ]
    ],
    'certifications' => [
        [
            'name' => 'IT Specialist - Artificial Intelligence',
            'issuer' => 'Pearson VUE',
            'issued_on' => '2025-02-01'
        ],
        [
            'name' => 'Microsoft certified Azure AI Fundamentals',
            'issuer' => 'Microsoft',
            'issued_on' => '2022-10-01'
        ]
    ]
];
?>

<div class="space-y-8">
    <!-- Profile Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="flex flex-col lg:flex-row">
            <!-- Left: Photo & Basic Info -->
            <div class="p-6 w-full lg:w-64 border-b lg:border-b-0 lg:border-r border-gray-200 bg-gray-50 flex flex-col items-center">
                <div class="w-56 h-72 rounded-xl overflow-hidden shadow-sm bg-white mb-6">
                    <img src="<?= htmlspecialchars($profile['photo_url']) ?>" alt="Profile Photo" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4 w-full">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 tracking-wider">NIP</h4>
                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($profile['nip']) ?></p>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 tracking-wider">NIDN</h4>
                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($profile['nidn']) ?></p>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 tracking-wider">Program Studi</h4>
                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($profile['major']) ?></p>
                    </div>
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 tracking-wider">Kontak</h4>
                        <ul class="text-xs text-gray-700 space-y-2 mt-2">
                            <li><span class="font-semibold">Email:</span><br><?= htmlspecialchars($profile['email']) ?></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 w-full">
                    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/profile/edit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-edit mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>
            <!-- Right: Details -->
            <div class="flex-1 p-6">
                <div class="mb-6">
                    <h1 class="text-3xl font-semibold text-gray-800"><?= htmlspecialchars($profile['name']) ?></h1>
                </div>

                <!-- Research Focus Tags -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <?php foreach ($profile['research_focus'] as $focus): ?>
                        <span class="px-4 py-1 rounded-full border border-gray-300 bg-white text-sm text-gray-700 shadow-sm">
                            <?= htmlspecialchars($focus) ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <!-- Social Links -->
                <div class="space-y-2 mb-8">
                    <?php foreach ($profile['social_links'] as $key => $url): ?>
                        <div class="text-sm">
                            <span class="text-gray-600 capitalize mr-2"><?= str_replace('_',' ', $key) ?>:</span>
                            <a href="<?= htmlspecialchars($url) ?>" target="_blank" class="text-blue-600 hover:underline break-all"><?= htmlspecialchars($url) ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Educations & Certifications -->
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Pendidikan & Sertifikasi</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Educations -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendidikan</h3>
                        <ul class="space-y-4">
                            <?php foreach ($profile['educations'] as $edu): ?>
                                <li class="text-sm">
                                    <p class="font-semibold text-gray-800">
                                        <?= htmlspecialchars($edu['level']) ?> – <?= htmlspecialchars($edu['degree']) ?>
                                    </p>
                                    <p class="text-xs text-gray-600"><?= htmlspecialchars($edu['institution']) ?> (<?= $edu['start_year'] ?>–<?= $edu['end_year'] ?>)</p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Certifications -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sertifikasi</h3>
                        <ul class="space-y-4">
                            <?php foreach ($profile['certifications'] as $cert): ?>
                                <li class="text-sm">
                                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($cert['name']) ?></p>
                                    <p class="text-xs text-gray-600"><?= htmlspecialchars($cert['issuer']) ?> <span class="italic">(terbit <?= htmlspecialchars($cert['issued_on']) ?>)</span></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
