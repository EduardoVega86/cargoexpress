<?php
//$id_proceso = $_POST['id_proceso'];
    $registro_id = $_POST['registro_id'];
    $imagen = $_FILES['imagen_' . $registro_id];
    require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";
     $ruta = '../../img/' . $imagen['name'];
    // Mover la imagen al directorio destino
    move_uploaded_file($imagen['tmp_name'], $ruta);
    // Actualizar la base de datos con la ruta de la imagen
    $sql = "UPDATE proceso2 SET url_image='$ruta' WHERE id_proceso='$registro_id'";
//echo $sql;
 //  $sql              = "UPDATE perfil SET  WHERE id_perfil='1';";
    $id_proceso= get_row('proceso2', 'id_proceso1', 'id_proceso', $registro_id);
   $query_new_insert = mysqli_query($conexion, $sql);
    // Cerrar conexión
    $conexion->close();
    // Resto del código para subir la imagen y actualizar la base de datos...
    //echo $id_proceso;
header("Location: procesos2.php?id=$id_proceso"); // Cambia 'pagina_deseada.php' por tu URL o nombre de página real
        exit(); // Asegurar que se detiene la ejecución después de redirigir
    
?>