<?php
include '../koneksi.php';
include '../admin-validation.php';
include '../function.php';

if(isset($_POST)){
  $id_peminjaman = $_POST['id_peminjaman'];
  $id_peminjam = $_POST['id_peminjam'];

    // Check if the peminjaman exists
    $checkQuery = "SELECT * FROM peminjaman WHERE id_peminjaman = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("i", $id_peminjaman);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if($result->num_rows === 0) {
        echo "<script>alert('Peminjaman tidak ditemukan.'); window.location.href='../peminjaman';</script>";
        exit;
    }

    // Update the status of the peminjaman to 'Dipinjam'

  $query = "UPDATE peminjaman SET status='Dipinjam', id_admin=? WHERE id_peminjaman=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $_SESSION['id'], $id_peminjaman);

    if($stmt->execute()) {
        // Update the stock of the borrowed item
        $updateQuery = "UPDATE barang SET tersedia = tersedia - 1 WHERE id_barang = (SELECT id_barang FROM peminjaman WHERE id_peminjaman = ?)";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $id_peminjaman);
        $updateStmt->execute();
        $updateStmt->close();

        $getUser = "SELECT nama_barang from peminjaman p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_peminjaman = ?";
        $getUser = $conn->prepare($getUser);
        $getUser->bind_param("i", $id_peminjaman);
        $getUser->execute();
        $result = $getUser->get_result();
        $data = $result->fetch_assoc();
        $nama_barang = $data['nama_barang'];
        addNotification($id_peminjam, "Peminjaman $nama_barang telah dikonfirmasi. Silakan ambil barang di tempat peminjaman.");
        echo "<script>alert('Peminjaman berhasil dikonfirmasi.'); window.location.href='../peminjaman';</script>";

    } else {
        echo "<script>alert('Gagal mengkonfirmasi peminjaman. Silakan coba lagi.'); window.location.href='../peminjaman';</script>";
    }
    $stmt->close();
}
?>
