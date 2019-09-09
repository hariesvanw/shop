<?php
session_start();
include('front/core/koneksi.php');

$pel = null;
$guest = false;
$profile = false;
$isNotLunas = false;
if(!isset($_SESSION["pel"])){
    $guest = true;
}else {
    $pel = $_SESSION["pel"];
    $id_pel = $pel['id'];
    $sql = "SELECT id FROM pelanggan_profile WHERE id_pelanggan='$id_pel'";
    $pel_pro = $conn->query($sql);
    $cek = mysqli_num_rows($pel_pro);
    $row = mysqli_fetch_assoc($pel_pro);
    $id_profile = $row['id'];

    if($cek > 0){
        $profile = true;
    }else{
        $profile = false;
    }

    $not_lunas = $conn->query("SELECT * FROM penjualan WHERE id_pelanggan_profile = '$id_profile' AND status != 'lunas'");
    $cek_lunas = mysqli_num_rows($not_lunas);
    if($cek_lunas > 0){
        $isNotLunas = TRUE;
    }else{
        $isNotLunas = FALSE;
    }
};

?>