<?php 
$pageTitle = 'Buat Berita';
$activeMenu = 'news';

$old_data = $old_data ?? ['title' => '', 'content' => '', 'image_file' => ''];
?>

<?php require BASE_PATH . '/resources/views/layouts/dashboard.php'; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Detail Berita</h2>

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <ul class="list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?? '.' ?>/admin-berita/news" method="POST" enctype="multipart/form-data">
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required 
                                    value="<?= htmlspecialchars($old_data['title'] ?? '') ?>" 
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">
                                Konten <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content" name="content" rows="8" required
                                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2"><?= htmlspecialchars($old_data['content'] ?? '') ?></textarea>
                        </div>

                        <div>
                            <label for="image_file" class="block text-sm font-medium text-gray-700">
                                Gambar Berita <span class="text-red-500">*</span>
                            </label>
                            
                            <div id="drop-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer transition duration-150 ease-in-out hover:border-blue-500">
                                <div class="space-y-1 text-center">
                                    
                                    <img id="image-preview" class="max-h-32 w-auto mx-auto rounded-md object-cover mb-2 hidden" alt="Pratinjau Gambar">
                                    
                                    <svg id="image-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m-11.828-11.828L28 28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    
                                    <p id="file-name-display" class="text-sm font-medium text-gray-700 hidden"></p>
                                    
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image_file_input" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Unggah file</span>
                                            <input id="image_file_input" name="image_file" type="file" required class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF hingga 10MB
                                    </p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="author_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/admin-berita/news" 
                            class="px-4 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Terbitkan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('image_file_input');
    const fileNameDisplay = document.getElementById('file-name-display');
    const imageIcon = document.getElementById('image-icon');
    const imagePreview = document.getElementById('image-preview'); 

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    dropArea.addEventListener('dragenter', () => {
        dropArea.classList.add('border-blue-500');
        dropArea.classList.add('bg-blue-50');
    }, false);

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-blue-500');
        dropArea.classList.remove('bg-blue-50');
    }, false);
    
    dropArea.addEventListener('dragover', () => {
        dropArea.classList.add('border-blue-500');
        dropArea.classList.add('bg-blue-50'); 
    }, false);

    dropArea.addEventListener('drop', (e) => {
        dropArea.classList.remove('border-blue-500');
        dropArea.classList.remove('bg-blue-50');
        handleDrop(e);
    }, false);


    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            handleFiles(files);
        }
    }

    dropArea.addEventListener('click', (e) => {
        if (!e.target.closest('label')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        const file = files[0];
        
        const resetUI = (isError = false, errorMessage = '') => {
            imagePreview.classList.add('hidden');
            imagePreview.src = '';
            imageIcon.classList.remove('hidden');
            fileNameDisplay.classList.remove('hidden');
            
            if (isError) {
                fileNameDisplay.textContent = errorMessage;
            } else {
                fileNameDisplay.textContent = 'atau tarik dan lepas';
            }
            
            if (isError) {
                fileInput.files = new DataTransfer().files; 
            }
        }
        
        if (!file) {
            resetUI(false);
            return;
        }

        if (file.type.match('image.*')) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                imageIcon.classList.add('hidden');
            };
            reader.readAsDataURL(file);

            fileNameDisplay.textContent = `File dipilih: ${file.name}`;
            fileNameDisplay.classList.remove('hidden');
        } else {
            resetUI(true, 'ERROR: Hanya file gambar yang diterima.');
        }
    }
</script>
<?php require BASE_PATH . '/resources/views/layouts/footer.php'; ?>