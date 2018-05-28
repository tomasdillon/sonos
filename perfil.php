<?php
require_once 'soporte.php';
require_once 'includes/html-doc.php';
require_once 'includes/nav-bar.php';


if ($auth->estaLogueado()){
  $usuario = $db->traerPorID($_SESSION['id']);
}

 ?>
<body>

  <div class="container margin-nav">

    <div class="row justify-content-center">

    <div class="d-block">
        <img src="<?=$usuario->getPicture()?>" alt="avatar" class="rounded-circle" width="200" height="200">

      <br><br>

      <strong><?=$usuario->getFirstName() . ' ' . $usuario->getLastName() ?></strong>


      </div>
    </div>

    <hr>

  <div class="row d-block">
    <div class="data-form">
      <form  method="post" enctype="multipart/form-data">

          <div class="row justify-content-center">

            <div class="col-sm-4 d-inline">
              <div class="form-group">
                <label class="control-label">Nombre: <?=$usuario->getFirstName()?> </label>
                <input type="text" class="form-control" name="name" value="" placeholder="Nombre">
                <span class="help-block" style="<?= !isset($errores['name']) ? 'display: none;' : ''; ?>">
                  <b class="glyphicon glyphicon-exclamation-sign"></b>
                  <?= isset($errores['name']) ? $errores['name'] : ''; ?>
                </span>
              </div>
            </div>

            <div class="col-sm-4 d-inline">
              <div class="form-group">
                <label class="control-label">Apellido: <?=$usuario->getLastName()?></label>
                <input type="text" class="form-control" name="last_name" value="" placeholder="Apellido">
                <span class="help-block" style="<?= !isset($errores['last_name']) ? 'display: none;' : ''; ?>">
                  <b class="glyphicon glyphicon-exclamation-sign"></b>
                  <?= isset($errores['last_name']) ? $errores['last_name'] : ''; ?>
                </span>
              </div>
            </div>

          </div>

          <div class="row justify-content-center">

            <div class="col-sm-4">
              <div class="form-group d-inline">
                <label class="control-label">Email: <?=$usuario->getEmail()?></label>
                <input class="form-control" type="text" name="email" value="" placeholder="Email">
                <span class="help-block" style="<?= !isset($errores['email']) ? 'display: none;' : ''; ?>">
                  <b class="glyphicon glyphicon-exclamation-sign"></b>
                  <?= isset($errores['email']) ? $errores['email'] : ''; ?>
                </span>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group d-inline">
                <label for="name" class="control-label">Cambiar imagen:</label>
                <input class="form-control" type="file" name="avatar" value="<?= isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : null ?>">
                <span class="help-block" style="<?= !isset($errores['avatar']) ? 'display: none;' : '' ; ?>">
                  <b class="glyphicon glyphicon-exclamation-sign"></b>
                  <?= isset($errores['avatar']) ? $errores['avatar'] : '' ;?>
                </span>
              </div>
            </div>

          </div>

          <div class="row justify-content-center">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Contraseña:</label>
                <input class="form-control" type="password" name="pass" value="">
                <span class="help-block" style="<?= !isset($errores['pass']) ? 'display: none;' : ''; ?>">
                  <b class="glyphicon glyphicon-exclamation-sign"></b>
                  <?= isset($errores['pass']) ? $errores['pass'] : ''; ?>
                </span>
              </div>
            </div>

            <div class="col-sm-4 mt-4 ml-2">
              <div class="form-group">
                <button class="btn" type="submit">Guardar</button>
              </div>
            </div>
          </div>


        </form>
      </div>

    </div>
  </div>
</body>
<?php require_once("includes/footer.php") ?>
