<?php
include "../koneksi.php";
include "../admin-validation.php";
$id_user = $_SESSION['id']; // pastikan id user disimpan saat login

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nimnip = $_POST['nimnip'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password) {
        echo "<script>alert('Konfirmasi kata sandi tidak cocok!');</script>";
    } else{
      // find user by email and nimnip
      $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND nim_nip = ?");
      $stmt->bind_param("ss", $email, $nimnip);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0) {
          // User found, update password
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ? AND nim_nip = ?");
          $update_stmt->bind_param("sss", $hashed_password, $email, $nimnip);

          if($update_stmt->execute()) {
              echo "<script>alert('Kata sandi berhasil diubah!');</script>";
              $update_stmt->close();
          } else {
              echo "<script>alert('Gagal mengubah kata sandi. Silakan coba lagi.');</script>";
          }
      } else {
          echo "<script>alert('Pengguna tidak ditemukan dengan email dan NIM/NIP tersebut.');</script>";
      }
      $stmt->close();

    }

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
                        <div class="card card-outline">
                            <div class="card-header ">
                                <h4 >Ubah Kata Sandi Pengguna</h3>
                                Masukkan Email dan NIM/NIP untuk reset kata sandi
                            </div>
                            <form class="card-body container" action="" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nimnip" class="form-label">NIM/NIP</label>
                                    <input type="nimnip" class="form-control" name="nimnip" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi Baru</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                    <input type="confirm_password" class="form-control" name="confirm_password" required>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                                </div>
                            </form>
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-info mt-3">
                                    <?= $message ?>
                                </div>
                            <?php endif; ?>
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
