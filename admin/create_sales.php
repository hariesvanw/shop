<?php 
include('core/header.php');
include('core/sidebar.php');
$msg = null;
$err = null;
if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
    $err = $_SESSION['errors'];
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_sales.php">Sales</a></li>
              <li class="breadcrumb-item active">Tambah Sales</li>
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
                <div class="card-header text-center">
                    <h4 class="font-weight-bold">Form Tambah Sales</h4>
                </div>
                <form action="sales/store_sales.php" method="post">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                        <?php 
                                            if($msg === 'gagal'){
                                            if(count($err) > 0) { foreach($err as $e) {
                                        ?>
                                        <div class="col-12">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong><?php echo $e ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <?php } } }?>
                                        <div class="col-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama_sales">Nama Sales</label>
                                                    <input type="text" class="form-control" id="nama_sales" name="nama_sales" placeholder="Masukkan Nama Sales ..." required
                                                    maxlength="80"
                                                    minlength="3"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="jenis-kelamin">Jenis Kelamin</label>
                                                    <div class="input-group mb-3">
                                                        <select class="custom-select" id="jenis-kelamin" name="jenis_kelamin" required>
                                                            <option value="L">Laki-laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir ..." required
                                                    maxlength="80"
                                                    minlength="3"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <div class="input-group">
                                                        <input name="tanggal_lahir" type="text" class="form-control datepicker" value="1995-07-12">
                                                        <div class="input-group-addon">
                                                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="no_telpon">No Telpon</label>
                                                    <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder="Masukkan No Telpon ..." required
                                                    maxlength="80"
                                                    minlength="3"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" name="alamat" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email ..." required
                                                    maxlength="80"
                                                    minlength="3"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password ..." required
                                                    maxlength="80"
                                                    minlength="3"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="container-fluid">
                                    <button type="submit" name="sales" value="sales" class="btn btn-block btn-primary">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
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
unset($_SESSION["errors"])
?>