<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResearchModel; 

class ResearchController extends Controller
{
    private $model; 

    public function __construct()
    {
        parent::__construct(); 
        $this->model = $this->model('ResearchModel'); 
    }

    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login');
        }

        // Gunakan model yang sudah diinisiasi
        $researchList = $this->model->getByUserId($userId); // Diubah

        view('anggota_lab.research.index', [
            'researchList' => $researchList
        ]);
    }

    public function create()
    {

        view('anggota_lab.research.create', [
            'header' => 'Propose New Research Project',
            'old' => [], 
            'errors' => [] 
        ]);
    }

    public function store()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $_POST;
            $userId = $_SESSION['user']['id'] ?? null;
            $errors = $this->validateProposal($data); 

            if (!empty($errors)) {
                view('anggota_lab.research.create', [
                    'header' => 'Propose New Research Project',
                    'errors' => $errors,
                    'old' => $data 
                ]);
                return; 
    
            }

 
            $researchData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
                'primary_investigator_id' => $userId,
                'status' => 'proposal' 
            ];

            $this->model->create($researchData); 

            $this->redirect('/anggota-lab/research');
        
        } else {
             $this->redirect('/anggota-lab/research/create');
             return;
        }
    }


    /**
     * Menampilkan form untuk mengedit proposal riset.
     * (Handler untuk GET /research/{id}/edit)
     */
    public function edit($id)
    {
        $research = $this->model->getById($id); // Diubah
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$this->canUserManageProposal($research, $userId)) { // Menggunakan method private
            // Langsung redirect (tanpa flash message)
            $this->redirect('/anggota-lab/research');
            return; // Hentikan eksekusi
        }

        view('anggota_lab.research.edit', [
            'header' => 'Edit Research Project: ' . htmlspecialchars($research['title']),
            'research' => $research,
            'old' => [], // Kirim array kosong
            'errors' => [] // Kirim array kosong
        ]);
    }

    /**
     * Mengupdate proposal riset di database.
     * (Handler untuk POST /research/{id} dengan _method=PUT)
     */
    public function update($id)
    {
        // Style check disamakan
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PUT') {

            $data = $_POST;
            $userId = $_SESSION['user']['id'] ?? null;
            $errors = $this->validateProposal($data); // Menggunakan method private

            if (!empty($errors)) {
                // --- LOGIKA ERROR BARU ---
                // Jika validasi gagal, kita perlu ambil data $research lagi untuk me-render form
                $research = $this->model->getById($id); 
                view('anggota_lab.research.edit', [
                    'header' => 'Edit Research Project: ' . htmlspecialchars($research['title']),
                    'research' => $research, //
                    'errors' => $errors,     
                    'old' => $data          
                ]);
                return; 

            }

            $research = $this->model->getById($id); 

            if (!$this->canUserManageProposal($research, $userId)) { // Menggunakan method private
                $this->redirect('/anggota-lab/research');
                return;
            }

            $updateData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
            ];

            $this->model->update($id, $updateData); // Diubah
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

            $this->model->delete($id); // Diubah
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
        if ($research['primary_investigator_id'] != $userId) {
            return false;
        }
        if ($research['status'] !== 'proposal') {
            return false;
        }
        return true;
    }
}