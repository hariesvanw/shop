<?php 
include('front/core/header.php');

$utang = null;
if(isset($_SESSION['utang'])){
    $utang = $_SESSION['utang'];
}

$stat_bayar = null;
if(isset($_SESSION['stat_bayar'])){
    $stat_bayar = $_SESSION['stat_bayar'];
}

if($guest){
    header("Location: ../login.php");
}else{
    $id_pel = $pel['id'];
    $sql = "SELECT * FROM penjualan WHERE id_pelanggan_profile='$id_profile' ORDER BY id DESC";
    $riwis = $conn->query($sql);
}

?>
    <main role="main">
        <div class="container-fluid py-5 bg-light" style="height:100vh">
            <div class="row justify-content-center align-center">
                <?php if($utang === 'sukses') { ?>
                    <div class="col-11">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat !</strong> Berhasil !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <?php if($stat_bayar === 'sukses') { ?>
                    <div class="col-11">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat !</strong> Tagihan Berhasil Dibayar. Tunggu Verifikasi Dari Sales !.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th class="text-center">ID Penjualan</th>
                                        <th class="text-center">Total Uang</th>
                                        <th class="text-center">Jatuh Tempo</th>
                                        <th class="text-center">Diskon</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_assoc($riwis)) { ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
                                        <td class="text-center align-middle"><?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                                        <td class="text-center align-middle"><?php echo $row['utang'] > 0 ? duit($row['utang']) : 'Belum Checkout' ?></td>
                                        <td class="text-center align-middle"><?php echo tgl_indo($row['jatuh_tempo']) ?></td>
                                        <td class="text-center align-middle"><?php echo $row['utang'] > 0 ? duit($row['diskon']) : 'Belum Checkout' ?></td>
                                        <td class="text-center align-middle"><?php echo $row['status'] ?></td>
                                        <td class="text-center text-nowrap">
                                            <a href="keranjang.php?cart=<?php echo $row['id'] ?>" class="btn btn-secondary">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                            <?php if($row['status'] !== 'lunas' && $row['status'] !== 'wait') { ?>
                                                <a href="bayar.php?cart=<?php echo $row['id'] ?>" class="btn btn-success">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th class="text-center">ID Penjualan</th>
                                        <th class="text-center">Total Uang</th>
                                        <th class="text-center">Jatuh Tempo</th>
                                        <th class="text-center">Diskon</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
include('front/core/footer.php');
unset($_SESSION["utang"]);
unset($_SESSION["message"]);
unset($_SESSION["stat_bayar"]);
?>