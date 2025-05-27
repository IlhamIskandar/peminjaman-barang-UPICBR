<?php
session_start();

if ($_SESSION['role'] == 'user') {
    header("Location: ../../pinjam/index.php");
    return;
}
if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    return;
}
?>
