<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['proceso'])) {
    $errors[] = "Código vacío";
}   else if (
    !empty($_POST['proceso']) 
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    //Archivo de funciones PHP
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
   
    $fecha_contrato       =$_POST['fecha_contrato'];
    $proceso       =$_POST['proceso'];
    $date_added       = date("Y-m-d H:i:s");
     $cliente       =$_POST['cliente'];
    $users            = intval($_SESSION['id_users']);
    $query_new_insert = '';
// check if user or email address already exists
    @$sql                   = "SELECT * FROM productos WHERE codigo_producto ='" . $codigo . "';";
    $codigo='1112131415';
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $sql = "UPDATE productos SET nombre='" . $nombre . "',
                                        nombre='" . $nombre . "',
                                        descripcion_producto='" . $descripcion . "',
                                        id_linea_producto='" . $linea . "',
                                        id_proveedor='" . $proveedor . "',
                                        inv_producto='" . $inv . "',
                                        iva_producto='" . $impuesto . "',
                                        estado_producto='" . $estado . "',
                                        costo_producto='" . $costo . "',
                                        utilidad_producto='" . $utilidad . "',
                                        valor1_producto='" . $precio_venta . "',
                                        valor2_producto='" . $precio_mayoreo . "',
                                        valor3_producto='" . $precio_especial . "',
                                        stock_producto='" . $stock . "',
                                        stock_min_producto='" . $stock_minimo . "'
                                        WHERE codigo_producto='" . $codigo . "'";
        $query_update = mysqli_query($conexion, $sql);
    } else {
        $sql              = "INSERT INTO `proceso` (`id_cliente`, `nombre`, `estado`, `fecha`) "
                . "VALUES ( '$cliente', '$proceso', '1', '$fecha_contrato');";
        $query_new_insert = mysqli_query($conexion, $sql);

    }
    //Seleccionamos el ultimo compo numero_fatura y aumentamos una
   
    if ($query_new_insert or $query_update) {
        $messages[] = "Edificio ha sido ingresado satisfactoriamente.";
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
if (isset($messages)) {

    ?>
        <div class="alert alert-success" role="alert">
            <strong>¡Bien hecho!</strong>
            <?php
foreach ($messages as $message) {
        echo $message;
    }
    ?>
        </div>
        <?php
}

?>