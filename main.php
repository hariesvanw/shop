<?php 
include('front/core/header.php');

$s_beli = null;
if(isset($_SESSION['status_beli'])){
    $s_beli = $_SESSION['status_beli'];
}

if(isset($_GET['cari'])){
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);
    // $produks = $conn->query("SELECT * FROM produk WHERE nama_produk LIKE '%$cari%'");
    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats
    FROM produk p 
    LEFT JOIN kategori_produk kp on p.id = kp.id_produk
    LEFT JOIN kategori k on k.id = kp.id_kategori
    WHERE nama_produk LIKE '%$cari%' GROUP BY p.id");

    $ditemukan = mysqli_num_rows($produks);

}else{
    $halaman = 12;
    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
    $produks = $conn->query("SELECT p.*, p.id, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats
    FROM produk p 
    LEFT JOIN kategori_produk kp on p.id = kp.id_produk
    LEFT JOIN kategori k on k.id = kp.id_kategori
    GROUP BY p.id");

    $total = mysqli_num_rows($produks);
    if($total > 80 && $total < 160){
        $halaman = 24;
    }else if($total > 160){
        $halaman = 48;
    }
    $pages = ceil($total/$halaman); 

    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats
    FROM produk p 
    LEFT JOIN kategori_produk kp on p.id = kp.id_produk
    LEFT JOIN kategori k on k.id = kp.id_kategori
    GROUP BY p.id LIMIT $mulai, $halaman");
}
?>
    <main role="main">
      <div class="album py-5 bg-light">
          <div class="container">
                <div class="row">
                    <?php if(isset($_GET['cari'])) { ?>
                        <div class="col-12">
                            <div class="alert alert-info d-flex" role="alert">
                                <span class="btn btn-secondary"><?php echo $ditemukan ?> Produk ditemukan.</span>
                                <a href="main.php" class="ml-auto btn btn-primary">Reset</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($s_beli === 'sukses') { ?>
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Selamat !</strong> Produk Berhasil ditambahkan.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- list produks -->
                    <?php 
                        while($row = mysqli_fetch_assoc($produks)){
                            if(!$guest){
                                $r_id_penjualan_cart = $conn->query("SELECT id,status FROM penjualan WHERE id_pelanggan_profile='$id_profile' AND status='keranjang'");
                                $row_cart = mysqli_fetch_assoc($r_id_penjualan_cart);
                                $id_cart = $row_cart['id'];
                                $id_duk = $row['id'];
                                $r_cek_cart = $conn->query("SELECT * FROM produk_record WHERE id_penjualan='$id_cart' AND id_produk='$id_duk'");
                                $cek_cart = mysqli_num_rows($r_cek_cart) > 0 ? TRUE : FALSE;

                                $r_id_penjualan_utang = $conn->query("SELECT id,status FROM penjualan WHERE id_pelanggan_profile='$id_profile' AND status='utang'");
                                $cek_utang = mysqli_num_rows($r_id_penjualan_utang) > 0 ? TRUE : FALSE;
                                $r_id_penjualan_wait = $conn->query("SELECT id,status FROM penjualan WHERE id_pelanggan_profile='$id_profile' AND status='wait'");
                                $cek_wait = mysqli_num_rows($r_id_penjualan_wait) > 0 ? TRUE : FALSE;
                            }
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="foto-produk" src="<?php echo $row['foto_utama'] ?>" alt="<?php echo $row['nama_produk'] ?>">
                            <div class="card-body card-foto">
                                <h3 class="card-text"><?php echo $row['nama_produk'] ?></h3>
                                <p class="card-text"><?php echo duit($row['harga_produk']) ?></p>
                                <div class="row align-items-center warna">
                                    <div class="col-12 mb-2">
                                        <small class="text-muted"><?php echo $row['kats'] ?></small>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <small class="text-muted">Stok : <?php echo $row['stok'] ?></small>
                                    </div>
                                    <div class="col-12">
                                        <form action="front/add_to_keranjang.php" method="post" onkeydown="return event.key != 'Enter';">
                                            <input type="hidden" name="id_pel" value="<?php echo $id_profile ?>">
                                            <div class="input-group mb-3">
                                                <input name="jumlah" 
                                                max="<?php echo $row['stok'] ?>"
                                                <?php echo $guest || !$profile ? 'disabled' : '' ?> type="<?php echo $cek_cart || $cek_utang || $cek_wait ? 'hidden' : 'number' ?>" class="form-control" placeholder="jumlah beli.." aria-label="jumlah beli" aria-describedby="tambah">
                                                <div class="input-group-append">
                                                    <?php if($guest) {?>
                                                        <button disabled class="btn btn-outline-secondary" type="button">Silahkan Login</button>
                                                    <?php }else if($profile) { ?>
                                                        <?php if($cek_wait) { ?>
                                                            <a href="riwayat_transaksi.php" class="btn btn-secondary rounded">Menunggu Verifikasi</a>
                                                        <?php }else if($cek_utang) { ?>
                                                            <a href="riwayat_transaksi.php" class="btn btn-secondary rounded">Bayar Hutang Sekarang</a>
                                                        <?php } else if($cek_cart) { ?>
                                                            <a href="keranjang.php?cart=<?php echo $id_cart ?>" class="btn btn-secondary rounded">Lihat Keranjang</a>
                                                        <?php } else { ?>
                                                            <input type="hidden" name="id_produk" value="<?php echo $row['id'] ?>">
                                                            <input type="hidden" name="harga" value="<?php echo $row['harga_produk'] ?>">
                                                            <button class="btn btn-outline-secondary" type="submit" name="beli" value="beli">
                                                                <i class="fas fa-shopping-cart"></i>
                                                                Tambah
                                                            </button>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <a href="profile.php" class="btn btn-secondary mt-2">Silahkan Isi Profile Anda Terlebih dahulu!</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                    <!-- end-list-produks -->
                    <?php if(!isset($_GET['cari'])) { ?>
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                            <?php if($page > 1) {  ?>
                                <li class="page-item"><a class="page-link" href="?halaman=1">Awal</a></li>
                            <?php } ?>
                            <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                <li class="page-item <?php echo $_GET['halaman'] == $i ? 'active' : ''  ?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php } ?>
                            <?php if($page < $pages) {  ?>
                                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $pages ?>">Akhir</a></li>
                            <?php } ?>
                            </ul>
                        </nav>
                    </div>
                    <?php } ?>
                </div>
          </div>
      </div>
    </main>

<?php 
include('front/core/footer.php');
unset($_SESSION["status_beli"]);
?>