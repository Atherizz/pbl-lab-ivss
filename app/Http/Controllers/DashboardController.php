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
    public function index()
    {
        view('admin_lab.index', []);
    }
    
}
