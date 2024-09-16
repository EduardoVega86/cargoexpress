<?php
require_once "../db.php";
require_once "../php_conexion.php";

if (isset($_POST['origen'])) {
    $origen = $_POST['origen'];

    // Conexión a la base de datos (ajusta los parámetros según sea necesario)
  
    // Main query to fetch the data
    $sTable = "bodega";
    $sWhere = "WHERE id = '$origen'";
    $sql    = "SELECT * FROM $sTable $sWhere";
    $query  = mysqli_query($conexion, $sql);

    // Loop through fetched data
    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        // Devolver los datos en formato JSON
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "No se encontraron datos."));
    }

    $conexion->close();
}
?>
