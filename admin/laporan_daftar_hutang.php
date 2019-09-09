<?php 
include('core/header.php');
include('core/sidebar.php');

$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime("+1 day"));

$dari = null;
$sampai = null;
$show = false;
$kat = 'semua';

if(isset($_GET['kategori'])){
  $kat = $_GET['kategori'];
  $dari = $_GET['tgl_dari'];
  $sampai = $_GET['tgl_sampai'];
  $show = true;

  if($kat === 'semua'){
    $piutangs = $conn->query("SELECT u.id, u.status, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar , pp.nama_pelanggan, pp.no_telpon 
    FROM penjualan u 
    INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile 
    WHERE (status='wait' or status='utang') AND tanggal_penjualan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal_penjualan ASC");
  }else if($kat === 'utang'){
    $piutangs = $conn->query("SELECT u.id, u.status, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar , pp.nama_pelanggan, pp.no_telpon 
    FROM penjualan u 
    INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile 
    WHERE status='utang' AND tanggal_penjualan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal_penjualan ASC");
  }else if($kat === 'wait'){
    $piutangs = $conn->query("SELECT u.id, u.status, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar , pp.nama_pelanggan, pp.no_telpon 
    FROM penjualan u 
    INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile 
    WHERE status='wait' AND tanggal_penjualan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal_penjualan ASC");
  }else {
    $piutangs = null;
  }

}else{
  echo "WOW";
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Daftar Piutang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="laporan_daftar_hutang.php">Piutang</a></li>
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
              Filter Piutang Berdasarkan Tanggal Transaksi
            </div>
            <div class="card-body">
              <div class="container">
                <form action="laporan_daftar_hutang.php" method="get">
                  <div class="row">
                    <div class="col-3">
                      <select class="custom-select" id="kategori" name="kategori">
                        <option value="semua"
                        <?php echo $kat === 'semua' ? 'selected' : '' ?>
                        >Semua</option>
                        <option
                        <?php echo $kat === 'utang' ? 'selected' : '' ?>
                        value="utang">Belum Bayar</option>
                        <option 
                        <?php echo $kat === 'wait' ? 'selected' : '' ?>
                        value="wait">Belum Verfikasi</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <input value="<?php echo $dari ? $dari : $today ?>" name="tgl_dari" type="text" class="form-control datepicker-laporan" placeholder="dari">
                    </div>
                    <div class="col-1 text-center">
                      <button class="btn" disabled>s/d</button>
                    </div>
                    <div class="col-3">
                      <input value="<?php echo $sampai ? $sampai : $tomorrow ?>" name="tgl_sampai" type="text" class="form-control datepicker-laporan" placeholder="sampai">
                    </div>
                    <div class="col-2 text-center">
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
                  <h3 class="card-title">Tabel Data Piutang</h3>
                </div>
                <div class="col-6 text-right">
                  <button class="btn btn-secondary"
                  onclick="bukajendela('laporan/cetak_laporan_daftar_hutang.php?kategori=<?php echo isset($_GET['kategori']) ? $_GET['kategori'] : '' ?>&tgl_dari=<?php echo isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '' ?>&tgl_sampai=<?php echo isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '' ?>')"
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
                  <th class="text-center">Tanggal Transaksi</th>
                  <th class="text-center">Pelanggan</th>
                  <th class="text-center">No Telp. Pelanggan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Total Piutang</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($piutangs)){
                    $arr['id_utang'] = $row['id'];
                    $arr['tgl'] = $row['tanggal_penjualan'];
                    $arr['pel'] = '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan']; 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
                      <td class="text-center align-middle"><?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];  ?></td>
                      <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['status'] === 'wait' ? 'Belum diverifikasi' : 'Belum Bayar' ?></td>
                      <td class="text-center align-middle"><?php echo duit($row['utang']-$row['diskon']) ?></td>
                    </tr>
                  <?php $no++; }?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Transaksi</th>
                  <th class="text-center">Tanggal Transaksi</th>
                  <th class="text-center">Pelanggan</th>
                  <th class="text-center">No Telp. Pelanggan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Total Piutang</th>
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