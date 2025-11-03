<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class ResearchController extends Controller
{

    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            $this->redirect('/login'); 
        }

        $researchModel = $this->model('ResearchModel');
        $researchList = $researchModel->getByUserId($userId);

        view('mahasiswa.research.index', [
            'header' => 'My Research Projects',
            'researchList' => $researchList
        ]);
    }

    public function create()
    {
        $oldInput = $_SESSION['_flash']['old_input'] ?? [];
        $errors = $_SESSION['_flash']['errors'] ?? [];
        unset($_SESSION['_flash']['old_input'], $_SESSION['_flash']['errors']);

        view('mahasiswa.research.create', [
            'header' => 'Propose New Research Project',
            'old' => $oldInput,
            'errors' => $errors
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             $this->redirect('/research/create');
        }

        $data = $_POST;
        $userId = $_SESSION['user']['id'] ?? null;
        $errors = $this->validateProposal($data);

        if (!empty($errors)) {
            $this->flash('errors', $errors);
            $this->flash('old_input', $data);
            $this->redirect('/research/create'); 
        } else {

            $researchData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
                'primary_investigator_id' => $userId,
                'status' => 'proposal'
            ];

            $researchModel = $this->model('ResearchModel');
            if ($researchModel->create($researchData)) {
                $this->flash('success', 'Research proposal submitted successfully!');
            } else {
                $this->flash('error', 'Failed to submit proposal.');
            }
            $this->redirect('/mahasiswa/research');
        }
    }


    public function edit($id)
    {
        $researchModel = $this->model('ResearchModel');
        $research = $researchModel->getById($id);
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$this->canUserManageProposal($research, $userId)) {
            $this->flash('error', 'You are not authorized to edit this research or it is no longer a proposal.');
            $this->redirect('/mahasiswa/research');
        }

        $oldInput = $_SESSION['_flash']['old_input'] ?? [];
        $errors = $_SESSION['_flash']['errors'] ?? [];
        unset($_SESSION['_flash']['old_input'], $_SESSION['_flash']['errors']);

        view('research.edit', [
            'header' => 'Edit Research Project: ' . htmlspecialchars($research['title']),
            'research' => $research,
            'old' => $oldInput,
            'errors' => $errors
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['_method'] ?? '') !== 'PUT') {
            $this->redirect('/mahasiswa/research');
        }

        $data = $_POST;
        $userId = $_SESSION['user']['id'] ?? null;
        $errors = $this->validateProposal($data);

        if (!empty($errors)) {
            $this->flash('errors', $errors);
            $this->flash('old_input', $data);
            $this->redirect('/mahasiswa/research/' . $id . '/edit');
        } else {
            $researchModel = $this->model('ResearchModel');
            $research = $researchModel->getById($id);

            if (!$this->canUserManageProposal($research, $userId)) {
                $this->flash('error', 'Unauthorized action.');
                $this->redirect('/mahasiswa/research');
            }

            $updateData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'publication_url' => $data['publication_url'] ?? null,
            ];

            if ($researchModel->update($id, $updateData)) {
                $this->flash('success', 'Proposal updated successfully!');
            } else {
                $this->flash('error', 'Failed to update proposal.');
            }
            $this->redirect('/mahasiswa/research');
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             $this->redirect('/mahasiswa/research');
        }

        $userId = $_SESSION['user']['id'] ?? null;
        $researchModel = $this->model('ResearchModel');
        $research = $researchModel->getById($id);

        if (!$this->canUserManageProposal($research, $userId)) {
            $this->flash('error', 'You can only delete your own proposals.');
            $this->redirect('/mahasiswa/research');
        }

        if ($researchModel->delete($id)) {
            $this->flash('success', 'Proposal deleted successfully!');
        } else {
            $this->flash('error', 'Failed to delete proposal.');
        }
        $this->redirect('/mahasiswa/research');
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