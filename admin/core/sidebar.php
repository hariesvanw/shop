<?php
  function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    $arr_url = explode('?', $url);
    $cek_url = $arr_url[0];
    if($currect_page == $cek_url){
        echo 'active'; //class name in css 
    } 
  }

  function open($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    $arr_url = explode('?', $url);
    $cek_url = $arr_url[0];
    if($currect_page == $cek_url){
        echo 'menu-open'; //class name in css 
    } 
  }

  $cekSales = $nama_sales;
?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link navbar-light">
      <img src="lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold"><?php echo $alias ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fas <?php echo $nama_sales ? 'fa-user' : 'fa-user-cog' ?> fa-2x" style="color:orange;"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nama_sales ? $nama_sales : 'Admin' ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php active('index.php');?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if(!$cekSales) { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php active('index_produk.php');?> <?php active('index_kategori_produk.php');?>">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Manajemen Produk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index_produk.php" class="nav-link <?php active('index_produk.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index_kategori_produk.php" class="nav-link <?php active('index_kategori_produk.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kategori Produk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php active('index_sales.php'); active('index_pelanggan.php');?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manajemen Manusia
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index_pelanggan.php" class="nav-link <?php active('index_pelanggan.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index_sales.php" class="nav-link <?php active('index_sales.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Sales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php open('laporan_monitoring_sales.php'); open('laporan_monitoring_toko.php'); open('laporan_daftar_reward.php'); open('laporan_daftar_pemasukan.php'); open('laporan_daftar_produk_terjual.php'); open('laporan_daftar_pembayaran.php'); open('laporan_daftar_hutang.php'); open('laporan_daftar_produk.php'); open('laporan_daftar_sales.php'); open('laporan_daftar_pelanggan.php');?>">
            <a href="#" class="nav-link <?php active('laporan_monitoring_sales.php'); active('laporan_monitoring_toko.php'); active('laporan_daftar_reward.php'); active('laporan_daftar_pemasukan.php'); active('laporan_daftar_produk_terjual.php'); active('laporan_daftar_pembayaran.php'); active('laporan_daftar_hutang.php'); active('laporan_daftar_produk.php'); active('laporan_daftar_sales.php'); active('laporan_daftar_pelanggan.php');?>">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan_daftar_produk.php" class="nav-link <?php active('laporan_daftar_produk.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Daftar Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_sales.php" class="nav-link <?php active('laporan_daftar_sales.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Daftar Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_pelanggan.php" class="nav-link <?php active('laporan_daftar_pelanggan.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Daftar Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_hutang.php" class="nav-link <?php active('laporan_daftar_hutang.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Daftar Piutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_pembayaran.php" class="nav-link <?php active('laporan_daftar_pembayaran.php'); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Rwyt. Pembayaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_produk_terjual.php" class="nav-link <?php active('laporan_daftar_produk_terjual.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Produk Terjual</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_pemasukan.php" class="nav-link <?php active('laporan_daftar_pemasukan.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pemasukan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_daftar_reward.php" class="nav-link <?php active('laporan_daftar_reward.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Reward & Punishment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_monitoring_toko.php" class="nav-link <?php active('laporan_monitoring_toko.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Monitoring Toko</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan_monitoring_sales.php" class="nav-link <?php active('laporan_monitoring_sales.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Monitoring Sales</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php if ($cekSales) { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php active('index_piutang.php');?> <?php active('index_pembayaran.php');?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Manajemen Penjualan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index_piutang.php" class="nav-link <?php active('index_piutang.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Piutang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index_pembayaran.php" class="nav-link <?php active('index_pembayaran.php');?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pembayaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }  ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>