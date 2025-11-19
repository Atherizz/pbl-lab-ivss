<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    private $model;
    private $itemsPerPage = 5;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('EquipmentModel');
    }

    public function index()
    { 
        $availableEquipments = $this->model->getAllEquipments();
        $totalItems = count($availableEquipments);
        
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
        
        $equipments = array_slice($availableEquipments, $offset, $itemsPerPage);

        $startItem = 0;
        $endItem = 0;
        if ($totalItems > 0) {
            $startItem = $offset + 1;
            $endItem = min($offset + count($equipments), $totalItems);
        }

        $paginationData = [
            'equipments'   => $equipments,
            'currentPage'  => $page,
            'totalPages'   => (int)$totalPages,
            'totalItems'   => $totalItems,
            'itemsPerPage' => $itemsPerPage,
            'startItem'    => $startItem, 
            'endItem'      => $endItem,
        ];

        view('admin_lab.equipments.index', $paginationData);
    }

    public function create()
    {
        view('admin_lab.equipments.create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $name = trim($_POST['name'] ?? '');
            $status = trim($_POST['status'] ?? '');

            $errors = [];

            if ($name === '') {
                $errors[] = 'Nama wajib diisi.';
            }

            $validStatuses = ['available', 'in_use', 'maintenance', 'broken'];
            if (!in_array($status, $validStatuses)) {
                $errors[] = 'Status yang dipilih tidak valid.';
            }

            if (!empty($errors)) {
                view('admin_lab.equipments.create', ['errors' => $errors]);
                return;
            }

            $this->model->createEquipment($_POST);
            
            set_flash('success', 'Peralatan berhasil dibuat!');
            
            $this->redirect('/admin-lab/equipment');
        }
    }

    public function edit($id)
    {
        $equipment = $this->model->getById($id);
        view('admin_lab.equipments.edit', ['equipment' => $equipment]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['name']) || empty($_POST['status'])) {
                $errors = ['Nama dan Status wajib diisi.'];
                $equipment = $this->model->getById($id);
                view('admin_lab.equipments.edit', ['errors' => $errors, 'equipment' => $equipment]);
                return;
            }

            $this->model->updateEquipment($id, $_POST);
            
            set_flash('success', 'Peralatan berhasil diperbarui!');
            
            $this->redirect('/admin-lab/equipment');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            if ($this->model->deleteEquipment($id)) {
                
                set_flash('success', 'Peralatan berhasil dihapus!');
                
            } else {
                
                set_flash('error', 'Gagal menghapus peralatan.');
                
            }
            $this->redirect('/admin-lab/equipment');
        }
    }
}