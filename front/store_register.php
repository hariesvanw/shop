<?php
session_start();
require_once("core/koneksi.php"); 
if(isset($_POST['register'])){
    $username = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $row = $conn->query("SELECT * FROM pelanggan WHERE username = '$username'");

    $arr_err = [];
    $uok = false;
    if(mysqli_num_rows($row)){
      array_push($arr_err, 'Username telah digunakan !');
      $_SESSION['message'] = 'gagal';
      $_SESSION['errors'] = $arr_err;
      header("Location: ../register.php");
      $uok = false;
    }else{
      $uok = true;
    }

    $pass = $_POST["password"];
    $conf = $_POST["konfirmasi"];

    if($pass !== $conf){
        array_push($arr_err, 'Konfirmasi Password Tidak Cocok !');
        $_SESSION['message'] = 'gagal';
        $_SESSION['errors'] = $arr_err;
        header("Location: ../register.php");
        $pok = false;
    }else{
        $pok = true;
    }

    if($uok && $pok){
        // menyiapkan query
        $sql = "INSERT INTO pelanggan (username,password) 
                VALUES (?, ?)";
        $stmtR = $conn->prepare($sql);
    
        // bind parameter ke query
        $stmtR->bind_param("ss", $username, $pass);
    
        $username = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        // eksekusi query untuk menyimpan ke database
        $saved = $stmtR->execute();
        $stmtR->close();
    
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved){
          $_SESSION['message'] = 'sukses';
          header("Location: ../login.php");
        }
    }
}
?>