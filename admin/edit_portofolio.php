<?php require_once('header.php') ?>

<!-- sidebar -->
<div class="offcanvas offcanvas-start bg-purple text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header shadow-sm d-block text-center">
        <div class="offcanvas-title" id="offcanvasExampleLabel">
            <a class="navbar-brand fw-bold" href="index.php"><img src="images/logo.png" alt="logo" class="img-fluid" width="80%"></a>
        </div>
    </div>
    <div class="offcanvas-body pt-3 p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav sidenav">
                <li class="nav-link bordered px-3 active">
                    <a href="index.php" class="nav-link px-3 ">
                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-link bordered px-3">
                    <a href="kontak.php" class="nav-link px-3 ">
                        <span class="me-2"><i class="bi bi-person"></i></span>
                        <span>Kontak</span>
                    </a>
                </li>

                <li class="nav-link bordered px-3">
                    <a href="layanan.php" class="nav-link px-3 ">
                        <span class="me-2"><i class="bi bi-bookmark-check"></i></span>
                        <span>Layanan</span>
                    </a>
                </li>
                <li class="nav-link bordered px-3">
                    <a href="porto.php" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-file-person-fill"></i></span>
                        <span>Portofolio</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- sidebar end -->

<!-- main content -->
<main class="mt-3 p-2">
    <div class="container">
        <div class="page-title">
            <div style="font-weight: 500;" class="fs-3">Edit Portofolio</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="porto.php">Portofolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Portofolio</li>
            </ol>
        </nav>
        <div class="all-student mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="page-title fs-5 fw-bold mb-4">
                        Edit Portofolio
                    </div>
                    <?php
                    include('koneksi.php');

                    // Mendapatkan id_portofolio dari URL
                    if (isset($_GET['id_portofolio'])) {
                        $id_portofolio = $_GET['id_portofolio'];

                        // Mengambil data portofolio dari database
                        $stmt = $koneksi->prepare("SELECT deskripsi, logo_perusahaan, gambar_portofolio, id_user FROM tb_portofolio WHERE id_portofolio = ?");
                        $stmt->bind_param("i", $id_portofolio);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $data = $result->fetch_assoc();
                            $deskripsi = $data['deskripsi'];
                            $logo_perusahaan = $data['logo_perusahaan'];
                            $gambar_portofolio = $data['gambar_portofolio'];
                            $id_user = $data['id_user'];
                        } else {
                            echo "Data tidak ditemukan!";
                            exit;
                        }

                        $stmt->close();
                    } else {
                        echo "ID portofolio tidak ditemukan!";
                        exit;
                    }

                    $koneksi->close();
                    ?>
                    <form action="update_portofolio_proses.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_portofolio" value="<?php echo $id_portofolio; ?>">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label for="logo_perusahaan" class="form-label">Logo Perusahaan:</label>
                                    <?php if ($logo_perusahaan) : ?>
                                        <img src="images/portofolio/<?php echo $logo_perusahaan; ?>" alt="Logo Perusahaan" width="100"><br>
                                    <?php endif; ?>
                                    <input type="file" id="logo_perusahaan" name="logo_perusahaan" class="form-control" accept="image/png, image/jpeg">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" required><?php echo $deskripsi; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label for="gambar_portofolio" class="form-label">Gambar Portofolio:</label>
                                    <?php if ($gambar_portofolio) : ?>
                                        <img src="images/portofolio/<?php echo $gambar_portofolio; ?>" alt="Gambar Portofolio" width="100"><br>
                                    <?php endif; ?>
                                    <input type="file" id="gambar_portofolio" name="gambar_portofolio" class="form-control" accept="image/png, image/jpeg">
                                </div>
                            </div>
                            <div class="col-12 mt-md-4">
                                <div class="mb-3 px-2">
                                    <button type="submit" class="btn btn-success"> Submit </button>
                                    <button type="reset" class="btn btn-warning"> Reset </button>
                                    <a href="porto.php" class="btn btn-danger"> Kembali </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end-->
<?php require_once('foooter.php') ?>