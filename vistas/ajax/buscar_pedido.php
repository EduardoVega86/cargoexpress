<?php
require_once "../db.php";
require_once "../php_conexion.php";

$q = $_POST['q'];
$estado = $_POST['estado'];

$sql = "SELECT * FROM pedidos WHERE id_pedido='$q' AND estado='$estado'";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 1; // Si se encuentra una coincidencia
} else {
    echo 0; // Si no se encuentra
}
?>
