<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class UserModel extends Model
{

    public function getAllUsers()
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil semua user dengan role 'admin_lab' (Dosen Pembimbing)
     */
    public function getSupervisors()
    {
        // Asumsi 'admin_lab' adalah Dosen Pembimbing
        $sql = "SELECT id, name FROM users WHERE role = 'admin_lab' ORDER BY name";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkCredential($user)
    {
        $password = $user['password'];
        $result = $this->getByEmail($user); // getByEmail sudah mengambil dari $user['email']
        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }
    public function createUser($data)
    {
        $query = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        // Perbaiki: 'role' harus dari $data atau default yang sesuai
        $role = $data['role'] ?? 'anggota_lab'; // Sesuaikan default jika perlu
        return $query->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $role // Menggunakan role dari data atau default
        ]);
    }
}