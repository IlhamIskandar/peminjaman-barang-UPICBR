<?php
include "../koneksi.php";
include "../admin-validation.php";

if(isset($_POST['nama']) && isset($_POST['nimnip']) && isset($_POST['email']) && isset($_POST['notelp']) && isset($_POST['password_baru']) && isset($_POST['konfirmasi'])) {
    $nama = $_POST['nama'];
    $nimnip = $_POST['nimnip'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi'];

    // Validasi input
    if ($password_baru !== $konfirmasi) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok!'); window.history.back();</script>";
        exit;
    }

    // Update password pengguna
    $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=? AND nim_nip=? AND email=? AND notelp=?");
    $stmt->bind_param("sssss", password_hash($password_baru, PASSWORD_DEFAULT), $nama, $nimnip, $email, $notelp);

    if ($stmt->execute()) {
        echo "<script>alert('Password berhasil diubah!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah password. Silakan coba lagi.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Data tidak lengkap. Silakan isi semua field.'); window.history.back();</script>";
}


?>
