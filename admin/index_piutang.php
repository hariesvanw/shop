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
            <h1>PIUTANG</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_piutang.php">Piutang</a></li>
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
            if($message === 'sukses'){
        ?>
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Selamat !</strong> Data piutang berhasil ditambahkan.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php } } ?>
        <!-- <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <a href="sales_job.php" class="btn btn-primary">Tambah Piutang</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
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
                  <th class="text-center">Tanggal Penjualan</th>
                  <th class="text-center">Pelanggan</th>
                  <th class="text-center">Total Piutang</th>
                  <th class="text-center">No Telp. Pelanggan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $piutangs = $conn->query("SELECT u.id, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar, u.status , pp.nama_pelanggan, pp.no_telpon FROM penjualan u INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile WHERE status='wait' OR status='utang' OR status='wait'");
                    while($row = mysqli_fetch_assoc($piutangs)){
                    $arr['id_utang'] = $row['id'];
                    $arr['tgl'] = $row['tanggal_penjualan'];
                    $arr['pel'] = '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle">
                        <a href="detail_faktur.php?id_fak=<?php echo $row['id'] ?>">
                          <?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?>
                        </a>
                      </td>
                      <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
                      <td class="text-center align-middle"><?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];  ?></td>
                      <td class="text-center align-middle"><?php echo duit($row['utang']-$row['diskon']) ?></td>
                      <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['status'] === "utang" ? "Hutang" : ($row['status'] === "wait" ? "Belum Diverifikasi" : $row['status'] ); ?></td>
                      <td class="text-center text-nowrap">
                        <button 
                        id="<?php echo $row['id'] ?>"
                        bukti="<?php echo $row['bukti_bayar'] ?>"
                        no-fk="<?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?>"
                        tgl="<?php echo tgl_indo($row['tanggal_penjualan']) ?>"
                        pel="<?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan']; ?>"
                        utang="<?php echo duit($row['utang']-$row['diskon']) ?>"
                        class="tombol-bayar btn btn-primary" data-toggle="modal" data-target="#bayar-utang"
                        > 
                          <i class="fas fa-money-bill-wave"></i>
                        </button>
                        <form action="piutang/bayar_utang.php" method="post" id="fb-utang<?php echo $row['id'] ?>">
                          <input type="hidden" value="<?php echo $row['id'] ?>" name="id_hutang">
                          <input type="hidden" value="<?php echo $id_sales ?>" name="id_sales">
                          <input type="hidden" value="<?php echo $row['utang']-$row['diskon'] ?>" name="dibayar">
                          <input type="hidden" value="<?php echo date('Y-m-d') ?>" name="tanggal_verifikasi">
                        </form>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Penjualan</th>
                  <th class="text-center">Tanggal Penjualan</th>
                  <th class="text-center">Pelanggan</th>
                  <th class="text-center">Total Piutang</th>
                  <th class="text-center">No Telp. Pelanggan</th>
                  <th class="text-center">Status</th>
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

  <!-- Modal -->
  <div class="modal fade" id="bayar-utang" tabindex="-1" role="dialog" aria-labelledby="bayar-utangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="no-fak"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <table class="table borderless">
                <tr>
                  <td>Tanggal Penjualan</td>
                  <td>:</td>
                  <td><span id="tgl-jual"></span></td>
                </tr>
                <tr>
                  <td>Pelanggan</td>
                  <td>:</td>
                  <td><span id="pelanggan"></span></td>
                </tr>
                <tr>
                  <td>Total Piutang</td>
                  <td>:</td>
                  <td><span id="tot-utang"></span></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <p>Bukti Bayar :</p>
                    <img id="path-bukti" src="" alt="" height="auto" width="300px">
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-12">
            <h4>Piutang telah dibayar ?</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="yakin-lunas">Yakin, Lunas</button>
        </div>
      </div>
    </div>
  </div>

<?php 
include('core/footer.php');
?>