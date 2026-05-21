<?php
namespace App\Controllers;

use App\Models\Team;
use App\Models\Problem;
// require_once '../app/models/students.php';
require_once '../app/models/Team.php';
require_once '../app/models/students.php';

class LandingController
{
    
    public function teamsView() {
        // Mencegah cache browser agar data selalu terbaru
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

        $teamModel = new Team();
        $allTeams = $teamModel->getAllTeams();

        $allTeams = array_map(function($team) {
            $path = '/uploads/';
            // Cek jika ada gambar dan filenya ada di folder public/uploads
            if (!empty($team['image']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $path . $team['image'])) {
                $team['profile_img'] = $path . $team['image'] . '?t=' . time();
            } else {
                // Fallback ke UI Avatars dengan timestamp untuk hindari cache
                $team['profile_img'] = 'https://ui-avatars.com/api/?name=' . urlencode($team['name']) . '&background=00ADB5&color=fff&t=' . time();
            }
            return $team;
        }, $allTeams);
        
        // Kita simpan data ke dalam variabel $data agar bisa dibaca di file teams.php
        $data = ['teams' => $allTeams];
        extract($data);
        
        require_once '../app/views/teams.php';
    }

    public function landingView() {
        $problemModel = new Problem();
        // Pakai method baru ini agar status bookmark terdeteksi saat halaman dimuat
        $problems = $problemModel->getAllProblemsWithBookmarkStatus(); 

        require_once '../app/views/landing.php'; // Sesuaikan dengan path file kamu
    }
    public function detailView() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        if (!$id) {
            header('Location: /');
            exit;
        }

        $problemModel = new Problem();
        $problem = $problemModel->getProblemById($id); 
        
        // --- TAMBAHAN BARU: Ambil semua komentar untuk masalah ini ---
        $comments = $problemModel->getCommentsByProblemId($id); 

        if (!$problem) {
            echo "Data tidak ditemukan atau terjadi masalah."; 
            exit;
        }
        
        // Kirim variabel $comments ke view juga
        $data = [
            'problem' => $problem,
            'comments' => $comments
        ];
        extract($data);

        require_once '../app/views/detail.php';
    }

    // --- FUNGSI BARU: Untuk menyimpan komentar dari Form ---
    public function postComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $problem_id = isset($_POST['problem_id']) ? intval($_POST['problem_id']) : 0;
            $content = isset($_POST['content']) ? trim($_POST['content']) : '';

            if ($problem_id > 0 && !empty($content)) {
                $problemModel = new Problem();
                // Simpan ke database dengan htmlspecialchars untuk keamanan
                $problemModel->addComment($problem_id, htmlspecialchars($content));
            }
            
            // Redirect otomatis kembali ke halaman detail postingan tersebut
            header('Location: /problem-detail?id=' . $problem_id);
            exit;
        }
    }

    public function teamsDetailView()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /teams');
            exit;
        }

        $id = intval($_GET['id']); 
        $teamModel = new Team();
        $team = $teamModel->getTeamById($id);

        if (!$team) {
            header('Location: /teams');
            exit;
        }

        $sections = $teamModel->getSectionsByTeamId($id);

        // --- TAMBAHAN BARU: Ambil postingan masalah khusus tim ini ---
        $problemModel = new Problem();
        $problems = $problemModel->getProblemsByTeamId($id);
        // -------------------------------------------------------------

        $path = '/uploads/';
        if (!empty($team['image']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $path . $team['image'])) {
            $team['profile_img'] = $path . $team['image'] . '?t=' . time();
        } else {
            $team['profile_img'] = 'https://ui-avatars.com/api/?name=' . urlencode($team['name']) . '&background=00ADB5&color=fff&t=' . time();
        }
        
        $data = [
            'team' => $team,
            'sections' => $sections,
            'problems' => $problems // Pastikan $problems dikirim ke view!
        ]; 
        extract($data);
        
        require_once '../app/views/teams detail.php';
    }
    public function teamsCreateView()//ganti nama ini kalo mau anok function lain, nama sesuaiin sama nama function yg mo dibuat, btw tulisan ni hapus ye
    {
        require_once '../app/views/create team.php';
    }

 // Di dalam LandingController.php
    public function storeTeam() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $teamModel = new Team();
        $imageName = $this->handleUpload(); 

        $data = [
            'name'        => $_POST['team_name'] ?? '',
            'description' => $_POST['team_description'] ?? '',
            'privacy'     => $_POST['privacy'] ?? 'public'
        ];

        // 1. Simpan Tim dan dapatkan ID-nya
        $teamId = $teamModel->insertSimple($data, $imageName);

        if ($teamId) {
            // 2. Ambil data section dari POST (hasil array dari JS tadi)
            if (isset($_POST['sections']) && is_array($_POST['sections'])) {
                $teamModel->insertSections($teamId, $_POST['sections']);
            }

            header("Location: /teams?status=success");
            exit;
        } else {
            echo "Gagal simpan tim.";
        }
    }
    }
    public function delete($id)
    {
        $id = intval($id); // Pastikan integer untuk keamanan
        $teamModel = new Team();
        $success = $teamModel->delete($id);

        if ($success) {
            // Redirect balik ke daftar tim dengan status sukses
            header('Location: /teams?delete=success');
            exit;
        } else {
            echo 'Gagal menghapus tim atau data tidak ditemukan.';
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

    public function toggleBookmark() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['problem_id'])) {
            $problemId = intval($_POST['problem_id']);
            $problemModel = new Problem();
            $status = $problemModel->toggleBookmark($problemId);

            echo json_encode(['status' => $status]);
            exit;
        }
        echo json_encode(['status' => 'error']);
        exit;
    }

    public function bookmarkView() {
        $problemModel = new Problem();
        $problems = $problemModel->getBookmarkedProblems();

        // Panggil file halaman bookmark baru yang akan kita buat di Langkah 6
        require_once '../app/views/bookmark.php'; 
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