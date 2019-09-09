<?php 
include('core/header.php');
include('core/sidebar.php');
$today = date('Y-m-d');
$tomorrow = date("Y-m-d", strtotime("+1 day"));

$kat = null;
if(isset($_GET['kategori'])){
  $kat = $_GET['kategori'];
  if($kat === 'semua'){
    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
    FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
    LEFT JOIN kategori k on kp.id_kategori = k.id
    GROUP BY p.id");
  }else{
    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
    FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
    LEFT JOIN kategori k on kp.id_kategori = k.id AND k.id = '$kat'
    GROUP BY p.id");
  }
}else{
  $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
  FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
  LEFT JOIN kategori k on kp.id_kategori = k.id
  GROUP BY p.id");
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Daftar Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="laporan_daftar_produk.php">Produk</a></li>
              <li class="breadcrumb-item active">Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- <div class="col-12">
          <div class="card">
            <div class="card-header">
              Filter Produk
            </div>
            <div class="card-body">
              <div class="container">
                <form action="laporan_daftar_produk.php" method="get">
                  <div class="row">
                    <div class="col-4">
                      <input value="<?php echo $today ?>" name="tgl_dari" type="text" class="form-control datepicker-laporan" placeholder="dari">
                    </div>
                    <div class="col-1 text-center">
                      <button class="btn" disabled>s/d</button>
                    </div>
                    <div class="col-4">
                      <input value="<?php echo $tomorrow ?>" name="tgl_sampai" type="text" class="form-control datepicker-laporan" placeholder="sampai">
                    </div>
                    <div class="col-3 text-center">
                      <button class="btn btn-primary btn-block">Filter</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Filter Produk
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <form action="laporan_daftar_produk.php" method="get">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="kategori">Kategori</label>
                        </div>
                        <select class="custom-select" id="kategori" name="kategori">
                          <option value="semua">Semua</option>
                          <?php 
                            $kats = $conn->query("SELECT * FROM kategori");
                            while($row = mysqli_fetch_assoc($kats)){
                          ?>
                            <option
                            <?php echo $row['id'] == $kat ? 'selected' : '' ?>
                            value="<?php echo $row['id']?>"><?php echo $row['nama_kategori']?></option>
                          <?php } ?>
                        </select>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-outline-secondary">Filter</button>
                          <a href="laporan_daftar_produk.php" class="btn btn-outline-secondary">Reset</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 <?php echo $kat ? 'tampil' : 'hide' ?>">
          <div class="card">
            <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-6">
                  <h3 class="card-title">Tabel Data Produk</h3>
                </div>
                <div class="col-6 text-right">
                  <button class="btn btn-secondary"
                  onclick="bukajendela('laporan/cetak_laporan_daftar_produk.php?kategori=<?php echo isset($_GET['kategori']) ? $_GET['kategori'] : '' ?>')"
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
                  <th class="text-center">ID Produk</th>
                  <th class="text-center">Nama Produk</th>
                  <th class="text-center">Harga Produk</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Stok</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($produks)){ 
                      if($row['kats']) {
                  ?>
                    <tr>
                      <td class="align-middle text-center"><?php echo $no ?></td>
                      <td class="align-middle text-center"><?php echo 'P'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                      <td class="align-middle text-center"><?php echo $row['nama_produk'] ?></td>
                      <td class="align-middle text-center"><?php echo duit($row['harga_produk']) ?></td>
                      <td class="align-middle text-center"><?php echo $row['kats'] ?></td>
                      <td class="align-middle text-center"><?php echo $row['stok'] ?></td>
                    </tr>
                  <?php $no++; } }?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Produk</th>
                  <th class="text-center">Nama Produk</th>
                  <th class="text-center">Harga Produk</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">stok</th>
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