<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LabUserProfileModel; 

class ProfileController extends Controller
{
    private $userProfileModel;
    private $userId; 

    public function __construct()
    {
        parent::__construct(); 
        $this->userProfileModel = $this->model('LabUserProfileModel'); 
        $this->userId = $_SESSION['user']['id'] ?? 0;
    }
    
    public function index() 
    {
        if (!$this->userId) {
            set_flash('error', 'Silakan login.');
            $this->redirect('/login');
            return;
        }

        $profile = $this->userProfileModel->getProfileByUserId($this->userId); 

        $data = [
            'profile'    => $profile,
            'mode'       => $profile ? 'edit' : 'create', 
            'pageTitle'  => 'Profil Anggota Lab',
            'activeMenu' => 'profile-user-lab',
            'fullName'   => $_SESSION['user']['name'] ?? 'Pengguna Lab',
            'BASE_URL'   => BASE_URL ?? '/', 
            'userId'     => $this->userId 
        ];
        
        view('anggota_lab.profile.index', $data); 
    }

    public function edit()
    {
        if (!$this->userId) {
            set_flash('error', 'Silakan login.');
            $this->redirect('/login');
            return;
        }

        $profile = $this->userProfileModel->getProfileByUserId($this->userId); 
        $isUpdate = $profile !== null;

        $data = [
            'profile'    => $profile,
            'mode'       => $isUpdate ? 'edit' : 'create', 
            'pageTitle'  => $isUpdate ? 'Edit Profil Anggota Lab' : 'Buat Profil Anggota Lab Baru',
            'activeMenu' => 'profile-user-lab',
            'fullName'   => $_SESSION['user']['name'] ?? 'Pengguna Lab',
            'BASE_URL'   => BASE_URL ?? '/', 
            'userId'     => $this->userId 
        ];
        
        view('anggota_lab.profile.edit', $data); 
    }

    public function store() 
    {
        if (!$this->userId || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            set_flash('error', 'Akses tidak valid.');
            $this->redirect('/anggota-lab/profile');
            return;
        }
        
        $existingProfile = $this->userProfileModel->getProfileByUserId($this->userId);
        $isUpdate = $existingProfile !== null;
        
    
        $postData = $this->sanitizeProfileData($_POST);

        if (empty($postData['email']) || empty($postData['major'])) {
             set_flash('error', 'Email dan Program Studi wajib diisi.');
             $this->redirect('/anggota-lab/profile');
             return;
        }

        $success = false;
        if ($isUpdate) {
            $success = $this->userProfileModel->updateProfile($postData, $this->userId);
            $message = 'Profil berhasil diperbarui!';
            $error_message = 'Gagal memperbarui profil.';
        } else {
            $success = $this->userProfileModel->createProfile($postData, $this->userId);
            $message = 'Profil berhasil dibuat!';
            $error_message = 'Gagal membuat profil baru.';
        }

        if ($success) {
            set_flash('success', $message);
        } else {
            set_flash('error', $error_message);
        }
        $this->redirect('/anggota-lab/profile');
    }
    
    // --- FUNGSIONALITAS SANITASI ---
    private function sanitizeProfileData(array $data): array
    {
        return $data; 
    }
    
    private function sanitizeArrayOfObjects(array $items): array
    {
        return $items; 
    }
}