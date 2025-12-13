<?php

namespace App\Http\Controllers;

use App\Models\GaleryModel;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private $userProfileModel;

    public function __construct()
    {
        parent::__construct();
        // Memuat Model Utama
        $this->userProfileModel = $this->model('LabUserProfileModel');
    }

    public function index()
    {
        // 1. Ambil Data Anggota (Existing)
        $allMembers = $this->userProfileModel->getAllMembers();

        // 2. Ambil Data Publikasi (Existing)
        $publicationModel = $this->model('PublicationModel');
        $publications = $publicationModel->getAllPaginated(
            3,
            0,
            'citations',
            null,
            null
        );

        // 3. Ambil Data COURSE / PELATIHAN (Baru)
        $courseModel = $this->model('CourseModel');
        $courses = $courseModel->getAll();

        // 4. Ambil Data GALERI (Perbaikan)
        $galeryModel = $this->model('GaleryModel');
        // Pastikan nama method di model Anda benar (misal: getAllGalery atau getAll)
        $galeryItems = $galeryModel->getAllGalery(); 

        // 5. Kirim SEMUA data ke view 'home'
        view('home', [
            'members'      => $allMembers,
            'publications' => $publications,
            'courses'      => $courses,
            'galeryItems'  => $galeryItems // <--- INI YANG SEBELUMNYA KURANG
        ]);
    }

    // ... (Fungsi publications, profile, news, dll biarkan tetap sama) ...
    public function publications() 
    {
        $itemsPerPage = 6;
        $currentPage  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $sortBy       = $_GET['sort'] ?? 'citations';
        $searchQuery  = $_GET['q'] ?? null; 

        $publicationModel = $this->model('PublicationModel');

        $totalItems  = $publicationModel->countAll($searchQuery);
        $totalPages  = max(1, ceil($totalItems / $itemsPerPage));
        $currentPage = min($currentPage, $totalPages);

        $offset = ($currentPage - 1) * $itemsPerPage;

        $publications = $publicationModel->getAllPaginated(
            $itemsPerPage,
            $offset,
            $sortBy,
            null,
            $searchQuery
        );

        $startItem = $totalItems > 0 ? $offset + 1 : 0;
        $endItem   = min($offset + $itemsPerPage, $totalItems);

        view('publications', [
            'publications'      => $publications,
            'totalPublications' => $totalItems,
            'currentPage'       => $currentPage,
            'totalPages'        => $totalPages,
            'startItem'         => $startItem,
            'endItem'           => $endItem,
            'sortBy'            => $sortBy,
            'searchQuery'       => $searchQuery,
        ]);
    }

    public function profile($slug)
    {
        $profile = $this->userProfileModel->getProfileBySlug($slug);
        
        if (!$profile) {
            header('Location: ' . BASE_URL); 
            exit;
        }

        $user = $this->model('UserModel')->getById($profile['user_id']);

        $itemsPerPage = 6;
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $sortBy = $_GET['sort'] ?? 'citations';

        $publicationModel = $this->model('PublicationModel');
        $totalItems = $publicationModel->countByUserId($profile['user_id']);
        $totalPages = max(1, ceil($totalItems / $itemsPerPage));
        $currentPage = min($currentPage, $totalPages);
        
        $offset = ($currentPage - 1) * $itemsPerPage;

        $publications = $publicationModel->getAllPaginated(
            $itemsPerPage,
            $offset,
            $sortBy,
            $profile['user_id'],
            null
        );
        
        $startItem = $totalItems > 0 ? $offset + 1 : 0;
        $endItem = min($offset + $itemsPerPage, $totalItems);

        view('profile', [
            'profile' => $profile,
            'user' => $user,
            'publications' => $publications,
            'totalPublications' => $totalItems,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'startItem' => $startItem,
            'endItem' => $endItem,
            'sortBy' => $sortBy
        ]);
    }

    public function news()
    {
        $news = $this->model('NewsModel')->getAllNews();
        view('news', [
            'newsList' => $news
        ]);
    }

    public function newsDetail($slug)
    {
        $newsModel = $this->model('NewsModel');
        $news = $newsModel->getBySlug($slug);

        if (!$news) {
            header('Location: ' . BASE_URL . '/berita');
            exit;
        }

        $recentNews = $newsModel->getRecentNews(3, $news['id']);

        view('news-detail', [
            'news' => $news,
            'recentNews' => $recentNews
        ]);
    }

    public function fasilitas()
    {
        $peralatan = $this->model('EquipmentModel')->getAllEquipments();
        view('fasilitas', [
            'equipments' => $peralatan
        ]);
    }
}