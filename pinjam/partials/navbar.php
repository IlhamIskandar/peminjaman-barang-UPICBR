
<div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="./" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Notifications Dropdown Menu-->
            <?php
            // find unseen notifications from DB
            $id_user = $_SESSION['id'];
            $query = "SELECT * FROM notifikasi WHERE id_user = ? order by created_at DESC";
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
                <span class="navbar-badge badge text-bg-warning">!</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header" id="notification-count">
                  <i class="bi bi-box-seam-fill me-2"></i><?= $unread_count ?> Notifikasi
                </span>
                <div class="dropdown-divider"></div>
                <div id="notification-list">

                  <?php
                if ($unread_count > 0) {
                  while ($dataNotif = $result->fetch_assoc()) {
                    $time = $dataNotif['created_at'] ? date('d M Y H:i', strtotime($dataNotif['created_at'])) : 'Tidak diketahui';
                    ?>
                <a href="daftar-pinjaman.php" class="dropdown-item text-truncate d-inline-block" data-toggle="tooltip" data-placement="top" title="<?= $dataNotif['pesan'] ?>"  data-id="<?= $dataNotif['id_notifikasi'] ?>">
                  <!-- style="min-width: 280px; max-width: 300px; -->
                  <i class="bi bi-bell-fill me-2"></i> <?= $dataNotif['pesan'] ?>
                  <span class="float-end text-secondary fs-7"><?= $time ?></span>
                </a>
                <div class="dropdown-divider"></div>
                <?php
                  }
                }
                ?>
                </div>
                <a href="daftar-pinjaman.php" class="dropdown-item dropdown-footer"> Lihat Peminjaman </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
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
                    <div class="col text-center"><a href="#">Profile</a></div>
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
