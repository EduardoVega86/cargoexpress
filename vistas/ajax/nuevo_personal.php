<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['usuario'])) {
    $errors[] = "referencia vacío";
} else if (!empty($_POST['usuario'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $usuario     = mysqli_real_escape_string($conexion, (strip_tags($_POST["usuario"], ENT_QUOTES)));
    $servicio = mysqli_real_escape_string($conexion, (strip_tags($_POST["servicio"], ENT_QUOTES)));
    $id_edificio = mysqli_real_escape_string($conexion, (strip_tags($_POST["id_edificio_ingresar"], ENT_QUOTES)));
    $estado      = intval($_POST['estado']);
    $date_added  = date("Y-m-d H:i:s");
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
    $sql                   = "SELECT * FROM personal WHERE id_servicio=$servicio and id_usuario =$usuario and id_edificio=$id_edificio;";
    //echo $sql;
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "El personal ya esta asignado para estte servicio.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO personal (id_edificio, id_usuario, id_servicio, status)
    VALUES ('$id_edificio','$usuario',$servicio,$estado)";
      //  echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

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