<?php
/*-------------------------
Autor: Delmar Lopez
Web: softwys.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; // Archivo verifica que el usario que intenta acceder a la URL está logueado
/* Connect To Database */
require_once "../db.php";
require_once "../php_conexion.php";
// Archivo de funciones PHP
include "../funciones.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ids'])) {
        $ids = json_decode($_POST['ids'], true); // Decodificar el JSON a un arreglo de PHP
        
        // Procesar los IDs y generar una respuesta
        $response = "";
        foreach ($ids as $id) {
            // Realizar la consulta a la base de datos
            $query = mysqli_query($conexion, "SELECT * FROM pedidos WHERE id_pedido='$id'");
            $row = mysqli_fetch_array($query);

            if ($row) {
                // Obtener los valores necesarios de la base de datos
                
                $destinatario =  $row['destino_nombre'];
                
                $remitente =  $row['origen_nombre'];
                
                $origen = $row['origen_direccion'];
                $destino = $row['destino_direccion'];
                $telefono_origen = $row['origen_telefono'];
                $telefono = $row['destino_telefono'];
                
                $fecha = $row['fecha'];
                $estado = get_row('estados', 'estado', 'id_estado', $row['estado']);
                $mensajero = ($row['id_driver'] == 0) ? 'NO ASIGNADO' : get_row('users', 'nombre_users', 'id_users', $row['id_driver']) . ' ' . get_row('users', 'apellido_users', 'id_users', $row['id_driver']);

                $origen_lat=$row['origen_lat'];
                $origen_lon=$row['origen_lon'];
                $destino_lat=$row['destino_lat'];
                $destino_lon=$row['destino_lon'];
                 $indicaciones=$row['indicaciones'];
                
                        
                
                // Formatear la respuesta según el formato especificado
                $response .= "ID: $id\n";
                $response .= "Remitente: $remitente\n";
                $response .= "Direccion: $origen\n";
                $response .= "Ubicación: https://www.google.com/maps?q=".$origen_lat.",".$origen_lon."\n";
                $response .= "Telefono: $telefono_origen\n";
                 $response .= "______________\n";
                $response .= "Destinatario: $destinatario\n";
                $response .= "Destino: $destino\n";
                $response .= "Ubicación: https://www.google.com/maps?q=".$destino_lat.",".$destino_lon."\n";
                $response .= "Teléfono: $telefono\n";
                $response .= "Fecha: $fecha\n";
                $response .= "Indicaciones: $indicaciones\n";
                $response .= "-------------------------\n";
            }
        }

        // Respuesta al cliente
        echo nl2br($response);
    } else {
        echo "No se recibieron IDs.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
