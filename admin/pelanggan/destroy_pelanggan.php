<?php 
session_start();
include('../core/koneksi.php');

$stmt = $conn->prepare("DELETE FROM pelanggan WHERE id = ?");

if ( false === $stmt ) {
    $stmt->close();
    $conn->close();
    $location = "/admin/index_pelanggan.php";
    $_SESSION['message'] = 'gagal';
    header("Location: $location");
}else{
    $bind = $stmt->bind_param('i', $id);
    $id = $_POST['id_pelanggan'];
    $exec = $stmt->execute();
    $stmt->close();
    $conn->close();
    $location = "/admin/index_pelanggan.php";
    $_SESSION['message'] = 'hapus';
    header("Location: $location");
}

?>