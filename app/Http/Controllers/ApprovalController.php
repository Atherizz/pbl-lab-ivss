<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\ApprovalService;
use App\Http\Services\EmailService;

class ApprovalController extends Controller
{
    private $registrationRequestModel;
    private $equipmentBookingModel;
    private $researchModel;
    private $approvalService;
    private $itemsPerPage = 5;
    private $mailer;

    public function __construct()
    {
        parent::__construct();
        $this->registrationRequestModel = $this->model('RegistrationRequestModel');
        $this->equipmentBookingModel = $this->model('EquipmentBookingModel');
        $this->researchModel = $this->model('ResearchModel');
        $this->approvalService = new ApprovalService();
        $this->mailer = new EmailService();
    }

    public function approvalAdminView($type)
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

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

        $paginationData = pagination($this->itemsPerPage, $currentPage, $allData, $dataKey);
        
        view('admin_lab.approval.' . $type, $paginationData);
    }
    
    public function approvalDospemView($type) 
    {
        $userId = $_SESSION['user']['id'];
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if ($type === 'anggota') {
            $allData = $this->registrationRequestModel->getRequestsByDospem($userId);
            $dataKey = 'userRequest';
        } else {
            $allData = $this->researchModel->getResearchByDospemId($userId);
            $dataKey = 'publication';
        }

        $paginationData = pagination($this->itemsPerPage, $currentPage, $allData, $dataKey);
    
        view('admin_lab.approval.' . $type, $paginationData);
    }
    
    private function buildApprovalEmailBody($userName, $approvalType, $rejectionReason = null)
    {
        $body = "<p>Halo {$userName},</p>";

        switch ($approvalType) {
            case 'approved_by_admin':
                $body .= "
                    <p>Selamat! Pengajuan pendaftaran Anda sebagai anggota Lab IVSS telah <strong>disetujui oleh Admin Lab</strong>.</p>
                    <p>Anda sekarang dapat login ke sistem menggunakan NIM dan password yang telah Anda daftarkan.</p>
                    <p><strong>Langkah selanjutnya:</strong></p>
                    <ul>
                        <li>Login ke sistem Lab IVSS</li>
                        <li>Lengkapi profil Anda</li>
                        <li>Mulai berkontribusi di laboratorium</li>
                    </ul>
                ";
                break;

            case 'approved_by_dospem':
                $body .= "
                    <p>Pengajuan pendaftaran Anda sebagai anggota Lab IVSS telah <strong>disetujui oleh Dosen Pembimbing</strong>.</p>
                    <p>Saat ini permohonan Anda sedang menunggu persetujuan dari Admin Lab.</p>
                    <p>Anda akan menerima email notifikasi lebih lanjut setelah Admin Lab melakukan review.</p>
                ";
                break;

            case 'rejected':
                $body .= "
                    <p>Mohon maaf, pengajuan pendaftaran Anda sebagai anggota Lab IVSS telah <strong>ditolak</strong>.</p>
                ";
                if ($rejectionReason) {
                    $body .= "<p><strong>Alasan penolakan:</strong><br>{$rejectionReason}</p>";
                }
                $body .= "
                    <p>Jika Anda merasa ada kesalahan atau ingin mengajukan kembali, silakan hubungi admin atau dosen pembimbing Anda.</p>
                ";
                break;
        }

        $body .= "<p>Salam,<br><strong>IVSS Lab</strong></p>";

        return $body;
    }
    
    public function approveRequestAdminLab($type, $id) {
        $action = ($type === 'peminjaman') ? 'approve' : 'approve_admin';
        $result = $this->approvalService->validateApproval($type, $id, $action);

        if (!$result['valid']) {
            set_flash('error', 'Aksi persetujuan gagal: ' . ($result['message'] ?? 'Data tidak valid.'));
            $this->redirect('/admin-lab/approval/' . $type);
            return;
        }
        
        $this->approvalService->approveByAdminLab($type, $id);
        
        if ($type === 'anggota') {
            $registeredUser = $this->registrationRequestModel->getById($id);
            $subject = 'Pendaftaran Lab IVSS - Disetujui';
            $to = $registeredUser['email'];
            $body = $this->buildApprovalEmailBody($registeredUser['name'], 'approved_by_admin');
            
            $this->mailer->send($to, $subject, $body);
        }
        
        set_flash('success', ' Berhasil disetujui oleh Admin Lab.');
        $this->redirect('/admin-lab/approval/' . $type);
    }

    public function rejectRequestAdminLab($type, $id) {
        $reason = $_POST['reason'] ?? null;
        $result = $this->approvalService->validateApproval($type, $id, 'reject');
        
        if (!$result['valid']) {
            set_flash('error', 'Aksi penolakan gagal: ' . ($result['message'] ?? 'Data tidak valid.'));
            $this->redirect('/admin-lab/approval/' . $type);
            return;
        }
        
        $this->approvalService->rejectByAdminLab($type, $id, $reason);
        
        if ($type === 'anggota') {
            $registeredUser = $this->registrationRequestModel->getById($id);
            $subject = 'Pendaftaran Lab IVSS - Ditolak';
            $to = $registeredUser['email'];
            $body = $this->buildApprovalEmailBody($registeredUser['name'], 'rejected', $reason);
            
            $this->mailer->send($to, $subject, $body);
        }
        
        set_flash('success', ' Berhasil ditolak oleh Admin Lab.');
        $this->redirect('/admin-lab/approval/' . $type);
    }

    public function approveRequestDospem($type, $id) {
        $result = $this->approvalService->validateApproval($type, $id, 'approve_dospem');
        
        if (!$result['valid']) {
            set_flash('error', 'Aksi persetujuan gagal: ' . ($result['message'] ?? 'Data tidak valid.'));
            $this->redirect('/anggota-lab/approval/' . $type);
            return;
        }
        
        $this->approvalService->approveByDospem($type, $id);
        
        if ($type === 'anggota') {
            $registeredUser = $this->registrationRequestModel->getById($id);
            $subject = 'Pendaftaran Lab IVSS - Disetujui Dosen Pembimbing';
            $to = $registeredUser['email'];
            $body = $this->buildApprovalEmailBody($registeredUser['name'], 'approved_by_dospem');
            
            $this->mailer->send($to, $subject, $body);
        }
        
        set_flash('success', ' Berhasil disetujui oleh Dosen Pembimbing.');
        $this->redirect('/anggota-lab/approval/' . $type);
    }

    public function rejectRequestDospem($type, $id) {
        $reason = $_POST['reason'] ?? null;
        $result = $this->approvalService->validateApproval($type, $id, 'reject');
        
        if (!$result['valid']) {
            set_flash('error', 'Aksi penolakan gagal: ' . ($result['message'] ?? 'Data tidak valid.'));
            $this->redirect('/anggota-lab/approval/' . $type);
            return;
        }
        
        $this->approvalService->rejectByDospem($type, $id, $reason);
        
        if ($type === 'anggota') {
            $registeredUser = $this->registrationRequestModel->getById($id);
            $subject = 'Pendaftaran Lab IVSS - Ditolak';
            $to = $registeredUser['email'];
            $body = $this->buildApprovalEmailBody($registeredUser['name'], 'rejected', $reason);
            
            $this->mailer->send($to, $subject, $body);
        }
        
        set_flash('success', ' Berhasil ditolak oleh Dosen Pembimbing.');
        $this->redirect('/anggota-lab/approval/' . $type);
    }
}