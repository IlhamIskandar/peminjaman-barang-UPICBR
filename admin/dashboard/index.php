<?php
include "../koneksi.php";
include "../admin-validation.php";

// Hitung total data
$query = [
    'barang' => "SELECT COUNT(*) as total FROM barang",
    'peminjaman' => "SELECT COUNT(*) as total FROM peminjaman WHERE tanggal_pinjam >= CURDATE() - INTERVAL 30 DAY",
    'user' => "SELECT COUNT(*) as total FROM users WHERE role = 'peminjam'",
    'peminjaman_aktif' => "SELECT COUNT(*) as total FROM peminjaman WHERE status = 'dipinjam'"
];

$stats = [];
foreach ($query as $key => $sql) {
    $result = $conn->query($sql);
    $stats[$key] = $result->fetch_assoc()['total'];
}

// Data untuk chart peminjaman 7 hari terakhir
$chart_data = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $sql = "SELECT COUNT(*) as total FROM peminjaman WHERE DATE(tanggal_pinjam) = '$date'";
    $result = $conn->query($sql);
    $chart_data['labels'][] = date('d M', strtotime($date));
    $chart_data['data'][] = $result->fetch_assoc()['total'];
}

// Peminjaman terbaru
$recent_peminjaman = $conn->query(
    "SELECT p.*, u.username, b.nama_barang
     FROM peminjaman p
     JOIN users u ON p.id_peminjam = u.id_user
     JOIN barang b ON p.id_barang = b.id_barang
     ORDER BY p.tanggal_pinjam DESC LIMIT 5"
);

// Data untuk chart status barang
$status_barang = $conn->query(
    "SELECT
        SUM(CASE WHEN tersedia > 0 THEN 1 ELSE 0 END) as tersedia,
        SUM(CASE WHEN tersedia = 0 THEN 1 ELSE 0 END) as dipinjam
     FROM barang"
)->fetch_assoc();

$status_data = [
    $status_barang['tersedia'] ?? 0,
    $status_barang['dipinjam'] ?? 0,
    $status_barang['perbaikan'] ?? 0
];
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
    <?php include "../partials/head.php";?>
    <style>
      /* Dashboard Cards */
.card-statistic {
    transition: transform 0.3s;
    border-radius: 10px;
    overflow: hidden;
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-statistic:hover {
    transform: translateY(-5px);
}

.card-statistic .card-body {
    padding: 1.5rem;
}

.card-statistic i {
    font-size: 2.5rem;
    opacity: 0.8;
}

/* Chart Container */
.chart-container {
    position: relative;
    min-height: 300px;
}

/* Table */
.table-responsive {
    overflow-x: auto;
}

.table thead th {
    white-space: nowrap;
    background-color: #f8f9fa;
}
    </style>

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
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li> -->
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--begin::App Content-->
        <div class="app-content">
<div class="container-fluid">
    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Barang</h6>
                            <h2 class="mb-0"><?= $stats['barang'] ?></h2>
                        </div>
                        <i class="bi bi-box-seam display-4 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Peminjaman (30 Hari)</h6>
                            <h2 class="mb-0"><?= $stats['peminjaman'] ?></h2>
                        </div>
                        <i class="bi bi-clipboard-data display-4 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Peminjaman Aktif</h6>
                            <h2 class="mb-0"><?= $stats['peminjaman_aktif'] ?></h2>
                        </div>
                        <i class="bi bi-hourglass-split display-4 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Pengguna</h6>
                            <h2 class="mb-0"><?= $stats['user'] ?></h2>
                        </div>
                        <i class="bi bi-people display-4 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Tabel -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Aktivitas Peminjaman 7 Hari Terakhir</h5>
                </div>
                <div class="card-body">
                    <div id="chart-peminjaman"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Status Barang</h5>
                </div>
                <div class="card-body">
                    <div id="chart-status"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Peminjaman Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peminjam</th>
                                    <th>Barang</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($recent_peminjaman->num_rows > 0): ?>
                                    <?php $no = 1; while($row = $recent_peminjaman->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['username']) ?></td>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td><?= date('d M Y', strtotime($row['tanggal_pinjam'])) ?></td>
                                        <td>
                                            <?php
                                            $badge_class = [
                                                'dipinjam' => 'bg-warning',
                                                'Dikembalikan' => 'bg-success',
                                                'Menunggu Pengambilan' => 'bg-secondary',
                                                'Ditolak' => 'bg-danger'
                                            ];
                                            ?>
                                            <span class="badge <?= $badge_class[$row['status']] ?? 'bg-primary' ?>">
                                                <?= $row['status'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="../laporan/detail-peminjaman.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data peminjaman</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Inisialisasi Chart
document.addEventListener('DOMContentLoaded', function() {
    // Chart Peminjaman
    const peminjamanChart = new ApexCharts(document.querySelector("#chart-peminjaman"), {
        series: [{
            name: 'Jumlah Peminjaman',
            data: <?= json_encode($chart_data['data']) ?>
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: { show: false }
        },
        colors: ['#3b82f6'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth' },
        xaxis: {
            categories: <?= json_encode($chart_data['labels']) ?>
        },
        tooltip: {
            y: { formatter: val => `${val} peminjaman` }
        }
    });
    peminjamanChart.render();

    // Chart Status Barang
    const statusChart = new ApexCharts(document.querySelector("#chart-status"), {
        series: [75, 15, 10], // Contoh data (ganti dengan query database)
        chart: {
            type: 'donut',
            height: 350
        },
        labels: ['Tersedia', 'Dipinjam', 'Perbaikan'],
        colors: ['#10b981', '#f59e0b', '#ef4444'],
        legend: { position: 'bottom' },
        responsive: [{
            breakpoint: 480,
            options: { chart: { width: 200 } }
        }]
    });
    statusChart.render();
});
</script>
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
