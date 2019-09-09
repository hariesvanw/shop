<?php 
include('core/header.php');
include('core/sidebar.php');

if(isset($_GET['idproduk'])){
  $id_p = $_GET['idproduk'];

  $produk = $conn->query("SELECT p.*, group_concat(DISTINCT kp.id_kategori) as kats
                          FROM produk p 
                          LEFT JOIN kategori_produk kp on p.id = kp.id_produk
                          WHERE p.id = '$id_p'");

  $row = mysqli_fetch_assoc($produk);
  $stok = $row['stok'];
  $path = $row['foto_utama'];
  $arr_kat = explode(',',$row['kats']);
  $exp = $row['expired'];
  $sup = $row['sup'];
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
              <li class="breadcrumb-item"><a href="index_produk.php">Produk</a></li>
              <li class="breadcrumb-item active">Edit Produk</li>
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
                    <h4 class="font-weight-bold">Form Edit Produk</h4>
                </div>
                <form action="produk/update_produk.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="id_produk">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label for="nama_produk">Nama Produk</label>
                                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk ..."
                                                value="<?php echo $row['nama_produk'] ?>"
                                                maxlength="80"
                                                minlength="3"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_produk">Harga Produk</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input 
                                                    value="<?php echo $row['harga_produk'] ?>"
                                                    type="number" class="form-control" id="harga_produk" name="harga_produk" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-6">
                                                <div class="row">
                                                  <div class="col-12">
                                                    <label for="kategori">Kategori Produk</label>
                                                  </div>
                                                  <div class="col-12">
                                                    <select class="selectpicker" multiple data-live-search="true" id="kategori" name="kategori[]" required>
                                                      <?php 
                                                        $res_kats = $conn->query("SELECT * FROM kategori");
                                                        while($row = mysqli_fetch_assoc($res_kats)){
                                                      ?>
                                                        <option 
                                                        <?php echo in_array($row['id'], $arr_kat) ? 'selected' : '' ?>
                                                        value="<?php echo $row['id']?>"><?php echo $row['nama_kategori']?></option>
                                                      <?php } ?>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-6">
                                                <div class="form-group">
                                                  <label for="stok_produk">Stok</label>
                                                  <div class="input-group mb-3">
                                                      <input
                                                      value="<?php echo $stok ?>"
                                                      type="text" class="form-control" id="stok_produk" name="stok_produk" required>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="expired">Expired</label>
                                                <div class="input-group">
                                                    <input name="expired" type="text" class="form-control datepicker" value="<?php echo $exp ?>" required>
                                                    <div class="input-group-addon">
                                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="sup">Supplier</label>
                                                <input type="text" class="form-control" id="sup" name="sup" placeholder="Masukkan Supplier..." required
                                                value="<?php echo $sup ?>"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="foto_produk">Foto Produk</label>
                                                <input
                                                value="<?php echo $path ? $path : '' ?>" 
                                                type="file" class="form-control-file mb-1" id="foto_produk" name="foto_produk">
                                                <img id="blah" src="<?php echo $path ? $path : 'holder.js/300x200' ?>" alt="foto produk">
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
<?php 
include('core/footer.php');
?>