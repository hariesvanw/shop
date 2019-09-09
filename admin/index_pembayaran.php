<?php
include('core/header.php');
include('core/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PEMBAYARAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_pembayaran.php">Pembayaran</a></li>
              <li class="breadcrumb-item active">Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php 
          if(!empty($_SESSION['message'])) {
            $message = $_SESSION['message'];
            if($message === 'lunas'){
        ?>
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Selamat !</strong> Pembayaran Telah diverifikasi (LUNAS).
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php } } ?>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Data Piutang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-full" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Penjualan</th>
                  <th class="text-center">Nama Pelanggan</th>
                  <th class="text-center">No Kuitansi</th>
                  <th class="text-center">Tanggal Verifikasi</th>
                  <th class="text-center">Dibayar</th>
                  <th class="text-center">Sales</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $bayars = $conn->query("SELECT b.id, b.id_penjualan, b.id_sales, b.tanggal_verifikasi, b.dibayar,p.utang , p.diskon, s.nama_sales, pp.nama_pelanggan 
                                            FROM pembayaran b 
                                            LEFT JOIN penjualan p on b.id_penjualan = p.id 
                                            LEFT JOIN sales s on b.id_sales = s.id 
                                            LEFT JOIN pelanggan_profile pp on p.id_pelanggan_profile = pp.id
                                            ORDER BY b.id");
                    while($row = mysqli_fetch_assoc($bayars)){ 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle">
                        <?php echo 'FK'.str_pad($row['id_penjualan'],4,'0',STR_PAD_LEFT); ?>
                      </td>
                      <td class="text-center align-middle"><?php echo $row['nama_pelanggan'] ?></td>
                      <td class="text-center align-middle"><?php echo 'BY'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_verifikasi']) ?></td>
                      <td class="text-center align-middle"><?php echo duit($row['dibayar']) ?></td>
                      <td class="text-center align-middle"><?php echo '[S'.str_pad($row['id_sales'],3,'0',STR_PAD_LEFT).'] '.$row['nama_sales'];  ?></td>
                      <td class="text-center align-middle">
                      <button class="btn btn-secondary"
                      onclick="bukajendela('laporan/cetak_kuitansi.php?id_fak=<?php echo $row['id_penjualan'] ?>')"
                      >
                        <i class="fas fa-print"></i>
                      </button>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Penjualan</th>
                  <th class="text-center">Nama Pelanggan</th>
                  <th class="text-center">No Kuitansi</th>
                  <th class="text-center">Tanggal Bayar</th>
                  <th class="text-center">Dibayar</th>
                  <th class="text-center">Sales</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
include('core/footer.php');
?>