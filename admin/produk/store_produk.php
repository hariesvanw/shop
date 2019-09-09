<?php
// echo print_r($_POST).'<br>';
// echo print_r($_FILES).'<br>'; 
include('../core/koneksi.php');


$time = date("h:i:s");
$arr = explode(':',$time);
$wak = $arr[0].''.$arr[1].''.$arr[2];

$target_dir = "../../assets/img/";
$target_file = $target_dir .'p_'.$wak.'_'. basename($_FILES["foto_produk"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["foto_produk"]["tmp_name"]);
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
if ($_FILES["foto_produk"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file)) {
        echo 'wow';
        $nama = $_POST['nama_produk'];
        $harga = $_POST['harga_produk'];
        $foto = "../assets/img/".'p_'.$wak.'_'. basename($_FILES["foto_produk"]["name"]);
        // $foto = "tes";
        $stok = $_POST['stok_produk'];
        $exp = $_POST['expired'];
        $sup = $_POST['sup'];

        $sql = "INSERT INTO produk (nama_produk, harga_produk, sup, foto_utama, stok, expired) VALUES ('$nama','$harga','$sup','$foto','$stok','$exp')";
        
        if($conn->query($sql) === TRUE){
            $id_ins = $conn->insert_id;
            $kats = $_POST['kategori'];
            foreach($kats as $kat){
                $id_k = $kat;
                $id_p = $id_ins;
                $sql = "INSERT INTO kategori_produk (id_kategori, id_produk) VALUES ('$id_k','$id_p')";
                $conn->query($sql);
            }
            session_start();
            $location = "/admin/index_produk.php";
            $_SESSION['message'] = 'sukses';
            header("Location: $location");
            $conn->close();
        }else{
            echo "Error: " .$sql. "<br>". $conn->error;
        }

        // $stmtD = $conn->prepare("INSERT INTO foto_produk (id_produk, f_path) VALUES (?, ?)");
        // $stmtD->bind_param("ss", $id_p, $path);
        // $id_p = $id_ins;
        // $path = "../assets/img/".'p_'.$wak.'_'. basename($_FILES["foto_produk"]["name"]);
        // $stmtD->execute();
        // $stmtD->close();
        // echo "The file ". basename( $_FILES["foto_produk"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>