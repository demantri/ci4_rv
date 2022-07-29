<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
            <a href="<?= base_url('dashboard')?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        <?php if (session()->get('role_id') == 1) { ?>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                    Masterdata
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('bahan-baku')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bahan Baku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('coa')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>COA</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('produk')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('supplier')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('role')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Role</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('user')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                </ul>
            </li>        

            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="<?= base_url('pembelian')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pembelian Bahan Baku</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?= base_url('penjualan')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penjualan</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?= base_url('produksi')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produksi Bahan Baku</p>
                </a>
                </li>
            </ul>
            </li>

            <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="<?= base_url('jurnal')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jurnal</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?= base_url('bukubesar')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Buku Besar</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?= base_url('pembelian/laporan-pembelian')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Pembelian</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="<?= base_url('penjualan/laporan-penjualan')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Penjualan</p>
                </a>
                </li>
            </ul>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a href="<?= base_url('Login/logout')?>" class="nav-link" onclick="return confirm('Apakah anda yakin ingin logout?')">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                Logout
                </p>
            </a>
        </li>
    </ul>
</nav>