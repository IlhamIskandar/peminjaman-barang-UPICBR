<?php
include "koneksi.php";
include "login-validation.php";

$redirect = $_GET['redirect'] ?? 'index.php';

// Update semua notifikasi user
$stmt = $conn->prepare("UPDATE notifikasi SET terbaca = 1 WHERE id_user = ? AND terbaca = 0");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();

header("Location: " . $redirect);
exit;
?>
