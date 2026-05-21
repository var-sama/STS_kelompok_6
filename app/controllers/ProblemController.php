<?php
namespace App\Controllers;

use App\Models\Problem; 
use App\Core\Database;
require_once '../app/models/students.php';

class ProblemController
{
    public function ProblemcreateView()
    {
        // Ambil semua tag dari database untuk dikirim ke View
        $database = new Database();
        $connection = $database->getConnection();
        
        $query = "SELECT * FROM tags ORDER BY name ASC";
        $result = $connection->query($query);
        
        $tags = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tags[] = $row;
            }
        }

        // Oper variabel $tags ke file view
        require_once '../app/views/Problemcreate.php'; 
    }

   public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['title']));
            $description = htmlspecialchars(trim($_POST['content'])); // Sesuai dengan name="content" di textarea
            
            // Tangkap array ID tag yang dipilih (jika tidak ada, beri array kosong)
            $tag_ids = isset($_POST['tags']) ? $_POST['tags'] : []; 
            
            $team_id = isset($_GET['team_id']) ? $_GET['team_id'] : null;

            $problemModel = new Problem();
            
            // Panggil fungsi saveProblem dengan menyertakan $tag_ids
            $success = $problemModel->saveProblem($title, $description, $tag_ids, $team_id);

            if ($success) {
                header('Location: /landing');
                exit;
            } else {
                echo "<script>alert('Gagal membagikan masalah'); window.history.back();</script>";
                exit;
            }
        }
    }

    public function TagsView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/Tags.php';
    }
}


?>
