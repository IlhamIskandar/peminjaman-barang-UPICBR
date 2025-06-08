<?php
// Hitung notifikasi belum dibaca
$unread_query = "SELECT COUNT(*) as unread_count FROM notifikasi
                 WHERE id_user = ? AND terbaca = 0";
$unread_stmt = $conn->prepare($unread_query);
$unread_stmt->bind_param("i", $_SESSION['id']);
$unread_stmt->execute();
$unread_result = $unread_stmt->get_result();
$unread_data = $unread_result->fetch_assoc();
$unread_count = $unread_data['unread_count'] ?? 0;

// Ambil notifikasi belum dibaca
$query = "SELECT * FROM notifikasi WHERE id_user = ? AND terbaca = 0 ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="./" class="nav-link">Home</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Notifications Dropdown Menu-->
            <?php
            // find unseen notifications from DB
            $id_user = $_SESSION['id'];
            $query = "SELECT * FROM notifikasi WHERE id_user = ? AND terbaca = 0 order by created_at DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_user);
            $stmt->execute();
            $result = $stmt->get_result();
            $unread_count = $result->num_rows;
            $stmt->close();
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#" id="notification-bell">
                  <i class="bi bi-bell-fill"></i>
                  <?php if ($unread_count > 0): ?>
                  <span class="navbar-badge badge text-bg-warning" id="notification-badge"><?= $unread_count ?></span>
                  <?php endif; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                  <span class="dropdown-item dropdown-header">
                      <i class="bi bi-box-seam-fill me-2"></i><?= $unread_count ?> Notifikasi
                      <?php if ($unread_count > 0): ?>
                      <small class="float-end">
                          <a href="mark_all_read.php" class="text-primary">Tandai semua dibaca</a>
                      </small>
                      <?php endif; ?>
                  </span>
                  <div class="dropdown-divider"></div>
                  <div id="notification-list">
                      <?php if ($unread_count > 0): ?>
                          <?php while ($dataNotif = $result->fetch_assoc()): ?>
                          <a data-toggle="tooltip" title="<?= $dataNotif['pesan'] ?>" href="mark_read.php?id=<?= $dataNotif['id_notifikasi'] ?>&redirect=daftar-pinjaman.php"
                            class="dropdown-item text-truncate d-inline-block" >
                              <i class="bi bi-bell-fill me-2"></i>
                              <?= htmlspecialchars($dataNotif['pesan']) ?>
                              <span class="float-end text-secondary fs-7">
                                  <?= date('d M Y H:i', strtotime($dataNotif['created_at'])) ?>
                              </span>
                          </a>
                          <div class="dropdown-divider"></div>
                          <?php endwhile; ?>
                      <?php else: ?>
                          <span class="dropdown-item text-muted">Tidak ada notifikasi baru</span>
                          <div class="dropdown-divider"></div>
                      <?php endif; ?>
                  </div>
                  <a href="mark_all_read.php?redirect=daftar-pinjaman.php" class="dropdown-item dropdown-footer">Lihat Semua Peminjaman</a>
              </div>
          </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="profle.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="../image/blank_profile.png"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline"><?= $_SESSION['username']  ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col text-center"><a href="#">Profil</a></div>
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                    <div class="col text-center"><a href="../admin/">Admin</a></div>
                    <?php } ?>
                    <div class="col text-center"><a href="logout.php" >Logout</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
              </ul>

            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
