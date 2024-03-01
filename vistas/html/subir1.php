<?php
    $registro_id = $_POST['registro_id'];
    $imagen = $_FILES['imagen_' . $registro_id];
    require_once "../db.php";
require_once "../php_conexion.php";
     $ruta = '../../img/' . $imagen['name'];
    // Mover la imagen al directorio destino
    move_uploaded_file($imagen['tmp_name'], $ruta);
    // Actualizar la base de datos con la ruta de la imagen
    $sql = "UPDATE proceso SET url_image='$ruta' WHERE id_proceso='$registro_id'";
//echo $sql;
 //  $sql              = "UPDATE perfil SET  WHERE id_perfil='1';";
   $query_new_insert = mysqli_query($conexion, $sql);
    // Cerrar conexión
    $conexion->close();
    // Resto del código para subir la imagen y actualizar la base de datos...
header("Location: procesos.php"); // Cambia 'pagina_deseada.php' por tu URL o nombre de página real
        exit(); // Asegurar que se detiene la ejecución después de redirigir
    
?>