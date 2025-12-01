<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class PublicationModel extends Model
{
    protected $table = 'publications';
    public function getAllByUserId(int $userId = null, string $searchQuery = null)
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

    public function getAllPaginated(
        int $limit,
        int $offset = 0,
        ?string $sortBy = 'citations',
        ?int $userId = null,
        ?string $searchQuery = null
    ): array {
        // Tentukan ORDER BY
        switch ($sortBy) {
            case 'latest':
                $orderBy = 'p.year DESC NULLS LAST';
                break;
            case 'oldest':
                $orderBy = 'p.year ASC NULLS LAST';
                break;
            case 'citations':
            default:
                $orderBy = 'p.cited_by_count DESC, p.year DESC NULLS LAST';
                break;
        }

        $sql = "SELECT 
                p.*, 
                u.name AS author_name,
                u.role AS author_role
            FROM {$this->table} p
            LEFT JOIN users u ON p.user_id = u.id
            WHERE 1=1";

        $params = [];

        if (!is_null($userId) && $userId > 0) {
            $sql .= " AND p.user_id = :user_id";
            $params['user_id'] = $userId;
        }

        if ($searchQuery) {
            $sql .= " AND (p.title ILIKE :searchQuery OR p.authors ILIKE :searchQuery)";
            $params['searchQuery'] = '%' . $searchQuery . '%';
        }

        $sql .= " ORDER BY {$orderBy}
              LIMIT :limit OFFSET :offset";

        $query = $this->db->prepare($sql);

        // bind params dinamis
        if (isset($params['user_id'])) {
            $query->bindValue(':user_id', $params['user_id'], PDO::PARAM_INT);
        }

        if (isset($params['searchQuery'])) {
            $query->bindValue(':searchQuery', $params['searchQuery'], PDO::PARAM_STR);
        }

        $query->bindValue(':limit',  (int) $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByUserId(int $userId): int
    {
        $sql = "SELECT COUNT(*) AS total
            FROM {$this->table}
            WHERE user_id = :user_id";

        $query = $this->db->prepare($sql);
        $query->execute([
            'user_id' => $userId
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return (int) ($result['total'] ?? 0);
    }

    public function countAll(?string $searchQuery = null): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} p WHERE 1=1";
        $params = [];

        if ($searchQuery) {
            $sql .= " AND (p.title ILIKE :searchQuery OR p.authors ILIKE :searchQuery)";
            $params['searchQuery'] = '%' . $searchQuery . '%';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }


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

    public function getByCitationId(string $citationId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE citation_id = :citation_id";
        $query = $this->db->prepare($sql);
        $query->execute(['citation_id' => $citationId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

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

    public function deleteAllByUserId(int $userId): int
    {
        $countSql = "SELECT COUNT(*) as total FROM {$this->table} WHERE user_id = :user_id";
        $countQuery = $this->db->prepare($countSql);
        $countQuery->execute(['user_id' => $userId]);
        $result = $countQuery->fetch(PDO::FETCH_ASSOC);
        $count = (int)($result['total'] ?? 0);

        $deleteSql = "DELETE FROM {$this->table} WHERE user_id = :user_id";
        $deleteQuery = $this->db->prepare($deleteSql);
        $deleteQuery->execute(['user_id' => $userId]);

        return $count;
    }
}
