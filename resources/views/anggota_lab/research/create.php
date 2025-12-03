<?php
$pageTitle = 'Ajukan Riset';
$activeMenu = 'ajukan-riset';

require BASE_PATH . '/resources/views/layouts/dashboard.php';

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

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

                <form action="<?= BASE_URL ?? '.' ?>/anggota-lab/research" method="POST">
                    <div class="space-y-6">

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Research Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required
                                   value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                                   class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['title']) ? 'border-red-500' : '' ?>">
                            <?php if (isset($errors['title'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['title']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($_SESSION['user']['role'] === 'mahasiswa'): ?>
                        <div class="bg-gradient-to-br from-slate-800 via-slate-900 to-slate-950 border border-slate-700 rounded-lg p-6 shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-cyan-500/20 rounded-lg backdrop-blur-sm">
                                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-white">Rekomendasi Dosen Pembimbing dengan AI</h3>
                                </div>
                                <button type="button" id="analyzeBtn" 
                                        class="px-5 py-2.5 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-200 flex items-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-cyan-500/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span>Analisis dengan AI</span>
                                </button>
                            </div>

                            <p class="text-sm text-slate-300 mb-4">
                                Dapatkan rekomendasi dosen pembimbing terbaik berdasarkan topik riset Anda menggunakan analisis AI.
                            </p>

                            <div id="loadingState" class="hidden">
                                <div class="flex items-center space-x-3 py-8 bg-slate-800/50 backdrop-blur-sm rounded-lg px-4 border border-slate-700">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-cyan-400"></div>
                                    <div>
                                        <p class="text-sm font-medium text-white">Menganalisis topik riset Anda...</p>
                                        <p class="text-xs text-slate-400">Proses ini mungkin memakan waktu beberapa detik</p>
                                    </div>
                                </div>
                            </div>

                            <div id="aiResults" class="hidden space-y-4">
                                <div class="bg-slate-800 border border-slate-700 rounded-lg shadow-xl p-5">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h4 class="font-bold text-white text-lg" id="topicTitle"></h4>
                                            <p class="text-xs text-slate-400 mt-1">Berdasarkan analisis judul riset Anda</p>
                                        </div>
                                        <span class="px-3 py-1 bg-cyan-500 text-white text-xs font-semibold rounded-full shadow-sm">
                                            ✓ Dianalisis AI
                                        </span>
                                    </div>

                                    <div id="recommendationsList" class="space-y-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="dospem_id" class="block text-sm font-medium text-gray-700">
                                Supervisor (Dosen Pembimbing) <span class="text-red-500">*</span>
                            </label>
                            <select id="dospem_id" name="dospem_id" required
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['dospem_id']) ? 'border-red-500' : '' ?>">
                                <option value="">-- Select Supervisor --</option>
                                <?php if (!empty($dospemList)): ?>
                                    <?php foreach($dospemList as $dospem): ?>
                                        <option value="<?= $dospem['id'] ?>" <?= (isset($old['dospem_id']) && $old['dospem_id'] == $dospem['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($dospem['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                             <?php if (isset($errors['dospem_id'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['dospem_id']) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description / Abstract <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                      class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 <?= isset($errors['description']) ? 'border-red-500' : '' ?>"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                            <?php if (isset($errors['description'])): ?>
                                <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['description']) ?></p>
                            <?php endif; ?>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const analyzeBtn = document.getElementById('analyzeBtn');
    const loadingState = document.getElementById('loadingState');
    const aiResults = document.getElementById('aiResults');
    const topicTitle = document.getElementById('topicTitle');
    const recommendationsList = document.getElementById('recommendationsList');
    const titleInput = document.getElementById('title');
    const dospemSelect = document.getElementById('dospem_id');

    analyzeBtn.addEventListener('click', function() {
        const title = titleInput.value.trim();

        if (!title) {
            alert('Mohon isi judul riset terlebih dahulu!');
            titleInput.focus();
            return;
        }

        analyzeBtn.disabled = true;
        
        loadingState.classList.remove('hidden');
        aiResults.classList.add('hidden');

        const formData = new FormData();
        formData.append('title', title);

        fetch('<?= BASE_URL ?>/anggota-lab/research/get-recommendation', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            loadingState.classList.add('hidden');
            
            if (result.success && result.data && result.data.length > 0) {
                displayResults(title, result.data);
                aiResults.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                alert(result.error || 'Tidak ada rekomendasi dosen ditemukan.');
            }
            
            analyzeBtn.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            loadingState.classList.add('hidden');
            alert('Terjadi kesalahan saat menganalisis. Silakan coba lagi.');
            analyzeBtn.disabled = false;
        });
    });

    function displayResults(title, lecturers) {
        topicTitle.textContent = title;
        recommendationsList.innerHTML = '';

        lecturers.forEach((lecturer, index) => {
            const scorePercentage = lecturer.percentage.toFixed(0);
            const scoreColor = lecturer.avg_score >= 0.5 ? 'cyan' : lecturer.avg_score >= 0.3 ? 'blue' : 'slate';
            
            const topPubs = lecturer.top_publications.slice(0, 2);
            const pubTitles = topPubs.map(p => `"${p.title}" (${p.year > 0 ? p.year : 'N/A'})`).join(' dan ');
            const explanation = `${lecturer.lecturer_name} direkomendasikan dengan ${lecturer.total_publications} publikasi (kesesuaian rata-rata ${(lecturer.avg_score * 100).toFixed(1)}%), termasuk ${pubTitles}.`;
            
            const recElement = document.createElement('div');
            recElement.className = 'border-l-4 border-' + scoreColor + '-500 bg-gradient-to-r from-slate-700 via-slate-800 to-slate-900 p-5 rounded-r-lg hover:shadow-lg hover:shadow-' + scoreColor + '-500/20 transition-all duration-200 cursor-pointer border border-slate-600';
            recElement.setAttribute('data-lecturer-nidn', lecturer.nidn);
            
            recElement.innerHTML = `
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-${scoreColor}-400 to-${scoreColor}-600 flex items-center justify-center shadow-md">
                                <span class="text-white font-bold text-lg">#${index + 1}</span>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-base">${lecturer.lecturer_name}</h5>
                            <div class="flex items-center space-x-2 mt-1.5">
                                <span class="text-xs px-3 py-1 bg-${scoreColor}-500 text-white rounded-full font-semibold shadow-sm">
                                    Kesesuaian: ${scorePercentage}%
                                </span>
                                <span class="text-xs text-slate-400">${lecturer.total_publications} publikasi</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="text-sm text-slate-300 mb-3 leading-relaxed bg-gradient-to-r from-slate-800 to-slate-900 p-4 rounded-lg border-l-4 border-cyan-500 shadow-sm">${explanation}</p>
                
                <div class="space-y-2.5 bg-slate-900/50 p-3 rounded-lg border border-slate-700">
                    <p class="text-xs font-bold text-slate-300 uppercase tracking-wide flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                        </svg>
                        Publikasi Relevan:
                    </p>
                    ${lecturer.top_publications.map(pub => `
                        <div class="flex items-start space-x-2 text-xs bg-slate-800 p-2.5 rounded-md border border-slate-600 hover:border-cyan-500 transition-colors">
                            <svg class="w-4 h-4 text-cyan-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex-1">
                                <span class="text-white font-semibold">${pub.title}</span>
                                <span class="text-cyan-400 font-medium"> (${pub.year > 0 ? pub.year : 'N/A'})</span>
                                ${pub.publication_venue ? `<br><span class="text-slate-400 italic text-xs">📍 ${pub.publication_venue}</span>` : ''}
                                <br><span class="text-slate-500 text-xs">🔖 Dikutip: ${pub.cited_by_count || 0}x | Match: ${(pub.score * 100).toFixed(1)}%</span>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;

            recommendationsList.appendChild(recElement);
        });

        document.querySelectorAll('[data-lecturer-nidn]').forEach(card => {
            card.addEventListener('click', function() {
                const lecturerNidn = this.getAttribute('data-lecturer-nidn');
                
                const options = Array.from(dospemSelect.options);
                const matchingOption = options.find(opt => {
                    return opt.text.includes(lecturerNidn) || opt.dataset.nidn === lecturerNidn;
                });
                
                if (matchingOption) {
                    dospemSelect.value = matchingOption.value;
                }
                
                document.querySelectorAll('[data-lecturer-nidn]').forEach(c => {
                    c.classList.remove('ring-4', 'ring-cyan-500', 'shadow-2xl', 'scale-105');
                });
                this.classList.add('ring-4', 'ring-cyan-500', 'shadow-2xl', 'scale-105');
                
                dospemSelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
                dospemSelect.focus();
            });
        });

        aiResults.classList.remove('hidden');
    }
});
</script>