<?php
include '../koneksi.php';
include '../admin-validation.php';
include '../function.php';

if(isset($_POST['id_peminjaman'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_peminjam = $_POST['id_peminjam'];
    $alasan_tolak = $_POST['alasan_tolak'];

    // Update status peminjaman to 'Ditolak' and set the reason
    $query = "UPDATE peminjaman SET status='Ditolak', id_admin=?, alasan=? WHERE id_peminjaman=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $_SESSION['id'], $alasan_tolak, $id_peminjaman);

    if($stmt->execute()) {
        $getUser = "SELECT nama_barang from peminjaman p JOIN barang b ON p.id_barang = b.id_barang WHERE p.id_peminjaman = ?";
        $getUser = $conn->prepare($getUser);
        $getUser->bind_param("i", $id_peminjaman);
        $getUser->execute();
        $result = $getUser->get_result();
        $data = $result->fetch_assoc();
        $nama_barang = $data['nama_barang'];
        addNotification($id_peminjam, "Peminjaman $nama_barang telah Ditolak.");

        echo "<script>alert('Peminjaman berhasil ditolak.'); window.location.href='../peminjaman';</script>";

    } else {
        echo "<script>alert('Gagal menolak peminjaman. Silakan coba lagi.'); window.location.href='../peminjaman';</script>";
    }

    $stmt->close();


} else {
    echo "<script>alert('Data tidak lengkap.'); window.location.href='../peminjaman';</script>";
}
?>
