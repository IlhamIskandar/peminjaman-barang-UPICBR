<?php
include "../koneksi.php";
include '../admin-validation.php';
include '../function.php';

if(isset($_POST['tanggal_awal']) && isset($_POST['tanggal_akhir'])) {
    $awal_periode = $_POST['tanggal_awal'];
    $akhir_periode = $_POST['tanggal_akhir'];

    // Validasi tanggal
    if (strtotime($awal_periode) > strtotime($akhir_periode)) {
        echo "<script>alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir.'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    // Set default periode jika tidak ada input
    $awal_periode = date('Y-m-01'); // Awal bulan ini
    $akhir_periode = date('Y-m-t'); // Akhir bulan ini
}
// Query untuk mengambil data peminjaman

$query = "SELECT *
          FROM peminjaman p
          JOIN users u ON p.id_peminjam = u.id_user
          JOIN barang b ON p.id_barang = b.id_barang
          WHERE p.tanggal_pinjam BETWEEN ? AND ?
          ORDER BY p.tanggal_pinjam DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $awal_periode, $akhir_periode);
$stmt->execute();
$result = $stmt->get_result();
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
              <div class="col-sm-6"><h3 class="mb-0">Laporan Peminjaman</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tabel Peminjaman</li>
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
            <div class="card">
              <div class="card-body">
                <form action="" method="post">

                  <div class="row align-items-baseline"  action="../cetak/laporan-peminjaman.php" method="post" target="_blank">
                    <div class="col-md-3 col-lg-auto col-sm-1" >
                      <input type="date" id="searchInput" name="tanggal_awal" class="form-control mb-3"  />
                    </div>
                    <div class="col-md-auto col-lg-auto col-sm-3 text-center mb-3">
                      <span>Sampai</span>
                    </div>
                    <div class="col-md-3 col-lg-auto col-sm-3">
                      <input type="date" id="searchInput " name="tanggal_akhir" class="form-control mb-3"  />
                    </div>
                    <div class="col-sm-auto col-md-auto col-lg-auto ">
                      <button type="submit" class="btn btn-success">Ubah Periode</button>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cetakModal">
                        Cetak Laporan
                      </button>
                      <!-- END Button trigger modal -->
                    </div>
                  </div>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <form action="laporan.php" method="post" target="_blank">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak Laporan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                              <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                              <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" required />
                            </div>
                            <div class="mb-3">
                              <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                              <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" required />
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- END Modal -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Peminjam</th>
                      <th>NIM/NIP</th>
                      <th>Barang Dipinjam</th>
                      <th>Tanggal Pinjam</th>
                      <th>Batas Pengembalian</th>
                      <th>Tanggal Kembali</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $n = 1;
                    if ($result->num_rows > 0) {
                      while ($data = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <th><?= $n ?></th>
                          <td><?= htmlspecialchars($data['username']) ?></td>
                          <td><?= htmlspecialchars($data['nim_nip']) ?></td>
                          <td><?= htmlspecialchars($data['nama_barang']) ?></td>
                          <td><?= htmlspecialchars($data['tanggal_pinjam']) ?></td>
                          <td><?= htmlspecialchars($data['batas_pengembalian']) ?></td>
                          <td><?= htmlspecialchars($data['tanggal_kembali']) ?></td>
                          <td>
                            <?php
                            if ($data['status'] == 'dipinjam') {
                              echo "<span class='badge bg-warning'>Dipinjam</span>";
                            } elseif ($data['status'] == 'Dikembalikan') {
                              echo "<span class='badge bg-success'>Kembali</span>";
                            } else if($data['status'] == 'Menunggu Pengambilan') {
                              echo "<span class='badge bg-secondary'>Menunggu Pengambilan</span>";
                            } elseif ($data['status'] == 'Ditolak') {
                              echo "<span class='badge bg-danger'>Ditolak</span>";
                            }
                            ?>
                          </td>
                          <td>
                            <a href="../laporan/detail-peminjaman.php?id=<?= $data['id_peminjaman'] ?>" class="btn btn-sm btn-primary" title="Detail Peminjaman">
                              <i class="bi bi-eye"></i>
                            </a>
                          </td>
                        </tr>
                    <?php
                        $n++;
                      }
                    } else {
                      echo "<tr><td colspan='7' class='text-center'>Tidak ada data peminjaman</td></tr>";
                    }
                    ?>
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
