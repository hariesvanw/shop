<?php 
session_start();
require_once("core/koneksi.php");

$msg = null;
if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../assets/css/sign.css">
  </head>
  <body class="text-center">
    <form action="admin_job/doLogin_admin.php" method="post" class="form-signin">
        <?php 
            if($msg === 'sukses'){
        ?>
            <div class="alert alert-success" role="alert">
                Pendaftaran berhasil !
            </div>
        <?php } else if($msg === 'hantu') { ?>
            <div class="alert alert-danger" role="alert">
                Username tidak terdaftar !
            </div>
        <?php } else if($msg === 'pass') { ?>
            <div class="alert alert-warning" role="alert">
                Username atau Password Salah !
            </div>
        <?php } ?>
        <img class="mb-4" src="../assets/img/logo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">SILAHKAN LOGIN</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="username" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <input name="login_admin" value="Login" class="btn btn-lg btn-primary btn-block mb-2" type="submit">
        <a href="register_admin.php" class="mb-3">Belum punya akun ?</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</body>
</html>

<?php 
    unset($_SESSION["message"]);
    unset($_SESSION["errors"])
?>