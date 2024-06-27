<?php require_once('header.php') ?>

<?php
include 'koneksi.php'; // File koneksi ke database

// Query untuk menghitung jumlah data kontak, layanan, dan portofolio
$sql_kontak = "SELECT COUNT(*) AS total_kontak FROM tb_kontak";
$sql_layanan = "SELECT COUNT(*) AS total_layanan FROM tb_layanan";
$sql_portofolio = "SELECT COUNT(*) AS total_portofolio FROM tb_portofolio";

$result_kontak = $koneksi->query($sql_kontak);
$result_layanan = $koneksi->query($sql_layanan);
$result_portofolio = $koneksi->query($sql_portofolio);

$total_kontak = 0;
$total_layanan = 0;
$total_portofolio = 0;

if ($result_kontak->num_rows > 0) {
  $row = $result_kontak->fetch_assoc();
  $total_kontak = $row['total_kontak'];
}

if ($result_layanan->num_rows > 0) {
  $row = $result_layanan->fetch_assoc();
  $total_layanan = $row['total_layanan'];
}

if ($result_portofolio->num_rows > 0) {
  $row = $result_portofolio->fetch_assoc();
  $total_portofolio = $row['total_portofolio'];
}
?>

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
          <a href="index.php" class="nav-link px-3 active">
            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-link bordered px-3">
          <a href="kontak.php" class="nav-link px-3">
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
      <div style="font-weight: 500;" class="fs-3">Dashboard</div>
    </div>
    <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </nav>

    <div class="dashboard">
      <div class="row">
        <div class="col-md-4">
          <div class="card px-4 border-0 shadow-sm">
            <div class="card-body">
              <div class="fs-5 text-end">
                <?php echo $total_kontak; ?>
              </div>
              <div style="margin-top: -10px;" class="fs-3 text-start text-info">
                <i class="bi bi-person"></i>
              </div>
              <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                Kontak
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card px-4 border-0 shadow-sm">
            <div class="card-body">
              <div class="fs-5 text-end">
                <?php echo $total_layanan; ?>
              </div>
              <div style="margin-top: -10px;" class="fs-3 text-start text-warning">
                <i class="bi bi-bookmark-check"></i>
              </div>
              <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                Layanan
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card px-4 border-0 shadow-sm">
            <div class="card-body">
              <div class="fs-5 text-end">
                <?php echo $total_portofolio; ?>
              </div>
              <div style="margin-top: -10px;" class="fs-3 text-start text-danger">
                <i class="bi bi-file-person-fill"></i>
              </div>
              <div style="margin-top: -40px;" class="fs-5 pt-4 text-end">
                Portofolio
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
<!-- main content end-->
<?php require_once('foooter.php') ?>