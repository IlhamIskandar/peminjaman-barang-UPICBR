<?php
include "../koneksi.php";
include "../admin-validation.php";

if (isset($_GET['id'])) {
    $id_kategori = $_GET['id'];
    $query = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    if (mysqli_query($conn, $query)) {
        echo "
        <script>
          alert('Berhasil menghapus kategori');
          window.location.href = 'kategori-barang.php';
        </script>
        ";
    } else {
        echo "
        <script>
          alert('Gagal menghapus kategori');
          window.location.href = 'kategori-barang.php';
        </script>
        ";
    }
}

?>
