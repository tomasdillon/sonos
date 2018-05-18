<?php

  require_once 'user.php';

  abstract class DB{
    public abstract function existeEmail($email);
    public abstract function traerTodos();
    public abstract function guardarUsuario(User $user, DB $db);
  }


//las clases abstractas no definen sus metodos, lo unico que hacen es decir que metodos van a utilizar todas las clases que hereden de este objeto, definen como va a ser la historia//
