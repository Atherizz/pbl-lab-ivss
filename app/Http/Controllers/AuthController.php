<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $userModel;
    private $registrationRequestModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('UserModel');
        $this->registrationRequestModel = $this->model('RegistrationRequestModel');
    }
    
    public function showRegistrationForm()
    {
        $dospem = $this->userModel->getAllAnggotaLab();

        view('register', [
        'dospem' => $dospem]);
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
            $password = trim($_POST['password'] ?? '');
            $dospem_id = trim($_POST['dospem_id'] ?? '');
            $registration_purpose = trim($_POST['registration_purpose'] ?? '');
            
            // Validasi sederhana
            if (empty($nim) || empty($name) || empty($password) || empty($dospem_id) || empty($registration_purpose)) {
                $_SESSION['error'] = 'Semua field harus diisi';
                $this->redirect('/register');
                exit;
            }
            
            // Validasi panjang registration_purpose
            if (strlen($registration_purpose) < 50) {
                $_SESSION['error'] = 'Tujuan pendaftaran minimal 50 karakter';
                $this->redirect('/register');
                exit;
            }
            
            // Cek apakah email atau NIM sudah terdaftar
            try {
                $existingNim = $this->registrationRequestModel->getByNim($nim);
                
                if ($existingNim) {
                    $_SESSION['error'] = 'NIM atau Email sudah terdaftar';
                    $this->redirect('/register');
                    exit;
                }
                
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                
                // Insert ke registration_requests menggunakan model
                $data = [
                    'nim' => $nim,
                    'name' => $name,
                    'password' => $hashedPassword,
                    'dospem_id' => $dospem_id,
                    'registration_purpose' => $registration_purpose
                ];
                
                $this->registrationRequestModel->createRequest($data);
                
                $_SESSION['success'] = 'Pendaftaran berhasil! Silakan tunggu persetujuan dari Dosen Pembimbing.';
                $this->redirect('/login');
                
            } catch (\Exception $e) {
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

            $user = $this->userModel->getByRegNumber($regNumber);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role']
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

    public function logout() {
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
            }
        
        $_SESSION = [];
        
        session_destroy();
        
        $this->redirect('/login');
        exit;
    }
}
