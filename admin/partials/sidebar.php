<aside class="app-sidebar bg-secondary-subtle" data-bs-theme="light">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="../" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="../../dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Admin</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
            <li class="nav-item">
                <!-- <a href="#" class="nav-link" onclick="loadContent('Dashboard')"> -->
                <a href="../dashboard" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Barang
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../barang" class="nav-link" >
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Barang</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../barang/tambah-barang.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Tambah Barang</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../barang/kategori-barang.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Kategori Barang</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Peminjaman Barang
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../peminjaman" class="nav-link" >
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Konfirmasi Peminjaman</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pengembalian" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Konfirmasi Pengembalian</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Pengguna
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pengguna" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Pengguna</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pengguna/ubah-password.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Ubah Password Pengguna</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="../Laporan" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Laporan</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
