<?php

  class Validator{

    //validateRegister recibe 2 parametros el primero es un objeto de la clase db (type hynting), con eso nos aseguramos q el primer parametro es si o si una clase que extienda o herede de db, tiene que ser un objeto que sea una instancia de la clase db. el sgdo es basicamente un archivo que es ntro archivo de imagen, no es mas que eso//

    public function validateRegister(DB $db, $archivo){
       $errores=[];

       $name = trim($_POST['name']);
       $last_name = trim($_POST['last_name']);
       $email = trim($_POST['email']);
       $pass = trim($_POST['pass']);

       if ($name == '') {
         $errores['name'] = 'Completá tu nombre';
       }
       if ($last_name =='') {
         $errores['last_name'] = 'Completá tu apellido';
       }
       if ($email == '') {
         $errores['email'] = 'Completá tu email';
       } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errores['email'] = 'Por favor, ingresa un email válido';
       } elseif ($db->existeEmail($_POST['email'])){
         $errores['email'] = "Ya existe el email";
       }
       if ($pass == '') {
         $errores['pass'] = 'Completá tu contraseña';
       } elseif (strlen($pass)<7) {
         $errores['pass'] = 'La clave no puede ser menor de 7 caracteres';
       }
       // if ($_FILES[$archivo]['error'] != UPLOAD_ERR_OK) {
       //   $errores['picture'] = "Subí una foto por favor";
       // } else {
       //   $ext=strtolower(pathinfo($_FILES[$archivo]['name'], PATHINFO_EXTENSION));
       //   if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
       //     $errores['picture'] = "Formatos admitidos: JPG, PNG o JPEG";
       //   }
       // }
       return $errores;
    }

    public function validacionLogeo(DB $db){

       $validacion = [];
       $email = trim($_POST['email']);
       $pass = trim($_POST['pass']);

       if ($email == '') {
         $validacion['email'] = 'Completa tu email';
       } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $validacion['email'] = 'Ingrese un email válido';
       } elseif (!$usuario = $db->existeEmail($email)) {
         $validacion['email'] = 'Email no registrado';
       } else {

         // $usuario = existeEmail($email);

         if (!password_verify($pass, $usuario->getPassword())) {
           $validacion['pass'] = "Credenciales incorrectas";
         }
       }
       return $validacion;
     }
  }
