<?php
include "../koneksi.php";
include "../admin-validation.php";

$id_barang = $_POST['id'];
$nama_barang = $_POST['nama'];
$kategori_barang = $_POST['kategori'];
$deskripsi_barang = $_POST['deskripsi'];
$stok = $_POST['stok'];

$stmt = $conn->prepare("UPDATE barang SET nama_barang=?, id_kategori=?, deskripsi=?, stok=?  WHERE id_barang = ?");

$stmt->bind_param("sssss", $nama_barang, $kategori_barang, $deskripsi_barang, $stok, $id_barang);


if ($stmt->execute()) {
    echo "
    <script>
      alert('Berhasil mengubah barang');
      window.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
    <script>
      alert('Gagal mengubah barang');
      window.location.href = 'ubah-barang.php?id=$id_barang';
    </script>
    ";
}
?>
