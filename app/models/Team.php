<?php

namespace App\Models;

require_once '../app/core/database.php';
use App\Core\Database;
use Exception;

class Team extends Database
{
    protected $table = 'grup';

    // 1. Fungsi Create Team (Mirip gaya register kamu)
    public function insertSimple($data, $imageName) {
        try {
            // Panggil koneksi persis seperti di registerView
            $database = new Database();
            $connection = $database->getConnection();

            // Siapkan query pakai tanda tanya (?)
            $query = "INSERT INTO {$this->table} (user_id, name, description, image, privacy) VALUES (?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($query);

            if (!$stmt) {
                return false; // Gagal menyiapkan query
            }

            // Siapkan variabel datanya
            $userId = 1; // Tembak ID manual dulu buat testing
            $name = htmlspecialchars(trim($data['name']));
            $desc = htmlspecialchars(trim($data['description']));
            $img = $imageName; // Nama file gambar atau null
            $privacy = $data['privacy'];

            // Bind param: 'issss' (Integer, String, String, String, String)
            $stmt->bind_param('issss', $userId, $name, $desc, $img, $privacy);

            // Eksekusi dan simpan hasilnya (true/false)
            $sukses = $stmt->execute();
            
            // Tutup koneksi
            $stmt->close();
            
            return $sukses;

        } catch (Exception $e) {
            // Kalau mau lihat error-nya apa, hapus tanda // di bawah ini:
            // die($e->getMessage()); 
            return false;
        }
    }

// private function getConnection() {
//         $database = new Database();
//         return $database->getConnection();
//     }

    public function getAllTeams()
    {
        $teams = [];
        $connection = $this->getConnection(); // AMBIL KONEKSI DULU
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $connection->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $teams[] = $row;
        }
        return $teams;

        
    }

    public function getTeamById(int $id)
    {
        $connection = $this->getConnection(); // AMBIL KONEKSI DULU
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    
    
}
?>