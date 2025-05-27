<?php
include "../koneksi.php";
include "../admin-validation.php";

if (isset($_GET['id'])) {
    $id_kategori = $_GET['id'];
    $query = "DELETE FROM users WHERE id_user = '$id_user'";
    if (mysqli_query($conn, $query)) {
        echo "
        <script>
          alert('Berhasil menghapus pengguna');
          window.location.href = 'pengguna.php';
        </script>
        ";
    } else {
        echo "
        <script>
          alert('Gagal menghapus pengguna');
          window.location.href = 'pengguna.php';
        </script>
        ";
    }
}

?>
