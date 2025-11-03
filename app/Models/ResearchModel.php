<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class ResearchModel extends Model
{
    protected $table = 'research_projects';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE primary_investigator_id = :userId 
                ORDER BY created_at DESC";
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
                    (title, description, publication_url, status, primary_investigator_id) 
                VALUES 
                    (:title, :description, :publication_url, :status, :primary_investigator_id)";
        $query = $this->db->prepare($sql);
        
        return $query->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_url' => $data['publication_url'],
            'status' => $data['status'],
            'primary_investigator_id' => $data['primary_investigator_id']
        ]);
    }


    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET 
                    title = :title, 
                    description = :description, 
                    publication_url = :publication_url 
                WHERE id = :id";
        $query = $this->db->prepare($sql);

        return $query->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_url' => $data['publication_url']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }
}