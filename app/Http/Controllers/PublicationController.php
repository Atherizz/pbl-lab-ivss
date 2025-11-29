<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PublicationController extends Controller
{
    private $userId;
    private $userProfileModel;
    private $model;


    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('PublicationModel');
        $this->userProfileModel = $this->model('LabUserProfileModel');
        $this->userId = $_SESSION['user']['id'] ?? 0;
    }

    public function index()
    {
        $scholarUrl = $this->userProfileModel->getScholarUrlByUserId($this->userId) ?? null;

        view(
            'anggota_lab.publications.index',
            ['scholarUrl' => $scholarUrl]
        );
    }

public function setup()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect('/anggota-lab/publikasi');
        return;
    }

    try {
        $currentProfile = $this->userProfileModel->getProfileByUserId($this->userId);
        
        $currentSocialLinks = $currentProfile['social_links'] ?? [];
        
        if (is_string($currentSocialLinks)) {
            $currentSocialLinks = json_decode($currentSocialLinks, true) ?: [];
        }
        

        $newSocialLinks = array_merge(
            $currentSocialLinks,
            $_POST['social_links'] ?? []
        );

        $updateResult = $this->userProfileModel->updateProfile([
            'social_links' => $newSocialLinks
        ], $this->userId);

        if ($updateResult) {
            $_SESSION['success'] = "URL Google Scholar berhasil disimpan!";
        } else {
            $_SESSION['error'] = "Gagal menyimpan URL Google Scholar.";
        }

    } catch (\Exception $e) {
        error_log("Error in setup: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
    }

    $this->redirect('/anggota-lab/publikasi');
}


    // public function store()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    //         $name = trim($_POST['name'] ?? '');
    //         $status = trim($_POST['status'] ?? '');

    //         $errors = [];

    //         if ($name === '') {
    //             $errors[] = 'Nama wajib diisi.';
    //         }

    //         $validStatuses = ['available', 'in_use', 'maintenance', 'broken'];
    //         if (!in_array($status, $validStatuses)) {
    //             $errors[] = 'Status yang dipilih tidak valid.';
    //         }

    //         if (!empty($errors)) {
    //             view('admin_lab.equipments.create', ['errors' => $errors]);
    //             return;
    //         }

    //         $this->model->createEquipment($_POST);

    //         set_flash('success', 'Peralatan berhasil dibuat!');

    //         $this->redirect('/admin-lab/equipment');
    //     }
    // }

}
