<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private $userProfileModel; // Ubah nama properti agar lebih jelas

    public function __construct()
    {
        parent::__construct();
        // Memuat Model
        $this->userProfileModel = $this->model('LabUserProfileModel');
    }

    public function index()
    {
        $allMembers = $this->userProfileModel->getAllMembers();


        view('home', [
            'members' => $allMembers
        ]);
    }

    public function publication()
    {


        view('publications', []);
    }

    public function profile($slug)
    {
        $profile = $this->userProfileModel->getProfileBySlug($slug);
        $user = $this->model('UserModel')->getById($profile['user_id']);
        $research = $this->model('ResearchModel')->getResearchByUserId($profile['user_id']);

        view('profile', [
            'profile' => $profile,
            'user' => $user,
            'research' => $research
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
