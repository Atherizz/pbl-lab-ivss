<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class GaleryModel extends Model
{
    protected $tableName = 'galeries'; // Nama tabel untuk galeri

    /**
     * Mengambil semua item galeri dengan nama penulis.
     */
    public function getAllGalery()
    {
        $sql = "SELECT g.*, 
                       u.name as author_name
                FROM {$this->tableName} g
                LEFT JOIN users u ON g.author_id = u.id
                ORDER BY g.created_at DESC";

        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database Error in getAllGalery: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Mengecek apakah slug sudah ada (untuk mencegah duplikasi).
     */
    public function isSlugExists($slug, $excludeId = null)
    {
        $sql = "SELECT id FROM {$this->tableName} WHERE slug = :slug";
        $params = ['slug' => $slug];
        
        if ($excludeId) {
            $sql .= " AND id != :id";
            $params['id'] = $excludeId;
        }
        
        try {
            $query = $this->db->prepare($sql);
            $query->execute($params);
            return $query->fetch() !== false;
        } catch (\PDOException $e) {
            error_log("Database Error in isSlugExists: " . $e->getMessage());
            return true; // Asumsi ada error berarti slug dianggap sudah ada
        }
    }
    
    /**
     * Mengambil item galeri berdasarkan ID.
     */
    public function getById($id)
    {
        $sql = "SELECT g.*, 
                       u.name as author_name
                FROM {$this->tableName} g
                LEFT JOIN users u ON g.author_id = u.id
                WHERE g.id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database Error in getById: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Membuat item galeri baru.
     */
    public function createGalery($data)
    {
        $query = $this->db->prepare("
            INSERT INTO {$this->tableName} (caption, image_url, author_id, created_at, slug) 
            VALUES (:caption, :image_url, :author_id, :created_at, :slug)
        ");

        return $query->execute([
            'caption'      => $data['caption'],
            'image_url'    => $data['image_url'] ?? null,
            'author_id'    => $data['author_id'],
            'slug'         => $data['slug'],
            'created_at'   => $data['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Memperbarui item galeri.
     */
    public function updateGalery($id, $data)
    {
        $query = $this->db->prepare("
            UPDATE {$this->tableName} 
            SET caption = :caption, image_url = :image_url, updated_at = :updated_at, slug = :slug
            WHERE id = :id
        ");

        return $query->execute([
            'caption'      => $data['caption'],
            'image_url'    => $data['image_url'] ?? null,
            'updated_at'   => $data['updated_at'] ?? date('Y-m-d H:i:s'),
            'slug'         => $data['slug'],
            'id'           => $id
        ]);
    }

    /**
     * Menghapus item galeri.
     */
    public function deleteGalery($id)
    {
        $query = $this->db->prepare("DELETE FROM {$this->tableName} WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}