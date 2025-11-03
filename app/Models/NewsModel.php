<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class NewsModel extends Model
{

    public function getAllNews()
    {
        $query = $this->db->prepare("SELECT * FROM news ORDER BY published_at DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createNews($data)
    {
        $query = $this->db->prepare("
            INSERT INTO news (title, content, image_url, author_id, published_at) 
            VALUES (:title, :content, :image_url, :author_id, :published_at)
        ");
        
        return $query->execute([
            'title'        => $data['title'], 
            'content'      => $data['content'], 
            'image_url'    => $data['image_url'] ?? null, 
            'author_id'    => $data['author_id'],
            'published_at' => $data['published_at'] ?? date('Y-m-d H:i:s') 
        ]);
    }

    public function updateNews($id, $data)
    {
        $query = $this->db->prepare("
            UPDATE news 
            SET title = :title, content = :content, image_url = :image_url, published_at = :published_at
            WHERE id = :id
        ");
        
        return $query->execute([
            'title'        => $data['title'],
            'content'      => $data['content'],
            'image_url'    => $data['image_url'] ?? null,
            'published_at' => $data['published_at'],
            'id'           => $id
        ]);
    }

    public function deleteNews($id)
    {
        $query = $this->db->prepare("DELETE FROM news WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}