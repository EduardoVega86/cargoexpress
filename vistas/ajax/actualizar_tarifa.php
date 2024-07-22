<?php
require_once "../db.php";
require_once "../php_conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Actualizar la tarifa en la base de datos
    $query = "UPDATE servicios_empresa SET $field='$value' WHERE id='$id'";
    if (mysqli_query($conexion, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Tarifa actualizada correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la tarifa.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
