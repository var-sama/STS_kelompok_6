<?php
namespace App\Controllers;

use App\Core\Database;

require_once '../app/core/database.php'; 

class AuthController
{
    public function loginView()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $connection = $database->getConnection();
            
            $nama = htmlspecialchars(trim($_POST['nama']));
            $password = $_POST['password'];
            
            $query = "SELECT * FROM akun_users WHERE nama = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('s', $nama);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /landing');
                exit;
            } else {
                header('Location: /login');
                exit;
            }
        }
        
        require_once '../app/views/auth/login.php';
    }

public function registerView()
{
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $database = new Database(); 
        $connection = $database->getConnection();
        
        $nama = htmlspecialchars(trim($_POST['nama']));
        $kelas = $_POST['kelas'];
        $jurusan = $_POST['jurusan'];
        $kelas_full = $kelas . ' ' . $jurusan;
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        
        if($password !== $confirm) {
            echo "<script>alert('Password tidak cocok'); window.location.href='/register';</script>";
            exit;
        }
        
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // --- TAMBAHAN UNTUK TANGGAL ---
        // Set timezone ke WIB biar waktunya akurat (opsional tapi disarankan)
        date_default_timezone_set('Asia/Jakarta');
        
        // Bikin format tanggal dan waktu sekarang (Tahun-Bulan-Hari Jam:Menit:Detik)
        $tanggal = date('Y-m-d H:i:s'); 

        $query = "INSERT INTO akun_users (nama, password, kelas, date) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        
        $stmt->bind_param('ssss', $nama, $hashed, $kelas_full, $tanggal);
        
        if($stmt->execute()) {
            header('Location: /login');
            exit;
        } else {
            echo "<script>alert('Gagal register'); window.location.href='/register';</script>";
            exit;
        }
    }
    
    require_once '../app/views/auth/register.php';
}
}
?>