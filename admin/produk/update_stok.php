<?php
include('../core/koneksi.php');

$id_p = $_POST['id_produk'];
$qt = $_POST['stok'];

$sql = "UPDATE produk
        SET stok = stok+'$qt'
        WHERE id='$id_p'";

if($conn->query($sql) === TRUE){
    session_start();
    $location = "/admin/index_produk.php";
    $_SESSION['stok'] = 'sukses';
    header("Location: $location");
}

?>