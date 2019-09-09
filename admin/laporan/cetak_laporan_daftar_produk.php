<?php 
require_once("../core/koneksi.php");
include('../../about.php');
include('../../library.php');

$today = date("Y-m-d");
$kat = null;
$kate = null;
if(isset($_GET['kategori'])){
  $kat = $_GET['kategori'];
  if($kat === 'semua'){
    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
    FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
    LEFT JOIN kategori k on kp.id_kategori = k.id
    GROUP BY p.id");
    $kate = "semua";
  }else{
    $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
    FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
    LEFT JOIN kategori k on kp.id_kategori = k.id AND k.id = '$kat'
    GROUP BY p.id");

    $r_kat = $conn->query("SELECT nama_kategori FROM kategori WHERE id='$kat'");
    $row = mysqli_fetch_assoc($r_kat);
    $kate = $row['nama_kategori'];
  }

}else{
  $produks = $conn->query("SELECT p.*, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats 
  FROM produk p LEFT JOIN kategori_produk kp on p.id = kp.id_produk 
  LEFT JOIN kategori k on kp.id_kategori = k.id
  GROUP BY p.id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Produk</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
      <div class="col-12">
        <div class="row">
          <div class="col-2">
            <img src="../../assets/img/logo1.png" height="110" alt="" class="gambar1">
          </div>
          <div class="col-8">
            <div class="row">
                <div class="col-12 text-center">
                    <h2><?php echo $nama_cv ?></h2>
                </div>
                <div class="col-12 text-center"><?php echo $alamat ?></div>
                <div class="col-12 text-center">Telp. <?php echo $telpon ?></div>
            </div>
          </div>
          <div class="col-2">
            <img src="../../assets/img/logo2.png" height="110" alt="" class="gambar2">
          </div>
        </div>
      </div>
      <hr>
      <div class="col-12">
        <div class="row">
          <div class="col-12 text-center">
            <h3>LAPORAN DAFTAR PRODUK</h3>
          </div>
          <div class="col-12 text-center">
            <h4>KATEGORI <span class="text-uppercase"><?php echo $kate ?></span></h4>
          </div>
        </div>
      </div>
      <div class="col-12 mb-5">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">ID Produk</th>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Harga Produk</th>
          <th class="text-center">Kategori</th>
          <th class="text-center">Stok</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            while($row = mysqli_fetch_assoc($produks)){ 
              if($row['kats']) {
          ?>
            <tr>
              <td class="align-middle text-center"><?php echo $no ?></td>
              <td class="align-middle text-center"><?php echo 'P'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
              <td class="align-middle text-center"><?php echo $row['nama_produk'] ?></td>
              <td class="align-middle text-center"><?php echo $row['harga_produk'] ?></td>
              <td class="align-middle text-center"><?php echo $row['kats'] ?></td>
              <td class="align-middle text-center"><?php echo $row['stok'] ?></td>
            </tr>
          <?php $no++; } }?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6">
              Total Produk : <?php echo mysqli_num_rows($produks) ?>
            </td>
          </tr>
        </tfoot>
      </table>
      </div>
      <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="row justify-content-end">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12 pl-5 mb-1">Banjarbaru, <?php echo tgl_indo($today) ?></div>
                                    <div class="col-12 pl-5 mb-0 font-weight-bold"><?php echo $tanda_tangan ?></div>
                                    <div class="col-12 pl-5 mt-5 font-weight-bold"><?php echo $nama_ttd ?></div>
                                    <div class="col-12 pl-5 font-weight-bold"><?php echo $no_peg ?> </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>  
      </div>
    </div>

    <script src="../../assets/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            window.load = window.print()
            window.onfocus = window.close()
        });
    </script>

</body>
</html>