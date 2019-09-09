<?php 
require_once("core/koneksi.php");

$id_p = $_POST['id_pel'];
$id_produk = $_POST['id_produk'];
$hrg = $_POST['harga'];
$jumlah = $_POST['jumlah'];

$sql = "SELECT * FROM penjualan WHERE id_pelanggan_profile='$id_p' AND status='keranjang'";
$cek = $conn->query($sql);
if(mysqli_num_rows($cek) > 0 ){

    $row = mysqli_fetch_assoc($cek);
    $id_cart = $row['id'];
    $sql_rec = "INSERT INTO produk_record (id_penjualan,id_produk,jumlah)
                VALUES ('$id_cart','$id_produk','$jumlah')";

    if($conn->query($sql_rec) === TRUE){
        $r_produk = $conn->query("UPDATE produk SET stok=stok-'$jumlah' WHERE id='$id_produk'");
        session_start();
        $_SESSION["status_beli"] = 'sukses';
        header("Location: ../main.php");
        echo 'sukses '.$conn->insert_id;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}else{
    $today = date('Y-m-d');
    $tempo = date('Y-m-d', strtotime($today. ' + 15 days'));
    $ins =  "INSERT INTO penjualan (tanggal_penjualan, id_pelanggan_profile, utang, jatuh_tempo, diskon)
             VALUES ('$today','$id_p','0','$tempo','0')";

    if ($conn->query($ins) === TRUE) {
        $last_id = $conn->insert_id;
        $sql_cart = "INSERT INTO produk_record (id_penjualan,id_produk,jumlah)
                     VALUES ('$last_id','$id_produk','$jumlah')";

        $totHarga = $hrg*$jumlah;
        
        if($conn->query($sql_cart) === TRUE){
            $r_produk = $conn->query("UPDATE produk SET stok=stok-'$jumlah' WHERE id='$id_produk'");
            session_start();
            $_SESSION["status_beli"] = 'sukses';
            header("Location: ../main.php");
            echo 'sukses '.$conn->insert_id;
            // $up = " UPDATE penjualan
            // SET utang = '$totHarga'
            // WHERE id='$last_id'";

            // if($conn->query($up) === TRUE){
            //     session_start();
            //     $_SESSION["status_beli"] = 'sukses';
            //     header("Location: ../main.php");
            //     echo 'sukses '.$conn->insert_id;
            // }
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>