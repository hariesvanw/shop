<?php 
session_start();
require_once("core/koneksi.php");

$id_pel = $_POST['id_pelanggan'];
$nama = $_POST['nama_pelanggan'];
$telpon = $_POST['no_telpon'];
$alamat = $_POST['alamat'];
$cat = date("Y-m-d");

if(isset($_POST['id_profile']) && "" !== trim($_POST['id_profile']) ){
    $id_pro = $_POST['id_profile'];
    $sql = "UPDATE pelanggan_profile
            SET nama_pelanggan = '$nama', no_telpon = '$telpon', alamat = '$alamat'
            WHERE id='$id_pro'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'update';
        header("Location: ../profile.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}else{
    $sql = "INSERT INTO pelanggan_profile (id_pelanggan, nama_pelanggan, no_telpon, alamat, created_at)
            VALUES ('$id_pel', '$nama', '$telpon','$alamat', '$cat')";
            
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'simpan';
        header("Location: ../profile.php");
    } else {
        echo "Error tambah record: " . $conn->error;
    }
}

?>