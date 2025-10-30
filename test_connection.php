
<?php
require_once 'vendor/autoload.php';

use App\Core\Database;

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    if ($conn) {
        echo "✅ Koneksi database berhasil!\n";
        
        // Test query
        $stmt = $conn->query("SELECT COUNT(*) as total FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Total users: " . $result['total'] . "\n";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}