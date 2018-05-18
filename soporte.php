<?php
  require_once 'classes/auth.php';
  require_once 'classes/validate.php';
  require_once 'classes/dbJson.php';

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
