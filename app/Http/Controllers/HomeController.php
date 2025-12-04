<?php

namespace App\Http\Controllers;

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
        // Kita load modelnya dan ambil datanya disini
        $courseModel = $this->model('CourseModel');
        $courses = $courseModel->getAll(); 

        $productModel = $this->model('ProductModel');
        $products = $productModel->getAllProducts();

        // 4. Kirim SEMUA data ke view 'home'
        view('home', [
            'members'      => $allMembers,
            'publications' => $publications,
            'courses'      => $courses,
            'products'     => $products
            
        ]);
    }

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
        
        // Error handling jika profile tidak ditemukan
        if (!$profile) {
            header('Location: ' . BASE_URL); // Atau tampilkan 404
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

    public function products()
    {
        $itemsPerPage = 6;
        $currentPage  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $sortBy       = $_GET['sort'] ?? 'id';
        $sortOrder    = $_GET['order'] ?? 'DESC';
        $searchQuery  = $_GET['q'] ?? null; 

        $totalItems = $this->productModel->countAll($searchQuery);
        $totalPages = max(1, ceil($totalItems / $itemsPerPage));
        $currentPage = min($currentPage, $totalPages);

        $offset = ($currentPage - 1) * $itemsPerPage;

        $products = $this->productModel->getAllPaginated(
            $itemsPerPage,
            $offset,
            $sortBy,
            $sortOrder,
            $searchQuery
        );

        $startItem = $totalItems > 0 ? $offset + 1 : 0;
        $endItem   = min($offset + $itemsPerPage, $totalItems);

        view('products', [
            'products'    => $products,
            'totalProducts' => $totalItems,
            'currentPage' => $currentPage,
            'totalPages'  => $totalPages,
            'startItem'   => $startItem,
            'endItem'     => $endItem,
            'sortBy'      => $sortBy,
            'sortOrder'   => $sortOrder,
            'searchQuery' => $searchQuery,
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