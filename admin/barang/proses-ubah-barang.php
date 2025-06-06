<?php
include "../koneksi.php";
include "../admin-validation.php";

$id_barang = $_POST['id'];
$nama_barang = $_POST['nama'];
$kategori_barang = $_POST['kategori'];
$deskripsi_barang = $_POST['deskripsi'];
$stok = $_POST['stok'];
$tersedia = $_POST['tersedia'];
$img = $_FILES['img']['name'];
$img_tmp = $_FILES['img']['tmp_name'];
$target_dir = "../../image/barang/";
// Check if an image is uploaded
if (empty($img)) {
    // If no image is uploaded, keep the existing image
    $img_name = $_POST['img_lama'];
} else {
    // If an image is uploaded, generate a new unique name
    $img_name = uniqid() . '.png';
    if (move_uploaded_file($img_tmp, $target_dir. $img_name)) {
        // File uploaded successfully
    } else {
      // Handle file upload error
      echo "
      <script>
        alert('Gagal mengunggah gambar barang');
        window.location.href = 'ubah-barang.php?id=$id_barang';
      </script>
      ";
    }
}


$stmt = $conn->prepare("UPDATE barang SET nama_barang=?, kategori=?, deskripsi=?, stok=?, img=?, tersedia=? WHERE id_barang = ?");
$stmt->bind_param("sssssss", $nama_barang, $kategori_barang, $deskripsi_barang, $stok, $img_name, $tersedia, $id_barang );



if ($stmt->execute()) {
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
