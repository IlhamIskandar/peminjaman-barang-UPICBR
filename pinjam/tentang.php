<?php
include "koneksi.php";
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tentang</title>
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
    body {
        font-family: 'Poppins', sans-serif;
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
            <!doctype html>
            <div class="container my-5 text-center" data-aos="zoom-in" data-aos-delay="50">
                <div class="row mb-4">
                    <div class="col">
                        <h2 class="fw-bold">Tentang</h2>
                    </div>
                </div>

                <div class="row justify-content-center text-start fs-5">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted">
                            Website ini adalah sistem informasi peminjaman barang yang dibuat untuk membantu civitas akademika UPI Kampus Cibiru dalam memanfaatkan berbagai fasilitas kampus secara mudah dan efisien.
                        </p>
                        <p class="text-muted">
                            Sistem ini dirancang agar pengguna dapat melihat daftar barang yang tersedia, mengajukan peminjaman, serta memantau statusnya tanpa perlu proses manual yang rumit.
                        </p class="text-muted">
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted">
                            Jika barang yang dibutuhkan tidak tersedia, pengguna tetap bisa menghubungi kontak kami tentang kebutuhannya agar pengelola mengetahui permintaan tersebut — sehingga menjadi lebih responsif dan terorganisir.
                        </p>
                        <p class="text-muted">
                            Sistem ini dibuat oleh mahasiswa untuk mahasiswa, sebagai bentuk kontribusi dalam membangun lingkungan kampus yang lebih tertib, transparan, dan mendukung kegiatan belajar-mengajar.
                        </p>
                    </div>
                </div>

                <!-- Kalimat penutup dan tombol -->
                <div class="row mt-4">
                    <div class="col">
                        <p class="fw-semibold fs-5">
                            Yuk, manfaatkan fasilitas kampus dengan bijak dan maksimal. Demi kenyamanan bersama, semua jadi lebih mudah dengan sistem ini!
                        </p>
                        <a class="btn btn-warning btn-lg mt-3" href="daftarbarang.php" role="button" data-aos="zoom-in" data-aos-delay="100">
                            Pinjam Barang
                        </a>
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