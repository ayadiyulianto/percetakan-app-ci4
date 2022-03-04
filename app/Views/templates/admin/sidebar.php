<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url(); ?>/img/Kaber.png" alt="KaBer Printing Logo" class="brand-image">
        <span class="brand-text font-weight-light">KaBer Printing</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url(); ?>/admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin TIO</a>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-header">MENU UTAMA</li>

                <li class="nav-item <?php if ($menu == "dashboard") echo "menu-open"; ?>">
                    <a href="<?= site_url('/dashboard') ?>" class="nav-link <?php if ($menu == "dashboard") echo "active"; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            DASHBOARD
                        </p>
                    </a>
                </li>

                <li class="nav-item <?php if ($menu == "daftarKerjaan") echo "menu-open"; ?>">
                    <a href="<?= site_url('/daftarKerjaan') ?>" class="nav-link <?php if ($menu == "daftarKerjaan") echo "active"; ?>"">
                        <i class=" nav-icon fas fa-th"></i>
                        <p>
                            DAFTAR KERJAAN
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA</li>

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
                </li>

                <li class="nav-item <?php if ($menu == "bahan") echo "menu-open"; ?>">
                    <a href="#" class="nav-link <?php if ($menu == "bahan") echo "active"; ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            BAHAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('/bahan') ?>" class="nav-link <?php if ($title == "Bahan") echo "active"; ?>">
                                <i class=" far fa-circle nav-icon"></i>
                                <p>Bahan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu Lain</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php if ($menu == "barang") echo "menu-open"; ?>">
                    <a href="#" class="nav-link <?php if ($menu == "barang") echo "active"; ?>">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            BARANG
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('/barang') ?>" class="nav-link <?php if ($title == "Daftar Barang") echo "active"; ?>">
                                <i class=" far fa-circle nav-icon"></i>
                                <p>Daftar Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/kategoribarang') ?>" class="nav-link <?php if ($title == "Kategori Barang") echo "active"; ?>">
                                <i class=" far fa-circle nav-icon"></i>
                                <p>Kategori Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">TRANSAKSI</li>

                <li class="nav-item <?php if ($menu == "transaksi") echo "menu-open"; ?>">
                    <a href="#" class="nav-link <?php if ($menu == "transaksi") echo "active"; ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            TRANSAKSI PENJUALAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('/transaksi') ?>" class="nav-link <?php if ($title == "Transaksi") echo "active"; ?>">
                                <i class=" far fa-circle nav-icon"></i>
                                <p>Daftar Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/transaksi/baru') ?>" class="nav-link <?php if ($title == "Transaksi Baru") echo "active"; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Baru</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php if ($menu == "transaksi") echo "menu-open"; ?>">
                    <a href="<?= site_url('/piutang') ?>" class="nav-link <?php if ($menu == "transaksi") echo "active"; ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            TRANSAKSI PIUTANG
                            <i class="right fas "></i>
                        </p>
                    </a>

                <li class="nav-header">TOOLS</li>

                <li class="nav-item <?php if ($menu == "satuan") echo "menu-open"; ?>">
                    <a href="<?= site_url("/satuan") ?>" class="nav-link <?php if ($menu == "satuan") echo "active"; ?>">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            SATUAN
                        </p>
                    </a>
                </li>
                <li class="nav-item <?php if ($menu == "bank") echo "menu-open"; ?>">
                    <a href="<?= site_url("/bank") ?>" class="nav-link <?php if ($menu == "bank") echo "active"; ?>">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            BANK
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>