<?php
namespace App\Models;

require_once '../app/core/database.php';
use App\Core\Database;
use Exception;

class Problem extends Database
{
    // Pastikan nama tabel kamu di database adalah 'problems'
    protected $table = 'problems'; 

    public function saveProblem($title, $description)
    {
        try {
            // 1. Ambil koneksi dari class Database induk
            $connection = $this->getConnection();

            // 2. Siapkan Query (gunakan ? untuk MySQLi)
            $query = "INSERT INTO {$this->table} (title, description, created_at) VALUES (?, ?, NOW())";
            $stmt = $connection->prepare($query);

            if (!$stmt) {
                return false; // Kalau query salah tulis, kembalikan false
            }

            // 3. Bind parameter ('ss' artinya dua variabel berjenis String)
            $stmt->bind_param('ss', $title, $description);
            
            // 4. Eksekusi
            $success = $stmt->execute();

            // 5. Bersihkan memori
            $stmt->close();

            return $success;

        } catch (Exception $e) {
            return false;
        }
    }
}