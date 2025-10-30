<?php 

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\AuthController;

return [
    'GET' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'showLoginForm', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'showRegistrationForm', 'middleware' => 'guest'],
        '/equipment/{id}/edit' => ['controller' => EquipmentController::class, 'action' => 'edit', 'middleware' => 'auth'],
        '/equipment/create' => ['controller' => EquipmentController::class, 'action' => 'create', 'middleware' => 'auth'],
        '/equipment' => ['controller' => EquipmentController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/' => ['view' => 'home', 'middleware' => 'guest'],
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'auth'],
        '/equipment/{id}/delete' => ['controller' => EquipmentController::class, 'action' => 'destroy', 'middleware' => 'auth'],
        '/equipment/{id}' => ['controller' => EquipmentController::class, 'action' => 'update', 'middleware' => 'auth'],
        '/equipment' => ['controller' => EquipmentController::class, 'action' => 'store', 'middleware' => 'auth'],
    ],
];
?>