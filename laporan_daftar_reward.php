<?php 
include('core/header.php');
include('core/sidebar.php');

$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime("+1 day"));

$dari = null;
$sampai = null;
$show = false;
$kat = null;

if(isset($_GET['kategori'])){
  $kat = $_GET['kategori'];
  $dari = $_GET['tgl_dari'];
  $sampai = $_GET['tgl_sampai'];
  $show = true;

  $r_reward = $conn->query("SELECT u.id_pelanggan_profile, pp.nama_pelanggan, COUNT(*) as c_transaksi ,COUNT(IF(diskon > 0 ,1,NULL)) as c_reward FROM penjualan u 
                            LEFT JOIN pelanggan_profile pp on u.id_pelanggan_profile = pp.id
                            WHERE tanggal_penjualan BETWEEN '$dari' AND '$sampai'
                            GROUP BY u.id_pelanggan_profile ORDER BY c_transaksi DESC, c_reward DESC");

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
            <h1>Laporan Daftar Reward</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="laporan_daftar_reward.php">Reward</a></li>
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
              Filter Reward
            </div>
            <div class="card-body">
              <div class="container">
                <form action="laporan_daftar_reward.php" method="get">
                  <div class="row">
                    <div class="col-3">
                      <select class="custom-select" id="kategori" name="kategori">
                        <option value="semua" 
                        <?php echo $kat === 'semua' ? 'selected' : '' ?>
                        >Semua</option>
                        <option
                        <?php echo $kat === 'rewarded' ? 'selected' : '' ?> 
                        value="rewarded">Dapat Reward</option>
                        <option
                        <?php echo $kat === 'nope' ? 'selected' : '' ?> 
                        value="nope">Tidak Dapat Reward</option>
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
                  <h3 class="card-title">Tabel Data Reward</h3>
                </div>
                <div class="col-6 text-right">
                  <button class="btn btn-secondary"
                  onclick="bukajendela('laporan/cetak_laporan_daftar_reward.php?kategori=<?php echo isset($_GET['kategori']) ? $_GET['kategori'] : '' ?>&tgl_dari=<?php echo isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '' ?>&tgl_sampai=<?php echo isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '' ?>')"
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
                    <th class="text-center">Pelanggan</th>
                    <th class="text-center">Jumlah Transaksi</th>
                    <th class="text-center">Jumlah Reward</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    if($kat == 'semua') {
                      while($row = mysqli_fetch_assoc($r_reward)){
                  ?>
                  <tr>
                    <td class="text-center align-middle"><?php echo $no ?></td>
                    <td class="text-center align-middle"><?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];  ?></td>
                    <td class="text-center align-middle"><?php echo $row['c_transaksi'] ?></td>
                    <td class="text-center align-middle"><?php echo $row['c_reward'] ?></td>
                  </tr>
                  <?php 
                      $no++; }
                    }else if($kat == 'rewarded') {
                      while($row = mysqli_fetch_assoc($r_reward)){
                        if($row['c_reward'] > 0) {
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];  ?></td>
                      <td class="text-center align-middle"><?php echo $row['c_transaksi'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['c_reward'] ?></td>
                    </tr>
                  <?php 
                        }
                      }
                    }else if($kat == 'nope'){
                      while($row = mysqli_fetch_assoc($r_reward)){
                        if($row['c_reward'] == 0) {
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];  ?></td>
                      <td class="text-center align-middle"><?php echo $row['c_transaksi'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['c_reward'] ?></td>
                    </tr>
                  <?php 
                        }
                      }
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Pelanggan</th>
                    <th class="text-center">Jumlah Transaksi</th>
                    <th class="text-center">Jumlah Reward</th>
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