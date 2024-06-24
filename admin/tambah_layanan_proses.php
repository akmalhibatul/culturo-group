<?php
include('koneksi.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_layanan = $_POST['judul_layanan'];
    $deskripsi = $_POST['deskripsi'];
    $id_user = $_POST['id_user']; // Get id_user from form or session

    if (isset($_FILES['gambar_layanan']) && $_FILES['gambar_layanan']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['gambar_layanan'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png', 'svg');

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { // Maksimal 5MB
                    $fileNameNew = uniqid('', true) . "." . $fileExt;
                    $fileDestination = 'images/layanan/' . $fileNameNew;

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $sql = "INSERT INTO tb_layanan (id_layanan, judul_layanan, deskripsi, gambar_layanan, id_user)
                                VALUES (NULL, ?, ?, ?, ?)";

                        $stmt = $koneksi->prepare($sql);
                        $stmt->bind_param("sssi", $judul_layanan, $deskripsi, $fileNameNew, $id_user);

                        if ($stmt->execute()) {
                            header("Location: layanan.php");
                        } else {
                            echo "Error: " . $stmt->error;
                        }

                        $stmt->close();
                    } else {
                        echo "Terjadi kesalahan saat mengupload file.";
                    }
                } else {
                    echo "Ukuran file terlalu besar.";
                }
            } else {
                echo "Terjadi kesalahan saat mengupload file.";
            }
        } else {
            echo "File tipe tidak diizinkan. Hanya JPG, JPEG, PNG, dan SVG yang diperbolehkan.";
        }
    } else {
        echo "Tidak ada file yang diupload atau terjadi kesalahan saat mengupload.";
    }
}

$koneksi->close();
