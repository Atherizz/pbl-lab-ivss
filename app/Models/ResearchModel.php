<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class ResearchModel extends Model
{
    protected $table = 'research_projects';

    public function getByUserId($userId)
    {

        $sql = "SELECT r.*, u.name as dospem_name
                FROM {$this->table} r
                LEFT JOIN users u ON r.dospem_id = u.id
                WHERE r.user_id = :userId
                ORDER BY r.id DESC"; 
        $query = $this->db->prepare($sql);
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table}
                    (title, description, publication_url, status, user_id, dospem_id)
                VALUES
                    (:title, :description, :publication_url, :status, :user_id, :dospem_id)";
        $query = $this->db->prepare($sql);

        return $query->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_url' => $data['publication_url'],
            'status' => $data['status'],
            'user_id' => $data['user_id'],
            'dospem_id' => $data['dospem_id']
        ]);
    }

    /**
     * Update status research
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function updateStatus($id, $status)
    {

        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute([
            'id' => $id,
            'status' => $status
        ]);
    }


    public function update($id, $data)
    {
        if (!isset($id, $data)) return false;
        
        $sql = "UPDATE {$this->table} SET
                    title = :title,
                    description = :description,
                    publication_url = :publication_url,
                    dospem_id = :dospem_id
                WHERE id = :id";
        $query = $this->db->prepare($sql);

        return $query->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_url' => $data['publication_url'],
            'dospem_id' => $data['dospem_id'] 
        ]);
    }

    public function delete($id)
    {
        if (!isset($id)) return false;
        
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }
}