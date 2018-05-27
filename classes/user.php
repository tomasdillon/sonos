<?php

  class User{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $pass;
    private $picture;
    private $reg_date;

    public function __construct($first_name, $last_name, $email, $pass){
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->email = $email;
      $this->pass = $pass;
      $this->picture = 'image/avatar_default.png';
    }

    public function nuevoUsuario(DB $db){
      global $dbType;
      if ($dbType == 'json') {
        return [
          'id' => $db->traerUltimoID(),
          'name' => $this->first_name,
          'last_name' => $this->last_name,
          'email' => $this->email,
          'pass' => $this->setPassword($this->pass),
          'picture' => $this->picture
        ];
      } elseif ($dbType == 'mysql') {
        return [
          'name' => $this->first_name,
          'last_name' => $this->last_name,
          'email' => $this->email,
          'pass' => $this->setPassword($this->pass),
          'picture' => $this->picture
        ];
      }
    }

    public function setId($id){
      $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

    public function setFirstName($first_name){
      $this->first_name = $first_name;
    }

    public function getFirstName(){
      return $this->first_name;
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

    public function passNoHash($pass){
      return $this->pass = $pass;
    }

    public function getPassword(){
      return $this->pass;
    }

    public function getPicture(){
      return $this->picture;
    }

  }
