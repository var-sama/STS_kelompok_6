<?php

namespace App\Models;
require_once '../app/core/database.php';

use App\Core\Database;

class Team extends Database
{
    protected $table = 'grup'; // Pastikan kamu udah bikin tabel 'teams' di database ya

    // fungsi nambah tim baru
 // Team.php (Model)
// Team.php (Model)
public function insertTeamFull($data, $imageName, $sections, $members) {
    try {
        // Mulai transaksi (fitur 'oren' biasanya punya ini)
        $this->db->beginTransaction();

        // 1. Masukkan ke tabel Utama (Teams)
        $this->db->query("INSERT INTO teams (name, description, image, privacy) VALUES (:name, :desc, :logo, :privacy)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':desc', $data['description']);
        $this->db->bind(':logo', $imageName);
        $this->db->bind(':privacy', $data['privacy']);
        $this->db->execute();

        // Ambil ID tim yang barusan dibuat
        $teamId = $this->db->lastInsertId();

        // 2. Masukkan Sections (Looping)
        foreach ($sections as $secName) {
            $this->db->query("INSERT INTO team_sections (team_id, section_name) VALUES (:tid, :sname)");
            $this->db->bind(':tid', $teamId);
            $this->db->bind(':sname', $secName);
            $this->db->execute();
        }

        // 3. Masukkan Members (Looping)
        foreach ($members as $memberName) {
            $this->db->query("INSERT INTO team_members (team_id, username) VALUES (:tid, :uname)");
            $this->db->bind(':tid', $teamId);
            $this->db->bind(':uname', $memberName);
            $this->db->execute();
        }

        // Kalau semua lancar, simpan permanen!
        $this->db->commit();
        return true;

    } catch (Exception $e) {
        // Kalau ada error satu aja, batalin semua yang udah masuk
        $this->db->rollBack();
        return false;
    }
}
}
?>