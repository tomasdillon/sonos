<?php
 require_once("funciones.php");
 $usuarios = [];
 $usuarios = traerTodos();
echo "<pre>";
 var_dump($usuarios);
echo "</pre>";

echo "<pre>";
 var_dump($usuarios[0]['photo']);
echo "</pre>";

$porID = [];
$porID = traerPorID(1);
echo "<pre>";
 var_dump($porID);
echo "</pre>";

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Pruebas</title>
   </head>
   <body>
     <img src="<?=$porID['photo']?>" alt="">
   </body>
 </html>
