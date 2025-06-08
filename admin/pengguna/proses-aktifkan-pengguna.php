<?php
include "../koneksi.php";
include "../admin-validation.php";

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Cek apakah pengguna dengan ID tersebut ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Hapus pengguna
        $delete_stmt = $conn->prepare("Update users SET active = 1 WHERE id_user = ?");
        $delete_stmt->bind_param("i", $id_user);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Pengguna berhasil diaktifkan kembali.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal mengaktifkan pengguna. Silakan coba lagi.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Pengguna tidak ditemukan.'); window.location.href='index.php';</script>";
    }

    // Tutup prepared statement
    $stmt->close();
} else {
    echo "<script>alert('ID pengguna tidak ditemukan.'); window.location.href='index.php';</script>";
}

?>
