<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['nombre'])) {
    $errors[] = "referencia vacío";
} else if (!empty($_POST['nombre'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    //$proceso = mysqli_real_escape_string($conexion, (strip_tags($_POST["proceso"], ENT_QUOTES)));
    $upload = mysqli_real_escape_string($conexion, (strip_tags($_POST["upload"], ENT_QUOTES)));
    $vigencia = mysqli_real_escape_string($conexion, (strip_tags($_POST["vigencia"], ENT_QUOTES)));
    //$estado      = intval($_POST['estado']);
    //$date_added  = date("Y-m-d H:i:s");
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
    $sql                   = "SELECT * FROM docrequire WHERE name ='" . $nombre. "' ;";
    //echo $sql;
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "El documento ya existe.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO `docrequire` (`id`, `name`, `doctype_id`, `upload`, `vigencia`) VALUES "
                . "(NULL, '$nombre','1','$upload','$vigencia')";
        $query_new_insert = mysqli_query($conexion, $sql);
echo $sql;
        if ($query_new_insert) {
            $messages[] = "Liena ha sido ingresada con Exito.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
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