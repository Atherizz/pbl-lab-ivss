<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class NewsModel extends Model
{

    public function getAllNews()
    {
        $sql = "SELECT n.*, 
                   u.name as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.id
            WHERE n.published_at IS NOT NULL
            ORDER BY n.published_at DESC";

        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database Error in getAllNews: " . $e->getMessage());
            return [];
        }
    }
    public function isSlugExists($slug, $excludeId = null)
    {
        if ($excludeId) {
            $query = $this->db->prepare("SELECT id FROM news WHERE slug = :slug AND id != :id");
            $query->execute(['slug' => $slug, 'id' => $excludeId]);
        } else {
            $query = $this->db->prepare("SELECT id FROM news WHERE slug = :slug");
            $query->execute(['slug' => $slug]);
        }

        return $query->fetch() !== false;
    }
    public function getById($id)
    {
        $sql = "SELECT n.*, 
                   u.name as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.id
            WHERE n.id = :id AND n.published_at IS NOT NULL";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database Error in getNewsById: " . $e->getMessage());
            return null;
        }
    }

    public function getBySlug($slug)
    {
        $sql = "SELECT n.*, 
                   u.name as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.id
            WHERE n.slug = :slug AND n.published_at IS NOT NULL";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['slug' => $slug]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database Error in getNewsById: " . $e->getMessage());
            return null;
        }
    }

    public function getRecentNews($limit = 3, $excludeId = null)
    {
        $excludeClause = $excludeId ? "AND n.id != :exclude_id" : "";

        $sql = "SELECT n.id, n.title, n.slug, n.image_url, n.published_at
            FROM news n
            WHERE n.published_at IS NOT NULL {$excludeClause}
            ORDER BY n.published_at DESC
            LIMIT :limit";

        try {
            $stmt = $this->db->prepare($sql);
            if ($excludeId) {
                $stmt->bindValue(':exclude_id', $excludeId, \PDO::PARAM_INT);
            }
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database Error in getRecentNews: " . $e->getMessage());
            return [];
        }
    }


    public function createNews($data)
    {
        $query = $this->db->prepare("
            INSERT INTO news (title, content, image_url, author_id, published_at, slug) 
            VALUES (:title, :content, :image_url, :author_id, :published_at, :slug)
        ");

        return $query->execute([
            'title'        => $data['title'],
            'content'      => $data['content'],
            'image_url'    => $data['image_url'] ?? null,
            'author_id'    => $data['author_id'],
            'slug'         => $data['slug'],
            'published_at' => $data['published_at'] ?? date('Y-m-d H:i:s')
        ]);
    }

    public function updateNews($id, $data)
    {
        $query = $this->db->prepare("
            UPDATE news 
            SET title = :title, content = :content, image_url = :image_url, published_at = :published_at ,slug = :slug
            WHERE id = :id
        ");

        return $query->execute([
            'title'        => $data['title'],
            'content'      => $data['content'],
            'image_url'    => $data['image_url'] ?? null,
            'published_at' => $data['published_at'],
            'slug'         => $data['slug'],
            'id'           => $id
        ]);
    }

    public function deleteNews($id)
    {
        $query = $this->db->prepare("DELETE FROM news WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}
