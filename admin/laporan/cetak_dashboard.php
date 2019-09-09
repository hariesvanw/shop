<?php require_once("../core/koneksi.php"); ?>
<?php include('../dashboard_job.php') ?>
<?php include('../../about.php') ?>
<?php include('../../library.php') ?>

<?php 
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Statistik</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <style>
    @media print{
        .tombol {
            display: none;
        }
    }
    .borderless td, .borderless th {
        border: none;
    }
    </style>
</head>
<body>
    <div class="container-fluid">
      <div class="col-12 text-center my-3 tombol">
            <button
            id="print" 
            onclick="bukajendela('laporan/cetak_dashboard.php')"
            class="btn btn-secondary">
                CETAK
            </button>
      </div>
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
              <div class="col-12 text-center">Telp. <?php echo $telpon ?> </div>
            </div>
          </div>
          <div class="col-2">
            <img src="../../assets/img/logo2.png" height="110" alt="" class="gambar2">
          </div>
        </div>
      </div>
      <hr>
      <div class="col-12 mb-3">
        <div class="row">
          <div class="col-12 text-center">
            <h3>LAPORAN DATA STATISTIK</h3>
          </div>
        </div>
      </div>
      <div class="col-12 mb-4">
          <div class="row">
              <div class="col-12 mb-3">
                  <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    Produk
                                </div>
                                <div class="card-body">
                                    <?php echo $c_produks ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    Pelanggan
                                </div>
                                <div class="card-body">
                                    <?php echo $c_pelanggan ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    Sales
                                </div>
                                <div class="card-body">
                                    <?php echo $c_sales ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    Transaksi Lunas
                                </div>
                                <div class="card-body">
                                    <?php echo $c_lunas ?>
                                </div>
                            </div>
                        </div>
                  </div>
              </div>
              <div class="col-12 mb-3">
                <div class="card card-success">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Transaksi Berhasil <?php echo $thn ?>
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <!-- BAR CHART -->
                        <div class="chart">
                            <canvas id="barChart" style="height:230px"></canvas>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-star mr-1"></i>
                        Produk Terlaris
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="terlaris" style="width: 100%;">
                            <table class="table borderless">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ranking</th>
                                        <th>Nama Produk</th>
                                        <th class="text-right">Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; while($row = mysqli_fetch_assoc($terlaris)) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no; ?></td>
                                            <td><?php echo $row['nama_produk'] ?></td>
                                            <td class="text-right"><?php echo $row['tot'] ?></td>
                                        </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- /.card-body-->
                </div>
              </div>
          </div>
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
    <!-- Bootstrap 4 -->
    <script src="../lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lte/plugins/chart.js/Chart.min.js"></script>
    <script src="../lte/dist/js/adminlte.min.js"></script>
    <!-- <script>
    $(function () {
        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

        //--------------
        //- AREA CHART -
        //--------------

        var areaChartData = {
        labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul','Agt','Sep','Okt','Nov','Des'],
        datasets: [
            {
            label               : 'Transaksi Berhasil <?php echo $thn ?>',
            backgroundColor     : 'rgb(39, 166, 10,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [ <?php foreach($arr_transaksi as $solo){ echo $solo.','; } ?> ]
            },
        ]
        }

        var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
            gridLines : {
                display : false,
            }
            }],
            yAxes: [{
            gridLines : {
                display : false,
            }
            }]
        }
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
        }

        var barChart = new Chart(barChartCanvas, {
        type: 'bar', 
        data: barChartData,
        options: barChartOptions
        })

    })
    </script> -->
    <script>
        $(document).ready(function() {
            /* ChartJS
            * -------
            * Here we will create a few charts using ChartJS
            */

            //--------------
            //- AREA CHART -
            //--------------

            var areaChartData = {
            labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul','Agt','Sep','Okt','Nov','Des'],
            datasets: [
                {
                label               : 'Transaksi Berhasil <?php echo $thn ?>',
                backgroundColor     : 'rgb(39, 166, 10,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [ <?php foreach($arr_transaksi as $solo){ echo $solo.','; } ?> ]
                },
            ]
            }

            var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                gridLines : {
                    display : false,
                }
                }],
                yAxes: [{
                gridLines : {
                    display : false,
                }
                }]
            }
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
            }

            var barChart = new Chart(barChartCanvas, {
            type: 'bar', 
            data: barChartData,
            options: barChartOptions
            })

            $('#print').click(function(){
                window.print()
            })
        });
    </script>
</body>
</html>