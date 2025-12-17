<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResearchModel;
use App\Models\UserModel;
use App\Http\Services\AIService;

class ResearchController extends Controller
{
    private $model;
    private $userModel;
    private $itemsPerPage = 6;
    private $aiService;


    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('ResearchModel');
        $this->userModel = $this->model('UserModel');
        $this->aiService = new AIService();
    }

    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login');
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $allResearch = $this->model->getByUserId($userId);
        $paginationData = pagination($this->itemsPerPage, $currentPage, $allResearch, 'researchList');

        view('anggota_lab.research.index', $paginationData);
    }

    public function direktori()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login');
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $statusFilter = $_GET['status'] ?? 'all';
        $searchQuery = $_GET['search'] ?? '';

        $allResearch = $this->model->getAll($statusFilter, $searchQuery);
        
        // Filter out rejected research from results
        $allResearch = array_filter($allResearch, function($research) {
            return ($research['status'] ?? '') !== 'rejected';
        });
        
        // Re-index array after filtering
        $allResearch = array_values($allResearch);
        
        $paginationData = pagination($this->itemsPerPage, $currentPage, $allResearch, 'research');

        $paginationData['currentStatus'] = $statusFilter;
        $paginationData['currentSearch'] = $searchQuery;

        view('anggota_lab.research.direktori', $paginationData);
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

    public function getRecommendation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';

            $result = $this->aiService->getRecommendation($title);

            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $userId = $_SESSION['user']['id'] ?? null;
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

            $dospem = $this->userModel->getById($data['dospem_id']);

            $initialStatus = ($dospem['role'] == 'admin_lab') ? 'approved_by_dospem' : 'pending_approval';


            $researchData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
                'dospem_id' => $data['dospem_id'],
                'user_id' => $userId,
                'status' => $initialStatus
            ];

            $this->model->create($researchData);

            set_flash('success', 'Proposal Riset berhasil diajukan!');

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
            'header' => 'Edit Proyek Riset: ' . htmlspecialchars($research['title']),
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
                    'header' => 'Edit Proyek Riset: ' . htmlspecialchars($research['title']),
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

            set_flash('success', 'Proyek Riset berhasil diperbarui!');

            $this->redirect('/anggota-lab/research');
        } else {
            $this->redirect('/anggota-lab/research');
            return;
        }
    }

    public function destroy($id)
    {
        $userRole = $_SESSION['user']['role'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            $userId = $_SESSION['user']['id'] ?? null;
            $userRole = $_SESSION['user']['role'] ?? null;
            $research = $this->model->getById($id);

            if (!$this->canUserManageProposal($research, $userId)) {
                $this->redirect('/anggota-lab/research');
                return;
            }

            $this->model->delete($id);

            set_flash('success', 'Proyek Riset berhasil dihapus!');

            if ($userRole === 'admin_lab') {
                $this->redirect('/anggota-lab/research/direktori');
            } else {
                $this->redirect('/anggota-lab/research');
            }
        } else {
            $this->redirect('/anggota-lab/research');
            return;
        }
    }

    private function validateProposal($data)
    {
        $errors = [];
        if (empty(trim($data['title'] ?? ''))) {
            $errors['title'] = 'Judul Riset wajib diisi.';
        }
        if (empty(trim($data['description'] ?? ''))) {
            $errors['description'] = 'Deskripsi / Abstrak wajib diisi.';
        }

        return $errors;
    }

    private function canUserManageProposal($research, $userId)
    {
        if (!$research) {
            return false;
        }

        $user = $this->userModel->getById($userId);

        if ($research['user_id'] != $userId && $user['role'] != 'admin_lab') {
            return false;
        }

        return true;
    }
}
