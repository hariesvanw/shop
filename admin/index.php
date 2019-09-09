<?php include('core/header.php') ?>
<?php include('core/sidebar.php') ?>
<?php include('dashboard_job.php') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark mr-1">Dashboard
                <button 
                onclick="bukajendela('laporan/cetak_dashboard.php')"
                class="btn btn-secondary">
                    <i class="fas fa-print"></i>
                </button>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $c_produks ?></h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="fas fa-box"></i>
              </div>
              <a href="index_produk.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $c_pelanggan ?></h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="index_pelanggan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $c_sales ?></h3>

                <p>Sales</p>
              </div>
              <div class="icon">
                <i class="fas fa-users-cog"></i>
              </div>
              <a href="index_sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $c_lunas ?></h3>

                <p>Transaksi Lunas</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="index_pembayaran.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
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
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
    
            <section class="col-lg-5 connectedSortable">
            <!-- Map card -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-star mr-1"></i>
                  Produk Terlaris
                </h3>
              </div>
              <div class="card-body">
                <div id="terlaris" style="width: 100%;">
                    <table class="table table-striped">
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
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include('core/footer.php') ?>