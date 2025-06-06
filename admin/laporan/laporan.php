<?php
include "../koneksi.php";
include '../admin-validation.php';
include '../function.php';

// Ambil parameter tanggal
$awal_periode = $_POST['tanggal_awal'] ?? date('Y-m-01');
$akhir_periode = $_POST['tanggal_akhir'] ?? date('Y-m-t');

// Validasi tanggal
if (strtotime($awal_periode) > strtotime($akhir_periode)) {
    die("Tanggal awal tidak boleh lebih besar dari tanggal akhir.");
}

// Query data peminjaman
$query = "SELECT p.*, u.username, u.nim_nip, b.nama_barang
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
        }
        .periode {
            font-size: 14px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            padding-top: 20px;
            border-top: 2px solid #333;
        }
        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 12px;
            color: white;
        }
        .bg-warning { background-color: #ffc107; }
        .bg-success { background-color: #198754; }
        .bg-secondary { background-color: #6c757d; }
        .bg-danger { background-color: #dc3545; }
        @page {
            size: A4;
            margin: 10mm;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN PEMINJAMAN BARANG</div>
        <div class="title">UPI CIBIRU</div>
        <div class="periode">
            Periode: <?= date('d F Y', strtotime($awal_periode)) ?> - <?= date('d F Y', strtotime($akhir_periode)) ?>
        </div>
    </div>

    <table>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $n = 1;
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    $status_badge = '';
                    switch ($data['status']) {
                        case 'dipinjam':
                            $status_badge = '<span class="badge bg-warning">Dipinjam</span>';
                            break;
                        case 'Dikembalikan':
                            $status_badge = '<span class="badge bg-success">Kembali</span>';
                            break;
                        case 'Menunggu Pengambilan':
                            $status_badge = '<span class="badge bg-secondary">Menunggu</span>';
                            break;
                        case 'Ditolak':
                            $status_badge = '<span class="badge bg-danger">Ditolak</span>';
                            break;
                    }
            ?>
            <tr>
                <td><?= $n ?></td>
                <td><?= htmlspecialchars($data['username']) ?></td>
                <td><?= htmlspecialchars($data['nim_nip']) ?></td>
                <td><?= htmlspecialchars($data['nama_barang']) ?></td>
                <td><?= date('d M Y', strtotime($data['tanggal_pinjam'])) ?></td>
                <td><?= date('d M Y', strtotime($data['batas_pengembalian'])) ?></td>
                <td><?= ($data['tanggal_kembali'] == '0000-00-00 00:00:00' || empty($data['tanggal_kembali'])) ? '-' : date('d M Y', strtotime($data['tanggal_kembali'])) ?></td>
                <td><?= $status_badge ?></td>
            </tr>
            <?php
                    $n++;
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">Tidak ada data peminjaman</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        <div style="float: left; width: 50%; text-align: center;">
            <p>Mengetahui,</p>
            <br><br><br>
            <p>_________________________</p>
            <p>Direktur</p>
        </div>
        <div style="float: right; width: 50%; text-align: center;">
            <p>Bandung, <?= date('d F Y') ?></p>
            <br><br><br>
            <p>_________________________</p>
            <p>Pengelola</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
