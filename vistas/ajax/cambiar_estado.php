<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
//$id_producto = $_SESSION['id'];
/*Inicia validacion del lado del servidor*/

    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $id_pedido = $_POST['id_pedido'];
    $id_estado = $_POST['estado'];
    $observacion = $_POST['observacion'];
   // $id_usuario = 1; // Suponiendo que el ID del usuario es 1. Ajusta esto según tu lógica.
$user_id  = $_SESSION['id_users'];
    // Procesar la subida del archivo
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/"; // Directorio donde se guardará la imagen
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen = $target_file; // Guardar la ruta de la imagen
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen.']);
            exit();
        }
    }

    // Actualizar la tabla pedidos
    $sql_update = "UPDATE pedidos SET estado='$id_estado' WHERE id_pedido='$id_pedido'";
    //echo $sql_update;
    if (mysqli_query($conexion, $sql_update)) {
        // Insertar en la tabla historial_pedido
        $sql_insert = "INSERT INTO historial_pedido (observacion, imagen, id_pedido, id_usuario, id_estado, fecha) VALUES ('$observacion', '$imagen', '$id_pedido', '$user_id', '$id_estado', current_timestamp())";
        if (mysqli_query($conexion, $sql_insert)) {
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar en historial_pedido.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el pedido.']);
    }

    mysqli_close($conexion);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}