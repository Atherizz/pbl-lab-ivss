<?php

namespace App\Models;

use App\Models\Model;
use PDO;
use Exception;

class UserModel extends Model
{   

    public function updateUserName($id, $newName)
    {
        if (empty($newName)) {
            return false;
        }

        $query = $this->db->prepare("UPDATE users SET name = :name WHERE id = :id");
        return $query->execute([
            'name' => $newName,
            'id' => $id
        ]);
    }

    public function updateUserPassword($id, $hashedPassword)
    {
        if (empty($hashedPassword)) {
            return false;
        }
        
        $query = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        return $query->execute([
            'password' => $hashedPassword,
            'id' => $id
        ]);
    }

    public function getAllUsers()
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAnggotaLab()
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE role IN (:role1, :role2)");

        $query->execute([
            'role1' => 'anggota_lab',
            'role2' => 'admin_lab'
        ]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByRegNumber($regNumber)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE reg_number = :reg_number");
        $query->execute(['reg_number' => $regNumber]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getById($id)
    {
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
    public function registerUser($data)
    {
        $query = $this->db->prepare("INSERT INTO users (name, reg_number, role, dospem_id) VALUES (:name, :reg_number, :role, :dospem_id)");
        return $query->execute(['name' => $data['name'], 'reg_number' => $data['reg_number'], 'role' => 'mahasiswa', 'dospem_id' => $data['dospem_id']]);
    }

    public function updateRegisteredUserPassword($password, $id)
    {
        $query = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        return $query->execute([
            'password' => $password,
            'id' => $id
        ]);
    }

    public function createMember($data)
    {
        try {
            // Mulai transaction
            $this->db->beginTransaction();

            // Insert user
            $query = $this->db->prepare("
            INSERT INTO users (name, reg_number, password, role) 
            VALUES (:name, :reg_number, :password, :role)
            RETURNING id
        ");

            $query->execute([
                'name' => $data['name'],
                'reg_number' => $data['reg_number'],
                'password' => $data['password'],
                'role' => $data['role']
            ]);

            if ($data['role'] == 'anggota_lab') {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $userId = $result['id'];

                // Insert lab_user_profiles
                $profileQuery = $this->db->prepare("
            INSERT INTO lab_user_profiles (user_id, slug) 
            VALUES (:user_id, :slug)
        ");

                $profileQuery->execute([
                    'user_id' => $userId,
                    'slug' => $data['slug']
                ]);
            }

            $this->db->commit();

            return $userId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function deleteUser($id)
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}
