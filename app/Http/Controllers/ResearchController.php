<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResearchModel;
use App\Models\UserModel;

class ResearchController extends Controller
{
    private $model;
    private $userModel; 

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('ResearchModel');
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login');
        }

        $researchList = $this->model->getByUserId($userId);

        view('anggota_lab.research.index', [
            'researchList' => $researchList
        ]);
    }

    public function direktori()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login');
        }
        $statusFilter = $_GET['status'] ?? 'all'; 
        $searchQuery = $_GET['search'] ?? null;

        $research = $this->model->getAll($statusFilter, $searchQuery);

        view('anggota_lab.research.direktori', [
            'research' => $research, 
            'currentStatus' => $statusFilter,   
            'currentSearch' => $searchQuery,   
        ]);
    }

    public function create()
    {
        $data = [];
        $userRole = $_SESSION['user']['role'] ?? null;

        $dospemList = $this->userModel->getAllAnggotaLab();

        if ($userRole === 'mahasiswa') {
            $data = [
            'dospemList' => $dospemList,
            'old' => [],
            'errors' => []
            ];
        } else {
            $data = [
            'old' => [],
            'errors' => []
            ];
        }

        view('anggota_lab.research.create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $userId = $_SESSION['user']['id'] ?? null;
            // AMBIL ROLE USER DARI SESSION
            $userRole = $_SESSION['user']['role'] ?? null;
            $errors = $this->validateProposal($data);

            if (!empty($errors)) {
                $dospemList = $this->userModel->getAllAnggotaLab();

                view('anggota_lab.research.create', [
                    'header' => 'Ajukan Riset Baru',
                    'dospemList' => $dospemList,
                    'errors' => $errors,
                    'old' => $data
                ]);
                return;
            }

            $initialStatus = ($userRole === 'mahasiswa') ? 'pending_approval' : 'approved_by_dospem';

            $researchData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
                'dospem_id' => $data['dospem_id'],
                'user_id' => $userId,
                'status' => $initialStatus 
            ];

            $this->model->create($researchData);
            $this->redirect('/anggota-lab/research');
        } else {
            $this->redirect('/anggota-lab/research/create');
            return;
        }
    }

    public function edit($id)
    {
        $research = $this->model->getById($id);
        $userId = $_SESSION['user']['id'] ?? null;
        $dospemList = $this->userModel->getAllAnggotaLab();

        if (!$this->canUserManageProposal($research, $userId)) {
            $this->redirect('/anggota-lab/research');
            return;
        }

        view('anggota_lab.research.edit', [
            'header' => 'Edit Research Project: ' . htmlspecialchars($research['title']),
            'research' => $research,
            'dospemList' => $dospemList,
            'old' => $research,
            'errors' => []
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PUT') {
            $data = $_POST;
            $userId = $_SESSION['user']['id'] ?? null;
            $errors = $this->validateProposal($data);

            if (!empty($errors)) {
                $research = $this->model->getById($id);
                $dospemList = $this->userModel->getAllAnggotaLab();

                view('anggota_lab.research.edit', [
                    'header' => 'Edit Research Project: ' . htmlspecialchars($research['title']),
                    'research' => $research,
                    'dospemList' => $dospemList,
                    'errors' => $errors,
                    'old' => $data
                ]);
                return;
            }

            $research = $this->model->getById($id);

            if (!$this->canUserManageProposal($research, $userId)) {
                $this->redirect('/anggota-lab/research');
                return;
            }

            $updateData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
                'dospem_id' => $data['dospem_id']
            ];

            $this->model->update($id, $updateData);
            $this->redirect('/anggota-lab/research');
        } else {
            $this->redirect('/anggota-lab/research');
            return;
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $userId = $_SESSION['user']['id'] ?? null;
            $research = $this->model->getById($id);

            if (!$this->canUserManageProposal($research, $userId)) {
                $this->redirect('/anggota-lab/research');
                return;
            }

            $this->model->delete($id);
            $this->redirect('/anggota-lab/research');
        } else {
            $this->redirect('/anggota-lab/research');
            return;
        }
    }

    private function validateProposal($data)
    {
        $errors = [];
        if (empty(trim($data['title'] ?? ''))) {
            $errors['title'] = 'Research Title is required.';
        }
        if (empty(trim($data['description'] ?? ''))) {
            $errors['description'] = 'Description / Abstract is required.';
        }

        return $errors;
    }

    private function canUserManageProposal($research, $userId)
    {
        if (!$research) {
            return false;
        }

        if ($research['user_id'] != $userId) {
            return false;
        }

        if (!in_array($research['status'], ['pending_approval', 'rejected'])) {
            return false;
        }
        return true;
    }
}