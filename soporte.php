<?php
  require_once 'classes/auth.php';
  require_once 'classes/validate.php';
  require_once 'classes/dbJson.php';

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  $auth = new Auth();
  $validator = new Validator();

  $dbType = 'json';

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
