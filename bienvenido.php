<?php
require_once 'funciones.php';
require_once 'includes/html-doc.php';

if (!estaLogueado()){
  header('location: index.php');
  exit;
}

$usuario = traerPorID($_SESSION['id']);
?>

<body>
  <div class="container">
    <h1>Hola <?=$usuario['name']?></h1>
    <img class="img-rounded" src="<?=$usuario['avatar']?>" width="200">
    <br><br>
    <a class="btn btn-info" href="logout.php">CERRAR SESIÓN</a>
  </div>
</body>
