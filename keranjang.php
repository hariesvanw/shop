<?php 
include('front/core/header.php');

if($guest){
    header("Location: login.php");
}else if(isset($_GET['cart'])){
    $id_cart = $_GET['cart'];
    $items = $conn->query("SELECT * FROM produk_record WHERE id_penjualan='$id_cart'");
    $r_cek = $conn->query("SELECT status FROM penjualan WHERE id='$id_cart'");
    $row = mysqli_fetch_assoc($r_cek);
    $ngutang = $row['status'] === 'utang' ? TRUE : FALSE;
    $wanas = $row['status'] === 'lunas' || $row['status'] === 'wait' ? TRUE : FALSE;
}else{
    header("Location: main.php");
}

?>
    <main role="main">
        <div class="container-fluid py-5 bg-light" style="height:100vh">
            <div class="row justify-content-center align-center">
                <?php 
                if(!empty($_SESSION['out_cart'])) {
                    $out_cart = $_SESSION['out_cart'];
                ?>
                <div class="col-11">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Selamat !</strong>
                    Berhasil dikeluarkan~
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                </div>
                <?php }?>
                <div class="col-11">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><a href="riwayat_transaksi.php">Riwayat Transaksi</a> <?php echo 'FK'.str_pad($id_cart,4,'0',STR_PAD_LEFT); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Foto Produk</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Harga Satuan</th>
                                        <th class="text-center">Jumlah Beli</th>
                                        <th class="text-center">Total Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $tot = 0;
                                    while($row = mysqli_fetch_assoc($items)) { 
                                        $id_p = $row['id_produk'];
                                        $r_produk = $conn->query("SELECT * FROM produk WHERE id='$id_p'");
                                        $row_p = mysqli_fetch_assoc($r_produk);
                                        $tot += $row_p['harga_produk']*$row['jumlah'];
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <img src="<?php echo $row_p['foto_utama'] ?>" alt="">
                                        </td>
                                        <td class="text-center align-middle"><?php echo $row_p['nama_produk'] ?></td>
                                        <td class="text-center align-middle"><?php echo $row_p['harga_produk'] ?></td>
                                        <td class="text-center align-middle"><?php echo $row['jumlah'] ?></td>
                                        <td class="text-center align-middle"><?php echo duit($row_p['harga_produk']*$row['jumlah']) ?></td>
                                        <td class="text-center align-middle">
                                            <form action="front/hapus_cart_item.php" method="post" id="form-hapus<?php echo $id_p ?>">
                                                <input type="hidden" name="id_cart" value="<?php echo $id_cart ?>">
                                                <input type="hidden" name="id_produk" value="<?php echo $id_p ?>">
                                                <input type="hidden" name="jumlah" value="<?php echo $row['jumlah'] ?>">
                                            </form>
                                            <button
                                            id="<?php echo $id_p ?>" 
                                            produk="<?php echo $row_p['nama_produk'] ?>"
                                            class="btn <?php echo $ngutang || $wanas ? 'btn-warning' : 'btn-danger' ?> hapus-cart-item"
                                            data-toggle="modal" data-target="#hcitem"
                                            <?php echo $ngutang || $wanas ? 'disabled' : '' ?>
                                            >
                                                <i class="fas <?php echo $ngutang || $wanas ? 'fa-lock' : 'fa-trash-alt' ?>"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <?php if($ngutang) { ?>
                                        <td class="text-left align-middle">
                                            <a href="riwayat_transaksi.php" class="btn btn-secondary">BACK</a>
                                        </td>
                                        <?php } else { ?>
                                            <td class="text-left">
                                                <a href="main.php" class="btn btn-primary">Beli Lagi</a>
                                            </td>
                                        <?php } ?>
                                        <td colspan="3" class="text-right align-middle">Total</td>
                                        <td class="text-center align-middle"><?php echo duit($tot) ?></td>
                                        <?php if($ngutang) { ?>
                                            <td class="text-center align-middle">
                                                <a href="bayar.php?cart=<?php echo $id_cart ?>" class="btn btn-primary">Bayar Sekarang</a>
                                            </td>
                                        <?php } else if($wanas) { ?>
                                            <td class="text-center align-middle">

                                            </td>
                                        <?php } else { ?>
                                            <td class="text-center">
                                                <form action="front/checkout.php" method="post" id="form-checkout">
                                                    <input type="hidden" name="id_cart" value="<?php echo $id_cart ?>">
                                                    <input type="hidden" name="total" value="<?php echo $tot ?>">
                                                </form>
                                                <button 
                                                    id="<?php echo $id_cart ?>"
                                                    class="btn btn-primary btn-block m-checkout" data-toggle="modal" data-target="#modalUtang">
                                                    Checkout Sekarang
                                                </button>
                                            </td>
                                        <?php } ?>
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
    <!-- Modal -->
    <div class="modal fade" id="modalUtang" tabindex="-1" role="dialog" aria-labelledby="modalUtangLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUtangLabel">KONFIRMASI CHECKOUT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin Checkout <span style="color:orange" id="cart-nya"></span> dan Kredit Sekarang ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-checkout">Yes, Checkout !</button>
            </div>
            </div>
        </div>
    </div> 
    
    <!-- Modal -->
    <div class="modal fade" id="hcitem" tabindex="-1" role="dialog" aria-labelledby="hcitemLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hcitemLabel">HAPUS KERANJANG ITEM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Yakin ingin menghapus produk <span style="color:orange" id="produk-nya"></span> dari keranjang ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="keluarkan">Yes, Keluarkan !</button>
            </div>
            </div>
        </div>
    </div>  

<?php 
include('front/core/footer.php');
unset($_SESSION["out_cart"])
?>