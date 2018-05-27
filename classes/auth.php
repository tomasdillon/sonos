<?php

  class Auth {

    public function __construct(){
      session_start();
      if (isset($_COOKIE['id']) && !$this->estaLogueado()){
        $this->loguear($_COOKIE['id']);
      }
    }

    public function loguear($usuarioID){
      $_SESSION['id'] = $usuarioID;
      header('location:bienvenido.php');
      exit;
    }

    public function estaLogueado(){
      return isset($_SESSION['id']);
    }

  }
