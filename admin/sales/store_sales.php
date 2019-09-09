<?php

session_start();
require_once("../core/koneksi.php"); 
if(isset($_POST['sales'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $row = $conn->query("SELECT * FROM sales WHERE email = '$email'");

    $arr_err = [];
    $uok = false;
    if(mysqli_num_rows($row)){
      array_push($arr_err, 'Email telah digunakan !');
      $_SESSION['message'] = 'gagal';
      $_SESSION['errors'] = $arr_err;
      header("Location: ../create_sales.php");
      $uok = false;
    }else{
      $uok = true;
    }

    $pass = $_POST["password"];

    if($uok){
        // menyiapkan query
        $today = date('Y-m-d');
        $sql = "INSERT INTO sales (nama_sales, jenis_kelamin, tempat_lahir, tanggal_lahir, no_telpon, alamat, email, password, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtR = $conn->prepare($sql);
    
        // bind parameter ke query
        $stmtR->bind_param("sssssssss", $nama, $jk, $tempat, $tanggal, $telpon, $alamat, $email, $pass, $created);

        $nama = filter_input(INPUT_POST, 'nama_sales', FILTER_SANITIZE_STRING);
        $jk = $_POST['jenis_kelamin'];
        $tempat = filter_input(INPUT_POST, 'tempat_lahir', FILTER_SANITIZE_STRING);
        $tanggal = filter_input(INPUT_POST, 'tanggal_lahir', FILTER_SANITIZE_STRING);
        $telpon = filter_input(INPUT_POST, 'no_telpon', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $created = $today;
        
        // eksekusi query untuk menyimpan ke database
        $saved = $stmtR->execute();
        $stmtR->close();
    
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
          $_SESSION['message'] = 'sukses';
          header("Location: ../index_sales.php");
        }
    }
}
?>