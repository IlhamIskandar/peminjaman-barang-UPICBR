<?php
function getNotifications($conn, $user_id, $limit = 5) {
    $query = "SELECT * FROM notifikasi
              WHERE id_user = ?
              ORDER BY created_at DESC
              LIMIT ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $limit);
    $stmt->execute();
    return $stmt->get_result();
}
function addNotification($user_id, $message) {
  global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (id_user, pesan) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);
    $stmt->execute();
}
?>
