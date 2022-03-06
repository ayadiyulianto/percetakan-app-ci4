<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url(); ?>/img/Kaber.png" alt="KaBer Printing Logo" class="brand-image">
        <span class="brand-text font-weight-light">KaBer Printing</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-header">MENU UTAMA</li>

                <!-- <li class="nav-item <?php if ($menu == "dashboard") echo "menu-open"; ?>">
                    <a href="<?= site_url('/dashboard') ?>" class="nav-link <?php if ($menu == "dashboard") echo "active"; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            DASHBOARD
                        </p>
                    </a>
                </li> -->

                <li class="nav-item <?php if ($menu == "daftarKerjaan") echo "menu-open"; ?>">
                    <a href="<?= site_url('/daftarKerjaan') ?>" class="nav-link <?php if ($menu == "daftarKerjaan") echo "active"; ?>"">
                        <i class=" nav-icon fas fa-th"></i>
                        <p>
                            DAFTAR KERJAAN
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <!-- <li class="nav-header">MASTER DATA</li>

                <li class="nav-item <?php if ($menu == "pelanggan") echo "menu-open"; ?>">
                    <a href="#" class="nav-link <?php if ($menu == "pelanggan") echo "active"; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            PELANGGAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('/pelanggan') ?>" class="nav-link <?php if ($title == "Pelanggan") echo "active"; ?>">
                                <i class=" far fa-circle nav-icon"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu Lain</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>