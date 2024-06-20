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
            <div style="font-weight: 500;" class="fs-3">Portofolio</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portofolio</li>
            </ol>
            <a href="tambah_portofolio.php" class="btn btn-primary">Tambah Portofolio</a>
        </nav>
        <div class="all-student mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Deskripsi</th>
                                <th>Gambar Portofolio</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>201901002</td>
                                <td>Arafat</td>
                                <td>CSE</td>
                                <td>
                                    <a href="edit_portofolio.php" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end-->
<?php require_once('foooter.php') ?>