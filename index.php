<?php 
include('front/core/header.php');
?>
    <main role="main" class="bg-light">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide" src="assets/img/slide1.png" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="assets/img/slide2.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="assets/img/slide3.png" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="container marketing">
        <div class="row">
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                <i class="fas fa-map-marker-alt fa-4x"></i>
              </div>
              <div class="card-body">
                <p class="card-text"><?php echo $nama_cv ?></p>
                <p class="card-text"><?php echo $alamat ?></p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                <i class="fas fa-phone fa-4x"></i>
              </div>
              <div class="card-body">
                <h1 class="card-text"><?php echo $telpon ?></h1>
                <h2 class="card-text"><?php echo $email ?></h2>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                <i class="fas fa-smile fa-4x"></i>
              </div>
              <div class="card-body">
                <p class="card-text"><?php echo $moto ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php 
include('front/core/footer.php');
?>