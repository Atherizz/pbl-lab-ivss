<?php
namespace App\Models;

class LabUserProfileModel extends Model 
{
    protected $table = 'lab_user_profiles';
    
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
            $profile['social_links']   = json_decode($profile['social_links'] ?? '{}', true);
            $profile['research_focus'] = json_decode($profile['research_focus'] ?? '[]', true);
            $profile['educations']     = json_decode($profile['educations'] ?? '[]', true);
            $profile['certifications'] = json_decode($profile['certifications'] ?? '[]', true);
        }
        
        return $profile ?: null;
    }

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
            
            'social_links'     => json_encode($socialLinks),
            'research_focus'   => json_encode($data['research_focus'] ?? []),
            'educations'       => json_encode($data['educations'] ?? []), 
            'certifications'   => json_encode($data['certifications'] ?? []),
        ];

        return array_filter($prepared, fn($value, $key) => $value !== null || 
            in_array($key, ['social_links', 'research_focus', 'educations', 'certifications']), 
            ARRAY_FILTER_USE_BOTH);
    }
    
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

    public function updateProfile(array $data, int $userId): bool
    {
        $preparedData = $this->prepareData($data, $userId);
        unset($preparedData['user_id']); 

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