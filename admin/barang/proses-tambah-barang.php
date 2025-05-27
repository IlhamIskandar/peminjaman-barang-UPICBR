<?php
include "../koneksi.php";
include "../admin-validation.php";

$nama_barang = $_POST['nama'];
$kategori_barang = $_POST['kategori'];
$deskripsi_barang = $_POST['deskripsi'];
$stok = $_POST['stok'];
$img = $_FILES['img']['name'];
$img_tmp = $_FILES['img']['tmp_name'];
$target_dir = "../../image/barang/";
$img_name = uniqid() . '.png'; // Generate a unique name for the image


$stmt = $conn->prepare("INSERT INTO barang (nama_barang, id_kategori, deskripsi, stok, img) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nama_barang, $kategori_barang, $deskripsi_barang, $stok, $img_name);

if ($stmt->execute()) {

  if (move_uploaded_file($img_tmp, $target_dir. $img_name)) {
        // File uploaded successfully
    } else {
        // Handle file upload error
        echo "
        <script>
          alert('Gagal mengunggah gambar barang');
          window.location.href = 'tambah-barang.php';
        </script>
        ";
        return;
    }
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
