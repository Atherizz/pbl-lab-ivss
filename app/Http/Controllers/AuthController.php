<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\SiakadService;
use Exception;

class AuthController extends Controller
{
    private $userModel;
    private $registrationRequestModel;
    private $siakadService;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('UserModel');
        $this->registrationRequestModel = $this->model('RegistrationRequestModel');
        $this->siakadService = new SiakadService();
    }

    public function showRegistrationForm()
    {
        $dospem = $this->userModel->getAllAnggotaLab();

        view('register', [
            'dospem' => $dospem
        ]);
    }

    public function showLoginForm()
    {
        $this->authMiddleware->redirectIfLoggedIn();
        view('login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Validasi input
            $nim = trim($_POST['nim'] ?? '');
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $password_confirmation = trim($_POST['password_confirmation'] ?? '');
            $dospem_id = trim($_POST['dospem_id'] ?? '');
            $registration_purpose = trim($_POST['registration_purpose'] ?? '');

            // Validasi sederhana
            if (empty($nim) || empty($name) || empty($email) || empty($dospem_id) || empty($registration_purpose)) {
                $_SESSION['error'] = 'Semua field harus diisi';
                $this->redirect('/register');
                exit;
            }

            // Validasi format email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Format email tidak valid';
                $this->redirect('/register');
                exit;
            }

            // Validasi panjang registration_purpose
            if (strlen($registration_purpose) < 50) {
                $_SESSION['error'] = 'Tujuan pendaftaran minimal 50 karakter';
                $this->redirect('/register');
                exit;
            }

            try {
                $existingNim = $this->userModel->getByRegNumber($nim);

                if ($existingNim) {
                    $_SESSION['error'] = 'NIM sudah terdaftar';
                    $this->redirect('/register');
                    exit;
                }

                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $dospem = $this->userModel->getById($dospem_id);

                $status = ($dospem['role'] == 'admin_lab') ? 'approved_by_dospem' : 'pending_approval';

                $data = [
                    'nim' => $nim,
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword,
                    'dospem_id' => $dospem_id,
                    'registration_purpose' => $registration_purpose,
                    'status' => $status
                ];

                $this->registrationRequestModel->createRequest($data);

                $_SESSION['success'] = 'Pendaftaran berhasil! Silakan tunggu persetujuan dari Dosen Pembimbing.';
                $this->redirect('/login');
            } catch (Exception $e) {
                $_SESSION['error'] = 'Terjadi kesalahan saat pendaftaran: ' . $e->getMessage();
                $this->redirect('/register');
                exit;
            }
        }
    }

    public function login()
    {
        if (isset($_POST['submit'])) {
            $regNumber = $_POST['reg_number'];
            $password = $_POST['password'];
            $isLoggedIn = false;
            $isSiakadLogged = false;
            $user = $this->userModel->getByRegNumber($regNumber);


            if ($user) {
                if ($user['password'] == null) {
                    $isLoggedIn = $this->siakadService->login($regNumber, $password);
                    if ($isLoggedIn) {
                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                        $this->userModel->updateRegisteredUserPassword($hashedPassword, $user['id']);
                    }
                } else {
                    $isLoggedIn = password_verify($password, $user['password']);
                }
            } else {
                $isSiakadLogged = $this->siakadService->login($regNumber, $password);
                if ($isSiakadLogged){
                $_SESSION['error'] = 'Anda belum terdaftar sebagai anggota lab!';
                $this->redirect('/login');
                exit;
            }
            }

            if ($isLoggedIn) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'reg_number' => $user['reg_number']
                ];
                if ($_SESSION['user']['role'] == 'admin_lab') {
                    $this->redirect('/admin-lab/dashboard');
                    exit;
                } else if ($_SESSION['user']['role'] == 'admin_berita') {
                    $this->redirect('/admin-berita/dashboard');
                    exit;
                } else {
                    $this->redirect('/anggota-lab/dashboard');
                    exit;
                }
            } else {
                $_SESSION['error'] = 'NIM/NIP atau password salah';
                $this->redirect('/login');
                exit;
            }
        }
    }

    public function showUpdateProfileForm()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->getById($userId);
        $regNumber = $user['reg_number'] ?? '';
        
        $isMahasiswa = is_numeric($regNumber) && strlen($regNumber) >= 8;

        view('update_profile', [
            'current_name' => $user['name'] ?? '',
            'is_mahasiswa' => $isMahasiswa
        ]);
    }
    
    public function updateProfile()
    {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
        $this->redirect('/update-profile'); 
        exit;
    }
    
    $userId = $_SESSION['user']['id'];
    $user = $this->userModel->getById($userId);
    
    if (!$user) {
        set_flash('error', 'Akun pengguna tidak ditemukan.');
        $this->redirect('/update-profile');
        exit;
    }
    
    $regNumber = $user['reg_number'] ?? '';
    $isMahasiswa = is_numeric($regNumber) && strlen($regNumber) >= 8;

    // Data dari form
    $newName = trim($_POST['new_name'] ?? '');
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (!empty($newName)) {
        if (strlen($newName) < 3) {
            $errors[] = 'Nama baru minimal 3 karakter.';
        } else {
            try {
                $this->userModel->updateUserName($userId, $newName); 
                $_SESSION['user']['name'] = $newName; 
                set_flash('success', 'Nama berhasil diganti menjadi **' . htmlspecialchars($newName) . '**.');
            } catch (Exception $e) {
                set_flash('error', 'Kesalahan saat mengganti nama. Silakan coba lagi.');
            }
        }
    }

    if (!empty($currentPassword) || !empty($newPassword) || !empty($confirmPassword)) {
        
        // Validasi Pembatasan Mahasiswa
        if ($isMahasiswa) { 
            set_flash('error', 'Ganti password tidak diizinkan untuk akun Mahasiswa.');
        } else {
            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                set_flash('error', 'Semua field password (lama, baru, konfirmasi) harus diisi.');
            } else if ($newPassword !== $confirmPassword) {
                set_flash('error', 'Password baru dan konfirmasi password tidak cocok.');
            } else if (strlen($newPassword) < 6) {
                set_flash('error', 'Password baru minimal 6 karakter.');
            } else if (!isset($user['password']) || !password_verify($currentPassword, $user['password'])) {
                set_flash('error', 'Password lama salah.');
            } else {
                try {
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $this->userModel->updateUserPassword($userId, $hashedPassword); 
                    set_flash('success', 'Password berhasil diganti!');
                } catch (Exception $e) {
                    set_flash('error', 'Kesalahan saat mengganti password. Silakan coba lagi.');
                }
            }
        }
    }
    $this->redirect('/update-profile');
    exit;
}

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        $this->redirect('/login');
        exit;
    }
}
