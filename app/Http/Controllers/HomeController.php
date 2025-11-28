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

    public function profile($id)
    {

        $profile = $this->userProfileModel->getProfileByUserId($id);
        $user = $this->model('UserModel')->getById($id);
        $research = $this->model('ResearchModel')->getResearchByUserId($id);

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

    public function newsDetail($id)
    {
        $newsModel = $this->model('NewsModel');


        $news = $newsModel->getById($id);

        if (!$news) {
            header('Location: ' . BASE_URL . '/news');
            exit;
        }

        $recentNews = $newsModel->getRecentNews(3, $id);

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
