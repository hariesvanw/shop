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
            <h1>PRODUK</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_produk.php">Produk</a></li>
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
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <a href="create_produk.php" class="btn btn-primary">Tambah Produk</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Data Produk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-full" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Produk</th>
                  <th class="text-center">Nama Produk</th>
                  <th class="text-center">Supplier</th>
                  <th class="text-center">Harga Produk</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Stok</th>
                  <th class="text-center">Expired</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
                                            FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
                                            LEFT JOIN kategori k on kp.id_kategori = k.id
                                            GROUP BY p.id ORDER BY p.expired");
                    while($row = mysqli_fetch_assoc($produks)){ 
                  ?>
                    <tr>
                      <td class="align-middle"><?php echo $no ?></td>
                      <td class="align-middle"><?php echo 'P'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                      <td class="align-middle"><?php echo $row['nama_produk'] ?></td>
                      <td class="align-middle"><?php echo $row['sup'] ?></td>
                      <td class="align-middle"><?php echo duit($row['harga_produk']) ?></td>
                      <td class="align-middle"><?php echo $row['kats'] ?></td>
                      <td class="align-middle">
                        <div class="row justify-content-between pr-2">
                          <div class="col-6">
                            <div class="mt-2"><?php echo $row['stok'] ?></div>
                          </div>
                          <div class="col-6">
                          <button class="btn btn-warning ml-2 tombol-tambah"
                          pr="<?php echo '[P'.str_pad($row['id'],4,'0',STR_PAD_LEFT).'] '.$row['nama_produk']; ?>"
                          id="<?php echo $row['id'] ?>"
                          data-toggle="modal" data-target="#modal-stok"
                          >
                            <i class="fas fa-plus-circle"></i>
                          </button>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle" nowrap><?php echo tgl_indo($row['expired']) ?></td>
                      <td class="text-center" nowrap>
                        <button class="btn btn-secondary tombol-foto"
                        prod="<?php echo '[P'.str_pad($row['id'],4,'0',STR_PAD_LEFT).'] '.$row['nama_produk']; ?>"
                        path="<?php echo $row['foto_utama'] ?>"
                        data-toggle="modal" data-target="#foto-produk"
                        >
                          <i class="fas fa-image"></i>
                        </button>
                        <a href="edit_produk.php?idproduk=<?php echo $row['id'] ?>" class="btn btn-primary fas fa-edit"></a>
                        <i
                          data-toggle="modal" data-target="#hapus-produk" 
                          class="btn btn-danger fas fa-trash-alt hapus-produk" 
                          id="<?php echo $row['id'] ?>"
                          produk="<?php echo '[P'.str_pad($row['id'],4,'0',STR_PAD_LEFT).'] '.$row['nama_produk']; ?>"
                        ></i>
                        <form action="produk/destroy_produk.php" method="post" id="fh-produk<?php echo $row['id'] ?>">
                          <input type="hidden" value="<?php echo $row['id'] ?>" name="id_produk">
                        </form>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Produk</th>
                  <th class="text-center">Nama Produk</th>
                  <th class="text-center">Supplier</th>
                  <th class="text-center">Harga Produk</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">stok</th>
                  <th class="text-center">Expired</th>
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
  <div class="modal fade" id="hapus-produk" tabindex="-1" role="dialog" aria-labelledby="hapus-produkLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapus-produkLabel">Konfirmasi Hapus Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Yakin ingin menghapus data dari <span style="color:orange" id="produk-nya"></span> ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="yh-produk">Ya, Hapus !</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="foto-produk" tabindex="-1" role="dialog" aria-labelledby="foto-produkTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="foto-produkLongTitle">Foto Produk <span id="id-foto"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-center">
              <img id="path-nya" src="" alt="" height="200px" width="300px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-stok" tabindex="-1" role="dialog" aria-labelledby="modal-stokTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-stokLongTitle">Tambah Stok <span id="stok-produknya"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-center">
              <form action="produk/update_stok.php" method="post">
                <div class="col-12">
                  <div class="input-group mb-3">
                    <input id="produk-id" type="hidden" name="id_produk">
                    <input id="stok-nya" name="stok" type="number" class="form-control" placeholder="Tambah Stok" aria-label="Tambah Stok" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button type="submit" name="submit" class="btn btn-success" type="button">Update Stok</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php 
include('core/footer.php');
unset($_SESSION["message"]);
unset($_SESSION["stok"]);
?>