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
  $datas = $conn->query("SELECT * FROM pelanggan_profile WHERE created_at BETWEEN '$dari' AND '$sampai' ORDER BY created_at ASC");
  $show = true;
}else{
  $datas = $conn->query("SELECT * FROM pelanggan");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Pelanggan</title>
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
            <h3>LAPORAN DAFTAR PELANGGAN</h3>
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
          <th class="text-center">ID Pelanggan</th>
          <th class="text-center">Nama Pelanggan</th>
          <th class="text-center">No Telpon</th>
          <th class="text-center">Alamat</th>
        </tr>
        </thead>
        <tbody>
          <?php 
            $no = 1;
            while($row = mysqli_fetch_assoc($datas)){ 
          ?>
            <tr>
              <td class="text-center align-middle"><?php echo $no ?></td>
              <td class="text-center align-middle"><?php echo 'CA'.str_pad($row['id_pelanggan'],3,'0',STR_PAD_LEFT); ?></td>
              <td class="text-center align-middle"><?php echo $row['nama_pelanggan'] ?></td>
              <td class="text-center align-middle"><?php echo $row['no_telpon'] ?></td>
              <td class="text-center align-middle"><?php echo $row['alamat'] ?></td>
            </tr>
          <?php $no++; }?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="8">
              Total Pelanggan : <?php echo mysqli_num_rows($datas) ?>
            </td>
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