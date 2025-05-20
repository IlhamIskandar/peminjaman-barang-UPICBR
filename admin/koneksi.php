<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "peminjaman_barang";

try {
  $koneksi = mysqli_connect($host,$user,$pass,$dbname);
} catch (\Throwable $th) {
  throw $th;
}


if (!$koneksi){
    echo "
    <script>
      alert('gagal mengambil data');
    </script>
    ";
}
?>


