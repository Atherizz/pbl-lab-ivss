<?php
namespace App\Models;

class LabUserProfileModel extends Model 
{
    protected $table = 'lab_user_profiles';
    
    /**
     * Mengambil profil lengkap berdasarkan user_id
     */
    public function getProfileByUserId(int $userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        
        try {
            $stmt = $this->db->prepare($sql); 
            $stmt->execute([$userId]);
            $profile = $stmt->fetch(\PDO::FETCH_ASSOC); 
            
        } catch (\PDOException $e) {
            error_log("Database Error in getProfileByUserId: " . $e->getMessage());
            return null; 
        }

        if ($profile) {
            // Decode JSON columns agar bisa dipakai sebagai array di PHP
            $profile['social_links']   = json_decode($profile['social_links'] ?? '{}', true);
            $profile['research_focus'] = json_decode($profile['research_focus'] ?? '[]', true);
            $profile['educations']     = json_decode($profile['educations'] ?? '[]', true);
            $profile['certifications'] = json_decode($profile['certifications'] ?? '[]', true);
        }
        
        return $profile ?: null;
    }

    /**
     * [BARU] Mengambil semua anggota lab (User + Profil) untuk Landing Page REZA
     */
    public function getAllMembers()
    {
        // Join tabel users dan lab_user_profiles
        // Mengambil user dengan role 'anggota_lab' atau 'admin_lab'
        $sql = "SELECT 
                    u.id, 
                    u.name, 
                    u.role, 
                    p.photo_url, 
                    p.nip, 
                    p.nidn, 
                    p.major,
                    p.research_focus
                FROM users u 
                LEFT JOIN {$this->table} p ON u.id = p.user_id 
                WHERE u.role IN ('anggota_lab', 'admin_lab') 
                ORDER BY 
                    CASE WHEN u.role = 'admin_lab' THEN 1 ELSE 2 END, -- Admin/Kepala Lab di urutan pertama
                    u.name ASC"; 
        
        try {
            $stmt = $this->db->query($sql);
            $members = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Decode research_focus jika ingin menampilkan tag keahlian
            foreach ($members as &$member) {
                $member['research_focus'] = json_decode($member['research_focus'] ?? '[]', true);
            }

            return $members;
        } catch (\PDOException $e) {
            error_log("Database Error in getAllMembers: " . $e->getMessage());
            return [];
        }
    }
    // end of getAllMembers
    
    /**
     * Helper untuk menyiapkan data sebelum insert/update
     */
    private function prepareData(array $data, int $userId): array
    {
        $socialLinks = $data['social_links'] ?? [];

        $prepared = [
            'user_id'          => $userId,
            'nip'              => $data['nip'] ?? null,
            'nidn'             => $data['nidn'] ?? null,
            'major'            => $data['major'] ?? null,
            'email'            => $data['email'] ?? null,
            'photo_url'        => $data['photo_url'] ?? null,
            
            // Encode array ke JSON sebelum disimpan ke DB
            'social_links'     => json_encode($socialLinks),
            'research_focus'   => json_encode($data['research_focus'] ?? []),
            'educations'       => json_encode($data['educations'] ?? []), 
            'certifications'   => json_encode($data['certifications'] ?? []),
        ];

        // Filter null value kecuali kolom JSON
        return array_filter($prepared, fn($value, $key) => $value !== null || 
            in_array($key, ['social_links', 'research_focus', 'educations', 'certifications']), 
            ARRAY_FILTER_USE_BOTH);
    }
    
    /**
     * Membuat profil baru
     */
    public function createProfile(array $data, int $userId): bool
    {
        $preparedData = $this->prepareData($data, $userId);
        $keys = array_keys($preparedData);
        $fields = implode(', ', $keys);
        $placeholders = implode(', ', array_fill(0, count($keys), '?'));
        
        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(array_values($preparedData));
        } catch (\PDOException $e) {
            error_log("Database Error in createProfile: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update profil yang sudah ada
     */
    public function updateProfile(array $data, int $userId): bool
    {
        $preparedData = $this->prepareData($data, $userId);
        unset($preparedData['user_id']); // Jangan update user_id

        $setParts = [];
        foreach (array_keys($preparedData) as $key) {
            $setParts[] = "{$key} = ?";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE user_id = ?";
        
        $values = array_values($preparedData);
        $values[] = $userId;
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($values);
        } catch (\PDOException $e) {
            error_log("Database Error in updateProfile: " . $e->getMessage());
            return false;
        }
    }
}