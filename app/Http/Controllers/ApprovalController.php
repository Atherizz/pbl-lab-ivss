<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class ApprovalController extends Controller
{
    private $registrationRequestModel;

    public function __construct()
    {
        parent::__construct();
        $this->registrationRequestModel = $this->model('RegistrationRequestModel');
    }
    public function approvalMember()
    {
        view('admin_lab.approval.member', []);
    }
    
    public function approvalResearch()
    {
        view('admin_lab.approval.research', []);
    }

    public function approvalBooking()
    {
        view('anggota_lab.booking', []);
    }
    
    // REGISTRATION LIST
    public function registrationList() {
        $userRole = $_SESSION['user']['role'];
        
        if ($userRole === 'dospem') {
            // Show only: status = 'pending_approval'
            // dan dospem_id = current user id
        }
        
        if ($userRole === 'admin_lab') {
            // Show only: status = 'approved_by_dospem'
        }
    }
    
    // REGISTRASI USER
    public function approveRegistrationDospem($id) {

    }
    
    public function rejectRegistrationDospem($id) {

    }

    public function approveRegistrationAdminLab($id) {

    }

    public function rejectRegistrationAdminLab($id) {

    }

    // BOOKING
    public function approveBookingAdminLab($id) {

    }
    
    public function rejectBookingAdminLab($id) {

    }

    // RESEARCH
    public function approveResearchDospem($id) {
    }
    
    public function rejectResearchDospem($id) {

    }

    public function approveResearchAdminLab($id) {

    }

    public function rejectResearchAdminLab($id) {

    }
    
}