<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        // $this->model = $this->model('EquipmentModel');
    }
    public function index()
    {
        view('home', []);
    }
    
}
