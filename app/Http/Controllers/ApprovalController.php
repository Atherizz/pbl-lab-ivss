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
    private $itemsPerPage = 5;

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
        $allData = [];

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, $currentPage);
        $itemsPerPage = $this->itemsPerPage;

        if ($itemsPerPage === 0) {
            $itemsPerPage = 1;
        }

        if ($type === 'anggota') {
            $allData = $this->registrationRequestModel->getAllRequestsAdmin();
            $dataKey = 'userRequest';
        } else if ($type === 'peminjaman') {
            $allData = $this->equipmentBookingModel->getAllBookings();
            $dataKey = 'equipmentBooking';
        } else {
            $allData = $this->researchModel->getApprovedByDospemResearch();
            $dataKey = 'publication';
        }

        $totalItems = count($allData);
        $totalPages = (int)ceil($totalItems / $itemsPerPage);
        
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        } elseif ($totalItems === 0) {
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $itemsPerPage;
        $paginatedData = array_slice($allData, $offset, $itemsPerPage);
        
        $startItem = 0;
        $endItem = 0;
        if ($totalItems > 0) {
            $startItem = $offset + 1;
            $endItem = min($offset + count($paginatedData), $totalItems);
        }

        $data = [
            $dataKey       => $paginatedData,
            'currentPage'  => $currentPage,
            'totalPages'   => $totalPages,
            'totalItems'   => $totalItems,
            'startItem'    => $startItem,
            'endItem'      => $endItem,
        ];

        view('admin_lab.approval.' . $type, $data);
    }
    
    public function approvalDospemView($type) 
    {
        $allData = [];

        $userId = $_SESSION['user']['id'];

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, $currentPage);
        $itemsPerPage = $this->itemsPerPage;

        if ($itemsPerPage === 0) {
            $itemsPerPage = 1;
        }

        if ($type === 'anggota') {
            $allData = $this->registrationRequestModel->getRequestsByDospem($userId);
            $dataKey = 'userRequest';
        } else {
            $allData = $this->researchModel->getResearchByDospemId($userId);
            $dataKey = 'publication';
        }

        $totalItems = count($allData);
        $totalPages = (int)ceil($totalItems / $itemsPerPage);

        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
        } elseif ($totalItems === 0) {
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $itemsPerPage;
        $paginatedData = array_slice($allData, $offset, $itemsPerPage);

        $startItem = 0;
        $endItem = 0;
        if ($totalItems > 0) {
            $startItem = $offset + 1;
            $endItem = min($offset + count($paginatedData), $totalItems);
        }

        $data = [
            $dataKey       => $paginatedData,
            'currentPage'  => $currentPage,
            'totalPages'   => $totalPages,
            'totalItems'   => $totalItems,
            'startItem'    => $startItem,
            'endItem'      => $endItem,
        ];
    
        view('admin_lab.approval.' . $type, $data);
    
    }
    
    // Fungsi Aksi Persetujuan (Approval)
    
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