<?php
namespace App\Controllers;

use App\Models\Problem; 
require_once '../app/models/students.php';

class ProblemController
{
    public function ProblemcreateView()
    {
        require_once '../app/views/Problemcreate.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Sanitasi input
            $title       = htmlspecialchars(trim($_POST['title']));
            $description = htmlspecialchars(trim($_POST['content']));

            // 1. Tangkap team_id dari URL (contoh: /Problemcreate?team_id=1)
            $team_id = isset($_GET['team_id']) ? intval($_GET['team_id']) : null;

            // Validasi pastikan tidak kosong
            if (!empty($title) && !empty($description)) {
                
                $problemModel = new Problem();
                
                // 2. Simpan beserta parameter team_id
                $isSaved = $problemModel->saveProblem($title, $description, $team_id);

                if ($isSaved) {
                    // 3. Jika problem ini milik suatu tim, kembalikan ke halaman tim itu
                    if ($team_id) {
                        header('Location: /teams-detail?id=' . $team_id);
                    } else {
                        // Jika tidak ada tim (problem umum/landing page), kembalikan ke home
                        header('Location: /'); 
                    }
                    exit;
                } else {
                    echo "Waduh, gagal menyimpan data ke database.";
                }
            } else {
                echo "Judul dan konten tidak boleh kosong!";
            }
        }
    }
}