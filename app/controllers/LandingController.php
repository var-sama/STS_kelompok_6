<?php
namespace App\Controllers;

use App\Models\Team;
require_once '../app/models/students.php';
require_once '../app/models/Team.php';

class LandingController
{
    
    public function teamsView() {
        $teamModel = new \App\Models\Team();
        $allTeams = $teamModel->getAllTeams();
        
        // Kita simpan data ke dalam variabel $data agar bisa dibaca di file teams.php
        $data = ['teams' => $allTeams];
        
        require_once '../app/views/teams.php';
    }

    public function teamsDetailView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/teams detail.php';
    }
    public function teamsCreateView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/create team.php';
    }

 // Di dalam LandingController.php
    public function storeTeam() {
        // die("<h1>ALHAMDULILLAH! BERHASIL MASUK KE STORE TEAM!</h1>");
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $teamModel = new \App\Models\Team();

            // 1. Definisikan dulu variabelnya (Panggil fungsi upload)
            // Kalau fungsi handleUpload ada di class yang sama, pakai $this->
            $imageName = $this->handleUpload(); 

            // 2. Siapkan data dari form
            $data = [
                'name'        => $_POST['team_name'] ?? '',
                'description' => $_POST['team_description'] ?? '',
                'privacy'     => $_POST['privacy'] ?? 'public'
            ];

            // 3. Baru kirim ke model (Sekarang $imageName tidak akan merah lagi)
            if ($teamModel->insertSimple($data, $imageName)) {
                header('Location: /teams?status=success');
                exit;
            } else {
                echo "Gagal simpan.";
            }
        }
    }
    private function handleUpload() {
        if (isset($_FILES['team_logo']) && $_FILES['team_logo']['error'] === 0) {
            $targetDir = "uploads/";
            
            // Buat folder otomatis kalau belum ada
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES["team_logo"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["team_logo"]["tmp_name"], $targetFile)) {
                return $fileName; // Ini yang nanti masuk ke variabel $imageName
            }
        }
        return null; // Kalau nggak ada foto, return null agar DB aman
    }
    // public function show(string $id):void{
    //         $id = intval($id);
    //         $studentModel = new Team();
    //         $student = $studentModel->getStudent($id);
    //         $this->view('students.show', [
    //             'student' => $student
    //         ]);
    // }
}

?>