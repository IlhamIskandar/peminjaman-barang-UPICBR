<?php
include "koneksi.php";
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>kontak</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    h2,
    h4 {
        font-weight: 600;
    }

    p,
    a,
    button,
    .btn {
        font-family: 'Poppins', sans-serif !important;
    }

    .btn-lg i {
        margin-right: 8px;
    }

    .btn-lg {
        padding: 12px 24px;
        font-weight: 500;
        border-radius: 8px;
    }

    .text-center {
        text-align: center;
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
            <!-- Link Bootstrap Icons -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

            <div class="container mt-5 p-0">
                <h2 class="text-center mb-4" >Kontak Kami</h2>
                <p class="text-center mb-4 text-muted" data-aos="zoom-in" data-aos-delay="50">Ada pertanyaan atau kendala? Jangan ragu untuk menghubungi kami melalui WhatsApp atau email!</p>
                <p class="text-center mb-4 text-muted" data-aos="zoom-in" data-aos-delay="80">Kami juga akan senang menerima saran dan rekomendasi mu loh!</p>

                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <!-- Tombol WhatsApp -->
                        <div class="mb-3 text-center">
                            <a class="btn btn-success btn-lg me-2" href="https://wa.me/6281234567890" data-aos="zoom-in" data-aos-delay="100" target="_blank">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>

                            <!-- Tombol Email -->
                            <a class="btn btn-danger btn-lg" href="https://mail.google.com/mail/?view=cm&fs=1&to=vaniaafiyar@upi.edu&su=Pertanyaan&body=Halo%20UPI%20Cibiru" data-aos="zoom-in" data-aos-delay="200" target="_blank">
                                <i class="bi bi-envelope-fill"></i> Email
                            </a>

                        </div>

                    </div>
                </div>

                <!-- Maps Lokasi -->
                <!-- <div class="row justify-content-center">
                    <div class="col-md-10">
                        <h4 class="text-center mb-3" data-aos="zoom-in" data-aos-delay="300">Lokasi Kami</h4>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7662159688525!2d107.71618717499622!3d-6.918881667698456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c3a0537975eb%3A0x27e96fd179d3fa45!2sUPI%20Kampus%20Cibiru!5e0!3m2!1sid!2sid!4v1717849473014!5m2!1sid!2sid"
                            width="100%"
                            height="400"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" data-aos="zoom-in" data-aos-delay="400">
                        </iframe>
                    </div>
                </div> -->
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
