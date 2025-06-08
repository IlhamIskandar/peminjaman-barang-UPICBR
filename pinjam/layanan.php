<?php
include "koneksi.php";
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>layanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
    <?php include "partials/head.php" ?>

</head>

<style>
    .service-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        border-radius: 1rem;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .service-icon {
        font-size: 2.5rem;
    }
</style>

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

            <!-- Konten -->
            <div class="container my-5" style="font-family: 'Poppins', sans-serif;" data-aos="zoom-in" data-aos-delay="100">
                <h2 class="text-center fw-bold mb-4">Layanan Kami</h2>

                <!-- Baris Pertama -->
                <div class="row justify-content-center g-4 mb-3 text-center">
                    <div class="col-md-6">
                        <div class="card service-card p-4 h-100">
                            <i class="bi bi-box-seam service-icon text-warning mb-3"></i>
                            <h5 class="fw-semibold">Peminjaman Barang</h5>
                            <p class="text-muted">Pinjam perlengkapan kampus seperti tripod, proyektor, kabel HDMI, dan lainnya dengan mudah secara online.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card service-card p-4 h-100">
                            <i class="bi bi-clock-history service-icon text-primary mb-3"></i>
                            <h5 class="fw-semibold">Pantau Status</h5>
                            <p class="text-muted">Lihat daftar barang yang tersedia dan pantau status peminjaman kamu kapan saja.</p>
                        </div>
                    </div>
                </div>

                <!-- Baris Kedua -->
                <div class="row justify-content-center g-4 text-center">
                    <div class="col-md-6">
                        <div class="card service-card p-4 h-100">
                            <i class="bi bi-plus-circle service-icon text-success mb-3"></i>
                            <h5 class="fw-semibold">Permintaan Barang</h5>
                            <p class="text-muted">Butuh barang yang tidak tersedia? Hubungi kami melalui halaman <a href="kontak.php" class="text-decoration-none fw-semibold">kontak</a> untuk mengajukan permintaan.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card service-card p-4 h-100">
                            <i class="bi bi-truck service-icon text-danger mb-3"></i>
                            <h5 class="fw-semibold">Pick Up / Antar Barang</h5>
                            <p class="text-muted">Barang bisa diambil langsung atau diantar ke ruanganmu. Isi catatan saat meminjam, atau hubungi kami langsung.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Footer-->
            <?php include "partials/footer.php"; ?>
            <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2000,
        });
    </script>
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
    <script src="../dist/js/adminlte.js"></script>
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
