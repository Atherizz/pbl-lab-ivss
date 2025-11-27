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
        // 1. Ambil data dari Model
        $allMembers = $this->userProfileModel->getAllMembers();

        // 2. (Opsional) Pisahkan Kepala Lab dan Peneliti biasa
        // Asumsi: Kepala lab punya user_id tertentu atau role khusus, 
        // disini kita filter manual atau ambil user pertama sebagai contoh.
        
        // Contoh sederhana: Kita kirim semua data ke view
        view('home', [
            'members' => $allMembers
        ]);
    }

    public function fasilitas()
    {
        view('fasilitasLab', []);
    }
}