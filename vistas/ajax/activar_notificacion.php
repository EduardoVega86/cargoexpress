<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['notificacion'])) {
    $errors[] = "notificacion";
} else if (
    !empty($_POST['notificacion'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
   $id_notificacion= $_POST['notificacion'];
   $id_usuario= $_POST['id_usuario'];
   //$valor= $_POST['valor'];

   
   $sql_check = "SELECT * FROM notificacion_cliente WHERE id_notificacion = $id_notificacion AND id_empresa = $id_usuario";
$result = mysqli_query($conexion, $sql_check);

if (mysqli_num_rows($result) > 0) {
    // Si el registro existe, eliminarlo
    $sql_delete = "DELETE FROM notificacion_cliente WHERE id_notificacion = $id_notificacion AND id_empresa = $id_usuario";
    
    if (mysqli_query($conexion, $sql_delete)) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    // Si el registro no existe, agregarlo
    $sql_insert = "INSERT INTO notificacion_cliente (id_notificacion, id_empresa) VALUES ($id_notificacion, $id_usuario)";
    
    if (mysqli_query($conexion, $sql_insert)) {
        echo "Registro agregado correctamente.";
    } else {
        echo "Error al agregar el registro: " . mysqli_error($conexion);
    }
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