<?php
include "koneksi.php";
include "login-validation.php";

?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
    .welcome-section {
        padding: 100px 20px;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
    }

    .welcome-section h1 {
        font-weight: 600;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    .welcome-section .btn-danger {
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        border-radius: 0.8rem;
    }

    .welcome-section .btn-danger:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
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
          <div class="container p-0" id="dynamic-content">
            <!-- Kontennya -->
            <section class="welcome-section text-center text-black" data-aos="fade-up" data-aos-duration="1200">
                <div class="container">
                    <h1 class="display-4 mb-3">Selamat datang di website Peminjaman Barang kami!</h1>
                    <p class="lead mb-4">UPI Kampus Cibiru - Program Studi Teknik Komputer</p>
                    <p class="text-muted">Akses lebih mudah untuk meminjam perlengkapan kampus kapan saja, di mana saja. Sistem ini dibuat agar mahasiswa dan staf bisa mengelola kebutuhan barang dengan cepat dan efisien.</p>
                    <hr class="my-4 w-50 mx-auto">
                    <a class="btn btn-danger btn-lg" href="tentang.php" role="button" data-aos="zoom-in" data-aos-delay="600">Pelajari Lebih Lanjut</a>
                </div>
            </section>

            <!--begin::Footer-->
            <?php include "partials/footer.php"; ?>
            <!--end::Footer-->
          </div>
        </main>
        <!--end::App Main-->
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
