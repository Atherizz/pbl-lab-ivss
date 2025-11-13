<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;

class NewsController extends Controller
{
    private $model;
    private $uploadDir;
    private $itemsPerPage = 5;
    public $uploadService;
    public $error = '';

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('NewsModel');
        $this->uploadDir = __DIR__ . '/../../../public/uploads/news/';
        $this->uploadService = new UploadService();
        
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
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
                $imageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                if (!$imageFileName) {
                    $errors[] = $this->uploadService->error;
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
                $newImageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                
                if (!$newImageFileName) {
                    $errors = [$this->uploadService->error];
                    view('admin_news.news.edit', ['errors' => $errors, 'news' => $news]);
                    return;
                }

                // Hapus gambar lama
                if (!empty($news['image_url'])) {
                    $oldFileName = basename($news['image_url']);
                    $this->uploadService->deleteImage($this->uploadDir, $oldFileName);
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
                $this->uploadService->deleteImage($this->uploadDir, $fileName);
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