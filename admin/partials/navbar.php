
<div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <!-- <li class="nav-item d-none d-md-block"><a href="../" class="nav-link">Home</a></li> -->
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                    src="../../image/blank_profile.png"
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
                    <div class="col text-center"><a href="../profile/">Profil</a></div>
                    <div class="col text-center"><a href="../../pinjam/" >Pinjam</a></div>
                    <div class="col text-center"><a href="../logout.php" >Logout</a></div>
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
