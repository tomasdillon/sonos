<?php

  class User{
    private $id;
    private $name;
    private $last_name;
    private $email;
    private $pass;
    private $picture;

    public function __construct($name, $last_name, $email, $pass, $picture){
      $this->name = $name;
      $this->last_name = $last_name;
      $this->email = $email;
      $this->pass = $pass;
      $this->picture = $picture;
    }

    public function nuevoUsuario(DB $db){
      return [
        'id' => $db->traerUltimoID(),
        'name' => $this->name,
        'last_name' => $this->last_name,
        'email' => $this->email,
        'pass' => $this->setPassword($this->pass),
        'picture' => $this->picture
      ];
      // return $usuario;
    }

    public function setId($id){
      $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

    public function setName($name){
      $this->name = $name;
    }

    public function getName(){
      return $this->name;
    }

    public function setLastName($last_name){
      $this->last_name = $last_name;
    }

    public function getLastName(){
      return $this->last_name;
    }

    public function setEmail($email){
      $this->email = $email;
    }

    public function getEmail(){
      return $this->email;
    }

    public function setPassword($pass){
      return password_hash($pass, PASSWORD_DEFAULT);
    }

    public function getPassword(){
      return $this->pass;
    }

    public function getPicture(){
      return $this->picture;
    }

  }
