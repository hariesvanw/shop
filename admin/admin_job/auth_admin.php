<?php
session_start();
include('core/koneksi.php');

$min = null;
$guest = false;
$nama_sales = null;
if(isset($_SESSION["min"])){
    $min = $_SESSION["min"];
    $id_admin = $min['id'];
}else if(isset($_SESSION["sales"])) {
    $sales = $_SESSION["sales"];
    $id_sales = $sales['id'];
    $nama_sales = $sales['nama_sales'];
}else{
    $guest = true;
}

?>