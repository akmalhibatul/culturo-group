<?php
session_start();
include 'koneksi.php'; // File koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "Username dan password tidak boleh kosong!";
        exit;
    }

    // Query untuk mendapatkan data pengguna
    $sql = "SELECT * FROM tb_user WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Cek status pengguna
            if ($user['status'] == 'aktif') {
                // Set session
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['level'] = $user['level'];

                // Redirect ke halaman sesuai level pengguna
                if ($user['level'] == 'admin') {
                    header("Location: ../admin/");
                } elseif ($user['level'] == 'super_admin') {
                    header("Location: ../admin/");
                } else {
                    header("Location: user_dashboard.php");
                }
                exit;
            } else {
                echo "Akun anda tidak aktif!";
            }
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
