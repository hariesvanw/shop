<?php 
require_once("core/koneksi.php");

$id_cart = $_POST['id_cart'];
$utang = $_POST['total'];

$update = " UPDATE penjualan
            SET utang='$utang', status='utang'
            WHERE id='$id_cart'";
        
        if($conn->query($update) === TRUE){
            session_start();
            $_SESSION["utang"] = 'sukses';
            header("Location: ../riwayat_transaksi.php");
        }
?>