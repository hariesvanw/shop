<?php 
include('front/core/header.php');

$msg = null;
if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
}

if($guest){
    header("Location: ../login.php");
}else{
    $id_cart = $_GET['cart'];
    $sql = "SELECT * FROM penjualan WHERE id='$id_cart'";
    $cart = $conn->query($sql);
    $row = mysqli_fetch_assoc($cart);

    $today = date_create(date('Y-m-d'));
    $tempo=date_create($row['jatuh_tempo']);
    $diff=date_diff($tempo,$today);
    $cek = $diff->format("%R%a");
}

?>
    <main role="main">
        <div class="container-fluid mb-3 bg-light">
            <div class="row justify-content-center align-center">
                <div class="col-8">
                    <?php 
                        if($msg === 'simpan'){
                    ?>
                        <div class="alert alert-success" role="alert">
                            Profile berhasil disimpan !
                        </div>
                    <?php } else if($msg === 'update') { ?>
                        <div class="alert alert-info" role="alert">
                            Profile berhasil diupdate !
                        </div>
                    <?php }?>
                    <div class="card mt-5">
                        <div class="card-header">
                            BAYAR TAGIHAN !
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                            action="front/store_bayar.php?id_cart=<?php echo $id_cart ?>" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table borderless">
                                        <tr>
                                            <td>Tanggal Transaksi</td>
                                            <td>:</td>
                                            <td><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>ID Penjualan</td>
                                            <td>:</td>
                                            <td><?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tagihan</td>
                                            <td>:</td>
                                            <td><?php echo duit($row['utang']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jatuh Tempo</td>
                                            <td>:</td>
                                            <td><?php echo tgl_indo($row['jatuh_tempo']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Diskon</td>
                                            <td>:</td>
                                            <td><?php echo $cek > 0 ? '0' : duit((2/100) * $row['utang']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Tagihan</td>
                                            <td>:</td>
                                            <td><?php echo $cek > 0 ? duit($row['utang']) : duit($row['utang']-((1/100) * $row['utang'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Bayar</td>
                                            <td>:</td>
                                            <td><?php echo tgl_indo(date("Y-m-d")); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="custom-file">
                                        <input required name="foto_bayar" type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <img id="blah" src="assets/img/no_bukti.png" class="foto-bukti" alt="customFile">
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="diskon" value="<?php echo $cek > 0 ? '0' : (2/100) * $row['utang']; ?>">
                                    <input type="hidden" name="tgl_bayar" value="<?php echo date("Y-m-d") ?>">
                                    <button type="submit" name="submit" value="bayar" class="btn btn-primary btn-block">Bayar</button>
                                </div>
                            </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
include('front/core/footer.php');
unset($_SESSION["message"])
?>