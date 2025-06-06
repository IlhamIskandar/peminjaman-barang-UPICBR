<?php
include "koneksi.php";
include "login-validation.php";
include "controller/function.php";

if(isset($_POST)){

    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $id_user = $_SESSION['id'];
    $catatan = $_POST['catatan'];
    // $tanggal_pinjam = date('Y-m-d H:i:s');
    $tanggal_pinjam = date('Y-m-d H:i:s');
    $batas_pengembalian = date('Y-m-d 17:00:00'); // Set batas pengembalian pada pukul 17:00:00 hari yang sama);
    $status = 'Menunggu Pengambilan';

    if($tanggal_pinjam >= $batas_pengembalian) {
        echo "
        <script>
        alert('Peminjaman barang hanya dapat dilakukan sebelum pukul 17:00:00!');
        window.history.back();
        </script>";
        return;
    }else{
      $stmt = $conn->prepare("SELECT tersedia FROM barang WHERE id_barang = ?");
      $stmt->bind_param("i", $id_barang);
      $stmt->execute();
      $stok_tersedia = $stmt->get_result()->fetch_assoc()['tersedia'];
      if ($stok_tersedia < 1) {
          echo "
          <script>
          alert('Barang tidak tersedia untuk dipinjam!');
          window.history.back();
          </script>";
          return;
      }else{
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO peminjaman (id_barang, id_peminjam, catatan, tanggal_pinjam, batas_pengembalian, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $id_barang, $id_user, $catatan, $tanggal_pinjam, $batas_pengembalian, $status);
        $stmt->execute();
        addNotification($id_user, "Permintaan peminjaman $nama_barang telah dibuat. Silahkan ambil barang di tempat peminjaman.");
        echo "
          <script>
          alert('Peminjaman Berhasil Dibuat. Silahkan Ambil Barang di Tempat Peminjaman!');
          window.location.href='index.php';
          </script>";
      }
    }
}
?>
