<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$id_producto = $_SESSION['id'];
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_pedido'])) {
    $errors[] = "Cantidad vacía";
} else if (!empty($_POST['id_pedido'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_pedido  = intval($_POST['id_pedido']);
    $mensajero  = intval($_POST['mensajero']);
 
   $user_id  = $_SESSION['id_users'];

    //GURDAMOS LAS ENTRADAS EN EL KARDEX
    //$costo_producto = get_row('productos', 'moneda', 'id_perfil', 1);
   
    $sql          = "UPDATE pedidos SET  id_driver= $mensajero, estado=2  WHERE id_pedido='" . $id_pedido . "'";
    //echo $sql;
    $update = mysqli_query($conexion, $sql);
    
    $nombre_mensajero=get_row('users', 'nombre_users', 'id_users', $mensajero).' '.get_row('users', 'apellido_users', 'id_users', $mensajero);
     $sql_insert = "INSERT INTO historial_pedido (observacion, imagen, id_pedido, id_usuario, id_estado, fecha) "
             . "VALUES ('Se asigno el chofer $nombre_mensajero', '', '$id_pedido', '$user_id', '2', current_timestamp())";
     $update = mysqli_query($conexion, $sql_insert);
     
    if ($update) {
        echo "ok";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {

    ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?php
foreach ($errors as $error) {
        echo $error;
    }
    ?>
    </div>
    <?php
}


?>