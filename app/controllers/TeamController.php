<?php

namespace App\Controllers;

require_once '../app/models/Team.php';
use App\Models\Team;

class TeamController
{
    public function delete($id)
    {
        $teamModel = new Team();
        $success = $teamModel->delete($id);

        if ($success) {
            header('Location: /teams');
            exit;
        } else {
            echo 'Gagal menghapus tim.';
        }
    }
}
