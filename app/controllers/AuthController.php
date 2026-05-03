<?php
namespace App\Controllers;

use App\Core\Database;

// Jika kamu TIDAK pakai Composer/Autoloader, uncomment baris di bawah dan sesuaikan lokasinya:
require_once __DIR__ . '/../core/database.php'; 

class AuthController
{
    public function loginView()
    {
        // 1. Proses data POST terlebih dahulu
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
        
        // 2. Jika bukan POST (hanya buka halaman), baru load View-nya
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function registerView()
    {
        // 1. Proses data POST terlebih dahulu
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database(); // Pastikan koneksi database di class Database sudah benar
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
            $query = "INSERT INTO akun_users (nama, password, kelas) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('sss', $nama, $hashed, $kelas_full);
            
            if($stmt->execute()) {
                header('Location: /login');
                exit;
            } else {
                echo "<script>alert('Gagal register'); window.location.href='/register';</script>";
                exit;
            }
        }
        
        // 2. Jika bukan POST (hanya buka halaman), baru load View-nya
        require_once __DIR__ . '/../views/auth/register.php';
    }
}
?>