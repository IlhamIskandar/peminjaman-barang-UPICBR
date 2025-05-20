<?php

include "../koneksi.php";
var_dump($_POST);

$kode_barang = $_POST['kode'];
$nama_barang = $_POST['nama'];
$kategori_barang = $_POST['kategori'];
$kondisi_barang = $_POST['kondisi'];
$deskripsi_barang = $_POST['deskripsi'];
$tersedia_barang = $_POST['status'];

$query = "INSERT INTO barang (kode_barang, nama, kategori, kondisi, deskripsi, tersedia) VALUES ('$kode_barang', '$nama_barang', '$kategori_barang', '$kondisi_barang', '$deskripsi_barang', '$tersedia_barang')";
if (mysqli_query($koneksi, $query)) {
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
