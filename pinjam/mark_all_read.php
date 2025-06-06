<?php
include "koneksi.php";
include "login-validation.php";

// Tandai SEMUA notifikasi user ini sebagai terbaca
$stmt = $conn->prepare("UPDATE notifikasi SET terbaca = TRUE WHERE id_user = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->close();

echo json_encode(['success' => true]);
