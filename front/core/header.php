<?php
    require_once("front/auth.php");
    include('library.php');
    include('about.php');
    function active($currect_page){
        $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
        $url = end($url_array);  
        if($currect_page == $url){
            echo 'active'; //class name in css 
        } 
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title><?php echo $alias ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.min.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/public.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700&display=swap" rel="stylesheet">

    <script src="assets/js/holder.js"></script>
    
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
  </head>

  <body>

  <header>
    <nav class="navbar navbar-expand-md navbar-light bg-faded">
        <a href="/" class="navbar-brand"><?php echo $alias ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar5">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar5">
            <ul class="navbar-nav">
                <li class="nav-item mr-2 <?php active('main.php');?>">
                    <a class="btn btn-primary" href="main.php">
                        <i class="fas fa-box mr-1"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary" href="riwayat_transaksi.php">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if($isNotLunas) { ?>
                            <span class="badge badge-warning" style="color:white;">!</span>
                        <?php } else { ?>
                            Transaksi
                        <?php } ?>
                    </a>
                </li>
            </ul>
            <form action="main.php" method="get" class="mx-2 d-inline w-100">
                <div class="input-group">
                    <input name="cari" type="text" class="form-control border border-right-0" placeholder="Search...">
                    <span class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary border border-left-0">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <?php if($pel) { ?>
                            <a class="dropdown-item" href="/profile.php"><?php echo $pel['username'] ?></a>
                            <a class="dropdown-item" href="front/logout.php">Log out</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="/login.php">Login</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
  </header>