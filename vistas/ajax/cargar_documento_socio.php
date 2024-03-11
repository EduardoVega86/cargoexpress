<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_GET['id'])) {
    $errors[] = "id vacío";
} else if (!empty($_GET['id'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $id       = $_GET['id'];
    $id_usuario       = $_GET['id_usuario'];
  
 
    // check if user or email address already exists
    $sql                   = "SELECT * FROM docuser where user_id=$id_usuario and docrequire_id=$id ";
    //echo $sql;
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $sql = "delete from `docuser` where `user_id`=$id_usuario and `docrequire_id`=$id  ";
               
        $query_new_insert = mysqli_query($conexion, $sql);
    } else {
        // write new user's data into database

        $sql = "INSERT INTO `docuser` (`user_id`, `docrequire_id`) "
                . "VALUES ( $id_usuario, $id);";
        //echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
           // $messages[] = "Gasto ha sido ingresado con Exito.";
        } else {
           // $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        }
    }
    $sql                   = "SELECT * FROM docuser where user_id=$id_usuario ";
    //echo $sql;
    $query_check_user_name = mysqli_query($conexion, $sql);
    echo mysqli_num_rows($query_check_user_name);

    
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