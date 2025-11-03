<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResearchModel; // Pastikan model di-import

class ResearchController extends Controller
{
    /**
     * Properti untuk menyimpan instance ResearchModel.
     */
    protected $researchModel;

    /**
     * Constructor untuk inisiasi model.
     */
    public function __construct()
    {
        // Inisiasi model di constructor
        // Method model() di-inherit dari parent Controller
        $this->researchModel = $this->model('ResearchModel');
    }

    /**
     * Menampilkan daftar riset yang dimiliki oleh mahasiswa yang sedang login.
     * (Handler untuk GET /research)
     */
    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login'); 
        }

        // Gunakan model yang sudah diinisiasi
        $researchList = $this->researchModel->getByUserId($userId);

        view('mahasiswa.research.index', [
            'header' => 'My Research Projects',
            'researchList' => $researchList
        ]);
    }

    /**
     * Menampilkan form untuk membuat proposal riset baru.
     * (Handler untuk GET /research/create)
     */
    public function create()
    {
        // Tidak perlu kirim error/old di GET request
        view('mahasiswa.research.create', [
            'header' => 'Propose New Research Project',
            'old' => [], // Kirim array kosong
            'errors' => [] // Kirim array kosong
        ]);
    }

    /**
     * Menyimpan proposal riset baru ke database.
     * (Handler untuk POST /research)
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             $this->redirect('/mahasiswa/research/create');
             return;
        }

        $data = $_POST;
        $userId = $_SESSION['user']['id'] ?? null;
        $errors = $this->validateProposal($data);

        if (!empty($errors)) {
            // --- LOGIKA ERROR BARU ---
            // Jika validasi gagal, render ulang view 'create' dengan data error dan input lama
            view('mahasiswa.research.create', [
                'header' => 'Propose New Research Project',
                'errors' => $errors,
                'old' => $data // Kirim kembali data POST
            ]);
            return; // Hentikan eksekusi
            // -------------------------
        } 
            
        // Validasi berhasil, siapkan data untuk model
        $researchData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_url' => $data['publication_url'] ?? null,
            'primary_investigator_id' => $userId,
            'status' => 'proposal' // Paksa status 'proposal' untuk mahasiswa
        ];

        // Gunakan model yang sudah diinisiasi
        $this->researchModel->create($researchData); 
        
        // Langsung redirect (tanpa flash message)
        $this->redirect('/mahasiswa/research');
    }


    /**
     * Menampilkan form untuk mengedit proposal riset.
     * (Handler untuk GET /research/{id}/edit)
     */
    public function edit($id)
    {
        $research = $this->researchModel->getById($id);
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$this->canUserManageProposal($research, $userId)) {
            // Langsung redirect (tanpa flash message)
            $this->redirect('/mahasiswa/research');
            return; // Hentikan eksekusi
        }

        view('mahasiswa.research.edit', [
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['_method'] ?? '') !== 'PUT') {
            $this->redirect('/mahasiswa/research');
            return;
        }

        $data = $_POST;
        $userId = $_SESSION['user']['id'] ?? null;
        $errors = $this->validateProposal($data);

        if (!empty($errors)) {
            // --- LOGIKA ERROR BARU ---
            // Jika validasi gagal, kita perlu ambil data $research lagi untuk me-render form
            $research = $this->researchModel->getById($id);
            
            view('mahasiswa.research.edit', [
                'header' => 'Edit Research Project: ' . htmlspecialchars($research['title']),
                'research' => $research, // Data asli
                'errors' => $errors,     // Error validasi
                'old' => $data         // Input yang gagal
            ]);
            return; // Hentikan eksekusi
            // -------------------------
        } 
            
        $research = $this->researchModel->getById($id);

        if (!$this->canUserManageProposal($research, $userId)) {
            $this->redirect('/mahasiswa/research');
            return;
        }

        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_url' => $data['publication_url'] ?? null,
        ];

        $this->researchModel->update($id, $updateData);
        $this->redirect('/mahasiswa/research');
    }

    /**
     * Menghapus proposal riset dari database.
     * (Handler untuk POST /research/{id}/delete)
     */
    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             $this->redirect('/mahasiswa/research');
             return;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        $research = $this->researchModel->getById($id);

        if (!$this->canUserManageProposal($research, $userId)) {
            $this->redirect('/mahasiswa/research');
            return;
        }

        $this->researchModel->delete($id);
        $this->redirect('/mahasiswa/research');
    }

    /**
     * Validasi data proposal (sederhana).
     * @return array Array berisi pesan error, kosong jika valid.
     */
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

    /**
     * Helper untuk cek otorisasi.
     * Cek jika riset ada, milik user, dan statusnya 'proposal'.
     */
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
