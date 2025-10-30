<?php
use App\Models\UserModel;

class DatabaseSeeder {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function run() {
        $this->userModel->createUser('Admin', 'admin@mail.com', 'password', 'Admin');
        $this->userModel->createUser('User', 'user@mail.com', 'password', 'User');
        echo "Database seeded successfully.\n";
    }
}

$seeder = new DatabaseSeeder();
$seeder->run();
