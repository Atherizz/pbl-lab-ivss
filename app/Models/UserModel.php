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

    public function getAllAnggotaLab()
    {
        $query = $this->db->prepare("SELECT * FROM users where role = :role");
        $query->execute(['role' => 'anggota_lab']);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByRegNumber($regNumber) {
        $query = $this->db->prepare("SELECT * FROM users WHERE reg_number = :reg_number");
        $query->execute(['reg_number' => $regNumber]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getById($id) {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkCredential($user)
    {
        $password = $user['password'];
        $result = $this->getByRegNumber($user['reg_number']);
        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }
    public function registerUser($data) {
        $query = $this->db->prepare("INSERT INTO users (name, reg_number, role, dospem_id) VALUES (:name, :reg_number, :role, :dospem_id)");
        return $query->execute(['name' => $data['name'], 'reg_number' => $data['reg_number'], 'role' => 'mahasiswa', 'dospem_id' => $data['dospem_id']]);
    }

    public function updateRegisteredUserPassword($password, $id) {
    $query = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
    return $query->execute([
        'password' => $password, 
        'id' => $id
    ]);
}

    public function createUser($data) {
        $query = $this->db->prepare("INSERT INTO users (name, reg_number, password, role, dospem_id) VALUES (:name, :reg_number, :password, :role, :dospem_id)");
        return $query->execute(['name' => $data['name'], 'reg_number' => $data['reg_number'], 'password' => $data['password'], 'role' => 'mahasiswa', 'dospem_id' => $data['dospem_id']]);
    }
}