<?php
include "koneksi.php";
include "login-validation.php";
include "controller/function.php";

$limit = 5;
$notifications = getNotifications($conn, $_SESSION['id'], $limit);

if ($notifications->num_rows > 0):
    while ($notif = $notifications->fetch_assoc()): ?>
    <a href="daftar-pinjaman.php" class="dropdown-item text-truncate d-inline-block <?= $notif['terbaca'] ? '0' : 'fw-bold' ?>"
       data-id="<?= $notif['id_notifikasi'] ?>">
        <i class="bi bi-bell-fill me-2"></i>
        <?= htmlspecialchars($notif['pesan']) ?>
        <span class="float-end text-secondary fs-7">
            <?= $notif['created_at'] ? date('d M Y H:i', strtotime($notif['created_at'])) : '' ?>
        </span>
    </a>
    <div class="dropdown-divider"></div>
    <?php endwhile;
else: ?>
    <span class="dropdown-item text-muted">Tidak ada notifikasi</span>
<?php endif; ?>
