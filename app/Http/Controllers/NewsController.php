<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    private $model;
    private $uploadDir;
    private $itemsPerPage = 5;
    public $error = '';

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('NewsModel');
        $this->uploadDir = __DIR__ . '/../../../public/uploads/news/';
        
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function uploadImage($fileInputName = 'image_file')
    {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] === UPLOAD_ERR_NO_FILE) {
            $this->error = "No file selected!";
            return false;
        }

        $file = $_FILES[$fileInputName];
        $target_dir = $this->uploadDir;
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            $this->error = "File is not an image!";
            return false;
        }

        // Cek ukuran file (max 5MB)
        if ($file["size"] > 5 * 1024 * 1024) {
            $this->error = "Sorry, your file is too large! Maximum 5MB.";
            return false;
        }

        // Cek format file yang diizinkan
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedTypes)) {
            $this->error = "Only JPG, JPEG, PNG, and GIF are allowed!";
            return false;
        }

        // Cek apakah direktori ada dan writable
        if (!is_dir($target_dir) || !is_writable($target_dir)) {
            $this->error = "Upload directory is not writable or does not exist: " . $target_dir;
            return false;
        }

        // Generate unique filename untuk menghindari duplikat
        $uniqueName = time() . '_' . uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueName;

        // Upload file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $uniqueName;
        } else {
            $this->error = "There was an error while uploading!";
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (empty($fileName)) {
            return true;
        }

        $filePath = $this->uploadDir . basename($fileName);
        
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        
        return true;
    }

    public function index()
    {
        // Ambil halaman dari query string
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;

        // Ambil semua news
        $allNews = $this->model->getAllNews();
        $totalItems = count($allNews);
        
        // Hitung total halaman
        $totalPages = ceil($totalItems / $this->itemsPerPage);
        
        // Pastikan halaman valid
        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
        }

        // Hitung offset
        $offset = ($page - 1) * $this->itemsPerPage;
        
        // Ambil news untuk halaman saat ini
        $news = array_slice($allNews, $offset, $this->itemsPerPage);

        // Data untuk view
        $paginationData = [
            'news'         => $news,
            'currentPage'  => $page,
            'totalPages'   => $totalPages,
            'totalItems'   => $totalItems,
            'itemsPerPage' => $this->itemsPerPage,
            'startItem'    => $totalItems > 0 ? $offset + 1 : 0,
            'endItem'      => min($offset + $this->itemsPerPage, $totalItems)
        ];

        view('admin_news.news.index', $paginationData);
    }

    public function create()
    {
        view('admin_news.news.create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $authorId = $_SESSION['user']['id'] ?? null;
            
            $errors = [];

            // Validasi text
            if ($title === '') {
                $errors[] = 'Title is required.';
            }
            if ($content === '') {
                $errors[] = 'Content is required.';
            }
            if (empty($authorId)) {
                $errors[] = 'Author ID is missing.';
            }

            // Upload image
            $imageFileName = null;
            if (!empty($_FILES['image_file']['name'])) {
                $imageFileName = $this->uploadImage('image_file');
                if (!$imageFileName) {
                    $errors[] = $this->error;
                }
            } else {
                $errors[] = 'Image file is required.';
            }

            // Jika ada error
            if (!empty($errors)) {
                view('admin_news.news.create', ['errors' => $errors, 'old_data' => $_POST]);
                return;
            }

            // Siapkan data
            $data = [
                'title'        => $title,
                'content'      => $content,
                'image_url'    => 'uploads/news/' . $imageFileName,
                'author_id'    => $authorId,
                'published_at' => date('Y-m-d H:i:s') 
            ];

            $this->model->createNews($data);
            $_SESSION['success'] = 'News created successfully!';
            $this->redirect('/admin-berita/news');
        }
    }

    public function edit($id)
    {
        $news = $this->model->getById($id);
        view('admin_news.news.edit', ['news' => $news]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (empty($_POST['title']) || empty($_POST['content'])) {
                $errors = ['Title and Content are required.'];
                $news = $this->model->getById($id);
                view('admin_news.news.edit', ['errors' => $errors, 'news' => $news]);
                return;
            }

            $news = $this->model->getById($id);
            $imageUrl = $news['image_url']; // Default pakai gambar lama

            // Cek apakah ada upload file baru
            if (!empty($_FILES['image_file']['name'])) {
                $newImageFileName = $this->uploadImage('image_file');
                
                if (!$newImageFileName) {
                    $errors = [$this->error];
                    view('admin_news.news.edit', ['errors' => $errors, 'news' => $news]);
                    return;
                }

                // Hapus gambar lama
                if (!empty($news['image_url'])) {
                    $oldFileName = basename($news['image_url']);
                    $this->deleteImage($oldFileName);
                }

                $imageUrl = 'uploads/news/' . $newImageFileName;
            }

            $data = [
                'title'        => trim($_POST['title']),
                'content'      => trim($_POST['content']),
                'image_url'    => $imageUrl,
                'published_at' => $_POST['published_at'] ?? date('Y-m-d H:i:s')
            ];
            
            $this->model->updateNews($id, $data);
            $_SESSION['success'] = 'News updated successfully!';
            $this->redirect('/admin-berita/news');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $news = $this->model->getById($id);

            if (!$news) {
                $_SESSION['error'] = 'News not found.';
                $this->redirect('/admin-berita/news');
                return;
            }

            // Hapus image file
            if (!empty($news['image_url'])) {
                $fileName = basename($news['image_url']);
                $this->deleteImage($fileName);
            }

            // Hapus dari database
            if ($this->model->deleteNews($id)) {
                $_SESSION['success'] = 'News deleted successfully!';
            } else {
                $_SESSION['error'] = 'Failed to delete news.';
            }

            $this->redirect('/admin-berita/news');
        }
    }
}