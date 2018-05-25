<?php
  require_once 'db.php';

  class dbJson extends DB{

    private $archive;

    public function __construct(){
      $this->archive = 'usuarios.json';
    }

    public function traerTodos(){

      //leo los usuarios de 'usuarios.json'
      $todosJson = file_get_contents($this->archive);

      //esto me arma un array con todos los usuarios
      $todosEnArray = explode(PHP_EOL, $todosJson);

      //saco el ultimo elemento que es una linea vacia
      array_pop($todosEnArray);

      //creo un array vacio, para guardar los usuarios
      $users = [];

      //recorremos el array y generamos por cada usuario un array del usuario y en la ult posicion vacia del array vacio $users va a generar un usario ($usuario) en formato array (true)
      foreach ($todosEnArray as $usuario) {

        $usuariosEnArray = json_decode($usuario, true);

        //decodificamos el array y hago un objeto de tipo user, convertimos a los usuarios en un objeto

        $usuario = new User($usuariosEnArray['name'], $usuariosEnArray['last_name'], $usuariosEnArray['email'], $usuariosEnArray['pass'], $usuariosEnArray['picture']);

        $usuario->setId($usuariosEnArray['id']);

        $users[] = $usuario;
      }

      return $users;

    }

    public function existeEmail($email){

      //traigo todos los usuarios
      $todos = $this->traerTodos();

      //recorro ese array
      foreach ($todos as $user) {

        // Si el mail del usuario en el array es igual al que me llegó por POST, devuelvo al usuario, sino retorno falso
        if ($user->getEmail() == $email) {

          return $user;
        }
      }
      return false;
    }

    public function traerUltimoID(){

       $usuarios = $this->traerTodos();

       if (count($usuarios) == 0){
         return 1;
       }

       $elUltimo = array_pop($usuarios);

       $id = $elUltimo->getId();

       return $id + 1;
     }

    public function traerPorID($id){
      $users = $this->traerTodos();

      foreach ($users as $usuario){
        if ($usuario->getId() == $id){
          return $usuario;
        }
      }
      return false;

    }

    public function guardarUsuario(User $user, DB $db){
      $usuario = $user->nuevoUsuario($db);

      $usuarioJSON = json_encode($usuario);

      file_put_contents($this->archive, $usuarioJSON.PHP_EOL, FILE_APPEND);

      return $user;
    }

    // public function guardarImagen($imagen, $email){
    //   $errores=[];
    //
    //   if ($_FILES[$imagen]['error'] == UPLOAD_ERR_OK){
    //
    //     $nombreArchivo = $_FILES[$imagen]['name'];
    //     $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    //     $archivoTemp = $_FILES[$imagen]['tmp_name'];
    //
    //     if ($ext == 'jpg' || $ext == 'png' || $ext = 'jpeg'){
    //       $rutaArchivoActual = dirname(__FILE__);
    //       $rutaArchivoFinal = $rutaArchivoActual . '/../avatarUsuarios/' . $email . '.' . $ext;
    //       move_uploaded_file($archivoTemp, $rutaArchivoFinal);
    //     } else {
    //       $errores['picture'] = "Formato de imagen no valido";
    //     }
    //
    //   } else {
    //     $errores['picture'] = "No subíste tu foto";
    //   }
    //   return $errores;
    // }

  }
