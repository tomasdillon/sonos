<?php
session_start();

if (isset($_COOKIE['id'])){
  $_SESSION['id'] = $_COOKIE['id'];
}

function nuevoUsuario($data, $imagen){
  $usuario = [
    'id' => crearID(),
    'name' => $data['name'],
    'apellido' => $data['apellido'],
    'email' => $data['email'],
    'pass' => password_hash($data['pass'], PASSWORD_DEFAULT),
    'avatar' => 'avatarUsuarios/' . $data['email'] . '.' . pathinfo($_FILES[$imagen]['name'], PATHINFO_EXTENSION)
  ];
  return $usuario;
}

function validacionDatos($dato, $archivo){
   $errores=[];

   $name = trim($_POST['name']);
   $apellido = trim($_POST['apellido']);
   $email = trim($_POST['email']);
   $pass = trim($_POST['pass']);

   if ($name == '') {
     $errores['name'] = 'Completá tu nombre';
   }
   if ($apellido =='') {
     $errores['apellido'] = 'Completá tu apellido';
   }
   if ($email == '') {
     $errores['email'] = 'Completá tu email';
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $errores['email'] = 'Por favor, ingresa un email válido';
   } elseif (existeEmail($_POST['email'])){
     $errores['email'] = "Ya existe el email";
   }
   if ($pass == '') {
     $errores['pass'] = 'Completá tu contraseña';
   } elseif (strlen($pass)<7) {
     $errores['pass'] = 'La clave no puede ser menor de 7 caracteres';
   }

   if ($_FILES[$archivo]['error'] != UPLOAD_ERR_OK) {
     $errores['avatar'] = "Subí una foto por favor";
   } else {
     $ext=strtolower(pathinfo($_FILES[$archivo]['name'], PATHINFO_EXTENSION));
     if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
       $errores['avatar'] = "Formatos admitidos: JPG, PNG o JPEG";
     }
   }
   // if (empty($errores)) {
   //   // $carga = json_encode($dato);
   //   $carga = [];
   //   $carga = nuevoUsuario($dato);
   //   $carga = json_encode($carga);
   //   file_put_contents('usuarios.json', $carga . PHP_EOL, FILE_APPEND);
   // }

   return $errores;
 }

function traerTodos(){
   $archivo = file_get_contents('usuarios.json');
   $enArray = explode(PHP_EOL, $archivo);
   array_pop($enArray);
   $users = [];
   foreach ($enArray as $key) {
     $users[] = json_decode($key, true);
   }
   return $users;
 }

function crearID(){
   $usuarios = traerTodos();
   if (count($usuarios) >= 1) {
     foreach ($usuarios as $key) {
       $users = $key['id'] + 1;
     }
     return $users;
   }
   return 1;
 }

function existeEmail($email){
   $todos = traerTodos();
   foreach ($todos as $user) {
     if ($user['email'] == $email) {
       return $user;
     }
   }
   return false;
 }

function guardarImagen($imagen){
  $errores=[];

  if ($_FILES[$imagen]['error'] == UPLOAD_ERR_OK){

    $nombreArchivo = $_FILES[$imagen]['name'];
    $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $archivoTemp = $_FILES[$imagen]['tmp_name'];

    if ($ext == 'jpg' || $ext == 'png' || $ext = 'jpeg'){
      $rutaArchivoActual = dirname(__FILE__);
      $rutaArchivoFinal = $rutaArchivoActual . '/avatarUsuarios/' . $_POST['email'] . '.' . $ext;
      move_uploaded_file($archivoTemp, $rutaArchivoFinal);
    } else {
      $errores['avatar'] = "Formato de imagen no valido";
    }

  } else {
    $errores['avatar'] = "No subíste tu foto";
  }
  return $errores;
}

function guardarUsuario($data, $imagen){
  $usuario = nuevoUsuario($data, $imagen);
  $usuarioJSON = json_encode($usuario);
  file_put_contents('usuarios.json', $usuarioJSON.PHP_EOL, FILE_APPEND);
  return $usuario;
}

function validacionLogeo($data){
   $validacion = [];
   $email = trim($data['email']);
   $pass = trim($data['pass']);
   if ($email == '') {
     $validacion['email'] = 'Completa tu email';
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $validacion['email'] = 'Ingrese un email válido';
   }elseif (!existeEmail($email)) {
     $validacion['email'] = 'Email no registrado';
   } else {
     $usuario = existeEmail($email);
     if (!password_verify($pass, $usuario['pass'])) {
       $validacion['pass'] = "Credenciales incorrectas";
     }
   }
   return $validacion;
 }

function loguear($usuario){
   $_SESSION['id'] = $usuario['id'];
   header('location: bienvenido.php');
 }

function estaLogueado(){
   return isset($_SESSION['id']);
 }

function traerPorID($id){
   $usuarios = traerTodos();
   foreach ($usuarios as $user) {
     if ($user['id'] == $id) {
       return $user;
     }
   }
   return false;
 }

?>
