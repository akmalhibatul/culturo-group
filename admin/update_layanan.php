<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_layanan = $_POST['id_layanan'];
    $judul_layanan = $_POST['judul_layanan'];
    $deskripsi = $_POST['deskripsi'];
    $id_user = $_POST['id_user'];

    // Cek apakah id_user ada di tabel tb_user
    $stmt = $koneksi->prepare("SELECT id_user FROM tb_user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 0) {
        echo "ID user tidak valid.";
    } else {
        $updateGambar = "";
        if (isset($_FILES['gambar_layanan']) && $_FILES['gambar_layanan']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['gambar_layanan'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) { // Maksimal 5MB
                        $fileNameNew = uniqid('', true) . "." . $fileExt;
                        $fileDestination = 'images/layanan/' . $fileNameNew;

                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            $updateGambar = ", gambar_layanan = ?";
                        } else {
                            echo "Terjadi kesalahan saat mengupload file.";
                            exit;
                        }
                    } else {
                        echo "Ukuran file terlalu besar.";
                        exit;
                    }
                } else {
                    echo "Terjadi kesalahan saat mengupload file.";
                    exit;
                }
            } else {
                echo "File tipe tidak diizinkan. Hanya JPG dan PNG yang diperbolehkan.";
                exit;
            }
        }

        $sql = "UPDATE tb_layanan SET judul_layanan = ?, deskripsi = ? $updateGambar WHERE id_layanan = ? AND id_user = ?";
        $stmt = $koneksi->prepare($sql);

        if ($updateGambar) {
            $stmt->bind_param("ssssi", $judul_layanan, $deskripsi, $fileNameNew, $id_layanan, $id_user);
        } else {
            $stmt->bind_param("ssii", $judul_layanan, $deskripsi, $id_layanan, $id_user);
        }

        if ($stmt->execute()) {
            echo "Data berhasil diupdate!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$koneksi->close();
