<?php 
$pageTitle = 'Buat Produk Lab Baru';
$activeMenu = 'products';

$old_data = $old_data ?? [
    'judul' => '', 
    'deskripsi' => '', 
    'produk_url' => '', 
    'produk_type' => [], 
    'features' => []
];

$errors = $errors ?? [];
$successMessage = flash('success') ?? null; 
$errorMessage = flash('error') ?? null;

$jsProdukType = json_encode($old_data['produk_type'] ?? []);
$features_data = $old_data['features'] ?? [];
$jsFeatures = json_encode($features_data); 
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Detail Produk</h2>

                <?php if (isset($errors) && !empty($errors) || $errorMessage): ?>
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <ul class="list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                            <?php if ($errorMessage && empty($errors)): ?>
                                <li><?= htmlspecialchars($errorMessage) ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?? '.' ?>/admin-lab/products/store" method="POST" enctype="multipart/form-data">
                    <div class="space-y-6">
                        
                        <div class="space-y-6 p-4 border border-gray-200 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700">Informasi Dasar</h3>
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">
                                    Judul Produk <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="judul" name="judul" required 
                                        value="<?= htmlspecialchars($old_data['judul'] ?? '') ?>" 
                                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                                    Deskripsi Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea id="deskripsi" name="deskripsi" rows="6" required
                                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"><?= htmlspecialchars($old_data['deskripsi'] ?? '') ?></textarea>
                            </div>
                            
                            <div>
                                <label for="produk_url" class="block text-sm font-medium text-gray-700">
                                    URL Produk (Opsional)
                                </label>
                                <input type="url" id="produk_url" name="produk_url"
                                        value="<?= htmlspecialchars($old_data['produk_url'] ?? '') ?>" 
                                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"
                                        placeholder="https://link-ke-produk.com">
                            </div>
                        </div>

                        <div class="space-y-6 p-4 border border-gray-200 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700">Gambar Produk</h3>
                            <div>
                                <label for="image_file_input" class="block text-sm font-medium text-gray-700">
                                    Unggah Gambar Utama <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 flex items-center space-x-4">
                                    <img id="image-preview" class="max-h-32 w-auto rounded-md object-cover hidden border border-gray-300" alt="Pratinjau Gambar">
                                    <div>
                                        <input id="image_file_input" name="image_file" type="file" required 
                                                         class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" 
                                                         accept="image/*">
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF hingga 10MB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-6 p-4 border border-gray-200 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700">Tipe Produk / Kategori (Tags)</h3>
                            <div id="produk-type-container" class="flex flex-wrap gap-2 mb-3">
                                </div>
                            <div class="flex gap-2">
                                <input id="new-produk-type-input" type="text" class="flex-1 rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800" placeholder="Tambah tipe (Enter): IoT, AI, Perikanan, dll."/>
                                <button type="button" id="add-produk-type-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Tambah</button>
                            </div>
                        </div>

                        <div class="space-y-6 p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-700">Daftar Fitur Utama</h3>
                                <button type="button" id="add-feature-btn" class="text-sm text-sky-600 hover:text-sky-800"><i class="fa fa-plus mr-1"></i>Tambah Fitur</button>
                            </div>
                            <div id="features-container" class="space-y-4">
                                </div>
                            <p class="text-xs text-gray-500">Contoh: Notifikasi Real-time, Analisis Data Historis.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/products" 
                            class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let produkType = <?= $jsProdukType ?> || [];
    let features = <?= $jsFeatures ?> || []; 

    const fileInput = document.getElementById('image_file_input');
    const imagePreview = document.getElementById('image-preview'); 
    
    const typeContainer = document.getElementById('produk-type-container');
    const newTypeInput = document.getElementById('new-produk-type-input');
    const addTypeBtn = document.getElementById('add-produk-type-btn');
    const featuresContainer = document.getElementById('features-container');
    const addFeatureBtn = document.getElementById('add-feature-btn');


    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.classList.add('hidden');
        }
    });


    function createTypeTag(tag, index) {
        const span = document.createElement('span');
        span.className = 'px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs inline-flex items-center gap-2 focus-tag';
        
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'produk_type[]';
        hiddenInput.value = tag;
        
        const textSpan = document.createElement('span');
        textSpan.textContent = tag;
        
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'text-sky-800 hover:text-sky-900 ml-1'; 
        deleteBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        
        deleteBtn.addEventListener('click', function() {
            const currentIndex = produkType.findIndex(t => t === tag); 
            if (currentIndex > -1) {
                 produkType.splice(currentIndex, 1);
            }
            renderProdukType();
        });

        span.appendChild(hiddenInput);
        span.appendChild(textSpan);
        span.appendChild(deleteBtn);
        return span;
    }

    function renderProdukType() {
        typeContainer.innerHTML = '';
        produkType = produkType.filter(t => t && typeof t === 'string' && t.trim() !== '');
        
        produkType.forEach((tag) => {
            typeContainer.appendChild(createTypeTag(tag, produkType.indexOf(tag)));
        });
    }

    function addType() {
        const t = newTypeInput.value.trim();
        if (!t) return;
        
        if (!produkType.some(tag => tag.toLowerCase() === t.toLowerCase())) {
            produkType.push(t);
        }
        
        newTypeInput.value = '';
        renderProdukType();
    }

    addTypeBtn.addEventListener('click', addType);
    newTypeInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            addType();
        }
    });

    
    function updateFeatureData(index, value) {
        if (features[index]) {
            features[index].judul = value;
        }
    }

    function createFeatureElement(data, index) {
        const wrapper = document.createElement('div');
        wrapper.className = 'grid grid-cols-1 md:grid-cols-4 gap-3 bg-white p-4 rounded-lg border border-gray-200 shadow-sm feature-item';
        
        const featureTitle = data.judul || ''; 
        
        const html = `
            <div class="md:col-span-3">
                <label class="text-xs text-slate-600">Nama Fitur</label>
                <input name="features[${index}][judul]" value="${featureTitle}" type="text" 
                        class="w-full rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500 bg-white text-gray-800 feature-input" 
                        placeholder="Contoh: Real-time Monitoring" required/>
            </div>
            <div class="md:col-span-1 flex items-end justify-end">
                <button type="button" class="text-xs text-rose-500 hover:text-rose-700 delete-feature-btn"><i class="fa fa-trash mr-1"></i>Hapus</button>
            </div>
        `;
        
        wrapper.innerHTML = html;

        const deleteBtn = wrapper.querySelector('.delete-feature-btn');
        deleteBtn.addEventListener('click', function() {
            features.splice(index, 1); 
            renderFeatures(); 
        });
        
        const inputElement = wrapper.querySelector('.feature-input');
        inputElement.addEventListener('input', function() {
            updateFeatureData(index, this.value);
        });

        return wrapper;
    }

    function renderFeatures() {
        featuresContainer.innerHTML = ''; 
        features.forEach((feature, index) => {
            featuresContainer.appendChild(createFeatureElement(feature, index));
        });
    }

    function addFeature() {
        features.push({ 
            judul: ""
        });
        renderFeatures();
    }
    
    addFeatureBtn.addEventListener('click', addFeature);


    renderProdukType();
    renderFeatures();
    
    if (features.length > 0) {
    }
});
</script>
<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>