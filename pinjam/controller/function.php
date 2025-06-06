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

?>
