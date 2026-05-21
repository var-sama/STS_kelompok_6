<?php
namespace App\Controllers;

class DashboardController
{
    public function dashboardView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/dashboard.php';
    }

}

?>