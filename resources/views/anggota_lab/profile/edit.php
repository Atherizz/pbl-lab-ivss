<?php

$profile = $profile ?? [];
$mode = $mode ?? 'create';
$fullName = $fullName ?? 'Nama Pengguna';
$BASE_URL = $BASE_URL ?? '';
$userId = $userId ?? null;

$userRole = $_SESSION['user']['role'] ?? 'anggota_lab';

$pageTitle = ($mode === 'edit') ? 'Edit Profil Lab User' : 'Buat Profil Lab User';
$activeMenu = 'profile-user-lab';

$researchFocus = $profile['research_focus'] ?? [];
$educations = $profile['educations'] ?? [];
$certifications = $profile['certifications'] ?? [];

$basePath = match ($userRole) {
    'admin_lab' => 'admin-lab',
    'anggota_lab' => 'anggota-lab',
    default => ''
};

$formAction = BASE_URL . '/anggota-lab/profile'; 
$formMethod = 'POST';

$successMessage = flash('success') ?? null; 
$errorMessage = flash('error') ?? null;

$errors = $errors ?? [];

$jsResearchFocus = json_encode($researchFocus);
$jsEducations = json_encode($educations);
$jsCertifications = json_encode($certifications);

require BASE_PATH . '/resources/views/layouts/dashboard.php';
?>

<div class="content">


<?php if ($successMessage) : ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
    </div>
<?php endif; ?>
<?php if ($errorMessage) : ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($errorMessage) ?></span>
    </div>
<?php endif; ?>

<form action="<?= $formAction ?>" method="<?= $formMethod ?>" enctype="multipart/form-data" class="bg-white border border-slate-300 rounded-xl shadow-lg overflow-hidden">

    <input type="hidden" name="user_id" value="<?= $userId ?>">

    <section class="p-6 border-b border-slate-200 bg-white">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Informasi Dasar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">Nama Lengkap (Dari Akun)</label>
                <input type="text" class="w-full rounded-md border border-gray-300 bg-gray-100 text-gray-600" value="<?= htmlspecialchars($fullName) ?>" disabled />
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">Email Kontak</label>
                <input name="email" type="email" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="nama@kampus.ac.id" value="<?= htmlspecialchars($profile['email'] ?? ($_SESSION['user']['email'] ?? '')) ?>" required/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">NIDN</label>
                <input name="nidn" type="text" class="w-full rounded-md border border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed" placeholder="1990..." value="<?= htmlspecialchars($nidn) ?>" readonly/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">NIP</label>
                <input name="nip" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="000..." value="<?= htmlspecialchars($profile['nip'] ?? '') ?>"/>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">Program Studi / Major</label>
                <select name="major" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <?php 
                    $majors = ['Teknik Informatika', 'Sistem Informasi Bisnis', 'Pengembangan Piranti Lunak Situs', 'Rekayasa Teknologi Informasi'];
                    $selectedMajor = $profile['major'] ?? '';
                    foreach ($majors as $major): 
                    ?>
                        <option value="<?= $major ?>" <?= ($major === $selectedMajor) ? 'selected' : '' ?>>
                            <?= $major ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </section>

    <section class="p-6 border-b border-slate-200 bg-white">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Social Links</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php 
            $socialFields = ['linkedin', 'google_scholar', 'sinta', 'cv', 'website', 'email']; 
            $socialData = $profile['social_links'] ?? [];
            ?>
            <?php foreach ($socialFields as $field): ?>
                <div>
                    <label class="text-xs text-slate-600"><?= ucwords(str_replace('_', ' ', $field)) ?></label>
                    <input name="social_links[<?= $field ?>]" type="<?= ($field === 'email') ? 'email' : 'url' ?>" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="https://..." value="<?= htmlspecialchars($socialData[$field] ?? '') ?>"/>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="p-6 border-b border-slate-200 bg-white">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Research Focus</h2>
        <div id="research-focus-container" class="flex flex-wrap gap-2 mb-3">
        </div>
        <div class="flex gap-2">
            <input id="new-tag-input" type="text" class="flex-1 rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="Tambah fokus riset (Enter)"/>
            <button type="button" id="add-tag-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Tambah</button>
        </div>
        <p class="text-xs text-slate-500 mt-2">Contoh: Data Science, Machine Learning, Information Retrieval, AI.</p>
    </section>

    <section class="p-6 border-b border-slate-200 bg-white">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Pendidikan</h2>
            <button type="button" id="add-education-btn" class="text-sm text-sky-600 hover:text-sky-800"><i class="fa fa-plus mr-1"></i>Tambah</button>
        </div>
        <div id="education-container" class="space-y-4">
        </div>
    </section>

    <section class="p-6 border-b border-slate-200 bg-white">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Sertifikasi</h2>
            <button type="button" id="add-cert-btn" class="text-sm text-sky-600 hover:text-sky-800"><i class="fa fa-plus mr-1"></i>Tambah</button>
        </div>
        <div id="certification-container" class="space-y-4">
        </div>
    </section>

    <div class="p-6 flex items-center justify-end gap-3 border-b border-slate-200 bg-white">
    <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/profile" 
        class="px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition duration-150 ease-in-out">
        Batal
    </a>
    <button type="submit" 
        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        <?= ($mode === 'create') ? 'Simpan Profil' : 'Simpan Perubahan' ?>
    </button>
