<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['latitud'])) {
    $errors[] = "Código vacío";
}   else if (
    !empty($_POST['latitud']) 
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    //Archivo de funciones PHP
    require_once "../funciones.php";
     $users          = $_POST['empresa'];
    // escaping, additionally removing everything that could be (html/javascript-) code
     $nombre_sucursal      = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre_sucursal"], ENT_QUOTES)));
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    $direccion      = mysqli_real_escape_string($conexion, (strip_tags($_POST["direccion_completa"], ENT_QUOTES)));
    //$localidad= mysqli_real_escape_string($conexion, (strip_tags($_POST["parroquia"], ENT_QUOTES)));
    $latitud= mysqli_real_escape_string($conexion, (strip_tags($_POST["latitud"], ENT_QUOTES)));
    $longitud= mysqli_real_escape_string($conexion, (strip_tags($_POST["longitud"], ENT_QUOTES)));
    //$contacto= mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    $telefono= mysqli_real_escape_string($conexion, (strip_tags($_POST["telefono"], ENT_QUOTES)));
   //$numero_casa= mysqli_real_escape_string($conexion, (strip_tags($_POST["numero_casa"], ENT_QUOTES)));
   $referencia= mysqli_real_escape_string($conexion, (strip_tags($_POST["referencia"], ENT_QUOTES)));
   $ciudad= mysqli_real_escape_string($conexion, (strip_tags($_POST["ciudad"], ENT_QUOTES)));
        $sql              = "INSERT INTO `bodega` (`responsable`, `id_empresa`, `longitud`, `latitud`, `direccion`, `num_casa`, `referencia`,  `contacto`, `localidad`, `nombre`) "
                . "VALUES ('$nombre', '$users', '$longitud', '$latitud', '$direccion', '$numero_casa', '$referencia',  '$telefono', '$ciudad', '$nombre_sucursal');";
        
        echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

    
    //Seleccionamos el ultimo compo numero_fatura y aumentamos una
   
    if ($query_new_insert or $query_update) {
        header("Location: ../html/bodegas_empresa.php");
exit;
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