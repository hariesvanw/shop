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
            <h1>KATEGORI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_kategori_produk.php">Kategori</a></li>
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
        <?php } ?>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <a href="create_kategori.php" class="btn btn-primary">Tambah Kategori</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Data Kategori</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-full" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Kategori</th>
                  <th class="text-center">Nama Kategori</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    $kategories = $conn->query("SELECT * FROM kategori");
                    while($row = mysqli_fetch_assoc($kategories)){ 
                  ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-center align-middle"><?php echo 'P'.str_pad($row['id'],2,'0',STR_PAD_LEFT); ?></td>
                      <td class="text-center align-middle"><?php echo $row['nama_kategori'] ?></td>
                      <td class="text-center">
                        <a href="edit_kategori.php?id_kat=<?php echo $row['id'] ?>" class="btn btn-primary">
                          <i class="fas fa-edit"></i>
                        </a>
                        <button 
                        data-toggle="modal" data-target="#hapuskategori"
                        id="<?php echo $row['id'] ?>" kategori="<?php echo $row['nama_kategori'] ?>" class="btn btn-danger hapus-kategori">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <form action="kategori/destroy_kategori.php" method="post" id="fh-kategori<?php echo $row['id'] ?>">
                          <input type="hidden" value="<?php echo $row['id'] ?>" name="id_kategori">
                        </form>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">ID Kategori</th>
                  <th class="text-center">Nama Kategori</th>
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
  <div class="modal fade" id="hapuskategori" tabindex="-1" role="dialog" aria-labelledby="hapuskategoriTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapuskategoriLongTitle">Konfirmasi Hapus kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span>Yakin ingin menghapus data dari <span style="color:orange" id="kategori-nya"></span> ?</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="yh-kategori">Yes, Hapus !</button>
        </div>
      </div>
    </div>
  </div>

<?php 
include('core/footer.php');
unset($_SESSION["message"]);
?>