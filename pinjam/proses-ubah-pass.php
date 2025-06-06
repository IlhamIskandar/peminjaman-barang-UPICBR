<?php

require 'koneksi.php';
require 'login-validation.php';

if (isset($_POST['confirm_password'])) {
    $id = $_SESSION['id'];
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Validate old password
    $query = "SELECT password FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($old_pass, $row['password'])) {
            // Check if new password matches confirm password
            if ($new_pass === $confirm_pass) {
                // Hash the new password
                $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_query = "UPDATE users SET password = ? WHERE id_user = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("si", $hashed_pass, $id);

                if ($update_stmt->execute()) {
                    echo "<script>
                            alert('Password berhasil diubah.');
                            window.location.href = 'profile.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Gagal mengubah password. Silakan coba lagi.');
                            window.location.href = 'profile.php';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Konfirmasi password tidak cocok.');
                        window.location.href = 'profile.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Password lama salah.');
                    window.location.href = 'profile.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Pengguna tidak ditemukan.');
                window.location.href = 'profile.php';
              </script>";
    }


}
?>
