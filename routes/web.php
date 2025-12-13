<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipmentBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatasetController; 
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GaleryController; 

return [
    'GET' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'showLoginForm', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'showRegistrationForm', 'middleware' => 'guest'],
        '/update-profile' => ['controller' => AuthController::class, 'action' => 'showUpdateProfileForm', 'middleware' => 'auth'],
        '/admin-lab/equipment/{id}/edit' => ['controller' => EquipmentController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/create' => ['controller' => EquipmentController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment' => ['controller' => EquipmentController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin-lab/course' => ['controller' => CourseController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin-lab/course/create' => ['controller' => CourseController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/course/{id}/edit' => ['controller' => CourseController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-lab/dashboard' => ['controller' => DashboardController::class, 'action' => 'admin_lab', 'middleware' => 'auth'],
        '/admin-lab/approval/{type}' => ['controller' => ApprovalController::class, 'action' => 'approvalAdminView', 'middleware' => 'admin_lab'],
        '/admin-lab/publication' => ['controller' => ResearchController::class, 'action' => 'direktori', 'middleware' => 'admin_lab'],
        '/admin-lab/galery' => ['controller' => GaleryController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin-lab/galery/create' => ['controller' => GaleryController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/galery/{id}/edit' => ['controller' => GaleryController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-berita/news/{id}/edit' => ['controller' => NewsController::class, 'action' => 'edit', 'middleware' => 'admin_berita'],
        '/admin-berita/news/create' => ['controller' => NewsController::class, 'action' => 'create', 'middleware' => 'admin_berita'],
        '/admin-berita/news' => ['controller' => NewsController::class, 'action' => 'index', 'middleware' => 'admin_berita'],
        '/admin-berita/dashboard' => ['controller' => DashboardController::class, 'action' => 'admin_berita', 'middleware' => 'auth'],
        '/anggota-lab/dashboard' => ['controller' => DashboardController::class, 'action' => 'anggota_lab', 'middleware' => 'auth'],
        '/anggota-lab/research' => ['controller' => ResearchController::class, 'action' => 'index', 'middleware' => 'auth'],
        '/anggota-lab/research/create' => ['controller' => ResearchController::class, 'action' => 'create', 'middleware' => 'auth'],
        '/anggota-lab/research/direktori' => ['controller' => ResearchController::class, 'action' => 'direktori', 'middleware' => 'auth'],
        '/anggota-lab/research/{id}/edit' => ['controller' => ResearchController::class, 'action' => 'edit', 'middleware' => 'auth'],
        '/anggota-lab/approval/{type}' => ['controller' => ApprovalController::class, 'action' => 'approvalDospemView', 'middleware' => 'anggota_lab'],
        '/anggota-lab/equipment/bookings/create/{id}' => ['controller' => EquipmentBookingController::class, 'action' => 'create', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/bookings' => ['controller' => EquipmentBookingController::class, 'action' => 'index', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/katalog' => ['controller' => EquipmentBookingController::class, 'action' => 'katalog', 'middleware' => 'mahasiswa'],
        '/anggota-lab/profile' => ['controller' => ProfileController::class, 'action' => 'index', 'middleware' => 'anggota_lab'],
        '/anggota-lab/profile/edit' => ['controller' => ProfileController::class, 'action' => 'edit', 'middleware' => 'anggota_lab'],
        '/anggota-lab/profile/photo' => ['controller' => ProfileController::class, 'action' => 'photoManager', 'middleware' => 'anggota_lab'],
        '/dataset/direktori' => ['controller' => DatasetController::class, 'action' => 'direktori', 'middleware' => 'auth'],
        '/anggota-lab/dataset' => ['controller' => DatasetController::class, 'action' => 'index', 'middleware' => 'pengguna_lab'],
        '/anggota-lab/publikasi' => ['controller' => PublicationController::class, 'action' => 'index', 'middleware' => 'anggota_lab'],
        '/admin-lab/dataset/create' => ['controller' => DatasetController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/dataset/{id}/edit' => ['controller' => DatasetController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-lab/members' => ['controller' => MemberController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/admin-lab/members/create' => ['controller' => MemberController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/fasilitas' => ['controller' => HomeController::class, 'action' => 'fasilitas'],
        '/publikasi' => ['controller' => HomeController::class, 'action' => 'publications'],
        '/berita/{slug}' => ['controller' => HomeController::class, 'action' => 'newsDetail'],
        '/berita' => ['controller' => HomeController::class, 'action' => 'news'],
        '/profile/{slug}' => ['controller' => HomeController::class, 'action' => 'profile'],
        '/admin-lab/products/{id}/edit' => ['controller' => ProductController::class, 'action' => 'edit', 'middleware' => 'admin_lab'],
        '/admin-lab/products/create' => ['controller' => ProductController::class, 'action' => 'create', 'middleware' => 'admin_lab'],
        '/admin-lab/products' => ['controller' => ProductController::class, 'action' => 'index', 'middleware' => 'admin_lab'],
        '/' => ['controller' => HomeController::class, 'action' => 'index'],
    ],
    'POST' => [
        '/login' => ['controller' => AuthController::class, 'action' => 'login', 'middleware' => 'guest'],
        '/register' => ['controller' => AuthController::class, 'action' => 'register', 'middleware' => 'guest'],
        '/logout' => ['controller' => AuthController::class, 'action' => 'logout', 'middleware' => 'auth'],
        '/update-profile' => ['controller' => AuthController::class, 'action' => 'updateProfile', 'middleware' => 'auth'],
        '/admin-lab/approval/{type}/approve/{id}' => ['controller' => ApprovalController::class, 'action' => 'approveRequestAdminLab', 'middleware' => 'admin_lab'],
        '/admin-lab/approval/{type}/reject/{id}' => ['controller' => ApprovalController::class, 'action' => 'rejectRequestAdminLab', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/{id}/delete' => ['controller' => EquipmentController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment/{id}' => ['controller' => EquipmentController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/equipment' => ['controller' => EquipmentController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-lab/course/{id}/delete' => ['controller' => CourseController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-lab/course/{id}' => ['controller' => CourseController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/course' => ['controller' => CourseController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-lab/galery/store' => ['controller' => GaleryController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-lab/galery/{id}/update' => ['controller' => GaleryController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/galery/{id}/destroy' => ['controller' => GaleryController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-lab/berita/news/{id}/delete' => ['controller' => NewsController::class, 'action' => 'destroy', 'middleware' => 'admin_berita'],
        '/admin-lab/berita/news/{id}' => ['controller' => NewsController::class, 'action' => 'update', 'middleware' => 'admin_berita'],
        '/admin-berita/news' => ['controller' => NewsController::class, 'action' => 'store', 'middleware' => 'admin_berita'],
        '/anggota-lab/research' => ['controller' => ResearchController::class, 'action' => 'store', 'middleware' => 'auth'],
        '/anggota-lab/research/get-recommendation' => ['controller' => ResearchController::class, 'action' => 'getRecommendation', 'middleware' => 'auth'],
        '/anggota-lab/research/{id}' => ['controller' => ResearchController::class, 'action' => 'update', 'middleware' => 'auth'],
        '/anggota-lab/research/{id}/delete' => ['controller' => ResearchController::class, 'action' => 'destroy', 'middleware' => 'auth'],
        '/anggota-lab/equipment/bookings/return/{id}' => ['controller' => EquipmentBookingController::class, 'action' => 'returnEquipment', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/bookings/{id}/delete' => ['controller' => EquipmentBookingController::class, 'action' => 'destroy', 'middleware' => 'mahasiswa'],
        '/anggota-lab/equipment/bookings' => ['controller' => EquipmentBookingController::class, 'action' => 'store', 'middleware' => 'mahasiswa'],
        '/anggota-lab/approval/{type}/approve/{id}' => ['controller' => ApprovalController::class, 'action' => 'approveRequestDospem', 'middleware' => 'anggota_lab'],
        '/anggota-lab/approval/{type}/reject/{id}' => ['controller' => ApprovalController::class, 'action' => 'rejectRequestDospem', 'middleware' => 'anggota_lab'],
        '/anggota-lab/publikasi/setup' => ['controller' => PublicationController::class, 'action' => 'setup', 'middleware' => 'anggota_lab'],
        '/anggota-lab/publikasi/synchronize' => ['controller' => PublicationController::class, 'action' => 'synchronize', 'middleware' => 'anggota_lab'],
        '/anggota-lab/publikasi/destroy-all' => ['controller' => PublicationController::class, 'action' => 'destroyAllPublications', 'middleware' => 'anggota_lab'],
        '/admin-lab/dataset' => ['controller' => DatasetController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-lab/dataset/{id}' => ['controller' => DatasetController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/dataset/{id}/delete' => ['controller' => DatasetController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/anggota-lab/profile' => ['controller' => ProfileController::class, 'action' => 'store', 'middleware' => 'anggota_lab'],
        '/anggota-lab/profile/photo/upload' => ['controller' => ProfileController::class, 'action' => 'uploadPhoto', 'middleware' => 'anggota_lab'],
        '/anggota-lab/profile/photo/delete' => ['controller' => ProfileController::class, 'action' => 'deletePhoto', 'middleware' => 'anggota_lab'],
        '/admin-lab/members' => ['controller' => MemberController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-lab/members/{id}/delete' => ['controller' => MemberController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
        '/admin-lab/products' => ['controller' => ProductController::class, 'action' => 'store', 'middleware' => 'admin_lab'],
        '/admin-lab/products/{id}' => ['controller' => ProductController::class, 'action' => 'update', 'middleware' => 'admin_lab'],
        '/admin-lab/products/{id}/delete' => ['controller' => ProductController::class, 'action' => 'destroy', 'middleware' => 'admin_lab'],
    ],
];
?>