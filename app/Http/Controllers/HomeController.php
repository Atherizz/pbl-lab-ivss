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
        

        view('publications', [
        ]);
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
        view('news', []);
    }

    public function fasilitas()
    {
        view('fasilitas', []);
    }
}