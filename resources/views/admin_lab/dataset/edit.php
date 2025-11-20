<?php
$pageTitle = 'Edit Dataset';
$activeMenu = 'direktori-dataset'; 

$old = $old ?? [];
$errors = $errors ?? [];

$displayTitle = $old['title'] ?? $dataset['title'] ?? '';
$displayDesc = $old['description'] ?? $dataset['description'] ?? '';
$displayTags = $old['tags'] ?? $dataset['tags'] ?? '';

// Siapkan data URL untuk JS
// 1. Prioritas input lama (jika error validasi)
// 2. Data dari database
// 3. Default array kosong (nanti di JS akan dibuat minimal 1)
$urlData = !empty($old['dataset_urls']) ? $old['dataset_urls'] : ($dataset['dataset_urls'] ?? []);
// Pastikan array index reset
$jsUrlData = array_values($urlData);

require BASE_PATH . '/resources/views/layouts/dashboard.php';
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Dataset: <?= htmlspecialchars($dataset['title']) ?></h2>

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded">
                        <ul class="list-disc pl-5 mt-2">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= (BASE_URL ?? '.') . '/admin-lab/dataset/' . ($dataset['id'] ?? '') ?>" method="POST">
                    <!-- Jika framework butuh method spoofing, uncomment ini -->
                    <!-- <input type="hidden" name="_method" value="PUT"> -->

                    <div class="space-y-6">

                        <!-- 1. Dataset Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Dataset Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required
                                   value="<?= htmlspecialchars($displayTitle) ?>"
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <!-- 2. Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4"
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($displayDesc) ?></textarea>
                        </div>

                        <!-- 3. Dataset URLs (Vanilla JS) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Dataset URLs <span class="text-red-500">*</span>
                            </label>
                            
                            <div id="url-container" class="space-y-3">
                                <!-- Input JS masuk sini -->
                            </div>

                            <button type="button" id="add-url-btn"
                                    class="mt-3 inline-flex items-center px-3 py-2 border border-dashed border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:border-blue-400 focus:outline-none transition-all w-full justify-center">
                                <i class="fas fa-plus mr-1.5 text-blue-500"></i> Add Another Link
                            </button>
                        </div>

                         <!-- 4. Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700">
                                Tags (Optional)
                            </label>
                            <input type="text" id="tags" name="tags"
                                   value="<?= htmlspecialchars($displayTags) ?>"
                                   placeholder="vision, yolo, object-detection"
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">Separate tags with a comma.</p>
                        </div>
                        
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-lab/dataset"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Update Dataset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('url-container');
    const addBtn = document.getElementById('add-url-btn');
    
    // Data dari PHP (Database atau Old input)
    const initialUrls = <?= json_encode($jsUrlData) ?>;
    
    function createUrlInput(value = '') {
        const wrapper = document.createElement('div');
        wrapper.className = 'flex gap-2 items-center url-group';
        
        const inputWrapper = document.createElement('div');
        inputWrapper.className = 'relative flex-grow';
        
        const iconDiv = document.createElement('div');
        iconDiv.className = 'absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none';
        iconDiv.innerHTML = '<i class="fas fa-link text-gray-400"></i>';
        
        const input = document.createElement('input');
        input.type = 'url';
        input.name = 'dataset_urls[]';
        input.value = value;
        input.placeholder = 'https://...';
        input.className = 'block w-full pl-10 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3';
        input.required = true;
        
        inputWrapper.appendChild(iconDiv);
        inputWrapper.appendChild(input);
        
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors delete-url-btn';
        deleteBtn.title = 'Remove URL';
        deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
        
        deleteBtn.addEventListener('click', function() {
            if (container.querySelectorAll('.url-group').length > 1) {
                wrapper.remove();
            } else {
                input.value = '';
                alert("Minimal satu URL harus ada.");
            }
        });

        wrapper.appendChild(inputWrapper);
        wrapper.appendChild(deleteBtn);
        
        return wrapper;
    }

    // Inisialisasi
    if (initialUrls.length > 0) {
        initialUrls.forEach(url => {
            container.appendChild(createUrlInput(url));
        });
    } else {
        container.appendChild(createUrlInput());
    }

    addBtn.addEventListener('click', function() {
        container.appendChild(createUrlInput());
    });
});
</script>