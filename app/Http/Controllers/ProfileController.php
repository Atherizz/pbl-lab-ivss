<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        view('anggota_lab.profile.index', []);
    }
    
    public function edit()
    {
        view('anggota_lab.profile.edit', []);
    }

}
