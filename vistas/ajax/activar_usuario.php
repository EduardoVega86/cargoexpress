<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
//$numero_factura = $_SESSION['numero_factura'];
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_usuario'])) {
    $errors[] = "Usuario vacía";
} else if (!empty($_POST['id_usuario'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    //echo "UPDATE `users` SET status=1 where users_id='" . $_POST['id_usuario'] . "'";
    
   
    if (get_row('users', 'status', 'id_users', $_POST['id_usuario'])==1){
      $consultar     = mysqli_query($conexion, "UPDATE `users` SET status=0 where id_users='" . $_POST['id_usuario'] . "'");   
    }else{
        //echo 'asd';
      $consultar     = mysqli_query($conexion, "UPDATE `users` SET status=1 where id_users='" . $_POST['id_usuario'] . "'");  
    }
    
    if ($consultar) {
        echo 'ok';
   // echo "Consulta ejecutada con éxito.";
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
}
 

?>