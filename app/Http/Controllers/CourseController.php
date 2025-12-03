<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourseModel;

class CourseController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('CourseModel');
    }

    public function index()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $searchQuery = $_GET['search'] ?? null;
        
        $allCourses = $this->model->getAll($searchQuery);
        
        $paginationData = pagination(6, $currentPage, $allCourses, 'courses');
        $paginationData['currentSearch'] = $searchQuery;
        
        view('admin_lab.course.index', $paginationData);
    }

    public function create()
    {
        view('admin_lab.course.create', [
            'old' => [],
            'errors' => []
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin-lab/course'); // PERBAIKAN DISINI
            return;
        }

        $data = $_POST;
        $errors = $this->validateCourse($data);

        if (!empty($errors)) {
            view('admin_lab.course.create', [
                'old' => $data,
                'errors' => $errors
            ]);
            return;
        }

        $courseData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? '',
            'icon_name' => $data['icon_name'] ?? 'brain',
            'level' => $data['level'],
            'total_sessions' => (int)$data['total_sessions'],
            'action_url' => $data['action_url'] ?? '#'
        ];

        $this->model->create($courseData);
        // PERBAIKAN: Tambahkan '-lab'
        $this->redirect('/admin-lab/course'); 
    }

    public function edit($id)
    {
        $course = $this->model->getById($id);
        if (!$course) {
            $this->redirect('/admin-lab/course'); // PERBAIKAN DISINI
            return;
        }

        view('admin_lab.course.edit', [
            'course' => $course,
            'old' => [],
            'errors' => []
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin-lab/course'); // PERBAIKAN DISINI
            return;
        }

        $data = $_POST;
        $errors = $this->validateCourse($data);

        if (!empty($errors)) {
            $course = $this->model->getById($id);
            $course = array_merge($course, $data); 
            
            view('admin_lab.course.edit', [
                'course' => $course,
                'old' => $data,
                'errors' => $errors
            ]);
            return;
        }

        $courseData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? '',
            'icon_name' => $data['icon_name'],
            'level' => $data['level'],
            'total_sessions' => (int)$data['total_sessions'],
            'action_url' => $data['action_url']
        ];

        $this->model->update($id, $courseData);
        // PERBAIKAN: Tambahkan '-lab'
        $this->redirect('/admin-lab/course');
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin-lab/course'); // PERBAIKAN DISINI
            return;
        }

        $this->model->delete($id);
        // PERBAIKAN: Tambahkan '-lab'
        $this->redirect('/admin-lab/course');
    }

    private function validateCourse($data)
    {
        $errors = [];

        if (empty(trim($data['title'] ?? ''))) {
            $errors['title'] = 'Nama Course (Title) wajib diisi.';
        }

        if (empty(trim($data['level'] ?? ''))) {
            $errors['level'] = 'Level wajib dipilih (Beginner/Intermediate).';
        }

        if (empty($data['total_sessions']) || !is_numeric($data['total_sessions'])) {
            $errors['total_sessions'] = 'Jumlah pertemuan harus berupa angka.';
        }

        return $errors;
    }
}