</div>
</form>

</div> 

<script>
document.addEventListener('DOMContentLoaded', function() {
    let researchFocus = <?= $jsResearchFocus ?> || [];
    let educations = <?= $jsEducations ?> || [];
    let certifications = <?= $jsCertifications ?> || [];

    const focusContainer = document.getElementById('research-focus-container');
    const newTagInput = document.getElementById('new-tag-input');
    const addTagBtn = document.getElementById('add-tag-btn');
    const educationContainer = document.getElementById('education-container');
    const addEducationBtn = document.getElementById('add-education-btn');
    const certificationContainer = document.getElementById('certification-container');
    const addCertBtn = document.getElementById('add-cert-btn');

    // =========================================================================
    // RESEARCH FOCUS LOGIC
    // =========================================================================

    function createFocusTag(tag, index) {
        const span = document.createElement('span');
        span.className = 'px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs inline-flex items-center gap-2 focus-tag';
        
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'research_focus[]';
        hiddenInput.value = tag;
        
        const textSpan = document.createElement('span');
        textSpan.textContent = tag;
        
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'text-sky-800 hover:text-sky-900 ml-1'; 
        deleteBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        
        deleteBtn.addEventListener('click', function() {
            researchFocus.splice(index, 1);
            renderResearchFocus();
        });

        span.appendChild(hiddenInput);
        span.appendChild(textSpan);
        span.appendChild(deleteBtn);
        return span;
    }

    function renderResearchFocus() {
        focusContainer.innerHTML = '';
        researchFocus.forEach((tag, index) => {
            focusContainer.appendChild(createFocusTag(tag, index));
        });
    }

    function addTag() {
        const t = newTagInput.value.trim();
        if (!t) return;
        
        if (!researchFocus.some(tag => tag.toLowerCase() === t.toLowerCase())) {
            researchFocus.push(t);
        }
        
        newTagInput.value = '';
        renderResearchFocus();
    }

    addTagBtn.addEventListener('click', addTag);
    newTagInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            addTag();
        }
    });

    // =========================================================================
    // PENDIDIKAN (EDUCATION) LOGIC
    // =========================================================================

    function createEducationElement(data, index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'grid grid-cols-1 md:grid-cols-5 gap-3 bg-white p-4 rounded-lg border border-gray-200 shadow-sm education-item';
        
        const html = `
            <div>
                <label class="text-xs text-slate-600">Level</label>
                <select name="educations[${index}][level]" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800">
                    <option value="S1" ${data.level === 'S1' ? 'selected' : ''}>S1</option>
                    <option value="S2" ${data.level === 'S2' ? 'selected' : ''}>S2</option>
                    <option value="S3" ${data.level === 'S3' ? 'selected' : ''}>S3</option>
                    <option value="D3" ${data.level === 'D3' ? 'selected' : ''}>D3</option>
                    <option value="D4" ${data.level === 'D4' ? 'selected' : ''}>D4</option>
                    <option value="Profesi" ${data.level === 'Profesi' ? 'selected' : ''}>Profesi</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="text-xs text-slate-600">Degree</label>
                <input name="educations[${index}][degree]" value="${data.degree || ''}" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="Teknik Informatika"/>
            </div>
            <div>
                <label class="text-xs text-slate-600">Mulai</label>
                <input name="educations[${index}][start_year]" value="${data.start_year || ''}" type="number" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800 education-start-year" placeholder="2014" data-index="${index}"/>
            </div>
            <div>
                <label class="text-xs text-slate-600">Selesai</label>
                <input name="educations[${index}][end_year]" value="${data.end_year || ''}" type="number" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800 education-end-year" placeholder="2016" data-index="${index}"/>
                <p class="text-xs text-red-500 mt-1 hidden education-year-error-${index}">Tahun selesai harus lebih besar dari tahun mulai</p>
            </div>
            <div class="md:col-span-5">
                <label class="text-xs text-slate-600">Institusi</label>
                <input name="educations[${index}][institution]" value="${data.institution || ''}" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="Institut Teknologi Sepuluh Nopember"/>
            </div>
            <div class="md:col-span-5 flex justify-end">
                <button type="button" class="text-xs text-rose-500 hover:text-rose-700 delete-edu-btn"><i class="fa fa-trash mr-1"></i>Hapus</button>
            </div>
        `;
        
        wrapper.innerHTML = html;
        
        wrapper.querySelector('.delete-edu-btn').addEventListener('click', function() {
            educations.splice(index, 1); 
            renderEducations(); 
        });

        return wrapper;
    }

    function renderEducations() {
        educationContainer.innerHTML = ''; 
        educations.forEach((edu, index) => {
            educationContainer.appendChild(createEducationElement(edu, index));
        });
    }

    function addEducation() {
        educations.push({ 
            level: "", 
            degree: "", 
            institution: "", 
            start_year: "", 
            end_year: "" 
        });
        renderEducations();
    }
    
    addEducationBtn.addEventListener('click', addEducation);

    // Validasi start_year < end_year untuk education
    function validateEducationYears() {
        let isValid = true;
        
        educations.forEach((edu, index) => {
            const startYear = parseInt(edu.start_year);
            const endYear = parseInt(edu.end_year);
            const errorElement = document.querySelector(`.education-year-error-${index}`);
            
            if (errorElement) {
                if (startYear && endYear && startYear >= endYear) {
                    errorElement.classList.remove('hidden');
                    isValid = false;
                } else {
                    errorElement.classList.add('hidden');
                }
            }
        });
        
        return isValid;
    }

    // Event listener untuk real-time validation
    educationContainer.addEventListener('input', function(e) {
        if (e.target.classList.contains('education-start-year') || 
            e.target.classList.contains('education-end-year')) {
            const index = parseInt(e.target.dataset.index);
            
            // Update data array
            if (e.target.classList.contains('education-start-year')) {
                educations[index].start_year = e.target.value;
            } else {
                educations[index].end_year = e.target.value;
            }
            
            validateEducationYears();
        }
    });

    // Validasi saat submit form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (!validateEducationYears()) {
            e.preventDefault();
            alert('Mohon periksa kembali tahun pendidikan. Tahun selesai harus lebih besar dari tahun mulai.');
            return false;
        }
    });

    // =========================================================================
    // SERTIFIKASI (CERTIFICATION) LOGIC
    // =========================================================================

    function createCertificationElement(data, index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'grid grid-cols-1 md:grid-cols-4 gap-3 bg-white p-4 rounded-lg border border-gray-200 shadow-sm certification-item';
        
        const html = `
            <div class="md:col-span-2">
                <label class="text-xs text-slate-600">Nama Sertifikasi</label>
                <input name="certifications[${index}][name]" value="${data.name || ''}" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="Azure AI Fundamentals"/>
            </div>
            <div>
                <label class="text-xs text-slate-600">Issuer</label>
                <input name="certifications[${index}][issuer]" value="${data.issuer || ''}" type="text" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="Microsoft"/>
            </div>
            <div>
                <label class="text-xs text-slate-600">Tanggal Terbit</label>
                <input name="certifications[${index}][issued_on]" value="${data.issued_on || ''}" type="date" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800"/>
            </div>
            <div class="md:col-span-4">
                <label class="text-xs text-slate-600">Credential URL</label>
                <input name="certifications[${index}][credential_url]" value="${data.credential_url || ''}" type="url" class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="https://..."/>
            </div>
            <div class="md:col-span-4 flex justify-end">
                <button type="button" class="text-xs text-rose-500 hover:text-rose-700 delete-cert-btn"><i class="fa fa-trash mr-1"></i>Hapus</button>
            </div>
        `;

        wrapper.innerHTML = html;

        wrapper.querySelector('.delete-cert-btn').addEventListener('click', function() {
            certifications.splice(index, 1);
            renderCertifications();
        });

        return wrapper;
    }

    function renderCertifications() {
        certificationContainer.innerHTML = '';
        certifications.forEach((cert, index) => {
            certificationContainer.appendChild(createCertificationElement(cert, index));
        });
    }

    function addCert() {
        certifications.push({ 
            name: "", 
            issuer: "", 
            issued_on: "", 
            credential_url: "" 
        });
        renderCertifications();
    }

    addCertBtn.addEventListener('click', addCert);


   

    // =========================================================================
    // INITIAL RENDER
    // =========================================================================
    
    renderResearchFocus();
    renderEducations();
    renderCertifications();
});
</script>