<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;

class EquipmentBookingController extends Controller
{
    private $model;
    private $equipmentModel;
    private $uploadDir;

    public $uploadService;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('EquipmentBookingModel'); 
        $this->equipmentModel = $this->model('EquipmentModel');
        $this->uploadDir = __DIR__ . '/../../../public/uploads/booking/';
        $this->uploadService = new UploadService();
        
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index()
    {
        $userId = $_SESSION['user']['id'];
        $bookings = $this->model->getMyBookings($userId);
        view('anggota_lab.equipment.bookings.index', ['bookings' => $bookings]);
    }

        public function katalog()
    {
        $equipments = $this->equipmentModel->getAllEquipments();
        view('anggota_lab.equipment.bookings.katalog', [
        'equipments' => $equipments]);
    }

    public function create() { 
        $equipmentId = $_GET['equipment_id'] ?? null; 
        if (!$equipmentId) {
            $this->redirect('/anggota_lab/equipment/bookings/katalog');
            return;
        }

        $equipment = $this->equipmentModel->getById($equipmentId);
        
        if (!$equipment) {
            $this->redirect('/anggota_lab/equipment/bookings/katalog');
            return;
        }
        $equipmentList = $this->equipmentModel->getAllEquipmentNameId();
        
        view('anggota_lab.equipment.bookings.create', [
            'equipment_list' => $equipmentList, 
            'selected_equipment' => $equipment, 
            'old_data' => $_SESSION['old_data'] ?? [], 
            'errors' => $_SESSION['errors'] ?? [], 
        ]);
        unset($_SESSION['old_data']);
        unset($_SESSION['errors']);
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
                view('anggota_lab.equipment.bookings.create', ['errors' => $errors, 'old_data' => $_POST]);
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
            $this->redirect('/anggota-lab/equipment/bookings'); 
        }
    }

    public function returnEquipment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || ($_POST['_method'] ?? '') === 'PUT') {
            $booking = $this->model->getById($id);
            if ($booking) {
                $this->equipmentModel->updateStatus($booking['equipment_id'], 'available');
            }

            if (!empty($_FILES['image_file']['name'])) {
                $newImageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                $imageUrl = 'uploads/booking/' . $newImageFileName;
            }

            $this->model->updateBookingStatus($id, 'returned', $imageUrl);
            $this->redirect('/anggota-lab/equipment/bookings');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $this->model->deleteBooking($id);
            $this->redirect('/anggota-lab/equipment/bookings');
        }
    }
}