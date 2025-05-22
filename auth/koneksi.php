<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_peminjaman_barang_upicb";

try {
  $conn = mysqli_connect($host,$user,$pass,$dbname);
} catch (\Throwable $th) {
  throw $th;
}


if (!$conn){
    echo "
    <script>
      alert('gagal mengambil data');
    </script>
    ";
}
?>


