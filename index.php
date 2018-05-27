<?php
require_once 'soporte.php';
require_once 'includes/nav-bar.php';
require_once 'includes/html-doc.php';

$name = '';
$last_name = '';
$email = '';

$errores = [];
if (isset($_POST['register'])) {

  $name = trim($_POST['name']);
  $last_name = trim($_POST['last_name']);
  $email = trim($_POST['email']);

  $errores = $validator->validateRegister($db, 'picture');
  if (empty($errores)){
    // $errores = $db->guardarImagen('picture', $email);
    if (empty($errores)){
      //No estaba guardando ninguna imagen con este codigo y tiraba error ya que $_FILES es una variable vacia al no estar mandando ninguna imagen, modifique en user.php el atributo PICTURE dentro del constructor.
      // $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
      // $picture = 'avatarUsuarios/' . $email . '.' . $ext;
      $usuario = new User($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['pass']);
      $test01 = $db->guardarUsuario($usuario, $db);
      $newUser = $db->traerPorEmail($email);
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      $auth->loguear($newUser->getId());
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
            <div class="col-8 col-md-6 col-lg-6">

              <form class="mt-5" method="post" enctype="multipart/form-data">

                <div class="form-inline">

                  <input class="form-control col-6 col-sm-5" type="text" placeholder="Nombre" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                  <input class="form-control col-6 col-sm-5 ml-sm-auto" type="text" placeholder="Apellido" name="last_name" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>">
                </div>

                <div class="form-inline d-inline">
                  <label>
                    <div class="mr-5 ">
                      <?php if (isset($errores['name'])): ?>
                        <span class="errores"><?=$errores['name'];?></span>
                      <?php endif; ?>
                    </div>

                    <div class="ml-5 " >
                      <?php if (isset($errores['last_name'])): ?>
                        <span class="errores"><?=$errores['last_name'];?></span>
                      <?php endif; ?>
                    </div>
                  </label>
                </div>
                <label></label>

                <input class="form-control" type="email" placeholder="Ingresá tu e-mail" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <label style="color:black;">
                  <?php if (isset($errores['email'])): ?>
                    <span class="errores"><?=$errores['email'];?></span>
                  <?php endif; ?>
                </label>

                <input class="form-control" type="password" placeholder="Creá tu contraseña" name="pass">
                <label style="color:black;">
                  <?php if (isset($errores['pass'])): ?>
                    <span class="errores"><?=$errores['pass'];?></span>
                  <?php endif; ?>
                </label>

                <div class="form-group">
                  <button class="btn btn-success my-5" type="submit" name="register">Registrarme</button>
                </div>

              </form>
            </div>
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

  <!-- boton top -->
  <button onclick="topFunction()" id="top-button" title="Go to top"> <span class="arrow-dropup-circle"></span> Top </button>


  <script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("top-button").style.display = "block";
    } else {
      document.getElementById("top-button").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
  </script>

  <?php require_once("includes/footer.php") ?>
