<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['servicio'])) {
    $errors[] = "servicio";
} else if (
    !empty($_POST['servicio'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
   $id_servicio= $_POST['servicio'];
   $id_usuario= $_POST['id_usuario'];
   //$valor= $_POST['valor'];

   
   $sql_check = "SELECT * FROM servicios_empresa WHERE id_servicio = $id_servicio AND id_empresa = $id_usuario";
$result = mysqli_query($conexion, $sql_check);

if (mysqli_num_rows($result) > 0) {
    // Si el registro existe, eliminarlo
    $sql_delete = "DELETE FROM servicios_empresa WHERE id_servicio = $id_servicio AND id_empresa = $id_usuario";
    
    if (mysqli_query($conexion, $sql_delete)) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    // Si el registro no existe, agregarlo
    $sql_insert = "INSERT INTO servicios_empresa (id_servicio, id_empresa) VALUES ($id_servicio, $id_usuario)";
    
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