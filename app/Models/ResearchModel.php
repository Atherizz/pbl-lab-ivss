<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class ResearchModel extends Model
{
    protected $table = 'research_projects';

    public function getAll(string $status = null, string $searchQuery = null)
    {
    $sql = "SELECT 
            r.*, 
            u_author.name AS author_name, 
            r.end_date AS publication_date  
        FROM {$this->table} r
        LEFT JOIN users u_author ON r.user_id = u_author.id 
        WHERE 1=1";

    $params = [];

    if ($status && $status !== 'all') {
        $sql .= " AND r.status = :status";
        $params['status'] = $status;
    }

    if ($searchQuery) {
        $sql .= " AND r.title ILIKE :searchQuery"; 
        $params['searchQuery'] = '%' . $searchQuery . '%';
    }

    $sql .= " ORDER BY r.id DESC";

    $query = $this->db->prepare($sql);
    $query->execute($params); 
    return $query->fetchAll(PDO::FETCH_ASSOC);
    }

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
        // Query ini juga mengambil data user pembuat dan dospem
        $sql = "SELECT r.*, 
                       u_user.name as user_name, 
                       u_dospem.name as dospem_name
                FROM {$this->table} r
                LEFT JOIN users u_user ON r.user_id = u_user.id
                LEFT JOIN users u_dospem ON r.dospem_id = u_dospem.id
                WHERE r.id = :id";
        $query = $this->db->prepare($sql);
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