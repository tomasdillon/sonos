<!--  Llamado a doc-html -->
<?php require_once("includes/html-doc.php") ?>
  <body>
      <!--  Traigo nav-bar desde includes -->
        <?php require_once("includes/nav-bar.php") ?>
    <!--  Ver clases en css/styles.css -->
    <section class="faq-body container-fluid">
      <div class="row faq-mobile">
        <div class="col-1 hidden-sm-down"> <!-- Columna vacia -->
        </div>
        <!--  Indices para buscar rapidamente -->
        <div class="col-md-4 faq-indice hidden-sm-down">
          <ul>
            <li><a href="#Sonos">Sonos!</a></li>
            <li><a href="#Seguir">Seguir</a></li>
            <li><a href="#Calendario">Calendario</a></li>
            <li><a href="#MP">Mensajes directos</a></li>
          </ul>
        </div>
        <!--  Contenido de preguntas y respuestas -->
        <div class="col-12 col-md-6 faq-content">
          <ul>
            <h2 id="Sonos">Sonos!</h2><br>
            <ul>
              <li>
                <h4>¿Qué es Sonos!?</h4>
                <p>Somos una comunidad para amantes de los recitales. Queremos que te encuentres con tus amigos, que hagas nuevos amigos y que puedas organizar tu próximo encuentro. Qué mejor que disfrutar del próximo recital de tu banda favorita con ellos! </p>
              </li><br>
              <li>
                <h4>¿Qué necesito para usar Sonos! ?</h4>
                <p>Para usar Sonos! solamente tedrás que registrarte dejando unos pocos datos (<a href="index.php">click aqui</a>). Una vez completados los datos, ya puedes empezar a utilizar tu cuenta.</p>
              </li><br>
              <li>
                <h4>¿Es posible usar Sonos! sin registrarme?</h4>
                <p>Podras utilizar Sonos! sin estar registrado, pero te estarás perdiendo de disfrutar todas las herramientas que disponemos para los miembros de nuestra comunidad.</p>
              </li><br>
            </ul> <br><br>
            <h2 id="Seguir">Seguir</h2><br>
            <ul>
              <li>
                <h4>¿Para qué sirve el botón seguir?</h4>
                <p>Significa que te suscribiste a una persona/banda/género. Cuando alguien publica un mensaje, o genera alguna actividad, te llegará una notificación si así lo deseas.</p>
              </li> <br>
              <li>
                <h4>¿A quién puedo seguir?</h4>
                <p>Podrás seguir a cualquier persona o banda que tenga habilitada la opción de cuenta pública.</p>
              </li><br>
              <li>
                <h4>¿Cómo se a quien estoy siguiendo?</h4>
                <p>Apenas haces click en el botón 'Seguir' inmediatamente estas siguiendo a esa cuenta. Para ver la lista de personas de a quienes sigues, debes entrar a tu perfil y hacer click en la opción 'Siguiendo'.</p>
              </li><br>
            </ul> <br><br>
            <h2 id="Calendario">Calendario</h2><br>
            <ul>
              <li>
                <h4>¿Qué es el calendario?</h4>
                <p>El calendario contendrá todas las fechas de recitales cercanos a realizarse.</p>
              </li><br>
              <li>
                <h4>¿Todos pueden ver mi calendario?</h4>
                <p>Tienes distintas opciones. El calendario lo verás solo tú, esto viene de forma predeterminada, pero puedes cambiarlo haciendo click en el botón que se situa arriba a la derecha del calendario.</p>
              </li> <br><br>
            </ul>
            <h2 id="MP">Mensajes directos</h2><br>
            <ul>
              <li>
                <h4>¿Qué son los mensajes directos?</h4>
                <p>Son mensajes privados enviados desde una cuenta de Sonos! hacia otra. Estos mensajes son totalmente privados, por lo que solo los veran el emisor y receptor del mismo.</p>
              </li><br>
              <li>
                <h4>¿A quien puedo enviar un mensaje directo?</h4>
                <p>Los mensajes directos pueden ser enviados solamente a personas que estas siguiendo.</p>
              </li><br>
            </ul>
          </ul>
        </div>
      </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
    <!--  Llamada al footer.php -->
    <?php require_once("./includes/footer.php") ?>
