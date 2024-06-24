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
                <?php if ($level == 'super_admin') : ?>
                    <li class="nav-link bordered px-3">
                        <a href="user.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-person-add"></i></span>
                            <span>User</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
<!-- sidebar end -->

<!-- main content -->
<main class="mt-3 p-2">
    <div class="container">
        <div class="page-title">
            <div style="font-weight: 500;" class="fs-3">Tambah Portofolio</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="porto.php">Portofolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Portofolio</li>
            </ol>
        </nav>
        <div class="all-student mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="page-title fs-5 fw-bold mb-4">
                        Tambah Portofolio
                    </div>
                    <form action="tambah_portofolio_proses.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Logo Perusahaan</label>
                                    <input type="file" id="logo_perusahaan" name="logo_perusahaan" class="form-control" accept="image/png, image/jpeg" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Gambar portofolio</label>
                                    <input type="file" id="gambar_portofolio" name="gambar_portofolio" class="form-control" accept="image/png, image/jpeg, image/svg+xml" required>
                                </div>
                                <input type="hidden" name="id_user" value="1"> <!-- Menambahkan input id_user -->

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