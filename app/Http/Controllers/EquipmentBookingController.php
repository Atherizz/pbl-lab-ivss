<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class EquipmentBookingController extends Controller
{
    private $model;
    private $equipmentModel;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('EquipmentBookingModel'); 
        $this->equipmentModel = $this->model('EquipmentModel');
    }

    public function index()
    {
        $bookings = $this->model->getAllBookings();
        view('mahasiswa.equipment.bookings.index', ['bookings' => $bookings]);
    }

        public function katalog()
    {
        $equipments = $this->equipmentModel->getAllEquipments();
        view('mahasiswa.equipment.bookings.katalog', [
        'equipments' => $equipments]);
    }

    public function create() {
    $equipmentList = $this->equipmentModel->getAllEquipmentNameId();
    
    view('mahasiswa.equipment.bookings.create', [
        'equipment_list' => $equipmentList
    ]);
    }
    

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $equipmentId = $_POST['equipment_id'] ?? null;
            $startDate = trim($_POST['start_date'] ?? '');
            $endDate = trim($_POST['end_date'] ?? '');
            $userId = $_SESSION['user']['id'] ?? null;
            $notes = trim($_POST['notes'] ?? '');
            
            $errors = [];

            if (empty($equipmentId)) {
                $errors[] = 'Equipment ID is required.';
            }
            if ($startDate === '') {
                $errors[] = 'Start Date is required.';
            }
            if ($endDate === '') {
                $errors[] = 'End Date is required.';
            }
            if (empty($userId)) {
                $errors[] = 'User ID is missing.';
            }

            if (!empty($errors)) {
                view('mahasiswa.equipment.bookings.create', ['errors' => $errors, 'old_data' => $_POST]);
                return;
            }
            
            $data = [
                'equipment_id' => $equipmentId,
                'user_id'      => $userId,
                'start_date'   => $startDate,
                'end_date'     => $endDate,
                'notes'        => $notes,
            ];

            $this->model->createBooking($data);
            $this->redirect('/mahasiswa/equipment/bookings'); 
        }
    }

    public function updateStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || ($_POST['_method'] ?? '') === 'PATCH') {
            $status = trim($_POST['status'] ?? '');

            if (!in_array($status, ['approved', 'rejected', 'returned', 'pending_approval'])) {
                return; 
            }
            
            $this->model->updateBookingStatus($id, $status);
            $this->redirect('/mahasiswa/equipment/bookings');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $this->model->deleteBooking($id);
            $this->redirect('/mahasiswa/equipment/bookings');
        }
    }
}