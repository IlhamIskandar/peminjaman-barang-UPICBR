<?php
include "../koneksi.php";
include "../admin-validation.php";

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    $query = "DELETE from barang WHERE id = '$id_barang'";
    if (mysqli_query($koneksi, $query)) {
        echo "
        <script>
          alert('Berhasil menghapus barang');
          window.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
          alert('Gagal menghapus barang');
          window.location.href = 'index.php';
        </script>
        ";
    }
}

?>

