<?php
include "../koneksi.php";
include "../admin-validation.php";

if(isset($_POST)){
  $id_peminjaman = $_POST['id_peminjaman'];

  $query = "UPDATE peminjaman SET status='Dikembalikan', id_admin=?, tanggal_kembali=? WHERE id_peminjaman=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $_SESSION['id'], date('Y-m-d H:i:s'), $id_peminjaman );

    if($stmt->execute()) {
        // Update the stock of the borrowed item
        $updateQuery = "UPDATE barang SET tersedia = tersedia + 1 WHERE id_barang = (SELECT id_barang FROM peminjaman WHERE id_peminjaman = ?)";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $id_peminjaman);
        $updateStmt->execute();
        $updateStmt->close();
        echo "<script>alert('Pengembalian berhasil dikonfirmasi.'); window.location.href='../pengembalian';</script>";

    } else {
        echo "<script>alert('Gagal mengkonfirmasi Pengembalian. Silakan coba lagi.'); window.location.href='../pengembalian';</script>";
    }
    $stmt->close();
}
?>
