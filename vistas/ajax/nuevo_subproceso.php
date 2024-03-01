<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_proceso_ingresar'])) {
    $errors[] = "referencia vacío";
} else if (!empty($_POST['id_proceso_ingresar'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["subproceso"], ENT_QUOTES)));
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];
    $id_proceso = mysqli_real_escape_string($conexion, (strip_tags($_POST["id_proceso_ingresar"], ENT_QUOTES)));
    $estado      = intval($_POST['estado']);
    $date_added  = date("Y-m-d H:i:s");
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
    //$sql                   = "SELECT * FROM departamento WHERE departamento ='" . $nombre . "' and id_edificio=$id_edificio;";
    //echo $sql;
    
    if (1 == 2) {
        $errors[] = "El Nombre ya está en uso.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO subproceso (subproceso, fecha_inicio, fecha_limite, id_proceso, estado)
    VALUES ('$nombre','$fecha_ini','$fecha_fin',$id_proceso,1)";
      // echo $sql;
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