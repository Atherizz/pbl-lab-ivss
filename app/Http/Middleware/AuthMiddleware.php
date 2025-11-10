<?php
namespace App\Http\Middleware;
Class AuthMiddleware {
    public function isLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user']);
    }
    
    public function requireLogin() {
        if (!self::isLoggedIn()) {
           header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }    
    public function redirectIfLoggedIn() {
        if (self::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/equipment');;
            exit;
        }
    }
    
    public function getUserRole() {
        if (self::isLoggedIn()) {
            return $_SESSION['user_role'];
        }
        return null;
    }
    
    public function requireAdminLab() {
        if (!self::isLoggedIn() || $_SESSION['user']['role'] !== 'admin_lab') {
            header('Location: ' . BASE_URL . '/');;
            exit;
        }
    } 
    public function requireAdminNews() {
        if (!self::isLoggedIn() || $_SESSION['user']['role'] !== 'admin_berita') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    } 

    public function requireAnggotaLab() {
        if (!self::isLoggedIn() || $_SESSION['user']['role'] !== 'anggota_lab') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

}