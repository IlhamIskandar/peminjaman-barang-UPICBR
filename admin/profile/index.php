<?php
include "../koneksi.php";
include "../admin-validation.php";
$id_user = $_SESSION['id'];

  if(isset($_POST['id_user'])) {
    $nama = $_POST['nama'];
    $nimnip = $_POST['nimnip'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    // Update data pengguna
    $stmt = $conn->prepare("UPDATE users SET username=?, nim_nip=?, email=?, notelp=? WHERE id_user=?");
    $stmt->bind_param("ssssi", $nama, $nimnip, $email, $telepon, $id_user);

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Data berhasil diperbarui');
            window.location.href = './';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal memperbarui data');
            window.location.href = './';
        </script>
        ";
    }

    $stmt->close();
}



$stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

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
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <!--end::Primary Meta Tags-->
    <?php include "../partials/head.php" ?>

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
                <!--end::Container-->
            </div>
            <!--begin::App Content-->
            <!--begin::App Main-->
            <main class="app-main">
                <!--begin::App Content-->
                <div class="app-content">
                    <div class="container-fluid" id="dynamic-content">
                        <div class="card card-success card-outline">
                            <div class="card-header ">
                                <h4>Profil Pengguna</h4>
                              </div>
                              <form class="card-body container" action="" method="post">
                                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $data['username'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NIM/NIP</label>
                                    <input type="text" class="form-control" name="nimnip" value="<?= $data['nim_nip'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" required>
                                </div>
                                <div class="mb-4">
                                  <label class="form-label">Nomor Telepon</label>
                                  <input type="text" class="form-control" name="telepon" value="<?= $data['notelp'] ?>" required>
                                </div>
                                <div class="d-flex gap-2">
                                  <button type="submit" class="btn btn-success">Simpan</button>
                                  <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#passModal">
                                    Ubah Password
                                  </button>
                                  <!-- END Button trigger modal -->
                                </div>
                              </form>
                                <!-- Modal -->
                                <div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form action="proses-ubah-pass.php" method="post">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="old_password" class="form-label">Password Lama</label>
                                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                        </div>
                                        <input type="text" name="id_user" value="<?= $data['id_user'] ?>" hidden>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" class="btn btn-warning">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <!-- END Modal -->
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
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
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
        document.addEventListener('DOMContentLoaded', function() {
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
        crossorigin="anonymous"></script>

    <script src="../assets/script.js"></script>
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
