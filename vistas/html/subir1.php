<?php
    $registro_id = $_POST['registro_id'];
    $usuario_documento = $_POST['usuario_documento'];
    $imagen = $_FILES['imagen_' . $registro_id];
    require_once "../db.php";
require_once "../php_conexion.php";
     $ruta = '../../documentos/' . $imagen['name'];
    // Mover la imagen al directorio destino
    move_uploaded_file($imagen['tmp_name'], $ruta);
    // Actualizar la base de datos con la ruta de la imagen
   $sql                   = "SELECT * FROM docuser where user_id=$id_usuario and docrequire_id=$id and secundary=$id_camion ";
    //echo $sql;
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $sql = "UPDATE `docuser` SET `estado` = '0' WHERE `docuser`.`id` = $registro_id;  ";
               
        $query_new_insert = mysqli_query($conexion, $sql);
    } else {
        // write new user's data into database

        $sql = "INSERT INTO `docuser` (`user_id`, `docrequire_id`, `estado`, url_doc) "
                . "VALUES ( $usuario_documento, $registro_id, 1, '$ruta');";
        //echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
           // $messages[] = "Gasto ha sido ingresado con Exito.";
        } else {
           // $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        }
    }
//echo $sql;
 //  $sql              = "UPDATE perfil SET  WHERE id_perfil='1';";
  // $query_new_insert = mysqli_query($conexion, $sql);
    // Cerrar conexión
    $conexion->close();
    // Resto del código para subir la imagen y actualizar la base de datos...
header("Location: verificacion_socios.php"); // Cambia 'pagina_deseada.php' por tu URL o nombre de página real
        exit(); // Asegurar que se detiene la ejecución después de redirigir
    
?>