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
                <?php if ($level == 'super_admin') : ?>
                    <li class="nav-link bordered px-3">
                        <a href="user.php" class="nav-link px-3 active">
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
            <div style="font-weight: 500;" class="fs-3">Edit User</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="user.php">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="all-student mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="page-title fs-5 fw-bold mb-4">
                        Edit User
                    </div>
                    <?php
                    include 'koneksi.php'; // File koneksi ke database

                    // Periksa apakah pengguna sudah login dan levelnya super_admin
                    if (!isset($_SESSION['username']) || $_SESSION['level'] != 'super_admin') {
                        header("Location: login.php");
                        exit;
                    }

                    // Ambil id_user dari query string
                    $id_user = $_GET['id_user'];

                    // Query untuk mendapatkan data pengguna berdasarkan id_user
                    $sql = "SELECT * FROM tb_user WHERE id_user = ?";
                    $stmt = $koneksi->prepare($sql);
                    $stmt->bind_param("i", $id_user);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();

                    if (!$user) {
                        echo "User tidak ditemukan!";
                        exit;
                    }
                    ?>
                    <form action="edit_user_proses.php" method="post">
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Username</label>
                                    <input class="form-control" placeholder="Masukan Username...." type="text" name="username" value="<?php echo $user['username']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" placeholder="Masukan Password...." type="password" name="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input class="form-control" placeholder="Masukan Nama Lengkap...." type="text" name="nama_lengkap" value="<?php echo $user['nama_lengkap']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Level</label>
                                    <select class="form-control" name="level" required>
                                        <option value="admin" <?php if ($user['level'] == 'admin') echo 'selected'; ?>>Admin</option>
                                        <option value="super_admin" <?php if ($user['level'] == 'super_admin') echo 'selected'; ?>>Super Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="aktif" <?php if ($user['status'] == 'aktif') echo 'selected'; ?>>Aktif</option>
                                        <option value="non_aktif" <?php if ($user['status'] == 'non_aktif') echo 'selected'; ?>>Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-md-4">
                                <div class="mb-3 px-2">
                                    <button type="submit" class="btn btn-success"> Submit </button>
                                    <button type="reset" class="btn btn-warning"> Reset </button>
                                    <a href="user.php" class="btn btn-danger"> Kembali </a>
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