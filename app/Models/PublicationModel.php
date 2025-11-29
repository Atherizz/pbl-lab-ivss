<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class PublicationModel extends Model
{
    protected $table = 'publications';
    public function getAll(int $userId = null, string $searchQuery = null)
    {
        $sql = "SELECT 
            p.*, 
            u.name AS author_name,
            u.role AS author_role
        FROM {$this->table} p
        LEFT JOIN users u ON p.user_id = u.id 
        WHERE 1=1";

        $params = [];

        if ($userId) {
            $sql .= " AND p.user_id = :user_id";
            $params['user_id'] = $userId;
        }

        if ($searchQuery) {
            $sql .= " AND (p.title ILIKE :searchQuery OR p.authors ILIKE :searchQuery)";
            $params['searchQuery'] = '%' . $searchQuery . '%';
        }

        $sql .= " ORDER BY p.year DESC, p.cited_by_count DESC";

        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get publications by user ID
     */
    public function getByUserId(int $userId)
    {
        $sql = "SELECT p.*
                FROM {$this->table} p
                WHERE p.user_id = :user_id
                ORDER BY p.year DESC, p.cited_by_count DESC";

        $query = $this->db->prepare($sql);
        $query->execute(['user_id' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get publication by citation_id (untuk cek duplikat)
     */
    public function getByCitationId(string $citationId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE citation_id = :citation_id";
        $query = $this->db->prepare($sql);
        $query->execute(['citation_id' => $citationId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create single publication
     */
    public function create(array $data)
    {
        $sql = "INSERT INTO {$this->table}
                    (user_id, title, authors, publication_venue, year, 
                     citation_id, scholar_link, cited_by_count, cited_by_link)
                VALUES
                    (:user_id, :title, :authors, :publication_venue, :year,
                     :citation_id, :scholar_link, :cited_by_count, :cited_by_link)";
        
        $query = $this->db->prepare($sql);
        
        return $query->execute([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'authors' => $data['authors'],
            'publication_venue' => $data['publication_venue'] ?? null,
            'year' => $data['year'] ?? null,
            'citation_id' => $data['citation_id'] ?? null,
            'scholar_link' => $data['scholar_link'] ?? null,
            'cited_by_count' => $data['cited_by_count'] ?? 0,
            'cited_by_link' => $data['cited_by_link'] ?? null
        ]);
    }

    public function bulkInsert(int $userId, array $articles)
    {
        if (empty($articles)) {
            return ['inserted' => 0, 'skipped' => 0];
        }

        $inserted = 0;
        $skipped = 0;

        foreach ($articles as $article) {
            $citationId = $article['citation_id'] ?? null;

            if ($citationId && $this->getByCitationId($citationId)) {
                $skipped++;
                continue;
            }

            $publicationData = [
                'user_id' => $userId,
                'title' => $article['title'] ?? '',
                'authors' => $article['authors'] ?? '',
                'publication_venue' => $article['publication'] ?? null,
                'year' => isset($article['year']) ? (int)$article['year'] : null,
                'citation_id' => $citationId,
                'scholar_link' => $article['link'] ?? null,
                'cited_by_count' => $article['cited_by']['value'] ?? 0,
                'cited_by_link' => $article['cited_by']['link'] ?? null
            ];

            if ($this->create($publicationData)) {
                $inserted++;
            } else {
                $skipped++;
            }
        }

        return [
            'inserted' => $inserted,
            'skipped' => $skipped,
            'total' => count($articles)
        ];
    }

    public function deleteByUserId(int $userId)
    {
        $sql = "DELETE FROM {$this->table} WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        return $query->execute(['user_id' => $userId]);
    }
}