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
            $description = htmlspecialchars(trim($_POST['content'])); // Mengambil dari name="content" di HTML

            // Validasi pastikan tidak kosong
            if (!empty($title) && !empty($description)) {
                
                $problemModel = new Problem();
                // Memanggil fungsi saveProblem dengan data yang pas
                $isSaved = $problemModel->saveProblem($title, $description);

                if ($isSaved) {
                    // Jika sukses, redirect ke halaman utama
                    header('Location: /'); 
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