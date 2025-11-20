<?php
namespace App\Http\Middleware;
class AuthMiddleware
{
    public function isLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']);
    }

    public function requireLogin()
    {
        if (!self::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }
    public function redirectIfLoggedIn()
    {
        if (self::isLoggedIn()) {
            if ($_SESSION['user']['role'] === 'admin_lab') {
                header('Location: ' . BASE_URL . '/admin-lab/dashboard');
                exit;
            } elseif ($_SESSION['user']['role'] === 'admin_berita') {
                header('Location: ' . BASE_URL . '/admin-berita/dashboard');
                exit;
            } else {
                header('Location: ' . BASE_URL . '/anggota-lab/dashboard');
                exit;
            }

        }
    }

    public function requireAdminLab()
    {
        if (!self::isLoggedIn() || $_SESSION['user']['role'] !== 'admin_lab') {
            header('Location: ' . BASE_URL . '/login');
            ;
            exit;
        }
    }
    public function requireAdminNews()
    {
        if (!self::isLoggedIn() || $_SESSION['user']['role'] !== 'admin_berita') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function requirePenggunalab()
    {
        $allowedRoles = ['anggota_lab', 'admin_lab', 'mahasiswa'];

        if (!self::isLoggedIn() || !in_array($_SESSION['user']['role'], $allowedRoles)) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function requireAnggotaLab()
    {
        $allowedRoles = ['anggota_lab', 'admin_lab'];

        if (!self::isLoggedIn() || !in_array($_SESSION['user']['role'], $allowedRoles)) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function requireMahasiswa()
    {
        if (!self::isLoggedIn() || $_SESSION['user']['role'] !== 'mahasiswa') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

}