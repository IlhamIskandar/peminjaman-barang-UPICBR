<?php
include "koneksi.php";
include "login-validation.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $redirect = $_GET['redirect'] ?? 'index.php';

    // Update status notifikasi
    $stmt = $conn->prepare("UPDATE notifikasi SET terbaca = 1 WHERE id_notifikasi = ? AND id_user = ?");
    $stmt->bind_param("ii", $id, $_SESSION['id']);
    $stmt->execute();

    header("Location: " . $redirect);
    exit;
}
?>
