<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class AuthController extends Controller
{

    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('UserModel');
    }
    public function showRegistrationForm()
    {
        view('register');
    }

    public function showLoginForm()
    {
        $this->authMiddleware->redirectIfLoggedIn();
        view('login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $user = $this->userModel->getByEmail($_POST);
            if ($user) {
                $_SESSION['error'] = 'Email sudah digunakan';
                $this->redirect('/register');
                exit;
            } else {
                $data = $_POST;
                $hashedPassword = password_hash($data['password'],PASSWORD_BCRYPT); 
                $data['password'] = $hashedPassword;
                $this->userModel->createUser($data);
                $this->redirect('/login');
            }
        }
    }
    public function login()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                $this->redirect('/equipment');
                exit;
            } else { 
                $_SESSION['error'] = 'Email atau password salah';
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
