<?php
include('koneksi.php');

$id_layanan = $_GET['id_layanan'];

$query = mysqli_query($koneksi, "DELETE FROM `tb_layanan` WHERE id_layanan = '$id_layanan'");

if ($query == true) {
    echo "Data berhasil dihapus!";
} else {
    mysqli_error($koneksi);
}
