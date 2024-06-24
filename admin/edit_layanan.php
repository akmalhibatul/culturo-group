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
                    <a href="layanan.php" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-bookmark-check"></i></span>
                        <span>Layanan</span>
                    </a>
                </li>
                <li class="nav-link bordered px-3">
                    <a href="porto.php" class="nav-link px-3">
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
            <div style="font-weight: 500;" class="fs-3">Edit Layanan</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="layanan.php">Layanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Layanan</li>
            </ol>
        </nav>
        <div class="all-student mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="page-title fs-5 fw-bold mb-4">
                        Edit Layanan
                    </div>
                    <?php
                    include('koneksi.php');

                    if (isset($_GET['id_layanan'])) {
                        $id_layanan = $_GET['id_layanan'];

                        // Mengambil data layanan dari database
                        $stmt = $koneksi->prepare("SELECT judul_layanan, deskripsi, gambar_layanan, id_user FROM tb_layanan WHERE id_layanan = ?");
                        $stmt->bind_param("i", $id_layanan);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $data = $result->fetch_assoc();
                            $judul_layanan = $data['judul_layanan'];
                            $deskripsi = $data['deskripsi'];
                            $gambar_layanan = $data['gambar_layanan'];
                            $id_user = $data['id_user'];
                        } else {
                            echo "Data tidak ditemukan!";
                            exit;
                        }

                        $stmt->close();
                    } else {
                        echo "ID layanan tidak ditemukan!";
                        exit;
                    }

                    $koneksi->close();
                    ?>
                    <form action="update_layanan.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Judul Layanan</label>
                                    <input class="form-control" placeholder="Masukan Judul...." type="text" name="judul_layanan" value="<?= $judul_layanan; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Deskripsi</label>
                                    <input class="form-control" placeholder="Masukan Deskripsi" type="tel" name="deskripsi" value="<?= $deskripsi; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Gambar Layanan</label>
                                    <?php if ($gambar_layanan) : ?>
                                        <img src="images/layanan/<?php echo $gambar_layanan; ?>" alt="Gambar Layanan" width="100"><br>
                                    <?php endif; ?>
                                    <input class="form-control" type="file" id="gambar_layanan" name="gambar_layanan" accept="image/png, image/jpeg">
                                </div>
                            </div>
                            <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                            <input type="hidden" name="id_layanan" value="<?= $id_layanan; ?>">
                            <div class="col-12 mt-md-4">
                                <div class="mb-3 px-2">
                                    <button type="submit" class="btn btn-success"> Submit </button>
                                    <button type="reset" class="btn btn-warning"> Reset </button>
                                    <a href="layanan.php" class="btn btn-danger"> Kembali </a>
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