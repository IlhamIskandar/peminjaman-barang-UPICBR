<?php
session_start();

if ($_SESSION['role'] == 'peminjam') {
    header("Location: ../../pinjam/");
    return;
}
if (!isset($_SESSION['role'])) {
    header("Location: ../../auth/login.php");
    return;
}
?>
