<?php
include "koneksi.php";
include "login-validation.php";

?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE | Dashboard v2" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <?php include "partials/head.php"?>

  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <?php include "partials/navbar.php"; ?>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
        <?php include "partials/sidebar.php"; ?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Peminjaman Anda</h3></div>
              <div class="col-sm-6">
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--begin::App Content-->
        <div class="app-content">
          <div class="container-fluid" id="dynamic-content">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM peminjaman p JOIN users u ON p.id_peminjam = u.id_user JOIN barang b ON p.id_barang = b.id_barang JOIN kategori k ON k.id_kategori = b.id_kategori WHERE p.id_peminjam = ? ORDER BY p.tanggal_pinjam DESC");
                    $stmt->bind_param("i", $_SESSION['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($data= mysqli_fetch_array($result)) {
                    ?>
            <div class="card mb-3">
              <div class="row card-body ">
                <div class="col-md-3 col-lg-2 col-sm-12 d-flex align-items-center">
                  <img class="rounded mx-auto img-fluid" style="max-height: 20vh;" src="../image/barang/<?= $data['img']?>" alt="<?= $data['img']?>">
                </div>
                <div class="col">
                  <div class="row">
                    <h4 class="mb-0"><?= $data["nama_barang"]?></h4>
                  </div>
                  <div class="row">
                     <p class="mb-1 text-muted">
                      <?= $data["nama_kategori"]?>
                     </p>
                  </div>
                  <div class="row">
                    <div class="col-4 col-sm-4 col-lg-3 col-md-4">
                      Nama Peminjam
                    </div>
                    <div class="col">
                      : <?= $data['username']?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4 col-sm-4 col-lg-3 col-md-4">
                      Tanggal Pinjam
                    </div>
                    <div class="col">
                      : <?= date('D, j M Y G:i:s', strtotime($data['tanggal_pinjam']))?>
                    </div>
                  </div>

                  <?php
                  if ($data['status'] == 'Dipinjam' || $data['status'] == 'Menunggu Pengambilan') {
                    ?>
                  <div class="row">
                    <div class="col-4 col-sm-4 col-lg-3 col-md-4">
                      Batas Pengembalian
                    </div>
                    <div class="col">
                      : <?= date('D, j M Y G:i:s', strtotime($data['batas_pengembalian']))?>
                    </div>
                  </div>
                    <?php
                  }
                  ?>
                  <?php
                  if ($data['status'] == 'Dikembalikan') {
                    ?>
                  <div class="row">
                    <div class="col-4 col-sm-4 col-lg-3 col-md-4">
                      Waktu Pengembalian
                    </div>
                    <div class="col">
                      : <?= date('D, j M Y G:i:s', strtotime($data['tanggal_kembali']))?>
                    </div>
                  </div>
                    <?php
                  }
                  ?>
                  <?php

                  if ($data['status'] == 'Dipinjam') {
                    $badgeClass = 'bg-success';
                  } elseif ($data['status'] == 'Ditolak') {
                    $badgeClass = 'bg-danger';
                  } else if ($data['status'] == 'Menunggu Pengambilan') {
                    $badgeClass = 'bg-warning';
                  } else {
                    $badgeClass = 'bg-primary';
                  }
                  ?>
                  <div class="row">
                    <div class="col-4 col-sm-4 col-lg-3 col-md-4">
                      Status
                    </div>
                    <div class="col">
                      : <span class="badge <?= $badgeClass ?>"><?= $data['status'] ?></span>
                    </div>
                  </div>
                  <div class="row">
                    <b>
                      Catatan Peminjam
                    </b>
                  </div>
                  <div class="row">
                    <div class="input-group ">
                        <?= $data['catatan'] == ''? 'TIdak Ada Catatan': $data['catatan'];?>
                      </div>
                  </div>
                  <?php
                  if ($data['status'] == 'Ditolak') {
                    ?>
                  <div class="row">
                    <b>
                      Catatan Penolakan
                    </b>
                  </div>
                  <div class="row">
                    <div class="input-group mb-3 ">
                        <?= $data['alasan'] == ''? 'TIdak Ada': $data['alasan'];?>
                      </div>
                  </div>
                    <?php
                  }
                  ?>

                </div>
              </div>
            </div>
                <?php } ?>
          </div>
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <?php include "partials/footer.php"; ?>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>

    <script src="../assets/script.js"></script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>

