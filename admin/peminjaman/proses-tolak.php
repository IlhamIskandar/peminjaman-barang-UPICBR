<?php
include '../koneksi.php';
include '../admin-validation.php';

if(isset($_POST['id_peminjaman'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $alasan_tolak = $_POST['alasan_tolak'];

    // Update status peminjaman to 'Ditolak' and set the reason
    $query = "UPDATE peminjaman SET status='Ditolak', id_admin=?, alasan=? WHERE id_peminjaman=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $_SESSION['id'], $alasan_tolak, $id_peminjaman);

    if($stmt->execute()) {
        echo "<script>alert('Peminjaman berhasil ditolak.'); window.location.href='../peminjaman';</script>";

    } else {
        echo "<script>alert('Gagal menolak peminjaman. Silakan coba lagi.'); window.location.href='../peminjaman';</script>";
    }

    $stmt->close();


} else {
    echo "<script>alert('Data tidak lengkap.'); window.location.href='../peminjaman';</script>";
}
?>
