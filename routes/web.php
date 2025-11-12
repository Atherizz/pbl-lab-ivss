<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\EquipmentBookingController;

return [
    'GET' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'showLoginForm', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'showRegistrationForm', 'middleware' => 'guest'],
        '/admin-lab/equipment/{id}/edit' => ['controller' => EquipmentController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/create' => ['controller' => EquipmentController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment' => ['controller' => EquipmentController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin-lab/dashboard' => ['controller' => DashboardController::class, 'action' => 'admin_lab', 'middleware' => 'auth'],
        '/admin-lab/approval/{type}' => ['controller' => ApprovalController::class, 'action' => 'approvalAdminView', 'middleware' => 'admin_lab'],
        '/admin-berita/news/{id}/edit' => ['controller' => NewsController::class, 'action' => 'edit', 'middleware' => 'admin_berita'],
        '/admin-berita/news/create' => ['controller' => NewsController::class, 'action' => 'create', 'middleware' => 'admin_berita'],
        '/admin-berita/news' => ['controller' => NewsController::class, 'action' => 'index', 'middleware' => 'admin_berita'],
        '/admin-berita/dashboard' => ['controller' => DashboardController::class, 'action' => 'admin_berita', 'middleware' => 'auth'],
        '/anggota-lab/dashboard' => ['controller' => DashboardController::class, 'action' => 'anggota_lab', 'middleware' => 'auth'],
        '/anggota-lab/research' => ['controller' => ResearchController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/anggota-lab/research/create' => ['controller' => ResearchController::class, 'action' => 'create', 'middleware' => 'auth'],
        '/anggota-lab/research/{id}/edit' => ['controller' => ResearchController::class, 'action' => 'edit', 'middleware' => 'auth'],
        '/anggota-lab/approval/{type}' => ['controller' => ApprovalController::class, 'action' => 'approvalDospemView', 'middleware' => 'anggota_lab'],
        '/anggota-lab/equipment/bookings/create' => ['controller' => EquipmentBookingController::class, 'action' => 'create', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/bookings' => ['controller' => EquipmentBookingController::class, 'action' => 'index', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/katalog' => ['controller' => EquipmentBookingController::class, 'action' => 'katalog', 'middleware' => 'mahasiswa'],
        '/' => ['view' => 'home', 'middleware' => 'guest'],
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'auth'],
        '/admin-lab/equipment/{id}/delete' => ['controller' => EquipmentController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/{id}' => ['controller' => EquipmentController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment' => ['controller' => EquipmentController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-berita/news/{id}/delete' => ['controller' => NewsController::class, 'action' => 'destroy', 'middleware' => 'admin_berita'],
        '/admin-berita/news/{id}' => ['controller' => NewsController::class, 'action' => 'update', 'middleware' => 'admin_berita'],
        '/admin-berita/news' => ['controller' => NewsController::class, 'action' => 'store', 'middleware' => 'admin_berita'],
        '/anggota-lab/research' => ['controller' => ResearchController::class, 'action' => 'store', 'middleware' => 'auth'],
        '/anggota-lab/research/{id}' => ['controller' => ResearchController::class, 'action' => 'update', 'middleware' => 'auth'],
        '/anggota-lab/research/{id}/delete' => ['controller' => ResearchController::class, 'action' => 'destroy', 'middleware' => 'auth'],
        '/anggota-lab/equipment/bookings/{id}/delete' => ['controller' => EquipmentBookingController::class, 'action' => 'destroy', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/bookings' => ['controller' => EquipmentBookingController::class, 'action' => 'store', 'middleware' => 'mahasiswa'],
    ],
];
?>