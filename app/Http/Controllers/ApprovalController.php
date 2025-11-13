<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\ApprovalService;

class ApprovalController extends Controller
{
    private $registrationRequestModel;
    private $equipmentBookingModel;
    private $researchModel;
    private $approvalService;


    public function __construct()
    {
        parent::__construct();
        $this->registrationRequestModel = $this->model('RegistrationRequestModel');
        $this->equipmentBookingModel = $this->model('EquipmentBookingModel');
        $this->researchModel = $this->model('ResearchModel');
        $this->approvalService = new ApprovalService();
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
    // REGISTRASI USER
    public function approveRequestAdminLab($type, $id) {
        $action = ($type === 'peminjaman') ? 'approve' : 'approve_admin';
        $result = $this->approvalService->validateApproval($type, $id, $action);

        if (!$result['valid']) {
            $this->redirect('/admin-lab/approval/' . $type);
            return;
        }

        $this->approvalService->approveByAdminLab($type, $id);
        $this->redirect('/admin-lab/approval/' . $type);
    }

    public function rejectRequestAdminLab($type, $id) {
        $reason = $_POST['reason'] ?? null;
        $result = $this->approvalService->validateApproval($type, $id, 'reject');
        if (!$result['valid']) {
            $this->redirect('/admin-lab/approval/' . $type);
            return;
        }
        $this->approvalService->rejectByAdminLab($type, $id, $reason);
        $this->redirect('/admin-lab/approval/' . $type);
    }

    public function approveRequestDospem($type, $id) {
        $result = $this->approvalService->validateApproval($type, $id, 'approve_dospem');
        if (!$result['valid']) {
            $this->redirect('/anggota-lab/approval/' . $type);
            return;
        }
        $this->approvalService->approveByDospem($type, $id);
        $this->redirect('/anggota-lab/approval/' . $type);
    }

    public function rejectRequestDospem($type, $id) {
        $reason = $_POST['reason'] ?? null;
        $result = $this->approvalService->validateApproval($type, $id, 'reject');
        if (!$result['valid']) {
            $this->redirect('/anggota-lab/approval/' . $type);
            return;
        }
        $this->approvalService->rejectByDospem($type, $id, $reason);
        $this->redirect('/anggota-lab/approval/' . $type);
    }


}
