<?php 
require_once("core/koneksi.php");

if(isset($_POST['login'])){

    $sql = "SELECT * FROM pelanggan WHERE username= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);

    $username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $stmt->execute();

    $result = $stmt->get_result();
    $pel = $result->fetch_assoc();

    // jika user terdaftar
    if($pel){
        // verifikasi password
        if(password_verify($password, $pel["password"])){
            // buat Session
            session_start();
            $_SESSION["pel"] = $pel;
            // login sukses, alihkan ke halaman timeline
            header("Location: ../main.php");
        }else{
            session_start();
            $_SESSION["message"] = 'pass';
            // login sukses, alihkan ke halaman timeline
            header("Location: ../login.php");
        }
    }else{
        session_start();
        $_SESSION["message"] = 'hantu';
        // login sukses, alihkan ke halaman timeline
        header("Location: ../login.php");
    }
}
?>