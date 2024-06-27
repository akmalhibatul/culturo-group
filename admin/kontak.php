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
                    <a href="kontak.php" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-person"></i></span>
                        <span>Kontak</span>
                    </a>
                </li>

                <li class="nav-link bordered px-3">
                    <a href="layanan.php" class="nav-link px-3">
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
            <div style="font-weight: 500;" class="fs-3">Kontak</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kontak</li>
            </ol>
        </nav>
        <div class="all-student mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <?php
                    include 'koneksi.php'; // File koneksi ke database
                    $sql = "SELECT id_kontak, nama_lengkap, nama_perusahaan, email, no_telp, pesan FROM tb_kontak ORDER BY id_kontak DESC";
                    $result = $koneksi->query($sql);
                    ?>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Nama Perusahaan</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data setiap baris
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["nama_lengkap"] . "</td>";
                                    echo "<td>" . $row["nama_perusahaan"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["no_telp"] . "</td>";
                                    echo "<td>" . $row["pesan"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end-->
<?php require_once('foooter.php') ?>