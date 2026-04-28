<?php
namespace App\Controllers;

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

}

?>