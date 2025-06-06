<?php
include "koneksi.php";
include "login-validation.php";
// Mark all notifications as read for the current user

    $stmt = $conn->prepare("UPDATE notifikasi SET is_read = TRUE WHERE id_user = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

