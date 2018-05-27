<?php

require_once 'db.php';
require_once 'dbJson.php';

class dbMYSQL extends DB{

  private $pdo;
  private $bd;

  public function __construct(){
    try {
      $this->pdo = new PDO("mysql:host=localhost;dbname=sonos_db;port=3306;charset=utf8", "root", "");
      $this->bd = true;

    } catch (\Exception $e) {
      $this->pdo = new PDO("mysql:host=localhost;", "root", "");
      $this->bd = false;
    }
  }

  public function getStatusDB(){
    return $this->bd;
  }

  public function checkTable($table){
    try {
      $result = $this->pdo->prepare("SELECT id FROM $table LIMIT 1");
      $result = $result->execute();
    } catch (\Exception $e) {
      return false;
    }
    return $result;
  }

  public function createDB(){
    try {
      // El IF NOT EXISTS evita que se utilice el codigo del try{} en caso de que sonos_db exista. Es un doble chequeo, ya que en script.php hay una validacion para crear la tabla o informar de que ya fue creada
      $createdb = $this->pdo->prepare('CREATE DATABASE IF NOT EXISTS sonos_db COLLATE utf8_spanish_ci');
      $createdb->execute();
      // Con las dos lineas debajo, pasamos a usar la base de datos que acabamos de crear (caso contrario estariamos utilizando una DB que no es la de sonos_db)
      $use_db = $this->pdo->prepare('USE sonos_db');
  		$use_db->execute();
    } catch (PDOException $error) {
      return $error;
    }
  }

  public function createTable(){
    try {
      //Script tabla users
      $create = "CREATE TABLE users (
        id INT(8) AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(40) NOT NULL,
        last_name VARCHAR(40) NOT NULL,
        email VARCHAR(60) NOT NULL,
        pass VARCHAR(100) NOT NULL,
        picture VARCHAR(120) NOT NULL,
        reg_date TIMESTAMP
      )";
      $createTable = $this->pdo->prepare($create);
      $createTable->execute();
    } catch (PDOException $error) {
        return $error;
    }
  }

  public function traerPorID($id){
    $users = $this->traerTodos();
    // $users = $this->id;
    foreach ($users as $usuario){
      if ($usuario->id == $id){
        $user = new User($usuario->first_name,$usuario->last_name,$usuario->email,$usuario->pass,$usuario->picture);
        $user->setId($id);
        return $user;
      }
    }
    return false;
  }

  public function traerPorEmail($email){
    $users = $this->traerTodos();
    // $users = $this->id;
    foreach ($users as $usuario){
      if ($usuario->email == $email){
        $user = new User($usuario->first_name,$usuario->last_name,$usuario->email,$usuario->pass,$usuario->picture);
        $user->setId($usuario->id);
        return $user;
      }
    }
    return false;
  }

  public function migrateUsers(){
    $dbJson = new dbJSON();
    $allUsers = $dbJson->traerTodos();
    foreach ($allUsers as $user) {
      try {
        $first_name = $user->getFirstName();
        $last_name = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $picture = $user->getPicture();
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, pass, picture)
        VALUES (:first_name, :last_name, :email, :password, :photo)");
        $stmt->bindParam('first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam('last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam('email', $email, PDO::PARAM_STR);
        $stmt->bindParam('password', $password, PDO::PARAM_STR);
        $stmt->bindParam('photo', $picture, PDO::PARAM_STR);
        $stmt->execute();
      } catch (\Exception $e) {
        echo $exception->getMessage();
      }
    }
    return $allUsers;
  }

  public function existeEmail($email){
    $users = $this->traerTodos(); //Todos los usuarios en $users
    //recorro ese array
    foreach ($users as $user) {
      // Si el mail del usuario en el array es igual al que me llegó por POST, devuelvo al usuario, sino retorno falso
      if ($user->email == $email) {
        $user = $this->traerPorEmail($email);
        // $user = new User($user->first_name,$user->last_name,$user->email,$user->pass,$user->picture);
        // var_dump($user);exit;
        // $user->setId($user->id);
        return $user;
      }
    }
    return false;
  }

  public function guardarUsuario(User $user, DB $db){
    //Solo se pueden pasar variables en el bindeo, por lo que utilizo los metodos para conseguir los datos previamente.
    $user = $user->nuevoUsuario($db);
    $query = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, pass, picture)
    VALUES (:first_name, :last_name, :email, :pass, :photo)");
    $query->bindParam('first_name', $user['name'], PDO::PARAM_STR);
    $query->bindParam('last_name', $user['last_name'], PDO::PARAM_STR);
    $query->bindParam('email', $user['email'], PDO::PARAM_STR);
    $query->bindParam('pass', $user['pass'], PDO::PARAM_STR);
    $query->bindParam('photo', $user['picture'], PDO::PARAM_STR);
    $query->execute();
    return $user;
  }

  public function traerTodos(){
    $query = $this->pdo->prepare('SELECT * FROM users');
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;

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
    //   } else {
    //     $errores['picture'] = "No subíste tu foto";
    //   }
    //   return $errores;
    // }
}
