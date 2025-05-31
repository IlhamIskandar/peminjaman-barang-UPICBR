<?php
include "koneksi.php";
include "login-validation.php";

if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM barang b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE id_barang=? ");
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $result = $stmt->get_result();
  if (mysqli_num_rows($result) > 0) {
    $data_barang = mysqli_fetch_assoc($result);
  } else {
    echo "
    <script>
      alert('Data Barang tidak ditemukan');
      window.location.href = 'index.php';
    </script>
    ";
  }
  $stmt = $conn->prepare("SELECT * FROM users WHERE id_user=? ");
  $stmt->bind_param("i", $_SESSION['id']);
  $stmt->execute();
  $user_result = $stmt->get_result();
  if (mysqli_num_rows($user_result) > 0) {
    $data_user = mysqli_fetch_assoc($user_result);
  } else {
    echo "
    <script>
      alert('Data Pengguna tidak ditemukan');
      window.location.href = 'index.php';
    </script>
    ";
  }
} else {
  echo "
  <script>
    alert('Pengguna tidak ditemukan');
    window.location.href = 'index.php';
  </script>
  ";
}
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
              <div class="col-sm-6"><h3 class="mb-0">Pinjam Barang</h3></div>
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
            <div class="card mb-3">
              <div class="row card-body ">
                <div class="col-md-3 col-lg-2 col-sm-12 d-flex align-items-center">
                  <img class="rounded mx-auto img-fluid" style="" src="../image/barang/<?= $data_barang['img']?>" alt="<?= $data_barang['img']?>">
                </div>
                <div class="col">
                  <div class="row">
                    <h4 class="mb-1">Informasi Barang</h4>
                  </div>
                  <div class="row">
                    <div class="col-2 mb-1">
                      Nama Barang
                    </div>
                    <div class="col mb-1">
                      : <?= $data_barang["nama_barang"]?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2 mb-1">
                      Kategori
                    </div>
                    <div class="col mb-1">
                      : <?= $data_barang["nama_kategori"]?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      Deskripsi Barang
                      </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <?= $data_barang["deskripsi"]?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <h4>Informasi Peminjam</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <?= $data_user["username"]?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <?= $data_user["email"]?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <?= $data_user["notelp"]?>
                    </div>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-6">
                      <p class="mb-0">
                        Tersedia: <span class="badge bg-success"><?= $data_barang["stok"]?></span>
                      </p>
                    </div>
                    <div class="col-6 justify-content-end d-flex">
                        <a href="barang.php?id=<?= $data_barang['id_barang']?>" class="btn btn-primary">Pinjam</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

