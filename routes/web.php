<?php 

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResearchController;

return [
    'GET' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'showLoginForm', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'showRegistrationForm', 'middleware' => 'guest'],
        '/admin-lab/equipment/{id}/edit' => ['controller' => EquipmentController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/create' => ['controller' => EquipmentController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment' => ['controller' => EquipmentController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin-berita/news/{id}/edit' => ['controller' => NewsController::class, 'action' => 'edit', 'middleware' => 'admin_berita'],
        '/admin-berita/news/create' => ['controller' => NewsController::class, 'action' => 'create', 'middleware' => 'admin_berita'],
        '/admin-berita/news' => ['controller' => NewsController::class, 'action' => 'index', 'middleware' => 'admin_berita'],
        '/admin-lab/dashboard' => ['controller' => DashboardController::class, 'action' => 'admin_lab', 'middleware' => 'auth'],
        '/admin-berita/dashboard' => ['controller' => DashboardController::class, 'action' => 'admin_berita', 'middleware' => 'auth'],
        '/mahasiswa/dashboard' => ['controller' => DashboardController::class, 'action' => 'mahasiswa', 'middleware' => 'auth'],
        '/' => ['view' => 'home', 'middleware' => 'guest'],
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'auth'],
        '/admin-lab/equipment/{id}/delete' => ['controller' => EquipmentController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/{id}' => ['controller' => EquipmentController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment' => ['controller' => EquipmentController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-berita/news/{id}/delete' => ['controller' => NewsController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-berita/news/{id}' => ['controller' => NewsController::class, 'action' => 'update', 'middleware' => 'admin_berita'],
        '/admin-berita/news' => ['controller' => NewsController::class, 'action' => 'store', 'middleware' => 'admin_berita'],
    ],
];
?>