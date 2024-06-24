<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi = $_POST['deskripsi'];
    $id_user = $_POST['id_user'];

    // Upload logo perusahaan
    if (isset($_FILES['logo_perusahaan']) && $_FILES['logo_perusahaan']['error'] == UPLOAD_ERR_OK) {
        $fileLogo = $_FILES['logo_perusahaan'];
        $fileNameLogo = $fileLogo['name'];
        $fileTmpNameLogo = $fileLogo['tmp_name'];
        $fileSizeLogo = $fileLogo['size'];
        $fileErrorLogo = $fileLogo['error'];
        $fileTypeLogo = $fileLogo['type'];

        $fileExtLogo = strtolower(pathinfo($fileNameLogo, PATHINFO_EXTENSION));
        $allowedLogo = array('jpg', 'jpeg', 'png');

        if (in_array($fileExtLogo, $allowedLogo)) {
            if ($fileErrorLogo === 0) {
                $fileNameNewLogo = uniqid('', true) . "." . $fileExtLogo;
                $fileDestinationLogo = 'images/portofolio/' . $fileNameNewLogo;

                if (move_uploaded_file($fileTmpNameLogo, $fileDestinationLogo)) {
                    // Upload gambar portofolio
                    if (isset($_FILES['gambar_portofolio']) && $_FILES['gambar_portofolio']['error'] == UPLOAD_ERR_OK) {
                        $filePortofolio = $_FILES['gambar_portofolio'];
                        $fileNamePortofolio = $filePortofolio['name'];
                        $fileTmpNamePortofolio = $filePortofolio['tmp_name'];
                        $fileSizePortofolio = $filePortofolio['size'];
                        $fileErrorPortofolio = $filePortofolio['error'];
                        $fileTypePortofolio = $filePortofolio['type'];

                        $fileExtPortofolio = strtolower(pathinfo($fileNamePortofolio, PATHINFO_EXTENSION));
                        $allowedPortofolio = array('jpg', 'jpeg', 'png');

                        if (in_array($fileExtPortofolio, $allowedPortofolio)) {
                            if ($fileErrorPortofolio === 0) {
                                $fileNameNewPortofolio = uniqid('', true) . "." . $fileExtPortofolio;
                                $fileDestinationPortofolio = 'images/portofolio/' . $fileNameNewPortofolio;

                                if (move_uploaded_file($fileTmpNamePortofolio, $fileDestinationPortofolio)) {
                                    // Insert data portofolio ke database
                                    $sql = "INSERT INTO tb_portofolio (id_portofolio, deskripsi, logo_perusahaan, gambar_portofolio, id_user)
                                            VALUES (NULL, ?, ?, ?, ?)";
                                    $stmt = $koneksi->prepare($sql);
                                    $stmt->bind_param("ssss", $deskripsi, $fileNameNewLogo, $fileNameNewPortofolio, $id_user);

                                    if ($stmt->execute()) {
                                        echo "Data portofolio berhasil ditambahkan!";
                                    } else {
                                        echo "Error: " . $stmt->error;
                                    }
                                } else {
                                    echo "Terjadi kesalahan saat mengupload gambar portofolio.";
                                }
                            } else {
                                echo "Terjadi kesalahan saat mengupload gambar portofolio.";
                            }
                        } else {
                            echo "File tipe tidak diizinkan untuk gambar portofolio. Hanya JPG dan PNG yang diperbolehkan.";
                        }
                    } else {
                        echo "Terjadi kesalahan saat mengupload gambar portofolio.";
                    }
                } else {
                    echo "Terjadi kesalahan saat mengupload logo perusahaan.";
                }
            } else {
                echo "Terjadi kesalahan saat mengupload logo perusahaan.";
            }
        } else {
            echo "File tipe tidak diizinkan untuk logo perusahaan. Hanya JPG dan PNG yang diperbolehkan.";
        }
    } else {
        echo "Terjadi kesalahan saat mengupload logo perusahaan.";
    }
}

$koneksi->close();
