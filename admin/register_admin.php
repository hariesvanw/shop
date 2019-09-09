<?php
session_start();
$msg = null;
$err = null;
if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
    $err = $_SESSION['errors'];
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
    <link rel="stylesheet" href="../assets/css/register.css">

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
    <link rel="stylesheet" href="assets/css/register.css">
  </head>
  <body class="text-center">
    <form action="admin_job/store_register_admin.php" method="post" class="form-register">
        <?php 
            if($msg === 'gagal'){
              if(count($err) > 0) { foreach($err as $e) {
        ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $e ?>
            </div>
        <?php } } }?>
        <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control mb-1" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control mb-1" placeholder="Password" required>
        <label for="konfirmasiPassword" class="sr-only">Password</label>
        <input name="konfirmasi" type="password" id="konfirmasiPassword" class="form-control mb-1" placeholder="Konfirmasi Password" required>
        <label for="kunci" class="sr-only">Lisensi</label>
        <input name="lisensi" type="text" id="kunci" class="form-control mb-1" placeholder="Masukkan Lisensi" required>
        <input name="register_admin" value="Daftar Sekarang" type="submit" class="btn btn-lg btn-primary btn-block mb-2">
        <a href="login_admin.php" class="mb-3">Login ?</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</body>
</html>

<?php 
    unset($_SESSION["message"]);
    unset($_SESSION["errors"])
?>