<?php
include "koneksi.php";

function register(){
  global $conn;
  if (isset($_POST['confirm_password'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nimnip = $_POST['nimnip'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'peminjam';
    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok!');</script>";
        exit;
    }
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
        exit;
    }
    // Check if NIM/NIP already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE nim_nip=?");
    $stmt->bind_param("s", $nimnip);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('NIM/NIP sudah terdaftar!');</script>";
        exit;
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (username, nim_nip, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama_lengkap, $nimnip, $email, password_hash($password, PASSWORD_DEFAULT), $role);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil!');</script>";
        header("Location: login.php");
        exit;
    } else {
        echo "<script>alert('Registrasi gagal!');</script>";
    }
}
}

function Login(){
  global $conn;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar');</script>";
    }
}
}

?>
