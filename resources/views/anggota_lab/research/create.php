<?php 
$header = 'Propose New Research Project'; 
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Research Proposal Details</h2>

                <form action="<?= BASE_URL ?? '.' ?>/anggota-lab/research" method="POST">
                    <div class="space-y-6">
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Research Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required 
                                   value="<?= htmlspecialchars($old['title'] ?? '') ?>" 
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description / Abstract <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                        </div>
                        
                        <div>
                            <label for="publication_url" class="block text-sm font-medium text-gray-700">
                                Publication URL (Optional)
                            </label>
                            <input type="url" id="publication_url" name="publication_url" 
                                   value="<?= htmlspecialchars($old['publication_url'] ?? '') ?>" 
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
                           Submit Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>