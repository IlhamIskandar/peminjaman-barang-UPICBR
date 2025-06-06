<?php
include "../koneksi.php";
include "../admin-validation.php";

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
    <?php include "../partials/head.php"?>

  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <?php include "../partials/navbar.php"; ?>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
        <?php include "../partials/sidebar.php"; ?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
            <main class="app-main">
              <!--begin::App Content Header-->
              <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Data Pengguna</h3></div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-end">
                        <!-- <li class="breadcrumb-item"><a href="./">Kembali</a></li> -->
                      </ol>
                    </div>
                  </div>
                  <!--end::Row-->
                </div>
                <!--end::Container-->
              </div>
                <!--begin::App Content-->
                <div class="app-content">
                    <div class="container-fluid" id="dynamic-content">
                        <div class="card card-success card-outline">
                            <div class="card-header ">
                                <h4>Ubah Password Pengguna</h4>
                                Masukan data akun pengguna yang ingin diubah passwordnya.
                              </div>
                              <form class="card-body container" action="proses-ubah-password.php" method="post">
                                <div class="">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="" placeholder="Masukkan Nama Lengkap Pengguna" required>
                                </div>
                                <div class="">
                                    <label class="form-label">NIM/NIP</label>
                                    <input type="text" class="form-control" name="nimnip" value="" placeholder="Masukan NIM/NIP Pengguna" required>
                                </div>
                                <div class="">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="" placeholder="Masukan Email Pengguna" required>
                                </div>
                                <div class="">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="notelp" value="" required placeholder="Masukkan Nomor Telepon Pengguna">
                                </div>
                                <div class="">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password_baru" placeholder="Masukkan Password Baru" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" name="konfirmasi" placeholder="Konfirmasi Password Baru" required>
                                </div>
                                <div class="d-flex gap-2">
                                  <button type="submit" class="btn btn-success">Ubah</button>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
                <!--end::App Content-->
            </main>

      <!--end::App Main-->
      <!--begin::Footer-->
      <?php include "../partials/footer.php"; ?>
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
    <script src="../../dist/js/adminlte.js"></script>
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
