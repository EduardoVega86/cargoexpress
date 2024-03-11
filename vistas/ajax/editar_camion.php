<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['mod_id_camion'])) {
    $errors[] = "ID vacío";
} else if (
    !empty($_POST['mod_id_camion'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
     //$estado      = intval($_POST['mod_estado']);
    $id_camion   = intval($_POST['mod_id_camion']);
     $estadocamion2   = $_POST['estadocamion2'];
      $placa2   = $_POST['placa2'];
      $vantype2   = $_POST['vantype2'];
      $brand2   = $_POST['brand2'];
      $weight2   = $_POST['weight2'];
      $anio2   = $_POST['anio2'];
    $chasis2   = $_POST['chasis2'];
    
        

    $sql = "UPDATE camiones SET  estado_id='" . $estadocamion2 . "',
                                placa='" . $placa2 . "',
                                vantype_id='" . $vantype2 . "',
                                brand_id='" . $brand2 . "',
                                weight_id='" . $weight2 . "',
                                     chasis='" . $chasis2 . "',
                                anio='" . $anio2 . "'
                                WHERE id='" . $id_camion . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Camión ha sido actualizada con Exito.";
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