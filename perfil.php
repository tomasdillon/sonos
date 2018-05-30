<?php
require_once 'soporte.php';
require_once 'includes/html-doc.php';
require_once 'includes/nav-bar.php';


if ($auth->estaLogueado()){
  $usuario = $db->traerPorID($_SESSION['id']);
}

$cambio=[];

if (isset($_POST['perfil'])) {

  $name = trim($_POST['name']);
  $last_name = trim($_POST['last_name']);
  $email = trim($_POST['email']);

  $cambio = $validator->cambiodePerfil($db, 'avatar');

  if (empty($cambio)){
     $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
     $picture = 'avatarUsuarios/' . $usuario->getId() . '.' . $ext;

      // $usuario = new User($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['pass']);
      // $test01 = $db->guardarUsuario($usuario, $db);
    

  }

}



?>
<body>

  <div class="container margin-nav">

    <div class="row justify-content-center">

      <div>
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
              </div>
            </div>

            <div class="col-sm-4 d-inline">
              <div class="form-group">
                <label class="control-label">Apellido: <?=$usuario->getLastName()?></label>
                <input type="text" class="form-control" name="last_name" value="" placeholder="Apellido">
              </div>
            </div>

          </div>

          <div class="row justify-content-center">

            <div class="col-sm-4">
              <div class="form-group d-inline">
                <label class="control-label">Email: <?=$usuario->getEmail()?></label>
                <input class="form-control" type="text" name="email" value="" placeholder="Email">
                <label>
                  <?php if (isset($cambio['email'])): ?>
                    <span class="errores"><?=$cambio['email'];?></span>
                  <?php endif; ?>
                </label>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group d-inline">
                <label for="name" class="control-label">Cambiar imagen:</label>
                <input class="form-control" type="file" name="avatar" value="<?= isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : null ?>">
                <label>
                  <?php if (isset($cambio['avatar'])): ?>
                    <span class="errores"><?=$cambio['avatar'];?></span>
                  <?php endif; ?>
                </label>
              </div>
            </div>

          </div>

          <div class="row justify-content-center">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Cambiar contraseña:</label>
                <input class="form-control" type="password" name="pass" value="">
                <label>
                  <?php if (isset($cambio['pass'])): ?>
                    <span class="errores"><?=$cambio['pass'];?></span>
                  <?php endif; ?>
                </label>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Confirmar cambios:</label>
                <input class="form-control" type="password" name="confirmar" placeholder="Contraseña">
                <label>
                  <?php if (isset($cambio['confirmar'])): ?>
                    <span class="errores"><?=$cambio['confirmar'];?></span>
                  <?php endif; ?>
                </label>
              </div>
            </div>

          </div>

            <button class="btn" type="submit" name="perfil">Cambiar</button>

        </form>
      </div>

    </div>
  </div>
</body>
<?php require_once("includes/footer.php") ?>
