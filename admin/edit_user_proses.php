<?php
session_start();
include 'koneksi.php'; // File koneksi ke database

// Periksa apakah pengguna sudah login dan levelnya super_admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'super_admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $level = $_POST['level'];
    $status = $_POST['status'];

    // Validasi input
    if (empty($username) || empty($nama_lengkap) || empty($level) || empty($status)) {
        echo "Semua field harus diisi!";
        exit;
    }

    // Query untuk memperbarui data pengguna
    if (empty($password)) {
        // Jika password kosong, jangan diubah
        $sql = "UPDATE tb_user SET username = ?, nama_lengkap = ?, level = ?, status = ? WHERE id_user = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ssssi", $username, $nama_lengkap, $level, $status, $id_user);
    } else {
        // Hash password baru
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tb_user SET username = ?, password = ?, nama_lengkap = ?, level = ?, status = ? WHERE id_user = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssssi", $username, $hashed_password, $nama_lengkap, $level, $status, $id_user);
    }

    if ($stmt->execute()) {
        echo "User berhasil diperbarui!";
        header("Location: user.php"); // Redirect ke halaman daftar pengguna
        exit;
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
}
