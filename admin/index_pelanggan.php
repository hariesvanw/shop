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
            <h1>PELANGGAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_pelanggan.php">Pelanggan</a></li>
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
            if($message === 'hapus'){
        ?>
          <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Selamat !</strong> Data pelanggan berhasil dihapus.
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
                    <a href="create_pelanggan.php" class="btn btn-primary">Tambah Pelanggan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Data Pelanggan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-full" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Pelanggan</th>
                  <th class="text-center">Nama Pelanggan</th>
                  <th class="text-center">No Telpon</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $pelanggans = $conn->query("SELECT * FROM pelanggan_profile ORDER BY id");
                    while($row = mysqli_fetch_assoc($pelanggans)){ 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo 'CA'.str_pad($row['id_pelanggan'],3,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo $row['nama_pelanggan'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['alamat'] ?></td>
                      <td class="text-center">
                        <i
                          data-toggle="modal" data-target="#modal-pelanggan" 
                          class="btn btn-danger fas fa-trash-alt hapus-pelanggan" 
                          id="<?php echo $row['id_pelanggan'] ?>"
                          pel="<?php echo $row['nama_pelanggan']; ?>"
                        ></i>
                        <form action="pelanggan/destroy_pelanggan.php" method="post" id="fh-pel<?php echo $row['id_pelanggan'] ?>">
                          <input type="hidden" value="<?php echo $row['id_pelanggan'] ?>" name="id_pelanggan">
                        </form>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">No</th>
                  <th class="text-center">ID Pelanggan</th>
                  <th class="text-center">Nama Pelanggan</th>
                  <th class="text-center">No Telpon</th>
                  <th class="text-center">Alamat</th>
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
  <div class="modal fade" id="modal-pelanggan" tabindex="-1" role="dialog" aria-labelledby="pelangganTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pelangganLongTitle">Konfirmasi Hapus Pelanggan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Yakin ingin menghapus data dari <span style="color:orange" id="pel-nya"></span> ?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="yh-pel">Yes, Hapus !</button>
        </div>
      </div>
    </div>
  </div>

<?php 
include('core/footer.php');
unset($_SESSION["message"]);
?>