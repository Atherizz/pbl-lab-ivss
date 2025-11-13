<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    private $registrationRequestModel;
    private $equipmentBookingModel;
    private $researchModel;

    public function __construct()
    {
        parent::__construct();
        $this->registrationRequestModel = $this->model('RegistrationRequestModel');
        $this->equipmentBookingModel = $this->model('EquipmentBookingModel');
        $this->researchModel = $this->model('ResearchModel');
    }

 
    public function approvalAdminView($type)
    {
        /** @var string $type */  
        $data = [];

        if ($type === 'anggota') {
                $userRequest = $this->registrationRequestModel->getAllRequestsAdmin();
                $data = [
                    'userRequest' => $userRequest
                ];
        } else if ($type === 'peminjaman') {
            $equipmentBooking = $this->equipmentBookingModel->getAllBookings();
            $data = [
                'equipmentBooking' => $equipmentBooking
            ];
        } else {

        }

        view('admin_lab.approval.' . $type, $data);
    }

    public function approvalDospemView($type) {

        /** @var string $type */  
        $data = [];

        $userId = $_SESSION['user']['id'];

        if ($type === 'anggota') {
                $userRequest = $this->registrationRequestModel->getRequestsByDospem($userId);
                $data = [
                    'userRequest' => $userRequest
                ];
        } else {
            $publication = $this->researchModel->getResearchByDospemId($userId);
                $data = [
                    'publication' => $publication
                ];
        }

        view('admin_lab.approval.' . $type, $data);
    
    }

    // REGISTRATION LIST
    // public function registrationList()
    // {
    //     $userRole = $_SESSION['user']['role'];

    //     if ($userRole === 'dospem') {
    //         // Show only: status = 'pending_approval'
    //         // dan dospem_id = current user id
    //     }

    //     if ($userRole === 'admin_lab') {
    //         // Show only: status = 'approved_by_dospem'
    //     }
    // }

    // REGISTRASI USER
    public function approveRegistrationDospem($id) {}

    public function rejectRegistrationDospem($id) {}

    public function approveRegistrationAdminLab($id) {}

    public function rejectRegistrationAdminLab($id) {}

    // BOOKING
    public function approveBookingAdminLab($id) {}

    public function rejectBookingAdminLab($id) {}

    // RESEARCH
    public function approveResearchDospem($id) {}

    public function rejectResearchDospem($id) {}

    public function approveResearchAdminLab($id) {}

    public function rejectResearchAdminLab($id) {}
}
