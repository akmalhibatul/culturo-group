<?php
include('koneksi.php');

$id_portofolio = $_GET['id_portofolio'];

$query = mysqli_query($koneksi, "DELETE FROM `tb_portofolio` WHERE id_portofolio = '$id_portofolio'");

if ($query == true) {
    echo "Data berhasil dihapus!";
} else {
    mysqli_error($koneksi);
}
