<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['mod_id'])) {
    $errors[] = "ID vacío";
}  else if (
    !empty($_POST['mod_id']) 
) {
    echo 'as';
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_nombre"], ENT_QUOTES)));
    $direccion = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_direccion"], ENT_QUOTES)));
    $fecha     = intval($_POST['mod_fecha']);
    $telefono  = intval($_POST['mod_telefono']);
    //$medida          = intval($_POST['mod_medida']);
   
    $id_telefono     = $_POST['mod_id'];
    $sql             = "UPDATE edificio SET nombre='" . $nombre . "',
                                        fecha_contrato='" . $fecha . "',
                                        direccion='" . $direccion . "',
                                        telefono='" . $telefono . "'
                                        WHERE id_edificio='" . $id_telefono . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Edificio ha sido actualizado satisfactoriamente.";
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