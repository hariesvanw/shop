<?php 
require_once("core/koneksi.php");

$id_cart = $_POST['id_cart'];
$id_produk = $_POST['id_produk'];
$jumlah = $_POST['jumlah'];
$sql = "DELETE FROM produk_record WHERE id_penjualan='$id_cart' AND id_produk='$id_produk'";

if ($conn->query($sql) === TRUE) {
	$r_produk = $conn->query("UPDATE produk SET stok=stok+'$jumlah' WHERE id='$id_produk'");
    session_start();
    $_SESSION['out_cart'] = 'sukses';
    header("Location: ../keranjang.php?cart=".$id_cart);
} else {
    echo "Error tambah record: " . $conn->error;
}
?>