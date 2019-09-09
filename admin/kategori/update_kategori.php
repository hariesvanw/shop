<?php 
include('../core/koneksi.php');

if(isset($_GET['id_kat'])){
    $nama_kat = $_POST['nama_kategori'];
    $cek = $conn->query("SELECT * FROM kategori WHERE nama_kategori='$nama_kat'");

    if(mysqli_num_rows($cek) > 0){
        session_start();
        $location = "/admin/create_kategori.php";
        $_SESSION['message'] = 'gagal';
        header("Location: $location");
    }else{

        $stmt = $conn->prepare("UPDATE kategori SET nama_kategori= ? WHERE id= ?");
        $stmt->bind_param("si", $nama, $id_k);

        $nama = filter_input(INPUT_POST,'nama_kategori', FILTER_SANITIZE_STRING);
        $id_k = $_GET['id_kat'];
        $stmt->execute();

        session_start();
        $location = "/admin/index_kategori_produk.php";
        $_SESSION['message'] = 'update';
        header("Location: $location");

        $stmt->close();
        $conn->close();
    }
}


?>