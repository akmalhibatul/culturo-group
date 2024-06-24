<?php
include 'koneksi.php'; // File koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $level = $_POST['level'];
    $status = $_POST['status'];

    // Validasi input
    if (empty($username) || empty($password) || empty($nama_lengkap) || empty($level) || empty($status)) {
        echo "Semua field harus diisi!";
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data pengguna baru
    $sql = "INSERT INTO tb_user (username, password, nama_lengkap, level, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $nama_lengkap, $level, $status);

    if ($stmt->execute()) {
        echo "Registrasi berhasil!";
        header("Location: user.php"); // Redirect ke halaman login
        exit;
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
}
