<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;

class ProfileController extends Controller
{
    private $userProfileModel;
    private $userId;
    private $uploadDir;

    public $uploadService;

    public function __construct()
    {
        parent::__construct();
        $this->userProfileModel = $this->model('LabUserProfileModel');
        $this->userId = $_SESSION['user']['id'] ?? 0;
        $this->uploadDir = __DIR__ . '/../../../public/uploads/profiles/';
        $this->uploadService = new UploadService();

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
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
            'nidn'        => $_SESSION['user']['reg_number'],
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

        if (!empty($postData['educations'])) {
            foreach ($postData['educations'] as $education) {
                $startYear = (int)($education['start_year'] ?? 0);
                $endYear = (int)($education['end_year'] ?? 0);

                if ($startYear && $endYear && $startYear >= $endYear) {
                    set_flash('error', 'Tahun selesai pendidikan harus lebih besar dari tahun mulai.');
                    $this->redirect('/anggota-lab/profile/edit');
                    return;
                }
            }
        }

        // Photo URL tidak lagi diupload di sini - sudah dipindah ke halaman terpisah
        // Preserve existing photo if updating
        if ($isUpdate && !empty($existingProfile['photo_url'])) {
            $postData['photo_url'] = $existingProfile['photo_url'];
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

    // --- PHOTO MANAGEMENT ---

    public function photoManager()
    {
        if (!$this->userId) {
            set_flash('error', 'Silakan login.');
            $this->redirect('/login');
            return;
        }

        $profile = $this->userProfileModel->getProfileByUserId($this->userId);

        $data = [
            'profile'    => $profile,
            'pageTitle'  => 'Kelola Foto Profil',
            'activeMenu' => 'profile-user-lab',
            'fullName'   => $_SESSION['user']['name'] ?? 'Pengguna Lab',
            'BASE_URL'   => BASE_URL ?? '/',
            'userId'     => $this->userId
        ];

        view('anggota_lab.profile.photo', $data);
    }

    public function uploadPhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            set_flash('error', 'Invalid request method.');
            $this->redirect('/anggota-lab/profile/photo');
            return;
        }

        if (empty($_FILES['photo']['name'])) {
            set_flash('error', 'Silakan pilih foto untuk diupload.');
            $this->redirect('/anggota-lab/profile/photo');
            return;
        }

        $newImageFileName = $this->uploadService->uploadImage($this->uploadDir, 'photo');

        if (!$newImageFileName) {
            set_flash('error', 'Upload gagal: ' . $this->uploadService->error);
            $this->redirect('/anggota-lab/profile/photo');
            return;
        }

        $imageUrl = '/uploads/profiles/' . $newImageFileName;

        $profile = $this->userProfileModel->getProfileByUserId($this->userId);

        $oldPhotoUrl = $profile['photo_url'] ?? '';

        if (!empty($oldPhotoUrl)) {
            $oldFileName = basename($oldPhotoUrl);

            if ($oldFileName !== $newImageFileName) {
                $this->uploadService->deleteImage('profiles', $oldFileName);
            }
        }

        if ($profile) {
            $this->userProfileModel->updateProfile(['photo_url' => $imageUrl], $this->userId);
        } else {
            $this->userProfileModel->createProfile(['photo_url' => $imageUrl], $this->userId);
        }

        set_flash('success', 'Foto profil berhasil diperbarui.');
        $this->redirect('/anggota-lab/profile/photo');
    }

    public function deletePhoto()
    {
        if (!$this->userId) {
            set_flash('error', 'Silakan login.');
            $this->redirect('/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            set_flash('error', 'Invalid request method.');
            $this->redirect('/anggota-lab/profile/photo');
            return;
        }

        $profile = $this->userProfileModel->getProfileByUserId($this->userId);

        if (!$profile || empty($profile['photo_url'])) {
            set_flash('error', 'Tidak ada foto untuk dihapus.');
            $this->redirect('/anggota-lab/profile/photo');
            return;
        }

        $fileName = basename($profile['photo_url']);

        // Hapus file foto
        if ($profile && !empty($profile['photo_url'])) {
            $this->uploadService->deleteImage($this->uploadDir, $fileName);
        }

        // Set photo_url ke NULL di database
        $this->userProfileModel->updateProfile(['photo_url' => null], $this->userId);

        set_flash('success', 'Foto profil berhasil dihapus.');
        $this->redirect('/anggota-lab/profile/photo');
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
