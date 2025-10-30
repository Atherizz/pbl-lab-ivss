<?php
namespace App\Models;

use App\Core\Database;
class Model {
    public $db;
    public $error;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
