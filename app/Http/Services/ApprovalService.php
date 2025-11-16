<?php

namespace App\Http\Services;

use App\Core\Database;
use App\Models\EquipmentModel;
use App\Models\ResearchModel;
use App\Models\RegistrationRequestModel;
use App\Models\UserModel;
use App\Models\EquipmentBookingModel;

class ApprovalService
{
    private $registrationRequestModel;
    private $userModel;
    private $bookingModel;
    private $researchModel;
    private $equipmentModel;

    public function __construct()
    {
        $this->registrationRequestModel = new RegistrationRequestModel();
        $this->userModel = new UserModel();
        $this->bookingModel = new EquipmentBookingModel();
        $this->researchModel = new ResearchModel();
        $this->equipmentModel = new EquipmentModel();
    }

    public function approveByAdminLab($type, $id)
    {

        if ($type === 'anggota') {
            $this->registrationRequestModel->updateStatus($id, 'approved_by_head');
            $registeredUser = $this->registrationRequestModel->getById($id);

            $userData = [
                'name' => $registeredUser['name'],
                'reg_number' => $registeredUser['nim'],
                'password' => $registeredUser['password'],
                'dospem_id' => $registeredUser['dospem_id']
            ];

            $this->userModel->createUser($userData);

            return true;

        } else if ($type === 'peminjaman') {
            $this->bookingModel->updateBookingStatus($id, 'approved');
            $this->equipmentModel->updateStatus($id, 'in_use');

            return true;
        } else if ($type === 'publikasi') {
            $this->researchModel->updateStatus($id, 'approved_by_head');
            return true;
        }

        return false; 
    }

    public function rejectByAdminLab($type, $id, $reason=null)
    {
        if ($type === 'anggota') {
            return $this->registrationRequestModel->updateStatus($id, 'pending_approval', $reason);

        } else if ($type === 'peminjaman') {
            return (bool) $this->bookingModel->updateBookingStatus($id, 'rejected');

        } else if ($type === 'publikasi') {
            return (bool) $this->researchModel->updateStatus($id, 'rejected', $reason);
        }

        return false; 
    }

    public function approveByDospem($type, $id)
    {
        if ($type === 'anggota') {
            return (bool) $this->registrationRequestModel->updateStatus($id, 'approved_by_dospem');

        } else if ($type === 'publikasi') {
            return (bool) $this->researchModel->updateStatus($id, 'approved_by_dospem');

        } 

        return false; 
    }

    public function rejectByDospem($type, $id, $reason=null)
    {
        if ($type === 'anggota') {
            return (bool) $this->registrationRequestModel->updateStatus($id, 'rejected', $reason);

        } else if ($type === 'publikasi') {
            return (bool) $this->researchModel->updateStatus($id, 'rejected', $reason);

        } 

        return false; 
    }



    public function validateApproval($type, $id, $action)
    {
        $errors = [];

        $record = null;
        if ($type === 'anggota') {
            $record = $this->registrationRequestModel->getById($id);
        } else if ($type === 'peminjaman') {
            $record = $this->bookingModel->getById($id);
        } else if ($type === 'publikasi') {
            $record = $this->researchModel->getById($id);
        }

        if (!$record) {
            $errors[] = 'Record not found.';
            return ['valid' => false, 'errors' => $errors];
        }

        // 2. Validasi transisi status dasar sesuai schema
        $status = $record['status'] ?? null;
        if ($type === 'peminjaman') {
            // equipment_bookings transitions
            if ($action === 'approve' && $status !== 'pending_approval') {
                $errors[] = 'Only pending_approval bookings can be approved.';
            }
            if ($action === 'reject' && $status !== 'pending_approval') {
                $errors[] = 'Only pending_approval bookings can be rejected.';
            }
        } elseif ($type === 'publikasi') {
            // research_projects transitions
            if ($action === 'approve_dospem' && $status !== 'pending_approval') {
                $errors[] = 'Only pending_approval research can be approved by dospem.';
            }
            if ($action === 'approve_admin' && $status !== 'approved_by_dospem') {
                $errors[] = 'Admin Lab can approve only after dospem approval.';
            }
        } elseif ($type === 'anggota') {
            // registration_requests transitions
            if ($action === 'approve_dospem' && $status !== 'pending_approval') {
                $errors[] = 'Only pending_approval registrations can be approved by dospem.';
            }
            if ($action === 'approve_admin' && $status !== 'approved_by_dospem') {
                $errors[] = 'Admin Lab can approve only after dospem approval.';
            }
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }
}
