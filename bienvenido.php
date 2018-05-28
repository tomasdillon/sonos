<?php
  require_once 'soporte.php';
  require_once 'includes/html-doc.php';
  require_once 'includes/nav-bar.php';

 if (!$auth->estaLogueado()){
     header('location:index.php');
   exit;
  }



  ?>

<body>
  <div class="container mt-5">
    <h1>Bienvenido <?=$usuario->getFirstName()?>!</h1>
    <img class="img-rounded" src="<?=$usuario->getPicture()?>" width="200">
    <br><br>
    <a class="btn btn-info" href="logout.php">CERRAR SESIÓN</a>
  </div>

<!-- <div class="container">
    <div class="row">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="..." alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
</div> -->





</body>

  <?php require_once("includes/footer.php") ?>
