<?php 
namespace App\Http\Services;

class UploadService {

    public $error = '';
     public function uploadImage($uploadDir, $fileInputName = 'image_file')
    {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] === UPLOAD_ERR_NO_FILE) {
            $this->error = "No file selected!";
            return false;
        }

        $file = $_FILES[$fileInputName];
        $target_file = $uploadDir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            $this->error = "File is not an image!";
            return false;
        }

        // Cek ukuran file (max 5MB)
        if ($file["size"] > 5 * 1024 * 1024) {
            $this->error = "Sorry, your file is too large! Maximum 5MB.";
            return false;
        }

        // Cek format file yang diizinkan
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedTypes)) {
            $this->error = "Only JPG, JPEG, PNG, and GIF are allowed!";
            return false;
        }

        // Cek apakah direktori ada dan writable
        if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
            $this->error = "Upload directory is not writable or does not exist: " . $uploadDir;
            return false;
        }

        // Generate unique filename untuk menghindari duplikat
        $uniqueName = time() . '_' . uniqid() . '.' . $imageFileType;
        $target_file = $uploadDir . $uniqueName;

        // Upload file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $uniqueName;
        } else {
            $this->error = "There was an error while uploading!";
            return false;
        }
    }

    public function deleteImage($uploadDir, $fileName)
    {
        if (empty($fileName)) {
            return true;
        }

        $filePath = $uploadDir . basename($fileName);
        
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        
        return true;
    }
}