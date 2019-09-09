<?php 
require_once("../core/koneksi.php");
include('../../about.php');
include('../../library.php');

$today = date("Y-m-d");

$kat = null;
$dari = $_GET['tgl_dari'];
$sampai = $_GET['tgl_sampai'];
if(isset($_GET['tgl_dari'])){
  $pemasukan = $conn->query("SELECT tanggal_verifikasi, sum(dibayar) as bays FROM pembayaran WHERE tanggal_verifikasi BETWEEN '$dari' AND '$sampai' GROUP BY tanggal_verifikasi");
}else{
  $pemasukan = $conn->query("SELECT tanggal_verifikasi, sum(dibayar) as bays FROM pembayaran GROUP BY tanggal_verifikasi");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Dafta Pemasukan</title>
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
            <h3>LAPORAN DAFTAR PEMASUKAN</h3>
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
            <th class="text-center">Tanggal Verifikasi</th>
            <th class="text-center">Pemasukan</th>
        </tr>
        </thead>
        <tbody>
        <?php 
          $no = 1;
          $total = 0;
          while($row = mysqli_fetch_assoc($pemasukan)){ 
        ?>
          <tr>
            <td class="align-middle text-center"><?php echo $no ?></td>
            <td class="align-middle text-center"><?php echo tgl_indo($row['tanggal_verifikasi']) ?></td>
            <td class="align-middle text-center"><?php echo duit($row['bays']) ?></td>
          </tr>
        <?php $no++;  $total += $row['bays']; }  ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" class="align-middle text-right">
              Total :
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