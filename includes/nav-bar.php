<?php
  require_once 'soporte.php';
  require_once 'includes/html-doc.php';

  if ($auth->estaLogueado()){
    header('location: bienvenido.php');
    exit;
  }


  $email = '';

  $validacion = [];

  if (isset($_POST['login'])){

    $email = trim($_POST['email']);

    $validacion = $validator->validacionLogeo($db);

    // var_dump($validacion);exit;

    if (empty($validacion)){
      $usuario = $db->existeEmail($email);

      $auth->loguear($usuario->getId());

      if(isset($_POST['recordar'])){
        setcookie('id', $usuario->getId(), time() + 3600);

      }
      header('location: bienvenido.php');
      exit;
    }

  }

 ?>


<header class="header-main fixed-top"> <!-- fixed-top -->
  <div class="header-sup ">

<div class="row justify-content-between">
     <div class="align-items-start col-1 col-lg-6">

        <div class="col-6">

                <nav class="navbar navbar-expand-lg p-0">
                    <div class="collapse navbar-collapse">

                              <a href="index.php"><img src="image/logosm.png" alt="logosm" >  </a>

                              <ul class="navbar-nav mt-2">
                                <li class="nav-item active">
                                  <a class="nav-link decoracion-borde" href="index.php">Home</a>
                                </li>
                                <li class="nav-item active">
                                  <a class="nav-link decoracion-borde" href="faq.php">Acerca de Sonos!</a>
                                </li>
                                <li class="nav-item active">
                                  <a class="nav-link decoracion-borde" href="index.php#QuienesSomos">Quienes Somos</a>
                                </li>
                                <li class="nav-item active">
                                  <a class="nav-link" href="#">Calendario</a>
                                </li>
                              </ul>

                    </div>
                </nav>

        </div>


                <div class="nav-mobie">
                    <div id="mySidenav" class="sidenav">
                      <a href="index.php"><img src="image/logosm.png" alt="logosm"></a>
                      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                      <a class="nav-link" href="index.php">Home</a>
                      <a href="faq.php">Acerca de Sonos!</a>
                      <a href="index.php#QuienesSomos">Quienes Somos</a>
                      <a href="#">Grupos</a>
                      <a href="#">Calendario</a>
                      <a href="#">Ciudades</a>
                    </div>
                    <span class="ion-navicon-round"style="font-size:1.8em;cursor:pointer;line-height:55px;color:black " onclick="openNav()"></span>
                </div>




    </div>





<div class="col-10 col-lg-5 p-1">

  <form class="col-lg-12" method="post">
    <div class="form-inline ">
      <div class="col-10 col-sm-9 col-md-8 col-lg-8 p-0 ml-lg-auto">
        <div class="input-group mr-2 ">


          <?php if (isset($validacion['email'])): ?>
          <input type="text" name="email" class="form-control mr-2 col-7" id="inlineFormInputName2" placeholder="Email" value="<?=isset($_POST['email']) ? $_POST['email'] : '' ?>" data-toggle="tooltip" title="<?=$validacion['email'];?>">
            <!-- <span class="errores2">?></span> -->
          <?php else:     ?>
           <input type="text" name="email" class="form-control mr-2 col-7" id="inlineFormInputName2" placeholder="Email" value="<?=isset($_POST['email']) ? $_POST['email'] : '' ?>">
          <?php endif; ?>


          <?php if (isset($validacion['pass'])): ?>
          <input type="password" name="pass" class="form-control col-5" id="inlineFormInputName2" placeholder="Email" value="<?=isset($_POST['pass']) ? $_POST['pass'] : '' ?>" data-toggle="tooltip" title="<?=$validacion['pass'];?>">
            <!-- <span class="errores2">?></span> -->
          <?php else:     ?>
           <input type="password" name="pass" class="form-control col-5" id="inlineFormInputName2" placeholder="Email" value="<?=isset($_POST['pass']) ? $_POST['pass'] : '' ?>">
          <?php endif; ?>


        </div>
      </div>

      <button type="submit" class="btn btn-success btn-sm ml-1 pl-2 pr-2 hidden-xs" style="font-size: 0.6em;font-weight:bold;" name="login"> <span class="ion-log-in"></span> Ingresar </button>
      <button type="submit" class="btn btn-success btn-sm button-small ml-2 p-0 px-2"style="font-size: 0.7em;font-weight:bold;"> <span class="ion-log-in"></span></button>

    </div>
    <div class="form-check ajusteleft">
      <label class="form-check-label" style="font-size: 0.7em; color:black;"><input class="form-check-input" type="checkbox" name="recordar">Recordarme</label>
      <a href="#" class="ml-1 ml-sm-5">¿Olvidaste tu contraseña?</a>
    </div>
  </form>

  </div>

      </div>
 </div>
</header>


<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "270px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}



$('[data-toggle="tooltip"]').tooltip('show');
</script>
