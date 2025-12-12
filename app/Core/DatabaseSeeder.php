<?php

namespace App\Core;

use App\Models\UserModel;

class DatabaseSeeder {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function run() {
        echo "--- Seeding Admin and Lab Members Started ---\n";
        
        // Check if users already exist
        try {
            $db = new Database();
            $pdo = $db->getConnection();
            $stmt = $pdo->query("SELECT COUNT(*) FROM users");
            $count = $stmt->fetchColumn();
            
            if ($count > 0) {
                echo "Users already exist ({$count} users found). Skipping seed.\n";
                echo "Use 'db:reset --force' to drop and reseed database.\n";
                return;
            }
        } catch (\Exception $e) {
            // Table doesn't exist yet, continue seeding
        }
        
        // 1. Dosen Pembimbing dan Admin (Tanpa Dospem)
        $usersToSeed = [
            // ID 1: Wilda Imama Sabilla (AKAN MENJADI DOSPEM MAHASISWA)
            [
                'name' => 'Wilda Imama Sabilla, S.Kom., M.Kom.',
                'reg_number' => '0029089201',
                'password' => '$2y$10$dMHthv8cmGXxucK2ZF4za.BNC8uBZIhEwbVnVuG7sPVPRaqyHguXW', 
                'role' => 'anggota_lab',
                'dospem_id' => null,
            ],
            // ID 2: Mamluatul Hani'ah
            [
                'name' => 'Mamluatul Hani\'ah, S.Kom., M.Kom',
                'reg_number' => '0006029003',
                'password' => '$2y$10$LWo9nCtO8NlabpAmVZMalO7ScaNHrf3KBdo4ZxboN1AY1hPhNRvBe', 
                'role' => 'anggota_lab',
                'dospem_id' => null,
            ],
            // ID 3: Dr. Ulla Delfana Rosiani (Admin Lab)
            [
                'name' => 'Dr. Ulla Delfana Rosiani, ST., MT.',
                'reg_number' => '4314058001',
                'password' => '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 
                'role' => 'admin_lab',
                'dospem_id' => null,
            ],
            // ID 4: Vivi Nur Wijayaningrum
            [
                'name' => 'Vivi Nur Wijayaningrum, S.Kom, M.Kom',
                'reg_number' => '0011089303',
                'password' => '$2y$10$9led7udBRhgRiBNSkSa6v.qGJaTWyLfvYsT2RG5xkbEC9KNKE/YJ2',
                'role' => 'anggota_lab',
                'dospem_id' => null,
            ],
            // ID 5: Dr. Ely Setyo Astuti
            [
                'name' => 'Dr. Ely Setyo Astuti, ST., MT.',
                'reg_number' => '0015057606',
                'password' => '$2y$10$Xw8Y7qxj838qzaj1DL.ty.eW7X.3wJT183yUQHh1.HeYE59CYblze',
                'role' => 'anggota_lab',
                'dospem_id' => null,
            ],
            // ID 6: Mungki Astiningrum
            [
                'name' => 'Mungki Astiningrum, ST., M.Kom.',
                'reg_number' => '0030107702',
                'password' => '$2y$10$oyHLkkiybUeTZ48WwhFV1O/kC9HpvP1LfRWE6eATDB1upAMg43.Im',
                'role' => 'anggota_lab',
                'dospem_id' => null,
            ],
            // ID 7: Prof. Dr. Eng. Rosa Andrie Asmara
            [
                'name' => 'Prof. Dr. Eng. Rosa Andrie Asmara, ST., MT.',
                'reg_number' => '0010108003',
                'password' => '$2y$10$Etc2VVIRb0JvBhS68Y6FsOkQE.Qy1NWK2R6Lf8YQSid8lTJLQLRRi',
                'role' => 'anggota_lab',
                'dospem_id' => null,
            ],
            // ID 8: Savero (Admin Berita)
            [
                'name' => 'Savero',
                'reg_number' => '1231234',
                'password' => '$2y$10$Vuh02I63jcx7t3C/ddCOYOB2NSayuWgTDMwlH0WtNEQJ0LxHTcK1.',
                'role' => 'admin_berita',
                'dospem_id' => null,
            ]
        ];

        // Jalankan looping insert
        foreach ($usersToSeed as $user) {
            $success = $this->userModel->createUser($user);
            if ($success) {
                echo "Seeded user: " . $user['name'] . "\n";
            } else {
                echo "Failed to seed user: " . $user['name'] . " (Reg: " . $user['reg_number'] . ")\n";
            }
        }

        echo "--- Seeding Complete ---\n";
    }
}

$seeder = new \App\Core\DatabaseSeeder();
$seeder->run();