<?php 
include('../core/koneksi.php');

if($_FILES['foto_produk']['error'] > 0){
    $stmtH = $conn->prepare("DELETE FROM kategori_produk WHERE id_produk = ?");
    $bind = $stmtH->bind_param('i', $id_h);
    $id_h = $_POST['id_produk'];
    $exec = $stmtH->execute();
    $stmtH->close();

    $kats = $_POST['kategori'];
    foreach($kats as $kat){
        $stmtB = $conn->prepare("INSERT INTO kategori_produk (id_kategori, id_produk) VALUES (?, ?)");
        $stmtB->bind_param("ii", $id_k, $id_p);
        $id_k = $kat;
        $id_p = $_POST['id_produk'];
        $stmtB->execute();
        $stmtB->close();
    }

    $stmtC = $conn->prepare("UPDATE produk 
    SET nama_produk = ?, harga_produk = ?, stok = ?, expired = ?, sup = ?
    WHERE id = ?");
    $stmtC->bind_param("siissi", $n_p, $h_p, $s_p, $exp, $sup, $id_p);
    $n_p = $_POST['nama_produk'];
    $h_p = $_POST['harga_produk'];
    $s_p = $_POST['stok_produk'];
    $exp = $_POST['expired'];
    $sup = $_POST['sup'];
    $id_p = $_POST['id_produk'];
    $stmtC->execute();
    $stmtC->close();

    session_start();
    $location = "/admin/index_produk.php";
    $_SESSION['message'] = 'update';
    header("Location: $location");
    $conn->close();
}else{
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
            $stmtH = $conn->prepare("DELETE FROM kategori_produk WHERE id_produk = ?");
            $bind = $stmtH->bind_param('i', $id_h);
            $id_h = $_POST['id_produk'];
            $exec = $stmtH->execute();
            $stmtH->close();
        
            $kats = $_POST['kategori'];
            foreach($kats as $kat){
                $stmtB = $conn->prepare("INSERT INTO kategori_produk (id_kategori, id_produk) VALUES (?, ?)");
                $stmtB->bind_param("ii", $id_k, $id_p);
                $id_k = $kat;
                $id_p = $_POST['id_produk'];
                $stmtB->execute();
                $stmtB->close();
            }
        
            $stmtC = $conn->prepare("UPDATE produk 
                        SET nama_produk = ?, harga_produk = ?, stok = ?, foto_utama = ?, expired = ?, sup = ?
                        WHERE id = ?");
            $stmtC->bind_param("siisi", $n_p, $h_p, $s_p, $foto, $exp, $sup, $id_p);
            $n_p = $_POST['nama_produk'];
            $h_p = $_POST['harga_produk'];
            $s_p = $_POST['stok_produk'];
            $foto = "../assets/img/".'p_'.$wak.'_'. basename($_FILES["foto_produk"]["name"]);
            $exp = $_POST['expired'];
            $sup = $_POST['sup'];
            $id_p = $_POST['id_produk'];
            $stmtC->execute();
            $stmtC->close();

            // $stmtD = $conn->prepare("UPDATE foto_produk SET f_path = ? WHERE id_produk = ?");
            // $stmtD->bind_param("si", $fp_path, $id_p);
            // $fp_path = "../assets/img/".'p_'.$wak.'_'. basename($_FILES["foto_produk"]["name"]);
            // $id_p = $_POST['id_produk'];
            // $stmtD->execute();
            // $stmtD->close();
            
            session_start();
            $location = "/admin/index_produk.php";
            $_SESSION['message'] = 'update';
            header("Location: $location");
            $conn->close();
            echo "The file ". basename( $_FILES["foto_produk"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>