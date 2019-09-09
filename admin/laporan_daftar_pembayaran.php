<?php 
include('core/header.php');
include('core/sidebar.php');

$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime("+1 day"));

$dari = null;
$sampai = null;
$show = false;
if(isset($_GET['tgl_dari'])){
  $dari = $_GET['tgl_dari'];
  $sampai = $_GET['tgl_sampai'];
  $bayars = $conn->query("SELECT b.id, b.id_penjualan, b.id_sales, b.tanggal_verifikasi, b.dibayar,p.utang , p.diskon, s.nama_sales 
                          FROM pembayaran b 
                          LEFT JOIN penjualan p on b.id_penjualan = p.id 
                          LEFT JOIN sales s on b.id_sales = s.id 
                          WHERE tanggal_verifikasi BETWEEN '$dari' AND '$sampai' ORDER BY b.id");
  $show = true;
}else{
  $bayars = $conn->query("SELECT b.id, b.id_penjualan, b.id_sales, b.tanggal_verifikasi, b.dibayar,p.utang , p.diskon, s.nama_sales FROM pembayaran b LEFT JOIN penjualan p on b.id_penjualan = p.id LEFT JOIN sales s on b.id_sales = s.id ORDER BY b.id");
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Daftar Pembayaran Lunas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="laporan_daftar_pelanggan.php">Pelanggan</a></li>
              <li class="breadcrumb-item active">Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Filter Pembayaran Berdasarkan Tanggal Verifikasi
            </div>
            <div class="card-body">
              <div class="container">
                <form action="laporan_daftar_pembayaran.php" method="get">
                  <div class="row">
                    <div class="col-4">
                      <input value="<?php echo $dari ? $dari : $today ?>" name="tgl_dari" type="text" class="form-control datepicker-laporan" placeholder="dari">
                    </div>
                    <div class="col-1 text-center">
                      <button class="btn" disabled>s/d</button>
                    </div>
                    <div class="col-4">
                      <input value="<?php echo $sampai ? $sampai : $tomorrow ?>" name="tgl_sampai" type="text" class="form-control datepicker-laporan" placeholder="sampai">
                    </div>
                    <div class="col-3 text-center">
                      <button class="btn btn-primary btn-block">Filter</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 <?php echo $show ? 'tampil' : 'hide' ?>">
          <div class="card">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-6">
                  <h3 class="card-title">Tabel Data Pelanggan</h3>
                </div>
                <div class="col-6 text-right">
                  <button class="btn btn-secondary"
                  onclick="bukajendela('laporan/cetak_laporan_daftar_pembayaran.php?tgl_dari=<?php echo isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '' ?>&tgl_sampai=<?php echo isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '' ?>')"
                  >
                    <i class="fas fa-print"></i>
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-full" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Transaksi</th>
                  <th class="text-center">No Kuitansi</th>
                  <th class="text-center">Tanggal Verifikasi</th>
                  <th class="text-center">Sales</th>
                  <th class="text-center">Dibayar</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($bayars)){ 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo 'FK'.str_pad($row['id_penjualan'],4,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo 'BY'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_verifikasi']) ?></td>
                      <td class="text-center align-middle"><?php echo '[S'.str_pad($row['id_sales'],3,'0',STR_PAD_LEFT).'] '.$row['nama_sales'];  ?></td>
                      <td class="text-center align-middle"><?php echo duit($row['dibayar']) ?></td>
                    </tr>
                  <?php $no++; }?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Transaksi</th>
                  <th class="text-center">No Kuitansi</th>
                  <th class="text-center">Tanggal Verifikasi</th>
                  <th class="text-center">Sales</th>
                  <th class="text-center">Dibayar</th>
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