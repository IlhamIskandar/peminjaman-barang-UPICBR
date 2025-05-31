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
              <div class="col-sm-6"><h3 class="mb-0">Data Barang</h3></div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--begin::App Content-->
        <div class="app-content">
          <div class="container-fluid" id="dynamic-content">
            <div class="card">
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Nama Peminjam</th>
                      <th>NIM/NIP</th>
                      <th>Telepon</th>
                      <th>Email</th>
                      <th>Waktu Peminjaman</th>
                      <th>Batas Pengembalian</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM peminjaman p JOIN users u ON p.id_peminjam = u.id_user JOIN barang b ON p.id_barang = b.id_barang WHERE status='Menunggu Pengambilan' ORDER BY p.tanggal_pinjam DESC");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $n = 1;
                    while($data= mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                      <th><?= $n?></th>
                      <td><?= $data["nama_barang"]?></td>
                      <td><?= $data["username"]?></td>
                      <td><?= $data["nim_nip"]?></td>
                      <td><?= $data["notelp"]?></td>
                      <td><?= $data["email"]?></td>
                      <td><?= $data["tanggal_pinjam"]?></td>
                      <td><?= $data["batas_pengembalian"]?></td>
                      <td>
                        <!-- Modal -->
                        <div class="modal fade" id="konfModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="proses-konfirm.php" method="POST">
                                <input type="hidden" name="id_peminjaman" value="<?= $data['id_peminjaman']?>">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Peminjaman</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    Apakah Anda yakin ingin mengkonfirmasi peminjaman barang <b><?= $data["nama_barang"]?></b> oleh <b><?= $data["username"]?></b>?
                                  </p>
                                  <b>Catatan</b>
                                  <p>
                                    Pastikan peminjam mengambil barang yang sesuai dengan data barang yang dipinjam sebelum melakukan konfirmasi peminjaman.
                                  </p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-success">Konfirmasi</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- END Modal -->
                          <!-- Modal -->
                        <div class="modal fade" id="cancModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="proses-tolak.php" method="post">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Peminjaman</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    Apakah Anda yakin ingin menolak peminjaman barang <b><?= $data["nama_barang"]?></b> oleh <b><?= $data["username"]?></b>?
                                  </p>
                                  <div class="mb-3">
                                    <label for="alasan_tolak" class="form-label">Alasan Penolakan</label>
                                    <textarea class="form-control" id="alasan_tolak" name="alasan_tolak" rows="3" required></textarea>
                                  </div>
                                </div>
                                <input type="hidden" name="id_peminjaman" value="<?= $data['id_peminjaman']?>">
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-danger">Tolak</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- END Modal -->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success btn-sm align-content-center" data-bs-toggle="modal" data-bs-target="#konfModal">
                          <i class="bi bi-check-lg bold"></i>
                        </button>
                        <!-- END Button trigger modal -->
                         <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancModal">
                          <i class="bi bi-x-lg bold"></i>
                        </button>
                        <!-- END Button trigger modal -->
                      </td>
                    </tr>
                    <?php $n++;} ?>
                  </tbody>
                </table>
              </div>
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
