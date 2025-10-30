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
    
    public function requireAdmin() {
        if (!self::isLoggedIn() || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . BASE_URL . '/');;
            exit;
        }
    } 

}