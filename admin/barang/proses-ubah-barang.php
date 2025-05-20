<?php
include "../koneksi.php";

$id_barang = $_POST['id'];
$kode_barang = $_POST['kode'];
$nama_barang = $_POST['nama'];
$kategori_barang = $_POST['kategori'];
$kondisi_barang = $_POST['kondisi'];
$deskripsi_barang = $_POST['deskripsi'];
$tersedia_barang = $_POST['status'];

$query = "UPDATE barang SET kode_barang='$kode_barang', nama='$nama_barang', kategori='$kategori_barang', kondisi='$kondisi_barang', deskripsi='$deskripsi_barang', tersedia='$tersedia_barang' WHERE id='$id_barang'";
if (mysqli_query($koneksi, $query)) {
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
