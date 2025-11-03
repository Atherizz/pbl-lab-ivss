<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        // $this->model = $this->model('EquipmentModel');
    }
    public function admin_lab()
    {
        view('admin_lab.index', []);
    }
    
    public function admin_berita()
    {
        view('admin_news.index', []);
    }

    public function mahasiswa()
    {
        view('mahasiswa.index', []);
    }
}
