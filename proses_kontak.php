<?php
include('koneksi.php');

$nama_lengkap = $_POST['nama_lengkap'];
$nama_perusahaan = $_POST['nama_perusahaan'];
$email = $_POST['email'];
$no_telp = $_POST['no_telp'];
$pesan = $_POST['pesan'];

$query = mysqli_query($koneksi, "INSERT INTO `tb_kontak`(`id_kontak`, `nama_lengkap`, `nama_perusahaan`, `email`, `no_telp`, `pesan`) VALUES (null,'$nama_lengkap','$nama_perusahaan','$email','$no_telp','$pesan')");

if ($query == true) {
    header('Location: success_page.php');
} else {
    mysqli_error($koneksi);
}
