<?php 
include('core/header.php');
include('core/sidebar.php');
$id_u = $_GET['id_fak'];
$piutang = $conn->query("SELECT p.*, pp.nama_pelanggan FROM penjualan p
                         INNER JOIN pelanggan_profile pp on p.id_pelanggan_profile = pp.id
                         WHERE p.id='$id_u'");
$row = mysqli_fetch_assoc($piutang);

$record = $conn->query("SELECT pr.*,p.nama_produk,p.harga_produk FROM produk_record pr
                        INNER JOIN produk p on pr.id_produk = p.id
                        WHERE id_penjualan='$id_u'");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DETAIL HUTANG</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_piutang.php">DETAIL HUTANG</a></li>
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
        ?>
          <div class="col-12">
            <div class="alert <?php echo $message === 'sukses' ? 'alert-success': ($message === 'update' ? 'alert-info' : ($message === 'hapus' ? 'alert-warning' : 'alert-danger')) ?> alert-dismissible fade show" role="alert">
              <strong>Selamat !</strong>
              <?php echo $message === 'sukses' ? 'produk berhasil ditambahkan': ($message === 'update' ? 'produk berhasil diupdate' : ($message === 'hapus' ? 'produk berhasil dihapus' : 'gagal ada yang salah !')) ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php }?>
        <?php 
          if(!empty($_SESSION['stok'])) {
            $stok = $_SESSION['stok'];
            if($stok === 'sukses'){
        ?>
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Selamat !</strong> Stok Produk berhasil di update.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php } } ?>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Hutang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row justify-content-between">
              <div class="col-4">
                <table class="table borderless">
                  <tr>
                    <td>NO FAKTUR</td>
                    <td>:</td>
                    <td><?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Penjualan</td>
                    <td>:</td>
                    <td><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
                  </tr>
                  <tr>
                    <td>Jatuh Tempo</td>
                    <td>:</td>
                    <td><?php echo tgl_indo($row['jatuh_tempo']) ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-6">
                <table class="table borderless">
                  <tr>
                    <td>Nama pelanggan</td>
                    <td>:</td>
                    <td><?php echo $row['nama_pelanggan'] ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-12">
                <h3 class="card-text pl-2">Detail Barang</h3>
              </div>
              <div class="col-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Jumlah Beli</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $no = 1;
                  $total = 0;
                  while($pr = mysqli_fetch_assoc($record)) { ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $pr['nama_produk'] ?></td>
                      <td><?php echo $pr['harga_produk'] ?></td>
                      <td><?php echo $pr['jumlah'] ?></td>
                      <td><?php echo duit($pr['harga_produk']*$pr['jumlah']) ?></td>
                    </tr>
                  <?php $no++; $total+=$pr['harga_produk']*$pr['jumlah']; } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" class="text-right">Total :</td>
                      <td><?php echo duit($total) ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <?php
            
            while($pr = mysqli_fetch_assoc($record)){
              echo '<pre>';
              print_r($pr);
              echo '</pre>';
            }
            
            ?>
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
unset($_SESSION["message"]);
unset($_SESSION["stok"]);
?>