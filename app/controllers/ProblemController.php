<?php
namespace App\Controllers;

class ProblemController
{
    public function ProblemcreateView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/Problemcreate.php';
    }

    public function TagsView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/Tags.php';
    }
}


?>