<?php 
include('core/header.php');
include('core/sidebar.php');

if(isset($_GET['id_kat'])){
  $id_kat = $_GET['id_kat'];
  $r_kat = $conn->query("SELECT * FROM kategori WHERE id='$id_kat'");
  $row = mysqli_fetch_assoc($r_kat);
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_kategori_produk.php">Kategori</a></li>
              <li class="breadcrumb-item active">Tambah Kategori</li>
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
                    <h4 class="font-weight-bold">Form Tambah Kategori</h4>
                </div>
                <form action="kategori/update_kategori.php?id_kat=<?php echo $row['id'] ?>" method="post">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_kategori">Nama Kategori</label>
                                                <input 
                                                value="<?php echo $row['nama_kategori'] ?>"
                                                type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori ..." required
                                                maxlength="80"
                                                minlength="3"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="container-fluid">
                                    <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary">SIMPAN</button>
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
<?php include('core/footer.php') ?>