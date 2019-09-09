<?php 
require_once("../core/koneksi.php");
include('../../about.php');
include('../../library.php');

$today = date('Y-m-d');

$id_fak = $_GET['id_fak'];
$kui = $conn->query("SELECT b.*, p.*, pp.nama_pelanggan, s.nama_sales FROM pembayaran b 
                     LEFT JOIN penjualan p on b.id_penjualan = p.id
                     LEFT JOIN pelanggan_profile pp on p.id_pelanggan_profile = pp.id
                     LEFT JOIN sales s on b.id_sales = s.id
                     WHERE id_penjualan = '$id_fak'");
$row = mysqli_fetch_assoc($kui);

$record = $conn->query("SELECT pr.*,p.nama_produk,p.harga_produk FROM produk_record pr
                        INNER JOIN produk p on pr.id_produk = p.id
                        WHERE id_penjualan='$id_fak'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Piutang</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <style>
    .borderless td, .borderless th {
        border: none;
    }
    @page {
        size: A5 landscape;
        margin: 0;
    }
    </style>
</head>
<body>
    <div class="container-fluid">
      <div class="col-12" style="border-bottom: 1px solid gray">
        <div class="row">
          <div class="col-2">
            <img src="../../assets/img/logo1.png" height="80" alt="" class="gambar1">
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
            <img src="../../assets/img/logo2.png" height="80" alt="" class="gambar2">
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-12 text-center">
            <h5>KUITANSI <?php echo 'BY'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></h5>
          </div>
        </div>
      </div>
      <div class="col-12 mb-1">
        <div class="row justify-content-between">
            <div class="col-6">
                <table class="table table-sm borderless">
                  <tr>
                    <td>NO FAKTUR</td>
                    <td>:</td>
                    <td><?php echo 'FK'.str_pad($row['id'],4,'0',STR_PAD_LEFT); ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Penjualan</td>
                    <td>:</td>
                    <td><?php echo tgl_indo($row['tanggal_penjualan']) ?></td>
                  </tr>
                  <tr>
                    <td>Jatuh Tempo</td>
                    <td>:</td>
                    <td><?php echo tgl_indo($row['jatuh_tempo']) ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-6">
                <table class="table table-sm borderless">
                  <tr>
                    <td>Nama pelanggan</td>
                    <td>:</td>
                    <td><?php echo $row['nama_pelanggan'] ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-12">
                <h5 class="card-text pl-1">Detail Barang</h5>
              </div>
              <div class="col-12">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Jumlah Beli</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $no = 1;
                  $total = 0;
                  while($pr = mysqli_fetch_assoc($record)) { ?>
                    <tr>
                      <td class="text-center"><?php echo $no ?></td>
                      <td><?php echo $pr['nama_produk'] ?></td>
                      <td><?php echo $pr['harga_produk'] ?></td>
                      <td><?php echo $pr['jumlah'] ?></td>
                      <td><?php echo duit($pr['harga_produk']*$pr['jumlah']) ?></td>
                    </tr>
                  <?php $no++; $total+=$pr['harga_produk']*$pr['jumlah']; } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" class="text-right">Total :</td>
                      <td class="font-weight-bold"><?php echo duit($total) ?></td>
                    </tr>
                    <tr>
                      <td colspan="4" class="text-right">Diskon :</td>
                      <td class="font-weight-bold"><?php echo duit($row['diskon']) ?></td>
                    </tr>
                    <tr>
                      <td colspan="4" class="text-right">Bayar :</td>
                      <td class="font-weight-bold"><?php echo duit($row['dibayar']) ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
      <div class="col-12">
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-12 pl-5 mb-4"></div>
                            <div class="col-12 pl-5 mb-0 font-weight-bold">PELANGGAN</div>
                            <div class="col-12 pl-5 mt-5 font-weight-bold"><?php echo $row['nama_pelanggan'] ?></div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-12 pl-5 mb-1">Banjarbaru, <?php echo tgl_indo($today) ?></div>
                            <div class="col-12 pl-5 mb-0 font-weight-bold">SALES</div>
                            <div class="col-12 pl-5 mt-5 font-weight-bold"><?php echo $row['nama_sales'] ?></div>
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