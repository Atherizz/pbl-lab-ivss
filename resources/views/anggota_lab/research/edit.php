<?php 

$header = 'Edit Anggota Lab Project: ' . htmlspecialchars($research['title'] ?? '...'); 
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Research Proposal</h2>

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded">
                        <p class="font-bold">Please fix the following errors:</p>
                        <ul class="list-disc pl-5 mt-2">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?> 

                <form action="<?= (BASE_URL ?? '.') . '/anggota-lab/research' . urlencode($research['id'] ?? '') ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT"> 
                    
                    <div class="space-y-6">
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Research Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required 
                                   value="<?= htmlspecialchars($old['title'] ?? $research['title'] ?? '', ENT_QUOTES) ?>" 
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <?php if (isset($errors['title'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['title']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description / Abstract <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($old['description'] ?? $research['description'] ?? '', ENT_QUOTES) ?></textarea>
                            <?php if (isset($errors['description'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['description']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <label for="publication_url" class="block text-sm font-medium text-gray-700">
                                Publication URL (Optional)
                            </label>
                            <input type="url" id="publication_url" name="publication_url" 
                                   value="<?= htmlspecialchars($old['publication_url'] ?? $research['publication_url'] ?? '', ENT_QUOTES) ?>" 
                                   placeholder="https://ieeexplore.ieee.org/..."
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="<?= BASE_URL ?? '.' ?>/anggota-lab/research" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                           Cancel
                        </a>
                        <button type="submit" name="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                           Update Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
