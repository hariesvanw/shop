<?php 
require_once("../core/koneksi.php");
include('../../about.php');
include('../../library.php');

$today = date('Y-m-d');

$dari = null;
$sampai = null;
$show = false;
if(isset($_GET['kategori'])){
  $kat = $_GET['kategori'];
  $dari = $_GET['tgl_dari'];
  $sampai = $_GET['tgl_sampai'];
  $show = true;

  if($kat === 'semua'){
    $piutangs = $conn->query("SELECT u.id, u.status, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar , pp.nama_pelanggan, pp.no_telpon 
    FROM penjualan u 
    INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile 
    WHERE (status='wait' or status='utang') AND tanggal_penjualan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal_penjualan ASC");
  }else if($kat === 'utang'){
    $piutangs = $conn->query("SELECT u.id, u.status, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar , pp.nama_pelanggan, pp.no_telpon 
    FROM penjualan u 
    INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile 
    WHERE status='utang' AND tanggal_penjualan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal_penjualan ASC");
  }else if($kat === 'wait'){
    $piutangs = $conn->query("SELECT u.id, u.status, u.tanggal_penjualan, u.id_pelanggan_profile, u.utang, u.diskon, u.bukti_bayar , pp.nama_pelanggan, pp.no_telpon 
    FROM penjualan u 
    INNER JOIN pelanggan_profile pp on pp.id = u.id_pelanggan_profile 
    WHERE status='wait' AND tanggal_penjualan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal_penjualan ASC");
  }else {
    $piutangs = null;
  }

}else{
  echo "WOW";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Piutang</title>
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
            <h3>LAPORAN DAFTAR PIUTANG</h3>
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
          <th class="text-center">Tanggal Transaksi</th>
          <th class="text-center">Pelanggan</th>
          <th class="text-center">No Telp. Pelanggan</th>
          <th class="text-center">Status</th>
          <th class="text-center">Total Piutang</th>
        </tr>
        </thead>
        <tbody>
          <?php 
            $no = 1;
            $total_kes = 0;
            while($row = mysqli_fetch_assoc($piutangs)){
            $total_kes += $row['utang']-$row['diskon'];
            $arr['id_utang'] = $row['id'];
            $arr['tgl'] = $row['tanggal_penjualan'];
            $arr['pel'] = '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan']; 
          ?>
            <tr>
              <td class="text-center align-middle"><?php echo $no ?></td>
              <td class="text-center align-middle"><?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
              <td class="text-center align-middle"><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
              <td class="text-center align-middle"><?php echo '[CA'.str_pad($row['id_pelanggan_profile'],3,'0',STR_PAD_LEFT).'] '.$row['nama_pelanggan'];  ?></td>
              <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
              <td class="text-center align-middle"><?php echo $row['status'] === 'wait' ? 'Belum diverifikasi' : 'Belum Bayar' ?></td>
              <td class="text-center align-middle"><?php echo duit($row['utang']-$row['diskon']) ?></td>
            </tr>
          <?php $no++; }?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4">
              Total Daftar Piutang : <?php echo mysqli_num_rows($piutangs) ?>
            </td>
            <td colspan="2" class="text-right">Total Keseluruhan : </td>
            <td><?php echo duit($total_kes); ?></td>
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