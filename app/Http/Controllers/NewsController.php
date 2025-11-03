<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('NewsModel');
    }

    public function index()
    {
        $news = $this->model->getAllNews();
        view('admin_news.news.index', ['news' => $news]);
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
            $authorId = $_SESSION['user']['id'];
            
            $errors = [];

            if ($title === '') {
                $errors[] = 'Title is required.';
            }
            if ($content === '') {
                $errors[] = 'Content is required.';
            }
            if (empty($authorId)) {
                $errors[] = 'Author ID is missing. (Harus diambil dari sesi pengguna).';
            }

            if (!empty($errors)) {
                view('admin_news.news.create', ['errors' => $errors, 'old_data' => $_POST]);
                return;
            }
            $data = [
                'title'        => $title,
                'content'      => $content,
                'image_url'    => trim($_POST['image_url'] ?? ''), 
                'author_id'    => $authorId,
                'published_at' => date('Y-m-d H:i:s') 
            ];

            $this->model->createNews($data);
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

            $data = [
                'title'        => trim($_POST['title']),
                'content'      => trim($_POST['content']),
                'image_url'    => trim($_POST['image_url'] ?? ''),
                'published_at' => $_POST['published_at'] ?? date('Y-m-d H:i:s')
            ];
            
            $this->model->updateNews($id, $data);
            $this->redirect('/admin-berita/news');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $this->model->deleteNews($id);
            $this->redirect('/admin-berita/news');
        }
    }
}
