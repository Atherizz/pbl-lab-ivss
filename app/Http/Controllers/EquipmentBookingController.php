<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use DateTime;
use Exception;

class EquipmentBookingController extends Controller
{
    private $model;
    private $equipmentModel;
    private $uploadDir;
    private $itemsPerPage = 6;

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
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $allBookings = $this->model->getMyBookings($userId);
        $paginationData = pagination($this->itemsPerPage, $currentPage, $allBookings, 'bookings');

        view('anggota_lab.equipment.bookings.index', $paginationData);
    }

    public function katalog()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $allEquipments = $this->equipmentModel->getAllEquipments();
        $paginationData = pagination($this->itemsPerPage, $currentPage, $allEquipments, 'equipments');

        view('anggota_lab.equipment.bookings.katalog', $paginationData);
    }

    public function create($id)
    {
        if (!$id) {
            $this->redirect('/anggota_lab/equipment/bookings/katalog');
            return;
        }

        $equipment = $this->equipmentModel->getById($id);

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
            $startDate   = trim($_POST['start_date'] ?? '');
            $endDate     = trim($_POST['end_date'] ?? '');
            $userId      = $_SESSION['user']['id'] ?? null;
            $notes       = trim($_POST['notes'] ?? '');

            $equipment = $this->equipmentModel->getById($equipmentId);

            $errors = [];

            if (empty($equipmentId)) {
                $errors[] = 'ID Peralatan wajib diisi.';
            }
            if ($startDate === '') {
                $errors[] = 'Tanggal Mulai wajib diisi.';
            }
            if ($endDate === '') {
                $errors[] = 'Tanggal Akhir wajib diisi.';
            }
            if (empty($userId)) {
                $errors[] = 'ID Pengguna hilang.';
            }

            if ($startDate !== '' && $endDate !== '') {
                try {
                    $start = new DateTime($startDate);
                    $end   = new DateTime($endDate);
                    $now   = new DateTime();

                    if ($start >= $end) {
                        $errors[] = 'Tanggal Mulai harus sebelum Tanggal Akhir.';
                    }

                    if ($start < $now) {
                        $errors[] = 'Tanggal Mulai tidak boleh lebih awal dari waktu saat ini.';
                    }
                } catch (Exception $e) {
                    $errors[] = 'Format tanggal tidak valid.';
                }
            }

            if (!empty($errors)) {
                view('anggota_lab.equipment.bookings.create', [
                    'errors'    => $errors,
                    'old_data'  => $_POST,
                    'selected_equipment' => $equipment
                ]);
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

            set_flash('success', 'Pemesanan peralatan berhasil dibuat!');
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

            $imageUrl = null;
            if (!empty($_FILES['image_file']['name'])) {
                $newImageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                $imageUrl = 'uploads/booking/' . $newImageFileName;
            }

            $this->model->updateBookingStatus($id, 'returned', $imageUrl);

            set_flash('success', 'Peralatan berhasil dikembalikan!');

            $this->redirect('/anggota-lab/equipment/bookings');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $booking = $this->model->getById($id);
            if (!$booking) {
                set_flash('error', 'Pemesanan tidak ditemukan.');
                $this->redirect('/anggota-lab/equipment/bookings');
                return;
            }
            if ($this->model->deleteBooking($id)) {
                set_flash('success', 'Pemesanan peralatan berhasil dihapus!');
            } else {
                set_flash('error', 'Gagal menghapus pemesanan peralatan.');
            }

            $this->redirect('/anggota-lab/equipment/bookings');
        }
    }
}
