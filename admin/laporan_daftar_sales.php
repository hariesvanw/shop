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
  $sales = $conn->query("SELECT * FROM sales WHERE created_at BETWEEN '$dari' AND '$sampai' ORDER BY created_at ASC");
  $show = true;
}else{
  $sales = $conn->query("SELECT * FROM sales");
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Daftar Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="laporan_daftar_sales.php">Sales</a></li>
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
              Filter Sales Berdasarkan Tanggal Terdaftar
            </div>
            <div class="card-body">
              <div class="container">
                <form action="laporan_daftar_sales.php" method="get">
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
                  <h3 class="card-title">Tabel Data Sales</h3>
                </div>
                <div class="col-6 text-right">
                  <button class="btn btn-secondary"
                  onclick="bukajendela('laporan/cetak_laporan_daftar_sales.php?tgl_dari=<?php echo isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '' ?>&tgl_sampai=<?php echo isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '' ?>')"
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
                  <th class="text-center">ID sales</th>
                  <th class="text-center">Nama sales</th>
                  <th class="text-center">Jenis Kelamin</th>
                  <th class="text-center">TTL</th>
                  <th class="text-center">No Telpon</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Alamat</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($sales)){ 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo 'S'.str_pad($row['id'],3,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo $row['nama_sales'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['jenis_kelamin'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['tempat_lahir'].', '.tgl_indo($row['tanggal_lahir']) ?></td>
                      <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['email'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['alamat'] ?></td>
                    </tr>
                  <?php $no++; }?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID sales</th>
                  <th class="text-center">Nama sales</th>
                  <th class="text-center">Jenis Kelamin</th>
                  <th class="text-center">TTL</th>
                  <th class="text-center">No Telpon</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Alamat</th>
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