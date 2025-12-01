<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DashboardModel;

class DashboardController extends Controller
{
    private $model;
    
    public function __construct()
    {
        parent::__construct();
        // Asumsi: $this->model('...') berhasil menginisiasi DashboardModel
        $this->model = $this->model('DashboardModel'); 
    }

    /**
     * Dashboard untuk Admin Lab
     * Memuat view: 'admin_lab.dashboard'
     */
    public function admin_lab()
    {
        // Ambil data dari model
        $stats = $this->model->getAdminLabStats();
        $pendingMembers = $this->model->getPendingMemberApprovals();
        $pendingPublications = $this->model->getPendingPublicationApprovals();
        $pendingBorrowings = $this->model->getPendingBorrowingApprovals();
        $recentActivities = $this->model->getLabRecentActivities(10);
        $equipmentStats = $this->model->getEquipmentStats();

        // Data yang dikirim ke View
        view('admin_lab.index', [
            'pageTitle' => 'Admin Lab Dashboard',
            'activeMenu' => 'dashboard',
            'stats' => $stats,
            'pendingMembers' => $pendingMembers,
            'pendingPublications' => $pendingPublications,
            'pendingBorrowings' => $pendingBorrowings,
            'recentActivities' => $recentActivities,
            'equipmentStats' => $equipmentStats
        ]);
    }

    /**
     * Dashboard untuk Anggota Lab (Termasuk Mahasiswa)
     * Memuat view: 'anggota_lab.dashboard'
     */
    public function anggota_lab()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        
        if (!$userId) {
            $this->redirect('/login');
            return;
        }

        // AMBIL SEMUA DATA STATISTIK YANG DIBUTUHKAN OLEH VIEW
        $stats = $this->model->getAnggotaLabStats($userId);
        $activeBorrowings = $this->model->getActiveBorrowings($userId);
        $recentResearch = $this->model->getRecentResearch($userId, 5);
        $recentActivities = $this->model->getRecentActivities($userId, 10);
        
        // Data yang dikirim ke View
        view('anggota_lab.index', [
            'pageTitle' => 'Dashboard Anggota Lab',
            'activeMenu' => 'dashboard',
            'stats' => $stats,
            'activeBorrowings' => $activeBorrowings,
            'recentResearch' => $recentResearch, // Disertakan untuk riwayat/aktivitas
            'recentActivities' => $recentActivities // Disertakan untuk riwayat/aktivitas
        ]);
    }
    
    /**
     * Dashboard untuk Admin Berita
     * Memuat view: 'admin_berita.dashboard'
     */
    public function admin_berita()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        
        // Ambil data dari model
        $stats = $this->model->getNewsStats($userId);
        $recentNews = $this->model->getRecentNews($userId, 10);
        $viewsStats = $this->model->getNewsViewsStats($userId); // Data ini mungkin kosong/statis

        // Data yang dikirim ke View
        view('admin_news.index', [
            'pageTitle' => 'Admin Berita Dashboard',
            'activeMenu' => 'dashboard',
            'stats' => $stats,
            'recentNews' => $recentNews,
            'viewsStats' => $viewsStats
        ]);
    }

    /**
     * API endpoint untuk refresh data dashboard (AJAX)
     * Rute: /api/dashboard/refreshStats
     */
    public function refreshStats()
    {
        header('Content-Type: application/json');
        
        $userRole = $_SESSION['user']['role'] ?? null;
        $userId = $_SESSION['user']['id'] ?? null;

        $response = [];

        switch ($userRole) {
            case 'anggota_lab':
            case 'mahasiswa':
                $response = $this->model->getAnggotaLabStats($userId);
                break;
            
            case 'admin_lab':
                $response = $this->model->getAdminLabStats();
                break;
            
            case 'admin_news':
                $response = $this->model->getNewsStats($userId);
                break;
            
            default:
                $response = ['error' => 'Invalid role'];
        }

        echo json_encode($response);
        exit;
    }
}