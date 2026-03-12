<?php
namespace App\Controllers;

class AuthController
{
    public function loginView()
    {
        require_once '../app/views/auth/login.php';
    }

    public function registerView()
    {
        require_once '../app/views/auth/register.php';
    }
}

?>