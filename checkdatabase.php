<?php
require_once 'soporte.php';

if (!$dbMYSQL->getStatusDB()) {
  header('Location:script.php');
  exit;
} elseif (!$dbMYSQL->checkTable('users')) {
  header('Location:script.php');
  exit;
} elseif (!count($dbMYSQL->traerTodos())) {
  header('Location:script.php');
  exit;
}
?>
