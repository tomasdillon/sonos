 <?php
 require_once("funciones.php");
 require_once("includes/html-doc.php");
 require_once("includes/nav-bar.php");

 if (estaLogueado()){
   header('location: bienvenido.php');
   exit;
 }

 $name = '';
 $email = '';
 $pais = '';

 $errores = [];

 if ($_POST) {
   $name = trim($_POST['name']);
   $apellido = trim($_POST['apellido']);
   $email = trim($_POST['email']);

   $errores = validacionDatos($_POST, 'avatar');

   if (empty($errores)){
     $errores = guardarImagen('avatar');
     if (empty($errores)){
       $usuario = guardarUsuario($_POST,'avatar');
       // loguear($usuario);
     }
   }
 }

 ?>

<body>
<!-- Registro & portada -->
<section class="portada-inicial justify-content-center">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 mt-3">
        <img src="image/logo.png" alt="logo" class="mt-5" style="width: 100%; max-width: 405px;">
        <em class="titulos d-none d-sm-block text-dark mb-5">La música nos une</em>
        <div class="row justify-content-center">
          <!--<div class="col-8 col-md-6 col-lg-6"> -->
            <form class="mt-5" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-6">
                  <input class="form-control" type="text" placeholder="Nombre" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                  <?php if (isset($errores['name'])): ?>
                    <span class="errores"><?=$errores['name'];?></span>
                  <?php endif; ?>
                </div>
                <div class="col-6">
                  <input class="form-control" type="text" placeholder="Apellido" name="apellido" value="<?= isset($_POST['apellido']) ? $_POST['apellido'] : '' ?>">
                  <?php if (isset($errores['apellido'])): ?>
                    <span class="errores"><?=$errores['apellido'];?></span>
                  <?php endif; ?>
                </div>
                <br><br>
              </div>

              <div class="form-group">
                <input class="form-control" type="email" placeholder="Ingresá tu e-mail" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <?php if (isset($errores['email'])): ?>
                  <span class="errores"><?=$errores['email'];?></span>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <input class="form-control" type="password" placeholder="Creá tu contraseña" name="pass">
                <?php if (isset($errores['pass'])): ?>
                  <span class="errores"><?=$errores['pass'];?></span>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label class="subiTuFoto">Subí tu foto</label>
                <input class="form-control" type="file" name="avatar" value="<?=isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : null ?>">
                <?php if (isset($errores['avatar'])): ?>
                  <span class="errores"> <?=$errores['avatar'];?>
                  </span>
                <?php endif; ?>
              </div>


              <div class="form-group">
                <!-- <div class="col-6"> -->
                  <button class="btn btn-success my-5" type="submit" name="button">Registrarme</button>
                </div>
                <!-- <div class="col-6">
                  <button class="btn btn-info my-5" type="" name="button">Iniciar Sesion</button>
                </div> -->

              </div>

            </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!--  Quienes Somos -->
<section class="container-fluid border fondoNeutro justify-content-center align-items-center" id="QuienesSomos">
  <h1 class="my-5 text-center display-3">Quienes somos</h1>
    <div class="col text-center border py-3 mb-5">
      <p>En <em>Sonos!</em> buscamos reunir personas con la misma pasión por la música. <br>
        Queremos que te encuentres con tus amigos, que hagas nuevos amigos y que puedas organizar tu próximo encuentro. <br>
        Qué mejor que disfrutar del próximo recital de tu banda favorita con ellos! <br> <br>
        Para hacerlo posible, nosotros te damos las herramientas: <br>
        Podrás consultar nuestro Calendario con la información de los próximos eventos en tu ciudad. <br>
        Podrás seguir a artistas y a otros usuarios. <br>
        Recibirás notificaciones por email de los shows programados y alertas cuando salen las entradas a la venta, así no te perdés de nada. <br><br>
        Lo mejor de esto, es que es 100% gratis. <br><br>
        Que esperas! <a href="#">Registrate</a> y deciles a tus amig@s!<br><br>
        La música nos une.
        Somos, <em>Sonos!</em>
      </p>
      <a href="faq.php" class="btn btn-success mt-3">¿Aún tenés dudas?</a>
    </div>
</section>

<?php require_once("includes/footer.php") ?>
