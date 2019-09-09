<?php
include('core/header.php');
include('core/sidebar.php');
$msg = null;
if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SALES</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_sales.php">Sales</a></li>
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
              <?php echo $message === 'sukses' ? 'sales berhasil ditambahkan': ($message === 'update' ? 'sales berhasil diupdate' : ($message === 'hapus' ? 'sales berhasil dihapus' : 'gagal ada yang salah !')) ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        <?php }?>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <a href="create_sales.php" class="btn btn-primary">Tambah Sales</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Data Sales</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-full" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Sales</th>
                  <th class="text-center">Nama Sales</th>
                  <th class="text-center">No Telpon</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $sales = $conn->query("SELECT * FROM sales ORDER BY id");
                    while($row = mysqli_fetch_assoc($sales)){ 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo 'S'.str_pad($row['id'],3,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo $row['nama_sales'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['email'] ?></td>
                      <td class="text-center align-middle"><?php echo $row['alamat'] ?></td>
                      <td class="text-center">
                        <form action="sales/destroy_sales.php" method="post" id="fh-sales<?php echo $row['id'] ?>">
                          <input type="hidden" value="<?php echo $row['id'] ?>" name="id_sales">
                        </form>
                        <button 
                        data-toggle="modal" data-target="#hapusSales"
                        id="<?php echo $row['id'] ?>" sales="<?php echo $row['nama_sales'] ?>" class="btn btn-danger hapus-sales">
                          <i class="fas fa-trash-alt"></i>
                        </button>
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
                  <th class="text-center">Email</th>
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
  <div class="modal fade" id="hapusSales" tabindex="-1" role="dialog" aria-labelledby="hapusSalesTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusSalesLongTitle">Konfirmasi Hapus Sales</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Yakin ingin menghapus data dari <span style="color:orange" id="sales-nya"></span> ?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="yh-sales">Yes, Hapus !</button>
        </div>
      </div>
    </div>
  </div>

<?php 
include('core/footer.php');
unset($_SESSION["message"]);
?>