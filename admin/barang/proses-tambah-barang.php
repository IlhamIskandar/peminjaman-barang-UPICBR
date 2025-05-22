<?php

include "../koneksi.php";

$nama_barang = $_POST['nama'];
$kategori_barang = $_POST['kategori'];
$deskripsi_barang = $_POST['deskripsi'];
$stok = $_POST['stok'];

$stmt = $conn->prepare("INSERT INTO barang (nama_barang, id_kategori, deskripsi, stok) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama_barang, $kategori_barang, $deskripsi_barang, $stok);

if ($stmt->execute()) {
    echo "
    <script>
      alert('Berhasil menambah barang');
      window.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
    <script>
      alert('Gagal menambah barang');
      window.location.href = 'tambah-barang.php';
    </script>
    ";
}


?>
