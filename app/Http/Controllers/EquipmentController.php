<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('EquipmentModel');
    }
    public function index()
    {
        $equipments = $this->model->getAllEquipments();
        view('admin_lab.equipments.index', [
        'equipments' => $equipments]);
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
                $errors[] = 'Name is required.';
            }

            $validStatuses = ['available', 'in_use', 'maintenance', 'broken'];
            if (!in_array($status, $validStatuses)) {
                $errors[] = 'Invalid status selected.';
            }

            if (!empty($errors)) {
                view('admin_lab.equipments.create', ['errors' => $errors]);
                return;
            }

            $this->model->createEquipment($_POST);
            $this->redirect('/admin/equipment');
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
                $errors = ['Name and Status are required.'];
                $equipment = $this->model->getById($id);
                view('admin_lab.equipments.edit', ['errors' => $errors, 'equipment' => $equipment]);
                return;
            }

            $this->model->updateEquipment($id, $_POST);

            $this->redirect('/admin/equipment');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $this->model->deleteEquipment($id);
            $this->redirect('/admin/equipment');
        }
    }
}
