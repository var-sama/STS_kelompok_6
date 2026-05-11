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
        $database = new Database();
        $connection = $database->getConnection();

        $query = "INSERT INTO {$this->table} (user_id, name, description, image, privacy) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        $userId = 1; 
        $name = htmlspecialchars(trim($data['name']));
        $desc = htmlspecialchars(trim($data['description']));
        $img = $imageName;
        $privacy = $data['privacy'];

        $stmt->bind_param('issss', $userId, $name, $desc, $img, $privacy);
        
        $result = false;
        if ($stmt->execute()) {
            $result = $connection->insert_id; // Kembalikan ID tim
        }

        $stmt->close();
        return $result;
    } catch (Exception $e) {
        return false;
    }
    }

    // Tambahkan fungsi baru untuk simpan section
    public function insertSections($teamId, $sections) {
        $database = new Database();
        $connection = $database->getConnection();
        
        $query = "INSERT INTO team_sections (team_id, section_name, display_order) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);

        foreach ($sections as $index => $name) {
            $cleanName = htmlspecialchars(trim($name));
            $stmt->bind_param('isi', $teamId, $cleanName, $index);
            $stmt->execute();
        }
        $stmt->close();
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
    public function getSectionsByTeamId(int $teamId)
    {
        $connection = $this->getConnection();
        // Ambil section berdasarkan team_id, urutkan berdasarkan display_order
        $query = "SELECT * FROM team_sections WHERE team_id = ? ORDER BY display_order ASC";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $teamId);
        $stmt->execute();

        $result = $stmt->get_result();
        $sections = [];
        while ($row = $result->fetch_assoc()) {
            $sections[] = $row;
        }
        return $sections;
    }
    
    public function delete(int $id)
{
    try {
        $connection = $this->getConnection();

        // 1. AMBIL NAMA FILE DULU sebelum datanya dihapus dari DB
        $team = $this->getTeamById($id);
        $fileName = $team['image'] ?? null;

        // 2. PROSES HAPUS DARI DATABASE
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $connection->prepare($query);
        
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        // 3. JIKA DB BERHASIL DIHAPUS, HAPUS FILE FISIKNYA
        if ($success && $affectedRows > 0) {
            if ($fileName) {
                // Sesuaikan path dengan lokasi folder upload kamu
                $filePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $fileName;
                
                // Cek apakah filenya beneran ada, kalau ada sikat (hapus)!
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            return true;
        }
        
        return false;
    } catch (Exception $e) {
        return false;
    }
}
    
    
}
?>