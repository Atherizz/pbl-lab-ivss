<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class CourseModel extends Model
{
    protected $table = 'courses';

    /**
     * Mengambil semua courses dengan filter pencarian
     * KHUSUS POSTGRESQL: Menggunakan ILIKE agar pencarian tidak sensitif huruf besar/kecil
     */
    public function getAll($searchQuery = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];

        if ($searchQuery) {
            // Pakai ILIKE (PostgreSQL specific)
            $sql .= " AND (title ILIKE :search OR description ILIKE :search OR level ILIKE :search)";
            $params['search'] = '%' . $searchQuery . '%';
        }

        $sql .= " ORDER BY created_at DESC"; 
        $query = $this->db->prepare($sql);
        $query->execute($params);
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * CREATE DINAMIS
     * ID tidak perlu dimasukkan karena sudah SERIAL (Auto Increment di Postgres)
     * created_at & updated_at akan otomatis terisi DEFAULT CURRENT_TIMESTAMP dari database
     */
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (title, description, icon_name, level, total_sessions, action_url)
                VALUES (:title, :description, :icon_name, :level, :total_sessions, :action_url)";
        
        $query = $this->db->prepare($sql);
        
        return $query->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'icon_name' => $data['icon_name'],
            'level' => $data['level'],
            'total_sessions' => $data['total_sessions'],
            'action_url' => $data['action_url']
        ]);
    }

    /**
     * UPDATE DINAMIS
     * KHUSUS POSTGRESQL: Kita tambahkan 'updated_at = NOW()' 
     * karena Postgres tidak punya fitur 'ON UPDATE CURRENT_TIMESTAMP' otomatis seperti MySQL.
     */
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET
                    title = :title,
                    description = :description,
                    icon_name = :icon_name,
                    level = :level,
                    total_sessions = :total_sessions,
                    action_url = :action_url,
                    updated_at = NOW() 
                WHERE id = :id";
                
        $query = $this->db->prepare($sql);

        return $query->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'icon_name' => $data['icon_name'],
            'level' => $data['level'],
            'total_sessions' => $data['total_sessions'],
            'action_url' => $data['action_url']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }
}