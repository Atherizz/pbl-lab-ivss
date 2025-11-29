<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DatasetModel;

class DatasetController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('DatasetModel');
    }

    public function direktori()
    {
        $searchQuery = $_GET['search'] ?? null;
        $datasets = $this->model->getAll($searchQuery);
        
        view('dataset.direktori', [
            'datasets' => $datasets,
            'currentSearch' => $searchQuery
        ]);
    }

    public function index()
    {
        $searchQuery = $_GET['search'] ?? null;
        $datasets = $this->model->getAll($searchQuery);
        
        view('admin_lab.dataset.index', [
            'datasets' => $datasets,
            'currentSearch' => $searchQuery
        ]);
    }

    public function create()
    {
        view('admin_lab.dataset.create', [
            'old' => [],
            'errors' => []
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/anggota-lab/dataset');
            return;
        }

        $data = $_POST;
        $errors = $this->validateDataset($data);

        if (!empty($errors)) {
            view('admin_lab.dataset.create', [
                'old' => $data,
                'errors' => $errors
            ]);
            return;
        }

        // 1. Ambil input array
        $urlsInput = $data['dataset_urls'] ?? [];
        
        // 2. Hapus input yang kosong/null
        $cleanUrls = array_filter($urlsInput, function($url) {
            return !empty(trim($url));
        });
        
        // 3. Re-index array (supaya urut 0, 1, 2, ...)
        $cleanUrls = array_values($cleanUrls);

        $datasetData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'urls' => json_encode($cleanUrls), // Simpan sebagai JSON
            'tags' => $this->model->formatTags($data['tags'] ?? '')
        ];

        $this->model->create($datasetData);
        $this->redirect('/anggota-lab/dataset');
    }
    
    public function edit($id)
    {
        $dataset = $this->model->getById($id);
        if (!$dataset) {
            $this->redirect('/anggota-lab/dataset');
            return;
        }

        // Decode JSON ke Array untuk ditampilkan di form
        $urls = json_decode($dataset['urls'] ?? '[]', true);
        
        // Pastikan minimal ada satu elemen kosong jika data kosong
        if (!is_array($urls) || empty($urls)) {
            $urls = [''];
        }
        $dataset['dataset_urls'] = $urls;
        
        // Format tags untuk tampilan
        $tags = $dataset['tags'] ?? '{}';
        $tags = str_replace(['{', '}'], '', $tags); 
        $dataset['tags'] = $tags; 

        view('admin_lab.dataset.edit', [
            'dataset' => $dataset,
            'old' => [],
            'errors' => []
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/anggota-lab/dataset');
            return;
        }

        $data = $_POST;
        $errors = $this->validateDataset($data);

        if (!empty($errors)) {
            $dataset = $this->model->getById($id); 
            $dataset['id'] = $id;
            
            // Kembalikan input user agar tidak hilang
            $dataset['dataset_urls'] = $data['dataset_urls'] ?? [''];
            // Pastikan tags juga kembali
            $dataset['tags'] = $data['tags'] ?? '';

            view('admin_lab.dataset.edit', [
                'dataset' => $dataset,
                'old' => $data, 
                'errors' => $errors
            ]);
            return;
        }
        
        $urlsInput = $data['dataset_urls'] ?? [];
        $cleanUrls = array_filter($urlsInput, function($url) {
            return !empty(trim($url));
        });
        $cleanUrls = array_values($cleanUrls);
        
        $datasetData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'urls' => json_encode($cleanUrls),
            'tags' => $this->model->formatTags($data['tags'] ?? '')
        ];

        $this->model->update($id, $datasetData);
        $this->redirect('/anggota-lab/dataset');
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/anggota-lab/dataset');
            return;
        }

        $this->model->delete($id);
        $this->redirect('/anggota-lab/dataset');
    }

    private function validateDataset($data)
    {
        $errors = [];
        if (empty(trim($data['title'] ?? ''))) {
            $errors['title'] = 'Dataset Title is required.';
        }
        
        // Validasi Array URLs
        $urls = $data['dataset_urls'] ?? [];
        $hasValidUrl = false;
        
        foreach ($urls as $index => $url) {
            if (!empty(trim($url))) {
                if (!filter_var($url, FILTER_VALIDATE_URL)) {
                    // Pesan error spesifik baris ke berapa
                    $errors['dataset_urls'] = "URL pada baris ke-" . ($index + 1) . " tidak valid.";
                } else {
                    $hasValidUrl = true;
                }
            }
        }

        // Jika tidak ada satupun URL valid yang diisi
        if (!$hasValidUrl && !isset($errors['dataset_urls'])) {
            $errors['dataset_urls'] = 'Minimal satu Dataset URL harus diisi.';
        }
        
        return $errors;
    }
}