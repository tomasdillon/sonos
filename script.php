<?php
require_once 'soporte.php';

if (count($dbMYSQL->traerTodos())) {
  header('Location:index.php');
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-whidt, initial-scale=1">
  <meta charset="utf-8">
  <title>Sonos!</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="css/script.css">
  <link href="https://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC|Indie+Flower" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">


</head>
<body>
  <div class="container-fluid">
    <div class="d-flex">
      <div class="col-sm-2 col-md-3"></div>
      <div class="col-12 col-sm-8 col-md-6">
        <img src="image/logo-white.png" alt="">
      </div>
      <div class="col-sm-2 col-md-3"></div>
    </div>
  </div>
  <br><br><br>
  </div>
  <div class="container">
    <h3>Antes de entrar a Sonos, te pedimos que nos ayudes a crear la Base de Datos, la tabla de usuarios y a migrar los mismos de Json a MySQL.</h3>

  </div>
  <div class="container">
    <div class="row">
    <form method="post" class="form-inline">
      <div class="col-12 col-md-4">
        <button type="submit" name="createDB" class="boton">CREAR BASE DE DATOS</button>
      </div>
      <div class="col-12 col-md-4">
        <button type="submit" name="createTable">CREAR TABLA DE USUARIOS</button>
      </div>
      <div class="col-12 col-md-4">
        <button type="submit" name="migrateUsers">MIGRAR USUARIOS A MYSQL</button>
      </div>
    </form>
  </div>
  </div>
  <br>  <br>

  <!--  Seccion de mensajes -->
  <section class="container">
    <!--  Mensajes al crear DB  -->
    <?php
    if (isset($_POST['createDB'])) {
      if (!$dbMYSQL->getStatusDB()) {
        $newDB = $dbMYSQL->createDB(); ?>
        <div class="alert alert-success">
          <strong>Felicitaciones!</strong> Base de datos 'sonos_db' creada exitosamente.
        </div><?php
      } else { ?>
        <div class="alert alert-warning">
          <strong>Error!</strong> La base de datos que esta tratando de crear ya existe.
        </div> <?php
        $data1 = true;
      }
    } ?>
    <!--  Mensajes al crear tabla users -->
    <?php
    if (isset($_POST['createTable'])) {
      if (!$dbMYSQL->getStatusDB()) {?>
        <div class="alert alert-warning">
          <strong>Error!</strong> No existe base de datos donde crear la tabla.
        </div><?php
      } elseif ($dbMYSQL->checkTable('users')) { ?>
        <div class="alert alert-warning">
          <strong>Error!</strong> La tabla USERS ya existe en nuestra base de datos.
        </div> <?php
      } else {
        $dbMYSQL->createTable(); ?>
        <div class="alert alert-success">
        <strong>Felicitaciones!</strong> Tabla 'users' creada exitosamente.
        </div> <?php
      }
    } ?>
    <!-- Mensajes en migracion de usuarios -->
    <?php
    if (isset($_POST['migrateUsers'])) {
      if (!$dbMYSQL->getStatusDB()) {?>
      <div class="alert alert-warning">
        <strong>Error!</strong> No existe base de datos donde crear la tabla.
      </div>

      <?php
    } elseif (!$dbMYSQL->checkTable('users')) { ?>
      <div class="alert alert-warning">
        <strong>Error!</strong> No existe tabla a donde migrar los usuarios.
      </div> <?php
    }
     else {
        $migration = $dbMYSQL->migrateUsers();
        ?>
        <div class="alert alert-success">
          <strong>Felicitaciones!</strong> Usuarios migrados exitosamente de JSON a MYSQL. Sera redirigido a nuestro sitio web en 5 segundos.
        </div><?php
        header( "refresh:5;url=index.php" );
        exit;
      }
    }
    ?>
  </section>

</body>
</html>
