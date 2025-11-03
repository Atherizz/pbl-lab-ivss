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
        '/admin/equipment/{id}/edit' => ['controller' => EquipmentController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin/equipment/create' => ['controller' => EquipmentController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin/equipment' => ['controller' => EquipmentController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin/news/{id}/edit' => ['controller' => NewsController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin/news/create' => ['controller' => NewsController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin/news' => ['controller' => NewsController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin/dashboard' => ['controller' => DashboardController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/research' => ['controller' => ResearchController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/research/create' => ['controller' => ResearchController::class, 'action' => 'create', 'middleware' => 'auth'],
        '/research/{id}/edit' => ['controller' => ResearchController::class, 'action' => 'edit', 'middleware' => 'auth'],
        '/' => ['view' => 'home', 'middleware' => 'guest'],
        
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'admin_lab'],
        '/research' => ['controller' => ResearchController::class, 'action' => 'store', 'middleware' => 'auth'],
        '/research/{id}' => ['controller' => ResearchController::class, 'action' => 'update', 'middleware' => 'auth'], 
        '/research/{id}/delete' => ['controller' => ResearchController::class, 'action' => 'destroy', 'middleware' => 'auth'],
        '/admin/equipment/{id}/delete' => ['controller' => EquipmentController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin/equipment/{id}' => ['controller' => EquipmentController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin/equipment' => ['controller' => EquipmentController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin/news/{id}/delete' => ['controller' => NewsController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin/news/{id}' => ['controller' => NewsController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin/news' => ['controller' => NewsController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
    ],
];
?>