<?php
namespace App\Controllers;

class AuthController
{
    public function loginView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/auth/login.php';
    }

    public function registerView()
    {
        require_once '../app/views/auth/register.php';
    }
}

?>