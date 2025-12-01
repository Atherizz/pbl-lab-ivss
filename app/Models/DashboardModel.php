<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class DashboardModel extends Model
{
    // Konfigurasi nama tabel - SESUAI DATABASE ANDA
    protected $researchTable = 'research_projects';
    protected $bookingTable = 'equipment_bookings';
    protected $equipmentTable = 'equipment';
    protected $userTable = 'users';
    protected $newsTable = 'news';
    protected $registrationTable = 'registration_requests';

    // ===========================================
    // LOGIKA UNTUK ANGGOTA LAB (Dipanggil oleh Controller: index)
    // ===========================================
    public function getAnggotaLabStats($userId)
    {
        // 1. Riset Aktif (Sesuai Kartu Dashboard: Approved atau sedang berjalan)
        $activeResearch = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM {$this->researchTable}
            WHERE user_id = :user_id 
            AND status IN ('approved_by_dospem', 'approved_by_head', 'active')
        ");
        $activeResearch->execute(['user_id' => $userId]);
        $activeResearchCount = $activeResearch->fetch(PDO::FETCH_ASSOC)['count'];

        // 2. Peminjaman Aktif (Sesuai Kartu Dashboard: Approved, BUKAN pending/returned)
        $activeBorrowings = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM {$this->bookingTable}
            WHERE user_id = :user_id 
            AND status = 'approved'
        ");
        $activeBorrowings->execute(['user_id' => $userId]);
        $activeBorrowingsCount = $activeBorrowings->fetch(PDO::FETCH_ASSOC)['count'];
        
        // 3. Kontribusi Publikasi (Completed)
        $publications = $this->db->prepare("SELECT COUNT(*) as count FROM {$this->researchTable} WHERE user_id = :user_id AND status = 'completed'");
        $publications->execute(['user_id' => $userId]);
        $publicationsCount = $publications->fetch(PDO::FETCH_ASSOC)['count'];
        
        // 4. Total Aktivitas (Penghitungan agregat sederhana: total riset + total peminjaman)
        $totalActivities = $this->db->prepare("
            SELECT (
                (SELECT COUNT(*) FROM {$this->researchTable} WHERE user_id = :user_id) +
                (SELECT COUNT(*) FROM {$this->bookingTable} WHERE user_id = :user_id)
            ) as count
        ");
        $totalActivities->execute(['user_id' => $userId]);
        $totalActivitiesCount = $totalActivities->fetch(PDO::FETCH_ASSOC)['count'];
        
        // 5. Perubahan Riset (Untuk badge +N, dihitung dari 30 hari terakhir)
        $researchChange = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM {$this->researchTable}
            WHERE user_id = :user_id 
            AND start_date >= CURRENT_DATE - INTERVAL '30 days'
        ");
        $researchChange->execute(['user_id' => $userId]);
        $researchChangeCount = $researchChange->fetch(PDO::FETCH_ASSOC)['count'];
        
        // 6. Data Pending (Dipertahankan untuk API refresh)
        $pendingResearch = $this->db->prepare("SELECT COUNT(*) as count FROM {$this->researchTable} WHERE user_id = :user_id AND status = 'pending_approval'");
        $pendingResearch->execute(['user_id' => $userId]);
        $pendingResearchCount = $pendingResearch->fetch(PDO::FETCH_ASSOC)['count'];
        
        $pendingBorrowings = $this->db->prepare("SELECT COUNT(*) as count FROM {$this->bookingTable} WHERE user_id = :user_id AND status = 'pending_approval'");
        $pendingBorrowings->execute(['user_id' => $userId]);
        $pendingBorrowingsCount = $pendingBorrowings->fetch(PDO::FETCH_ASSOC)['count'];

        return [
            'active_research' => (int) $activeResearchCount,
            'active_borrowings' => (int) $activeBorrowingsCount,
            'publications' => (int) $publicationsCount,
            'total_activities' => (int) $totalActivitiesCount,
            'research_change' => (int) $researchChangeCount, 
            'pending_research' => (int) $pendingResearchCount,
            'pending_borrowings' => (int) $pendingBorrowingsCount,
        ];
    }

    public function getActiveBorrowings($userId)
    {
        // Mengambil peminjaman yang sedang dalam proses atau sudah selesai (untuk riwayat/status)
        $sql = "SELECT eb.id, eb.status, eb.start_date, eb.end_date, e.name as equipment_name FROM {$this->bookingTable} eb JOIN {$this->equipmentTable} e ON eb.equipment_id = e.id WHERE eb.user_id = :user_id AND eb.status IN ('pending_approval', 'approved', 'returned') ORDER BY eb.start_date DESC LIMIT 5";
        $query = $this->db->prepare($sql);
        $query->execute(['user_id' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentResearch($userId, $limit = 5)
    {
        // Mengambil riset terbaru (untuk riwayat)
        $sql = "SELECT id, title, status, start_date as created_at FROM {$this->researchTable} WHERE user_id = :user_id ORDER BY start_date DESC LIMIT :limit";
        $query = $this->db->prepare($sql);
        $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentActivities($userId, $limit = 10)
    {
        // Menggabungkan riset dan peminjaman untuk aktivitas
        $sql = "(SELECT 'research' as type, id, title as description, status, start_date as created_at FROM {$this->researchTable} WHERE user_id = :user_id) UNION ALL (SELECT 'borrowing' as type, eb.id, CONCAT('Peminjaman ', e.name) as description, eb.status, eb.start_date as created_at FROM {$this->bookingTable} eb JOIN {$this->equipmentTable} e ON eb.equipment_id = e.id WHERE eb.user_id = :user_id) ORDER BY created_at DESC LIMIT :limit";
        $query = $this->db->prepare($sql);
        $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // ===========================================
    // LOGIKA UNTUK ADMIN LAB (Dipanggil oleh Controller: index)
    // ===========================================

    public function getAdminLabStats()
    {
        $activeMembers = $this->db->query("SELECT COUNT(*) FROM {$this->userTable} WHERE role IN ('anggota_lab', 'mahasiswa') AND account_status = 'active'")->fetchColumn();
        $totalEquipment = $this->db->query("SELECT COUNT(*) FROM {$this->equipmentTable}")->fetchColumn();
        $publicResearch = $this->db->query("SELECT COUNT(*) FROM {$this->researchTable} WHERE status = 'completed'")->fetchColumn();
        $pendingMembers = $this->db->query("SELECT COUNT(*) FROM {$this->registrationTable} WHERE status = 'pending_approval'")->fetchColumn();
        $pendingResearch = $this->db->query("SELECT COUNT(*) FROM {$this->researchTable} WHERE status = 'pending_approval'")->fetchColumn();
        $pendingBorrowings = $this->db->query("SELECT COUNT(*) FROM {$this->bookingTable} WHERE status = 'pending_approval'")->fetchColumn();

        return [
            'total_alat' => (int) $totalEquipment,
            'riset_publik' => (int) $publicResearch,
            'anggota_lab' => (int) $activeMembers,
            'total_approval' => (int) ($pendingMembers + $pendingResearch + $pendingBorrowings),
        ];
    }

    public function getPendingMemberApprovals()
    {
        $sql = "SELECT name, nim FROM {$this->registrationTable} WHERE status = 'pending_approval' ORDER BY id DESC LIMIT 5";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingPublicationApprovals()
    {
        $sql = "SELECT p.id, p.title, p.start_date as created_at, u.name as author_name FROM {$this->researchTable} p JOIN {$this->userTable} u ON p.user_id = u.id WHERE p.status = 'pending_approval' ORDER BY p.start_date DESC LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingBorrowingApprovals()
    {
        $sql = "SELECT eb.id, eb.start_date as borrowed_at, eb.end_date as return_by, e.name as equipment_name, u.name as borrower_name FROM {$this->bookingTable} eb JOIN {$this->equipmentTable} e ON eb.equipment_id = e.id JOIN {$this->userTable} u ON eb.user_id = u.id WHERE eb.status = 'pending_approval' ORDER BY eb.start_date DESC LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLabRecentActivities($limit = 10)
    {
        $sql = "(SELECT 'research' as type, r.id, CONCAT(u.name, ' - ', r.title) as description, r.status, r.start_date as created_at FROM {$this->researchTable} r JOIN {$this->userTable} u ON r.user_id = u.id) UNION ALL (SELECT 'borrowing' as type, eb.id, CONCAT(u.name, ' meminjam ', e.name) as description, eb.status, eb.start_date as created_at FROM {$this->bookingTable} eb JOIN {$this->equipmentTable} e ON eb.equipment_id = e.id JOIN {$this->userTable} u ON eb.user_id = u.id) ORDER BY created_at DESC LIMIT :limit";
        $query = $this->db->prepare($sql);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEquipmentStats()
    {
        return $this->db->query("SELECT status, COUNT(*) as count FROM {$this->equipmentTable} GROUP BY status")->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===========================================
    // LOGIKA UNTUK ADMIN BERITA (Dipanggil oleh Controller: index)
    // ===========================================

    public function getNewsStats($userId)
    {
        $draft = $this->db->prepare("SELECT COUNT(*) FROM {$this->newsTable} WHERE author_id = :user_id AND published_at IS NULL");
        $draft->execute(['user_id' => $userId]);
        $draftCount = $draft->fetchColumn();

        $published = $this->db->prepare("SELECT COUNT(*) FROM {$this->newsTable} WHERE author_id = :user_id AND published_at IS NOT NULL");
        $published->execute(['user_id' => $userId]);
        $publishedCount = $published->fetchColumn();

        return [
            'total_draft' => (int) $draftCount,
            'total_published' => (int) $publishedCount,
            'total_views' => 0
        ];
    }

    public function getRecentNews($userId, $limit = 10)
    {
        $sql = "SELECT id, title, CASE WHEN published_at IS NOT NULL THEN 'published' ELSE 'draft' END as status, published_at FROM {$this->newsTable} WHERE author_id = :user_id ORDER BY published_at DESC NULLS LAST LIMIT :limit";
        $query = $this->db->prepare($sql);
        $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsViewsStats($userId)
    {
        return [];
    }
}