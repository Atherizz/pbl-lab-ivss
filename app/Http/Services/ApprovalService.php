<?php

namespace App\Http\Services;

use App\Core\Database;
use App\Models\ResearchModel;
use App\Models\RegistrationRequestModel;
use App\Models\UserModel;
use App\Models\EquipmentBookingModel;

class ApprovalService
{
    private $registrationModel;
    private $userModel;
    private $bookingModel;
    private $researchModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationRequestModel();
        $this->userModel = new UserModel();
        $this->bookingModel = new EquipmentBookingModel();
        $this->researchModel = new ResearchModel();
    }


    // public function updateStatus($type, $id, $status, $data = [])
    // {
    //     // TODO: Implement
    //     // 1. Tentukan table berdasarkan $type
    //     // 2. Update status di table tersebut
    //     // 3. Log approval history (optional)
    //     // 4. Return true/false
        
    //     return false; 
    // }

    public function approve($type, $id)
    {
        // TODO: Implement
        // 1. Update status menjadi 'approved'
        // 2. Trigger action berdasarkan type:
        //    - registration: create user account
        //    - publication: publish research
        //    - booking: confirm booking
        // 3. Send notification
        // 4. Return true/false
        
        return false; 
    }

    public function reject($type, $id, $reason)
    {
        // TODO: Implement
        // 1. Update status menjadi 'rejected'
        // 2. Simpan rejection_reason
        // 3. Send notification ke user
        // 4. Return true/false
        
        return false; 
    }


    public function getDetail($type, $id)
    {
        // TODO: Implement
        // 1. Tentukan table berdasarkan $type
        // 2. Fetch data by ID
        // 3. Include relasi (user, dospem, dll)
        // 4. Return array atau null
        
        return null; // Placeholder
    }

    public function getPendingApprovals($role, $userId = null)
    {
        // TODO: Implement
        // 1. Query berdasarkan role:
        //    - dospem: pending_approval + dospem_id = $userId
        //    - admin_lab: approved_by_dospem
        // 2. Gabungkan dari berbagai tipe (registration, publication, booking)
        // 3. Return array dengan metadata (type, count, items)
        
        return []; // Placeholder
    }


    public function canApprove($type, $id, $userId, $role)
    {
        // TODO: Implement
        // 1. Cek role sesuai dengan level approval
        // 2. Untuk dospem: cek apakah dia yang ditunjuk
        // 3. Cek status item (harus sesuai dengan level approval)
        // 4. Return true/false
        
        return false; 
    }


    // public function getTableName($types)
    // {
    //     $tables = [
    //         'registration' => 'registration_requests',
    //         'publication' => 'research_projects', 
    //         'booking' => 'equipment_bookings'
    //     ];
        
    //     return $tables[$types];
    // }


    private function validateApproval($type, $id, $action)
    {
        // TODO: Implement
        // 1. Cek apakah item exists
        // 2. Cek status sesuai dengan action
        // 3. Validasi data required (misal: rejection harus ada reason)
        // 4. Return validation result
        
        return ['valid' => false, 'errors' => []]; // Placeholder
    }
}
