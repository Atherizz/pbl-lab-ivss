<?php 

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;

return [
    'GET' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'showLoginForm', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'showRegistrationForm', 'middleware' => 'guest'],
        '/admin/equipment/{id}/edit' => ['controller' => EquipmentController::class, 'action' => 'edit', 'middleware' => 'auth'],
        '/admin/equipment/create' => ['controller' => EquipmentController::class, 'action' => 'create', 'middleware' => 'auth'],
        '/admin/equipment' => ['controller' => EquipmentController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/admin/news/{id}/edit' => ['controller' => NewsController::class, 'action' => 'edit', 'middleware' => 'auth'],
        '/admin/news/create' => ['controller' => NewsController::class, 'action' => 'create', 'middleware' => 'auth'],
        '/admin/news' => ['controller' => NewsController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/admin/dashboard' => ['controller' => DashboardController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/' => ['view' => 'home', 'middleware' => 'guest'],
        
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'auth'],
        '/admin/equipment/{id}/delete' => ['controller' => EquipmentController::class, 'action' => 'destroy', 'middleware' => 'auth'],
        '/admin/equipment/{id}' => ['controller' => EquipmentController::class, 'action' => 'update', 'middleware' => 'auth'],
        '/admin/equipment' => ['controller' => EquipmentController::class, 'action' => 'store', 'middleware' => 'auth'],
        '/admin/news/{id}/delete' => ['controller' => NewsController::class, 'action' => 'destroy', 'middleware' => 'auth'],
        '/admin/news/{id}' => ['controller' => NewsController::class, 'action' => 'update', 'middleware' => 'auth'],
        '/admin/news' => ['controller' => NewsController::class, 'action' => 'store', 'middleware' => 'auth'],
    ],
];
?>