<?php
  //Uso de ob_start() para que deje hacer uso del header location ya enviado HTML al querer autologear despues de registrado el usuario.
  ob_start();
  require_once 'classes/auth.php';
  require_once 'classes/validate.php';
  require_once 'classes/dbJson.php';
  require_once 'classes/dbMYSQL.php';

  // error_reporting(E_ALL);
  // ini_set('display_errors', '1');

  $auth = new Auth();
  $validator = new Validator();
  $dbMYSQL = new dbMYSQL();
  $dbJSON = new dbJson();

  $dbType = 'mysql';

	switch ($dbType) {
		case 'json':
			$db = new dbJson();
			break;
		case 'mysql':
			$db = new dbMYSQL();
			break;
		default:
			$db = NULL;
			break;
	}
