<?php 
require_once("../core/koneksi.php");
include('../../about.php');
include('../../library.php');


$today = date('Y-m-d');

$dari = null;
$sampai = null;
$show = false;
if(isset($_GET['tgl_dari'])){
  $dari = $_GET['tgl_dari'];
  $sampai = $_GET['tgl_sampai'];
  $bayars = $conn->query("SELECT b.id, b.id_penjualan, b.id_sales, b.tanggal_verifikasi, b.dibayar,p.utang , p.diskon, s.nama_sales 
                          FROM pembayaran b 
                          LEFT JOIN penjualan p on b.id_penjualan = p.id 
                          LEFT JOIN sales s on b.id_sales = s.id 
                          WHERE tanggal_verifikasi BETWEEN '$dari' AND '$sampai' ORDER BY b.id");
  $show = true;
}else{
  $bayars = $conn->query("SELECT b.id, b.id_penjualan, b.id_sales, b.tanggal_verifikasi, b.dibayar,p.utang , p.diskon, s.nama_sales FROM pembayaran b LEFT JOIN penjualan p on b.id_penjualan = p.id LEFT JOIN sales s on b.id_sales = s.id ORDER BY b.id");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Pembayaran</title>
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
            <h3>LAPORAN DAFTAR PEMBAYARAN</h3>
          </div>
          <div class="col-12 text-center">
            <h4><?php echo tgl_indo($dari).' s/d '.tgl_indo($sampai) ?></h4>
          </div>
        </div>
      </div>
      <div class="col-12 mb-5">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">ID Transaksi</th>
          <th class="text-center">No Kuitansi</th>
          <th class="text-center">Tanggal Verifikasi</th>
          <th class="text-center">Sales</th>
          <th class="text-center">Dibayar</th>
        </tr>
        </thead>
        <tbody>
          <?php 
            $no = 1;
            $total_kes = 0;
            while($row = mysqli_fetch_assoc($bayars)){ 
            $total_kes += $row['dibayar'];
          ?>
            <tr>
              <td class="text-center align-middle"><?php echo $no ?></td>
              <td class="text-center align-middle"><?php echo 'FK'.str_pad($row['id_penjualan'],4,'0',STR_PAD_LEFT); ?></td>
              <td class="text-center align-middle"><?php echo 'BY'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
              <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_verifikasi']) ?></td>
              <td class="text-center align-middle"><?php echo '[S'.str_pad($row['id_sales'],3,'0',STR_PAD_LEFT).'] '.$row['nama_sales'];  ?></td>
              <td class="text-center align-middle"><?php echo duit($row['dibayar']) ?></td>
            </tr>
          <?php $no++; }?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">
              Total Transaksi : <?php echo mysqli_num_rows($bayars) ?>
            </td>
            <td colspan="2" class="text-right">
              Total Keseluruhan :
            </td>
            <td class="text-center"><?php echo duit($total_kes) ?></td>
          </tr>
        </tfoot>
      </table>
      </div>
      <div class="col-12">
        <table>
            <tbody>
                <tr>
                    <td colspan="8">
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