<?php
namespace App\Controllers;
require_once '../app/models/students.php';

class LandingController
{
    
    public function landingView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/landing.php';
    }
    public function teamsView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
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

   // Di dalam function storeTeam() Controller
// LandingController.php
// LandingController.php
public function storeTeam() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $teamModel = new Team();

        // 1. Ambil data teks & array dari form
        $teamData = [
            'name'        => $_POST['team_name'] ?? '',
            'description' => $_POST['team_description'] ?? '',
            'privacy'     => $_POST['privacy'] ?? 'Publik',
        ];
        
        $sections = $_POST['sections'] ?? []; 
        $members  = $_POST['members'] ?? [];

        // 2. Handle upload foto ke folder (biasanya public/uploads/...)
        $imageName = $this->handleUpload(); 

        // 3. Panggil fungsi sakti di Model
        $result = $teamModel->insertTeamFull($teamData, $imageName, $sections, $members);

        if ($result) {
            return header('Location: /teams?msg=success');
        } else {
            return header('Location: /teams/create?msg=fail');
        }
    }
}
}

?>