<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado

require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

if (isset($_POST['estado_cambiar']) && isset($_POST['lista_pedidos']) && isset($_POST['mensajero'])) {
    $estado_cambiar = $_POST['estado_cambiar'];
    $lista_pedidos = $_POST['lista_pedidos'];
    $mensajero = $_POST['mensajero']; // Dato recibido desde el AJAX
   $user_id  = $_SESSION['id_users'];

    // Convertir el array en una cadena separada por comas para la consulta de actualización
    $ids = implode(',', $lista_pedidos);

    // Preparar la observación dependiendo del estado_cambiar
    if ($estado_cambiar == 2) {
        $nombre_mensajero=get_row('users', 'nombre_users', 'id_users', $mensajero).' '.get_row('users', 'apellido_users', 'id_users', $mensajero);
        $observacion = "Se asignó el chofer $nombre_mensajero";
    } else {
        $observacion = "Estado cambiado de forma masiva";  // Ajusta el mensaje según tu lógica
    }

    // Conexión a la base de datos
    $conexion->autocommit(FALSE);  // Iniciar transacción
 
    // Consulta para actualizar el estado de los pedidos
    if ($estado_cambiar == 2) {
     $sql_update = "UPDATE `pedidos` SET `estado` = $estado_cambiar, id_driver=$mensajero WHERE `id_pedido` IN ($ids)";
        }else{
        $sql_update = "UPDATE `pedidos` SET `estado` = $estado_cambiar WHERE `id_pedido` IN ($ids)";     
        }
    $update_success = $conexion->query($sql_update);

    if ($update_success) {
        $insert_success = true;

        // Insertar en la tabla `historial_pedido` para cada pedido
        foreach ($lista_pedidos as $id_pedido) {
            $sql_insert = "INSERT INTO `historial_pedido` 
                            (`id_historial`, `observacion`, `imagen`, `id_pedido`, `id_usuario`, `id_estado`, `fecha`) 
                            VALUES 
                            (NULL, '$observacion', "
                    . "'', '$id_pedido', '$user_id', '$estado_cambiar', NOW())";

            if (!$conexion->query($sql_insert)) {
                $insert_success = false;
                break;  // Detener el proceso si ocurre un error en la inserción
            }
        }

        if ($insert_success) {
            $conexion->commit();  // Confirmar la transacción si todo fue exitoso
            echo json_encode(['success' => true]);
        } else {
            $conexion->rollback();  // Revertir cambios si hubo un error
            echo json_encode(['success' => false, 'message' => 'Error al insertar en historial']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en la consulta de actualización']);
    }

    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
}
?>
