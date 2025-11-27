<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserModel; 

class MemberController extends Controller
{
    private $model;
    private $itemsPerPage = 5; 

    public function __construct()
    {
        parent::__construct(); 
        $this->model = $this->model('UserModel'); 
    }

    public function index()
    { 
        $availableUsers = $this->model->getAllUsers();
        $totalItems = count($availableUsers);
        
        $itemsPerPage = $this->itemsPerPage; 

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);

        if ($itemsPerPage === 0) {
            $itemsPerPage = 1; 
        }
        
        $totalPages = ceil($totalItems / $itemsPerPage);
        
        if ($page > $totalPages && $totalPages > 0) {
            $page = (int)$totalPages;
        }

        $offset = ($page - 1) * $itemsPerPage;
        
        $users = array_slice($availableUsers, $offset, $itemsPerPage);

        $startItem = 0;
        $endItem = 0;
        if ($totalItems > 0) {
            $startItem = $offset + 1;
            $endItem = min($offset + count($users), $totalItems);
        }

        $paginationData = [
            'users'        => $users,
            'currentPage'  => $page,
            'totalPages'   => (int)$totalPages,
            'totalItems'   => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'startItem'    => $startItem, 
            'endItem'      => $endItem,
        ];

        view('admin_lab.members.index', $paginationData);
    }

    public function create()
    {
        view('admin_lab.members.create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $name = trim($_POST['name'] ?? '');
            $regNumber = trim($_POST['reg_number'] ?? '');
            $password = $_POST['password'] ?? ''; 

            $errors = [];
            $password = $regNumber;

            if ($name === '' || $regNumber === '' || $password === '') {
                $errors[] = 'Nama, NIM/NIP, dan Password wajib diisi.';
            }

            if (!empty($errors)) {
                view('admin_lab.members.create', ['errors' => $errors, 'old' => $_POST]);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $data = [
                'name' => $name,
                'reg_number' => $regNumber,
                'password' => $hashedPassword,
            ];

            $this->model->createAnggotaLab($data); 
            set_flash('success', 'Anggota berhasil ditambahkan!');
            $this->redirect('/admin-lab/members');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            
            if ($this->model->deleteUser($id)) {  
                set_flash('success', 'Anggota berhasil dihapus!');
            } else {
                set_flash('error', 'Gagal menghapus anggota.'); 
            }
            $this->redirect('/admin-lab/members');
        }
    }
}