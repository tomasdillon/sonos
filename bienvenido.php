<?php
  require_once 'soporte.php';
  require_once 'includes/html-doc.php';
  // require_once 'nav-bar.php';

  if (!$auth->estaLogueado()){
    header('location:index.php');
    exit;
  }

  $usuario = $db->traerPorID($_SESSION['id']);

  ?>

<body>
  <div class="container">
    <h1>Bienvenido <?=$usuario->getFirstName()?>!</h1>
    <img class="img-rounded" src="<?=$usuario->getPicture()?>" width="200">
    <br><br>
    <a class="btn btn-info" href="logout.php">CERRAR SESIÓN</a>
  </div>
</body>
