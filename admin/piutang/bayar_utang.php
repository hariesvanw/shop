<?php  
include('../core/koneksi.php');

$id_h = $_POST['id_hutang'];
$id_s = $_POST['id_sales'];
$dibayar = $_POST['dibayar'];
$tgl = $_POST['tanggal_verifikasi'];

$r_utang = $conn->query("UPDATE penjualan
                         SET status='lunas'
                         WHERE id='$id_h'");

$sql = "INSERT INTO pembayaran (id_penjualan, id_sales, dibayar, tanggal_verifikasi)
        VALUES ('$id_h','$id_s','$dibayar','$tgl')";

    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['message'] = 'lunas';
        header("Location: ../index_pembayaran.php");
    } else {
        echo "Error tambah record: " . $conn->error;
    }
?>