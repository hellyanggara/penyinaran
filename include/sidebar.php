<?php
if (isset($_GET['page'])) {
    $leveldir = '../../';
} else {
    if (isset($_SESSION['antriandir'])) {
        $leveldir = $_SESSION['antriandir'];
    } else {
        $leveldir = '../';
    }
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $leveldir ?>" class="brand-link">
        <img src="<?php echo $leveldir ?>dist/img/worldwide.png" alt="Inventory" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AntrianLITE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $leveldir ?>dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['nama_user'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="font-size: 15px">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item mb-2">
                    <a href="<?php echo $leveldir ?>dashboard/" class="nav-link <?php echo ($_SESSION['aktif'] == 'dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="<?php if ($_SESSION['aktif'] == 'panggil') {
                                    echo '';
                                } elseif ($_SESSION['aktif'] == 'dashboard') {
                                    echo 'panggil/page';
                                } else {
                                    echo '../panggil/page';
                                } ?>" class="nav-link <?php echo ($_SESSION['aktif'] == 'panggil') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-megaphone"></i>
                        <p>
                            Panggil
                        </p>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="<?php if ($_SESSION['aktif'] == 'laporan') {
                                    echo '';
                                } elseif ($_SESSION['aktif'] == 'dashboard') {
                                    echo 'laporan/page';
                                } else {
                                    echo '../laporan/page';
                                } ?>" class="nav-link <?php echo ($_SESSION['aktif'] == 'laporan' || $_SESSION['aktif'] == 'laporantiket' || $_SESSION['aktif'] == 'laporanloket') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li class="nav-header">ACCESS</li>
                <li class="nav-item">
                    <a href="<?php echo $leveldir ?>signout.php" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>