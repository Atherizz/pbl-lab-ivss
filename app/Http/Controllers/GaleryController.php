<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\SlugService;
use App\Http\Services\UploadService;

class GaleryController extends Controller
{
    private $model;
    private $uploadDir;
    private $itemsPerPage = 10; 
    public $uploadService;
    public $slugService;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('GaleryModel'); 
        // Pastikan path ini mengarah ke folder public/uploads/galery yang benar
        $this->uploadDir = __DIR__ . '/../../../public/uploads/galery/'; 
        $this->uploadService = new UploadService();
        $this->slugService = new SlugService('GaleryModel');
        
        // Buat folder jika belum ada
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $allGalery = $this->model->getAllGalery(); 
        
        // Pagination
        $paginationData = pagination($this->itemsPerPage, $currentPage, $allGalery, 'galery'); 
        
        // Mapping data agar view bisa membacanya dengan variabel '$items' atau '$galery'
        $data = $paginationData;
        $data['items'] = $paginationData['galery'];

        view('admin_lab.galery.index', $data); 
    }

    public function create()
    {
        view('admin_lab.galery.create'); 
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $caption = trim($_POST['caption'] ?? ''); 
            $authorId = $_SESSION['user']['id'] ?? null;
            
            $errors = [];

            if ($caption === '') {
                $errors[] = 'Caption wajib diisi.';
            }
            
            $imageFileName = null;
            if (!empty($_FILES['image_file']['name'])) {
                $imageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                if (!$imageFileName) {
                    $errors[] = $this->uploadService->error;
                }
            } else {
                $errors[] = 'File gambar wajib diupload.';
            }

            if (!empty($errors)) {
                view('admin_lab.galery.create', ['errors' => $errors, 'old_data' => $_POST]); 
                return;
            }

            $slug = $this->slugService->generateUniqueSlug($caption); 

            $data = [
                'caption'      => $caption, 
                'image_url'    => 'uploads/galery/' . $imageFileName, 
                'author_id'    => $authorId,
                'created_at'   => date('Y-m-d H:i:s'),
                'slug'         => $slug
            ];

            $this->model->createGalery($data); 
            $_SESSION['success'] = 'Dokumentasi berhasil ditambahkan!';
            $this->redirect('/admin-lab/galery'); 
        }
    }

    public function edit($id)
    {
        $galery = $this->model->getById($id); 
        
        if (!$galery) {
            $_SESSION['error'] = 'Data galeri tidak ditemukan.';
            $this->redirect('/admin-lab/galery');
            return;
        }

        view('admin_lab.galery.edit', ['galery' => $galery]); 
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $galery = $this->model->getById($id);
            if (!$galery) {
                $_SESSION['error'] = 'Data tidak ditemukan.';
                $this->redirect('/admin-lab/galery');
                return;
            }

            if (empty($_POST['caption'])) { 
                view('admin_lab.galery.edit', ['errors' => ['Caption wajib diisi.'], 'galery' => $galery]); 
                return;
            }

            $imageUrl = $galery['image_url']; // Default: pakai gambar lama

            // Cek jika user upload gambar baru
            if (!empty($_FILES['image_file']['name'])) {
                $newImageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                
                if (!$newImageFileName) {
                    view('admin_lab.galery.edit', ['errors' => [$this->uploadService->error], 'galery' => $galery]); 
                    return;
                }

                // Hapus file gambar lama fisik
                if (!empty($galery['image_url'])) {
                    $oldFileName = basename($galery['image_url']);
                    if (file_exists($this->uploadDir . $oldFileName)) {
                        unlink($this->uploadDir . $oldFileName);
                    }
                }

                $imageUrl = 'uploads/galery/' . $newImageFileName; 
            }

            $slug = $this->slugService->generateUniqueSlug($_POST['caption'], $id); 

            $data = [
                'caption'      => trim($_POST['caption']), 
                'image_url'    => $imageUrl,
                'updated_at'   => date('Y-m-d H:i:s'),
                'slug'         => $slug
            ];
            
            if ($this->model->updateGalery($id, $data)) {
                $_SESSION['success'] = 'Dokumentasi berhasil diperbarui!';
            } else {
                $_SESSION['error'] = 'Gagal memperbarui database.';
            }

            $this->redirect('/admin-lab/galery'); 
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $galery = $this->model->getById($id); 

            if (!$galery) {
                $_SESSION['error'] = 'Data tidak ditemukan.';
                $this->redirect('/admin-lab/galery'); 
                return;
            }

            // Hapus File Fisik
            if (!empty($galery['image_url'])) {
                $fileName = basename($galery['image_url']);
                $filePath = $this->uploadDir . $fileName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus Data Database
            if ($this->model->deleteGalery($id)) { 
                $_SESSION['success'] = 'Dokumentasi berhasil dihapus!';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }

            $this->redirect('/admin-lab/galery'); 
        }
    }
}