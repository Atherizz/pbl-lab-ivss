<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class DatasetModel extends Model
{
    protected $table = 'datasets';

    /**
     * Mengambil semua dataset dengan filter pencarian
     */
    public function getAll($searchQuery = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];

        if ($searchQuery) {
            // Cari di title, description, atau tags
            $sql .= " AND (title ILIKE :search OR description ILIKE :search OR tags::text ILIKE :search)";
            $params['search'] = '%' . $searchQuery . '%';
        }

        $sql .= " ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil satu dataset berdasarkan ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Membuat dataset baru
     * (Kolom file_url dihapus)
     */
    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (title, description, urls, tags)
                VALUES (:title, :description, :urls, :tags)";
        $query = $this->db->prepare($sql);
        
        return $query->execute([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'urls' => $data['urls'], // JSON string
            'tags' => $data['tags'] // PostgreSQL Array string
        ]);
    }

    /**
     * Mengupdate dataset
     * (Kolom file_url dihapus)
     */
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET
                    title = :title,
                    description = :description,
                    urls = :urls,
                    tags = :tags
                WHERE id = :id";
        $query = $this->db->prepare($sql);

        return $query->execute([
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'urls' => $data['urls'],
            'tags' => $data['tags']
        ]);
    }

    /**
     * Menghapus dataset
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }

    /**
     * Helper untuk mengubah string "tag1, tag2" menjadi array Psql
     */
    public function formatTags($tagString)
    {
        if (empty($tagString)) {
            return null;
        }
        $tags = array_map('trim', explode(',', $tagString));
        $tags = array_filter($tags); 
        if (empty($tags)) {
            return null;
        }

        $cleanTags = array_map(function($tag) {
            return str_replace(['{', '}', '"'], '', $tag);
        }, $tags);
        
        return '{' . implode(',', $cleanTags) . '}';
    }
}