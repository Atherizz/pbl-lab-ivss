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

    // --- FUNGSI BARU UNTUK APPROVAL ---

    /**
     * Helper private untuk update status secara internal.
     */
    private function updateStatus($id, $newStatus)
    {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['status' => $newStatus, 'id' => $id]);
    }

    /**
     * Menyetujui proposal oleh Dosen Pembimbing.
     * Hanya berhasil jika status = 'pending_approval' DAN dospemId-nya cocok.
     *
     * @param int $researchId ID riset
     * @param int $dospemId ID user Dosen Pembimbing yang sedang login
     * @return bool True jika berhasil, false jika gagal (status/dospem salah)
     */
    public function approveByDospem($researchId, $dospemId)
    {
        $research = $this->getById($researchId);

        if (!$research) {
            return false; // Riset tidak ditemukan
        }

        // Cek 1: Apakah statusnya sedang menunggu Dospem?
        // Cek 2: Apakah user yang menyetujui adalah Dospem yang ditugaskan?
        if ($research['status'] === 'pending_approval' && $research['dospem_id'] == $dospemId) {
            // Lolos, update status ke 'approved_by_dospem' (menunggu Ketua Lab)
            return $this->updateStatus($researchId, 'approved_by_dospem');
        }

        return false; // Gagal (status salah atau bukan dospem-nya)
    }

    /**
     * Menyetujui proposal oleh Ketua Lab.
     * Hanya berhasil jika status = 'approved_by_dospem'.
     * Controller-lah yang harus memverifikasi bahwa user ini adalah Ketua Lab.
     *
     * @param int $researchId ID riset
     * @return bool True jika berhasil, false jika gagal (status salah)
     */
    public function approveByHeadOfLab($researchId)
    {
        $research = $this->getById($researchId);

        if (!$research) {
            return false; // Riset tidak ditemukan
        }

        // Cek 1: Apakah statusnya sedang menunggu Ketua Lab?
        if ($research['status'] === 'approved_by_dospem') {
            // Lolos, update status ke 'approved_by_head' (final)
            // Anda bisa ganti 'approved_by_head' ke 'active' jika mau
            return $this->updateStatus($researchId, 'approved_by_head');
        }

        return false; // Gagal (status salah)
    }

    /**
     * Menolak proposal (bisa oleh Dospem atau Ketua Lab).
     *
     * @param int $researchId ID riset
     * @return bool True jika berhasil, false jika gagal (misal sudah final)
     */
    public function reject($researchId)
    {
        $research = $this->getById($researchId);

        if (!$research) {
            return false; // Riset tidak ditemukan
        }

        // Jangan reject jika sudah disetujui final atau sudah di-reject
        if (in_array($research['status'], ['approved_by_head', 'completed', 'rejected'])) {
            return false;
        }

        // Set status ke 'rejected'
        return $this->updateStatus($researchId, 'rejected');
    }
}