<?php
session_start();
require_once("../core/koneksi.php");
$lisensi = null; 
if(isset($_POST['register_admin'])){
  $lisensi = $_POST['lisensi'];
  $cek_lisensi = $conn->query("SELECT * FROM kunci WHERE lisensi = '$lisensi'");
  $row = mysqli_num_rows($cek_lisensi);
  if($row > 0){
    $username = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $row = $conn->query("SELECT * FROM admin WHERE username = '$username'");

    $arr_err = [];
    $uok = false;
    if(mysqli_num_rows($row)){
      array_push($arr_err, 'Username telah digunakan !');
      $_SESSION['message'] = 'gagal';
      $_SESSION['errors'] = $arr_err;
      header("Location: ../register_admin.php");
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
        header("Location: ../register_admin.php");
        $pok = false;
    }else{
        $pok = true;
    }

    if($uok && $pok){
        // menyiapkan query
        $sql = "INSERT INTO admin (username,password) 
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
          header("Location: ../login_admin.php");
        }
    }
  }else{
    echo "not work";
  }
}else{
  echo 'wow';
}
?>