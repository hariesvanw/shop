<?php 
require_once("../core/koneksi.php");
include('../../about.php');
include('../../library.php');

$today = date("Y-m-d");

$kat = null;
if(isset($_GET['kategori'])){
  $kat = $_GET['kategori'];
  if($kat === 'semua'){
    $produks = $conn->query("SELECT p.id, p.nama_produk, p.harga_produk, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats, SUM(pr.jumlah) as tot
    FROM produk p 
    LEFT JOIN kategori_produk kp on p.id = kp.id_produk
    LEFT JOIN kategori k on k.id = kp.id_kategori
    LEFT JOIN produk_record pr
    on p.id = pr.id_produk
    GROUP BY p.id ORDER BY tot DESC");
  }else{
    $produks = $conn->query("SELECT p.id, p.nama_produk, p.harga_produk, group_concat(DISTINCT k.nama_kategori SEPARATOR ', ') as kats ,SUM(pr.jumlah) as tot
    FROM produk p 
    LEFT JOIN kategori_produk kp on p.id = kp.id_produk AND kp.id_kategori = '$kat'
    LEFT JOIN kategori k on k.id = kp.id_kategori
    LEFT JOIN produk_record pr on p.id = pr.id_produk
    GROUP BY p.id ORDER BY tot DESC");
  }
}else{
  $produks = $conn->query("SELECT p.id, p.nama_produk, p.harga_produk, SUM(pr.jumlah) as tot
                           FROM produk p 
                           LEFT JOIN produk_record pr
                           on p.id = pr.id_produk
                           GROUP BY p.id ORDER BY tot DESC");
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
            <h3>LAPORAN DAFTAR PRODUK TERJUAL</h3>
          </div>
          <div class="col-12 text-center">
            <h4>KATEGORI <span class="text-uppercase"><?php echo $kat ?></span></h4>
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
          <th class="text-center">Kategori</th>
          <th class="text-center">Harga Produk</th>
          <th class="text-center">Terjual</th>
          <th class="text-center">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php 
          $no = 1;
          $total = 0;
          while($row = mysqli_fetch_assoc($produks)){ 
            if($row['kats']) {
        ?>
          <tr>
            <td class="align-middle text-center"><?php echo $no ?></td>
            <td class="align-middle text-center"><?php echo 'P'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
            <td class="align-middle text-center"><?php echo $row['nama_produk'] ?></td>
            <td class="align-middle text-center"><?php echo $row['kats'] ?></td>
            <td class="align-middle text-center"><?php echo duit($row['harga_produk']) ?></td>
            <td class="align-middle text-center"><?php echo $row['tot'] > 0 ? $row['tot'] : '0' ?></td>
            <td class="align-middle text-center"><?php echo $row['tot'] > 0 ? duit($row['tot']*$row['harga_produk']) : '0' ?></td>
          </tr>
        <?php $no++;  $total += $row['tot']*$row['harga_produk']; } } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4">
              Jumlah Produk : <?php echo mysqli_num_rows($produks) ?>
            </td>
            <td colspan="2" class="align-middle text-right">
              Total Keseluruhan :
            </td>
            <td class="align-middle text-center">
              <?php echo duit($total) ?>
            </td>
          </tr>
        </tfoot>
      </table>
      </div>
      <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td colspan="7">
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