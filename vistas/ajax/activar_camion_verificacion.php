<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
//$numero_factura = $_SESSION['numero_factura'];
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_camion'])) {
    $errors[] = "Usuario vacía";
} else if (!empty($_POST['id_camion'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    //echo "UPDATE `users` SET status=1 where users_id='" . $_POST['id_usuario'] . "'";
    $consultar     = mysqli_query($conexion, "UPDATE `camiones` SET habilitado=1 where id='" . $_POST['id_camion'] . "'");
   
    if ($consultar) {
        echo 'ok';
   // echo "Consulta ejecutada con éxito.";
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
}
 

?>