<?php
include 'koneksi.php';
include 'login-validation.php';

if(isset($_GET['id'])) {
    $id_peminjaman = $_GET['id'];

    // Update status peminjaman to 'Dibatalkan'
    $query = "DELETE FROM peminjaman WHERE id_peminjaman = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_peminjaman);

    if($stmt->execute()) {
        echo "<script>alert('Peminjaman berhasil dibatalkan.'); window.location.href='daftar-pinjaman.php';</script>";
    } else {
        echo "<script>alert('Gagal membatalkan peminjaman. Silakan coba lagi.'); window.location.href='daftar-pinjaman.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Data tidak lengkap.'); window.location.href='daftar-pinjaman.php';</script>";
}
?>
