<?php

//echo 'funciona';
include 'vistas/db.php';
include 'vistas/php_conexion.php';


$tildes = $conexion->query("SET NAMES 'utf8'"); //Para que se inserten las tildes correctamente

mysqli_query($conexion, "ALTER TABLE `camiones` ADD `chasis` VARCHAR(100) NULL AFTER `updated_at`;");

mysqli_close($conexion); // Cerramos la link con la base de datos

echo json_encode("ok");
