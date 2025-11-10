<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class RegistrationRequestModel extends Model
{
    protected $table = 'registration_requests';

    public function getAllRequests()
    {
        $query = $this->db->prepare("
            SELECT rr.*, u.name as dospem_name 
            FROM {$this->table} rr
            LEFT JOIN users u ON rr.dospem_id = u.id
            ORDER BY rr.created_at DESC
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRequestsByDospem($dospemId)
    {
        $query = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE dospem_id = :dospem_id 
            ORDER BY created_at DESC
        ");
        $query->execute(['dospem_id' => $dospemId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->prepare("
            SELECT rr.*, u.name as dospem_name 
            FROM {$this->table} rr
            LEFT JOIN users u ON rr.dospem_id = u.id
            WHERE rr.id = :id
        ");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getByNim($nim)
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE nim = :nim");
        $query->execute(['nim' => $nim]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createRequest($data)
    {
        $query = $this->db->prepare("
            INSERT INTO {$this->table} 
            (nim, name, password, dospem_id, registration_purpose, status) 
            VALUES (:nim, :name, :password, :dospem_id, :registration_purpose, :status)
        ");
        
        return $query->execute([
            'nim' => $data['nim'],
            'name' => $data['name'],
            'password' => $data['password'],
            'dospem_id' => $data['dospem_id'],
            'registration_purpose' => $data['registration_purpose'],
            'status' => 'pending_approval'
        ]);
    }

    public function updateStatus($id, $status, $rejectionReason = null)
    {
        if ($rejectionReason) {
            $query = $this->db->prepare("
                UPDATE {$this->table} 
                SET status = :status, rejection_reason = :rejection_reason 
                WHERE id = :id
            ");
            return $query->execute([
                'id' => $id,
                'status' => $status,
                'rejection_reason' => $rejectionReason
            ]);
        } else {
            $query = $this->db->prepare("
                UPDATE {$this->table} 
                SET status = :status 
                WHERE id = :id
            ");
            return $query->execute([
                'id' => $id,
                'status' => $status
            ]);
        }
    }

    public function deleteRequest($id)
    {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

}
