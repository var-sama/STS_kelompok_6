<?php
namespace App\Models;

require_once '../app/core/database.php';
use App\Core\Database;
use Exception;

class Problem extends Database
{
    // Pastikan nama tabel kamu di database adalah 'problems'
    protected $table = 'problems'; 

    // UBAH FUNGSI saveProblem MENJADI SEPERTI INI:
    public function saveProblem($title, $description, $team_id = null)
    {
        try {
            $connection = $this->getConnection();
            
            // Tambahkan team_id ke dalam query insert
            $query = "INSERT INTO {$this->table} (title, description, team_id, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $connection->prepare($query);

            if (!$stmt) return false;

            // 'ssi' berarti String, String, Integer
            $stmt->bind_param('ssi', $title, $description, $team_id);
            $success = $stmt->execute();
            $stmt->close();

            return $success;
        } catch (Exception $e) {
            return false;
        }
    }

    // TAMBAHKAN FUNGSI BARU INI DI BAWAHNYA:
    public function getProblemsByTeamId($team_id)
    {
        $problems = [];
        $connection = $this->getConnection();
        
        // Ambil postingan KHUSUS untuk tim tertentu beserta status bookmarknya
        $query = "SELECT p.*, IF(b.id IS NOT NULL, 1, 0) AS is_bookmarked 
                  FROM problems p 
                  LEFT JOIN bookmarks b ON p.id = b.problem_id 
                  WHERE p.team_id = ?
                  ORDER BY p.id DESC";
                  
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $team_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        $stmt->close();
        return $problems;
    }

    public function getAllProblems()
    {
        $problems = [];
        $connection = $this->getConnection();
        
        // Ambil semua data, urutkan dari ID terbesar (terbaru)
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $connection->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        return $problems;
    }

    // Contoh untuk PDO
// Pastikan ada `use Exception;` di bagian paling atas file model-mu

    public function getProblemById($id) 
        {
            try {
                $connection = $this->getConnection();
                
                // Query diubah: menggunakan LEFT JOIN untuk mendeteksi status bookmark
                $query = "SELECT p.*, IF(b.id IS NOT NULL, 1, 0) AS is_bookmarked 
                        FROM {$this->table} p 
                        LEFT JOIN bookmarks b ON p.id = b.problem_id 
                        WHERE p.id = ?";
                
                $stmt = $connection->prepare($query);
                
                if (!$stmt) {
                    throw new Exception("Gagal prepare query: " . $connection->error);
                }
                
                $stmt->bind_param("i", $id); 
                $stmt->execute();
                
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                
                $stmt->close();
                
                return $data;

            } catch (Exception $e) {
                return false;
            }
        }

    // Tambahkan fungsi-fungsi ini di dalam class Problem

    public function toggleBookmark($problem_id)
    {
        $connection = $this->getConnection();
        
        // 1. Cek apakah postingan ini sudah di-bookmark atau belum
        $query = "SELECT id FROM bookmarks WHERE problem_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $problem_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Jika sudah ada, hapus (Unbookmark)
            $stmt->close();
            $deleteQuery = "DELETE FROM bookmarks WHERE problem_id = ?";
            $deleteStmt = $connection->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $problem_id);
            $deleteStmt->execute();
            $deleteStmt->close();
            return 'removed';
        } else {
            // Jika belum ada, masukkan (Bookmark)
            $stmt->close();
            $insertQuery = "INSERT INTO bookmarks (problem_id) VALUES (?)";
            $insertStmt = $connection->prepare($insertQuery);
            $insertStmt->bind_param("i", $problem_id);
            $insertStmt->execute();
            $insertStmt->close();
            return 'added';
        }
    }

    // Fungsi untuk mengambil semua data masalah beserta status bookmark-nya (untuk Landing Page)
    public function getAllProblemsWithBookmarkStatus()
    {
        $problems = [];
        $connection = $this->getConnection();
        $query = "SELECT p.*, IF(b.id IS NOT NULL, 1, 0) AS is_bookmarked 
                FROM problems p 
                LEFT JOIN bookmarks b ON p.id = b.problem_id 
                ORDER BY p.id DESC";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        $stmt->close();
        return $problems;
    }

    // Fungsi untuk mengambil KHUSUS postingan yang di-bookmark saja
    public function getBookmarkedProblems()
    {
        $problems = [];
        $connection = $this->getConnection();
        $query = "SELECT p.*, 1 AS is_bookmarked 
                FROM problems p 
                INNER JOIN bookmarks b ON p.id = b.problem_id 
                ORDER BY b.id DESC";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        $stmt->close();
        return $problems;
    }

    // Fungsi untuk menyimpan komentar baru
    public function addComment($problem_id, $content)
    {
        try {
            $connection = $this->getConnection();
            $query = "INSERT INTO comments (problem_id, content) VALUES (?, ?)";
            $stmt = $connection->prepare($query);
            
            if (!$stmt) return false;
            
            $stmt->bind_param("is", $problem_id, $content);
            $success = $stmt->execute();
            $stmt->close();
            
            return $success;
        } catch (Exception $e) {
            return false;
        }
    }

    // Fungsi untuk mengambil daftar komentar milik suatu masalah
    public function getCommentsByProblemId($problem_id)
    {
        $comments = [];
        $connection = $this->getConnection();
        
        // Mengurutkan komentar dari yang paling baru (DESC)
        $query = "SELECT * FROM comments WHERE problem_id = ? ORDER BY created_at DESC";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $problem_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        $stmt->close();
        
        return $comments;
    }

    // --- FUNGSI BARU: Untuk mencari masalah berdasarkan keyword ---
    public function searchProblemsWithBookmarkStatus($keyword)
    {
        $problems = [];
        $connection = $this->getConnection();
        
        // Mencari di kolom 'title' atau 'description' yang mirip dengan keyword
        $query = "SELECT p.*, IF(b.id IS NOT NULL, 1, 0) AS is_bookmarked 
                  FROM problems p 
                  LEFT JOIN bookmarks b ON p.id = b.problem_id 
                  WHERE p.title LIKE ? OR p.description LIKE ?
                  ORDER BY p.id DESC";
                  
        $stmt = $connection->prepare($query);
        
        // Tambahkan % di awal dan akhir keyword agar pencarian lebih fleksibel
        $searchKeyword = "%" . $keyword . "%";
        $stmt->bind_param("ss", $searchKeyword, $searchKeyword);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        $stmt->close();
        return $problems;
    }
}