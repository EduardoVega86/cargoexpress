<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['usuariocamion'])) {
    $errors[] = "Usuario vacío";
} else if (!empty($_POST['usuariocamion'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $usuariocamion      = mysqli_real_escape_string($conexion, (strip_tags($_POST["usuariocamion"], ENT_QUOTES)));
    $estadocamion = mysqli_real_escape_string($conexion, (strip_tags($_POST["estadocamion"], ENT_QUOTES)));
    $placa = mysqli_real_escape_string($conexion, (strip_tags($_POST["placa"], ENT_QUOTES)));
    $vantype = mysqli_real_escape_string($conexion, (strip_tags($_POST["vantype"], ENT_QUOTES)));
    $brand = mysqli_real_escape_string($conexion, (strip_tags($_POST["brand"], ENT_QUOTES)));
    $weight = mysqli_real_escape_string($conexion, (strip_tags($_POST["weight"], ENT_QUOTES)));
    $anio = mysqli_real_escape_string($conexion, (strip_tags($_POST["anio"], ENT_QUOTES)));
    $chasis = mysqli_real_escape_string($conexion, (strip_tags($_POST["chasis"], ENT_QUOTES)));
    
  //  $estado      = intval($_POST['estado']);
    $date_added  = date("Y-m-d H:i:s");
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
    $sql                   = "SELECT * FROM camiones WHERE placa ='" . $placa . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "Placa ya está en uso.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO `camiones` ( `placa`, `brand_id`, `vantype_id`, `weight_id`, `anio`, `user_id`, `estado_id`, `status`, `created_at`, `chasis`)"
                . " VALUES ('$placa','$brand','$vantype','$weight','$anio','$usuariocamion','$estadocamion','0','$date_added','$chasis')";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Camion ingresado con Exito.";
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