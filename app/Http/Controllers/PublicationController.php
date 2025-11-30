<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\ScholarService;

class PublicationController extends Controller
{
    private $userId;
    private $userProfileModel;
    private $model;

    private $scholarService;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('PublicationModel');
        $this->userProfileModel = $this->model('LabUserProfileModel');
        $this->userId = $_SESSION['user']['id'] ?? 0;
        $this->scholarService = new ScholarService();
    }

    public function index()
    {
        $scholarUrl = $this->userProfileModel->getScholarUrlByUserId($this->userId) ?? null;

        $itemsPerPage = 4;
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $currentSearch = $_GET['search'] ?? '';

        $allPublications = $this->model->getAllByUserId($this->userId, $currentSearch) ?? [];
        
        // Get all publications without search filter for stats
        $allPublicationsForStats = $this->model->getAllByUserId($this->userId, null) ?? [];

        $totalItems = count($allPublications);
        $totalPages = max(1, ceil($totalItems / $itemsPerPage));
        $currentPage = min($currentPage, $totalPages);

        $offset = ($currentPage - 1) * $itemsPerPage;
        $publications = array_slice($allPublications, $offset, $itemsPerPage);

        $startItem = $totalItems > 0 ? $offset + 1 : 0;
        $endItem = min($offset + $itemsPerPage, $totalItems);

        view(
            'anggota_lab.publications.index',
            [
                'scholarUrl' => $scholarUrl,
                'publications' => $publications,
                'allPublications' => $allPublicationsForStats,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
                'totalItems' => $totalItems,
                'itemsPerPage' => $itemsPerPage,
                'startItem' => $startItem,
                'endItem' => $endItem,
                'currentSearch' => $currentSearch
            ]
        );
    }

    public function setup()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/anggota-lab/publikasi');
            return;
        }

        try {
            $scholarUrl = trim($_POST['social_links']['google_scholar'] ?? '');

            if (empty($scholarUrl)) {
                $_SESSION['error'] = "URL Google Scholar tidak boleh kosong!";
                $this->redirect('/anggota-lab/publikasi');
                return;
            }

            $pattern = '/^https:\/\/scholar\.google\.com\/citations\?user=[a-zA-Z0-9_-]+(&.*)?$/';

            if (!preg_match($pattern, $scholarUrl)) {
                $_SESSION['error'] = "Format URL Google Scholar tidak valid! URL harus mengandung 'https://scholar.google.com/citations?user=...'";
                $this->redirect('/anggota-lab/publikasi');
                return;
            }

            $currentProfile = $this->userProfileModel->getProfileByUserId($this->userId);

            $currentSocialLinks = $currentProfile['social_links'] ?? [];

            if (is_string($currentSocialLinks)) {
                $currentSocialLinks = json_decode($currentSocialLinks, true) ?: [];
            }

            $newSocialLinks = array_merge(
                $currentSocialLinks,
                ['google_scholar' => $scholarUrl]
            );

            $updateResult = $this->userProfileModel->updateProfile([
                'social_links' => $newSocialLinks
            ], $this->userId);

            if ($updateResult) {
                $_SESSION['success'] = "URL Google Scholar berhasil disimpan!";
            } else {
                $_SESSION['error'] = "Gagal menyimpan URL Google Scholar.";
            }
        } catch (\Exception $e) {
            error_log("Error in setup: " . $e->getMessage());
            $_SESSION['error'] = "Terjadi kesalahan saat menyimpan data.";
        }

        $this->redirect('/anggota-lab/publikasi');
    }


    public function synchronize()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $scholarUrl = trim($_POST['scholar_url'] ?? '');
            $isGetAllPages = false;
            $errors = [];

            if ($scholarUrl === '') {
                $errors[] = 'URL kosong!';
            }

            if (!empty($errors)) {
                view('anggota_lab.publications.index', ['errors' => $errors]);
                return;
            }

            $scholarId = $this->scholarService->extractAuthorId($scholarUrl);

            if ($this->model->countByUserId($this->userId) === 0) {
                $isGetAllPages = true;
            }

            $authorArticle = $this->scholarService->getAuthorPublications($scholarId, $isGetAllPages);

            $this->model->bulkInsert($this->userId, $authorArticle['articles']);

            set_flash('success', 'Berhasil sinkronisasi Google Scholar!');

            $this->redirect('/anggota-lab/publikasi');
        }
    }

    public function destroyAllPublications()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deletedCount = $this->model->deleteAllByUserId($this->userId);
            
            if ($deletedCount > 0) {
                set_flash('success', "Berhasil menghapus {$deletedCount} publikasi.");
            } else {
                set_flash('error', 'Tidak ada publikasi yang dihapus.');
            }
            
            $this->redirect('/anggota-lab/publikasi');
        } else {
            $this->redirect('/anggota-lab/publikasi');
        }
    }
}
