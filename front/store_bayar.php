<?php 
// echo print_r($_POST);
// echo '<br>';
include('core/koneksi.php');

$time = date("h:i:s");
$arr = explode(':',$time);
$wak = $arr[0].''.$arr[1].''.$arr[2];
$id_cart = $_GET['id_cart'];

$target_dir = "../assets/img/";
$target_file = $target_dir .'bukti_'.$id_cart.'_'.$wak.'_'.basename($_FILES["foto_bayar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["foto_bayar"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["foto_bayar"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["foto_bayar"]["tmp_name"], $target_file)) {
        $stmtA = $conn->prepare("UPDATE penjualan SET
                                 diskon = ?, status = ?, bukti_bayar = ?, tgl_bayar = ?
                                 WHERE id = ?");
        $stmtA->bind_param("isssi", $dis, $stat, $bukti, $tgl_b, $id_p);

        $dis = $_POST['diskon'];
        $stat = 'wait';
        $bukti = "../assets/img/".'bukti_'.$id_cart.'_'.$wak.'_'.basename($_FILES["foto_bayar"]["name"]);
        $tgl_b = $_POST['tgl_bayar'];
        $id_p = $id_cart;
        $stmtA->execute();
        $stmtA->close();

        session_start();
        $location = "../riwayat_transaksi.php";
        $_SESSION['stat_bayar'] = 'sukses';
        header("Location: $location");
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>