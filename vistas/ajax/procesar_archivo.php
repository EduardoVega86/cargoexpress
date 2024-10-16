<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id = session_id();
$user_id  = $_SESSION['id_users'];
include '../simplexlsx/SimpleXLSX.php';

use Shuchkin\SimpleXLSX;

if (isset($_FILES['archivo_pedidos']['tmp_name'])) {
    $file = $_FILES['archivo_pedidos']['tmp_name'];
$contador=0;
    if ($xlsx = SimpleXLSX::parse($file)) {
        foreach ($xlsx->rows() as $row) {
            if ($contador > 0){
                
            
            echo "<tr>";
            echo "<td><input type='text' class='form-control' value='{$row[0]}' id='cliente'></td>";
            echo "<td><input type='text' class='form-control' value='{$row[1]}' id='latitud_remitente'></td>";
            echo "<td><input type='text' class='form-control' value='{$row[2]}' id='longitud_remitente'></td>";
            echo "<td><input type='text' class='form-control' value='{$row[3]}' id='latitud_destinatario'></td>";
            echo "<td><input type='text' class='form-control' value='{$row[4]}' id='longitud_destinatario'></td>";
            echo "<td><input type='text' class='form-control' id='resultado_distancia'></td>";
            echo "<td><input type='text' class='form-control' id='resultado_valor'></td>";
            echo "<td><button type='button' class='btn btn-primary' onclick='calcular_distancia(this.parentElement.parentElement)'>Calcular</button></td>";
            echo "</tr>";
            }
            $contador++;
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}
?>
