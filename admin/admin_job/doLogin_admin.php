<?php 
require_once("../core/koneksi.php");

if(isset($_POST['login_admin'])){

    $sql = "SELECT * FROM admin WHERE username= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);

    $username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $stmt->execute();

    $result = $stmt->get_result();
    $cek_min = mysqli_num_rows($result);

    $sqlB = "SELECT * FROM sales WHERE email= ?";
    $stmtB = $conn->prepare($sqlB);
    $stmtB->bind_param('s', $usernameB);

    $usernameB = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
    $passwordB = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $stmtB->execute();

    $resultB = $stmtB->get_result();
    $cek_sales = mysqli_num_rows($resultB);

    // jika user terdaftar
    if($cek_min > 0){
        $min = $result->fetch_assoc();
        // verifikasi password
        if(password_verify($password, $min["password"])){
            // buat Session
            session_start();
            $_SESSION["min"] = $min;
            // login sukses, alihkan ke halaman timeline
            header("Location: ../index.php");
        }else{
            session_start();
            $_SESSION["message"] = 'pass';
            // login sukses, alihkan ke halaman timeline
            header("Location: ../login_admin.php");
        }
    }else if($cek_sales > 0){
        $sales = $resultB->fetch_assoc();
        if(password_verify($password, $sales["password"])){
            // buat Session
            session_start();
            $_SESSION["sales"] = $sales;
            // login sukses, alihkan ke halaman timeline
            header("Location: ../index.php");
        }else{
            session_start();
            $_SESSION["message"] = 'pass';
            // login sukses, alihkan ke halaman timeline
            header("Location: ../login_admin.php");
        }
    }else{
        session_start();
        $_SESSION["message"] = 'hantu';
        // login sukses, alihkan ke halaman timeline
        header("Location: ../login_admin.php");
    }
}
?>