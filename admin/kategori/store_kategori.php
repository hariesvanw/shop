<?php 
include('../core/koneksi.php');

$nama_kat = $_POST['nama_kategori'];
$cek = $conn->query("SELECT * FROM kategori WHERE nama_kategori='$nama_kat'");

if(mysqli_num_rows($cek) > 0){
    session_start();
    $location = "/admin/create_kategori.php";
    $_SESSION['message'] = 'gagal';
    header("Location: $location");
}else{
    $stmt = $conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
    $stmt->bind_param("s", $nama);

    $nama = filter_input(INPUT_POST,'nama_kategori', FILTER_SANITIZE_STRING);
    $stmt->execute();

    session_start();
    $location = "/admin/index_kategori_produk.php";
    $_SESSION['message'] = 'sukses';
    header("Location: $location");

    $stmt->close();
    $conn->close();
}

?>