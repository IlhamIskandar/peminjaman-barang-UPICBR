<?php
include "../koneksi.php";
include "../admin-validation.php";

if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM barang WHERE id_barang=?");
  $stmt->bind_param("i", $_GET['id']);
  $stmt->execute();
  $result = $stmt->get_result();
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
  } else {
    echo "
    <script>
      alert('Data tidak ditemukan');
      window.location.href = 'index.php';
    </script>
    ";
  }
} else {
  echo "
  <script>
    alert('ID barang tidak ditemukan');
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
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="./">Kembali</a></li>
                  <!-- <li class="breadcrumb-item">Data Barang</li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Data Barang</li> -->
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
            <div class="card card-warning card-outline">
              <div class="card-header ">
                <h4>Ubah Barang</h4>
              </div>
              <form class="card-body container" action="proses-ubah-barang.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id_barang']; ?>">
                <div class="row mb-3">
                  <div class="col">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama barang" required value="<?= $data['nama_barang']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3 col-sm-12">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" aria-label="Default select example" id="kategori" name="kategori" required>
                      <option value="<?= htmlspecialchars($data['kategori']) ?>"><?= htmlspecialchars($data['kategori']) ?></option>
                      <?php
                        $stmt = $conn->prepare("SELECT * FROM kategori");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = mysqli_fetch_array($result)) {
                          ?>
                          <option value="<?= htmlspecialchars($row['nama_kategori']) ?>" <?= $row['nama_kategori'] == $data['kategori'] ? 'selected' : '' ?>>
                          <?= htmlspecialchars($row['nama_kategori']) ?>
                          </option>
                          <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 ">
                    <label for="deskripsi">Deskripsi Barang</label>
                    <textarea class="form-control" placeholder="Masukan deskripsi barang" id="deskripsi" name="deskripsi"><?= $data['deskripsi'] ?></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="img" class="form-label">Upload Gambar Barang</label>
                    <input class="form-control" type="file" id="img" name="img" accept="image/*">
                    <img style="max-width: 20vh;" src="../../image/barang/<?= $data['img']?>" alt="<?= $data['img']?>">
                    <input type="text" class="form-control mt-2" id="img_lama" name="img_lama" value="<?= $data['img']?>" hidden>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3 mb-3 ">
                    <label class="form-label" for="stok">Stok Barang</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukan stok barang" required value="<?= $data['stok']; ?>">
                  </div>
                  <div class="col-3 mb-3 ">
                    <label class="form-label" for="tersedia">Jumlah Barang Bisa Dipinjam</label>
                    <input type="number" class="form-control" id="tersedia" name="tersedia" placeholder="Jumlah ketersediaan barang" required value="<?= $data['tersedia']; ?>">
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-auto mb-3">
                    <button class="btn btn-warning">Ubah</button>
                  </div>
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
