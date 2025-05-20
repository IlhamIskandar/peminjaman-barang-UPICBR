<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "peminjaman_barang";

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


