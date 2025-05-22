<?php
include "koneksi.php";

function register(){
  global $conn;
  if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nimnip = $_POST['nimnip'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'peminjam';
    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok!');</script>";
        return;
    }
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    }
    // Check if NIM/NIP already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE nim_nip=?");
    $stmt->bind_param("s", $nimnip);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('NIM/NIP sudah terdaftar!');window.histroy.back();</script>";
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (username, nim_nip, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama_lengkap, $nimnip, $email, password_hash($password, PASSWORD_DEFAULT), $role);

    if ($stmt->execute()) {
        echo "
        <script>
        alert('Registrasi berhasil!');
        window.location.href = 'login.php';
        </script>";

        return;
    } else {
        echo "
        <script>
        alert('Registrasi gagal!');
        window.histroy.back();
        </script>";
    }
  }
}

function Login(){
  global $conn;
  if(isset($_POST)){

  }
}
?>
