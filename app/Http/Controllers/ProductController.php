<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use Exception;

class ProductController extends Controller
{
    private $model;
    private $uploadDir;
    public $uploadService;
    public $error = '';
    protected $itemsPerPage = 10;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('ProductModel');
        $this->uploadDir = __DIR__ . '/../../../public/uploads/products/';
        $this->uploadService = new UploadService();
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }
    
    public function index()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $allProducts = $this->model->getAllProducts() ?? [];
        $paginationData = pagination($this->itemsPerPage, $currentPage, $allProducts, 'products');
        view('admin_lab.products.index', $paginationData);
    }

    public function create()
    {
        view('admin_lab.products.create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $judul = trim($_POST['judul'] ?? '');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            $produkUrl = trim($_POST['produk_url'] ?? '');
            
            $produkType = array_filter((array)($_POST['produk_type'] ?? []));
            $featuresRaw = (array)($_POST['features'] ?? []);
            $features = array_filter($featuresRaw);
            
            $errors = [];

            if ($judul === '') {
                $errors[] = 'Judul wajib diisi.';
            }
            if ($deskripsi === '') {
                $errors[] = 'Deskripsi wajib diisi.';
            }

            $imageFileName = null;
            if (!empty($_FILES['image_file']['name'])) {
                $imageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                if (!$imageFileName) {
                    $errors[] = $this->uploadService->error;
                }
            } else {
                $errors[] = 'File gambar wajib diisi.';
            }

            $data = [
                'judul'         => $judul,
                'deskripsi'     => $deskripsi,
                'produk_url'    => $produkUrl === '' ? null : $produkUrl,
                'image_url'     => $imageFileName ? ('uploads/products/' . $imageFileName) : null,
                'produk_type'   => json_encode($produkType),
                'features'      => json_encode($features),
            ];

            if (!empty($errors)) {
                view('admin_lab.products.create', ['errors' => $errors, 'old_data' => $_POST]);
                return;
            }
            
            try {
                if ($this->model->createProduct($data)) {
                    set_flash('success', 'Produk berhasil dibuat!'); 
                    $this->redirect('/admin-lab/products');
                } else {
                    throw new Exception("Model mengembalikan false. Cek ProductModel::createProduct.");
                }
            } catch (Exception $e) {
                
                if($imageFileName) {
                    $this->uploadService->deleteImage($this->uploadDir, $imageFileName);
                }
                
                $errors[] = 'Gagal menyimpan data.';
                set_flash('error', 'Gagal membuat produk karena kesalahan database.'); 
                view('admin_lab.products.create', ['errors' => $errors, 'old_data' => $_POST]);
            }
        }
    }

    public function edit($id)
    {
        $product = $this->model->getProductById($id);

        if (!$product) {
            set_flash('error', 'Produk tidak ditemukan.');
            $this->redirect('/admin-lab/products');
            return;
        }
        
        $product['produk_type'] = json_decode($product['produk_type'] ?? '[]', true);
        $product['features'] = json_decode($product['features'] ?? '[]', true);

        view('admin_lab.products.edit', ['product' => $product]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $method_spoofing = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
            
            if ($method_spoofing === 'DELETE') {
                return $this->destroy($id);
            }

            if ($method_spoofing === 'PUT' || $id === 'store') {
                
                if ($id === 'store') {
                    return $this->store();
                }
                
                $product = $this->model->getProductById($id);

                if (!$product) {
                    set_flash('error', 'Produk tidak ditemukan.');
                    $this->redirect('/admin-lab/products');
                    return;
                }

                $judul = trim($_POST['judul'] ?? '');
                $deskripsi = trim($_POST['deskripsi'] ?? '');
                $produkUrl = trim($_POST['produk_url'] ?? '');
                
                $produkType = array_filter((array)($_POST['produk_type'] ?? []));
                $featuresRaw = (array)($_POST['features'] ?? []);
                $features = array_filter($featuresRaw);
                
                $errors = [];

                if (empty($judul) || empty($deskripsi)) {
                    $errors[] = 'Judul dan Deskripsi wajib diisi.';
                    
                    $old_data = array_merge(
                        $product,
                        $_POST,
                        [
                            'produk_type' => $produkType,
                            'features' => $features
                        ]
                    );
                    
                    view('admin_lab.products.edit', ['errors' => $errors, 'product' => $product, 'old_data' => $old_data]);
                    return;
                }

                $imageUrl = $product['image_url'] ?? null;
                $newImageFileName = null;

                if (!empty($_FILES['image_file']['name'])) {
                    $newImageFileName = $this->uploadService->uploadImage($this->uploadDir, 'image_file');
                    
                    if (!$newImageFileName) {
                        $errors[] = $this->uploadService->error;
                    } else {
                        if (!empty($product['image_url'])) {
                            $oldFileName = basename($product['image_url']);
                            $this->uploadService->deleteImage($this->uploadDir, $oldFileName);
                        }

                        $imageUrl = 'uploads/products/' . $newImageFileName;
                    }
                }
                
                if (!empty($errors)) {
                    $old_data = array_merge($product, $_POST, ['produk_type' => $produkType, 'features' => $features]);
                    view('admin_lab.products.edit', ['errors' => $errors, 'product' => $product, 'old_data' => $old_data]);
                    return;
                }

                $data = [
                    'judul'       => $judul,
                    'deskripsi'   => $deskripsi,
                    'produk_url'  => $produkUrl === '' ? null : $produkUrl,
                    'image_url'   => $imageUrl,
                    'produk_type' => json_encode($produkType),
                    'features'    => json_encode($features),
                ];
                
                try {
                    if ($this->model->updateProduct($id, $data)) {
                        set_flash('success', 'Produk berhasil diperbarui!');
                        $this->redirect('/admin-lab/products');
                    } else {
                        throw new Exception("Model mengembalikan false. Cek ProductModel::updateProduct.");
                    }
                } catch (Exception $e) {
                    
                    if($newImageFileName) {
                        $this->uploadService->deleteImage($this->uploadDir, $newImageFileName);
                    }
                    
                    $errors[] = 'Gagal memperbarui data.';
                    set_flash('error', 'Gagal memperbarui produk karena kesalahan database.');
                    view('admin_lab.products.edit', ['errors' => $errors, 'product' => $product]);
                }
            }
        }
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && (($_POST['_method'] ?? '') === 'DELETE' || isset($_POST['submit']))) {
            
            $product = $this->model->getProductById($id);

            if (!$product) {
                set_flash('error', 'Produk tidak ditemukan.');
                $this->redirect('/admin-lab/products');
                return;
            }
            
            if (!empty($product['image_url'])) {
                $fullPath = __DIR__ . '/../../../public/' . $product['image_url'];
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }

            try {
                if ($this->model->deleteProduct($id)) {
                    set_flash('success', 'Produk berhasil dihapus!');
                } else {
                    throw new Exception("Model mengembalikan false. Cek ProductModel::deleteProduct.");
                }
            } catch (Exception $e) {
                set_flash('error', 'Gagal menghapus produk karena kesalahan database.');
            }

            $this->redirect('/admin-lab/products');
        }
    }
}