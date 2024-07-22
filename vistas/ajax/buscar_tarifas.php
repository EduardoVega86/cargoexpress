<?php
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_empresa = $_POST['id'];

   
    
    
    // Consulta a la base de datos para obtener las tarifas
    $query = mysqli_query($conexion, "SELECT * FROM servicios_empresa WHERE id_empresa='$id_empresa'");

    if (mysqli_num_rows($query) > 0) {
      
        echo '<div class="table-responsive">';
        echo '<table class="table table-sm table-striped">';
        echo '<thead class="info">';
        echo '<tr><th>Servicio</th><th>Valor</th><th>Km Adicional</th><th>Volumen</th><th>Contra Entrega</th><th>Costo</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($query)) {
               $id_servicios=$row['id_servicio'];
        $servicio= get_row('servicios', 'nombre_servicio', 'id_servicio', $id_servicios);
            echo '<tr>';
            echo '<td>' . $servicio . '</td>';
            echo '<td><input type="text" class="form-control tarifa-input" data-id="' . $row['id'] . '" data-field="valor" value="' . $row['valor'] . '"></td>';
            echo '<td><input type="text" class="form-control tarifa-input" data-id="' . $row['id'] . '" data-field="km_adicional" value="' . $row['km_adicional'] . '"></td>';
            echo '<td><input type="text" class="form-control tarifa-input" data-id="' . $row['id'] . '" data-field="volumen" value="' . $row['volumen'] . '"></td>';
            echo '<td><input type="text" class="form-control tarifa-input" data-id="' . $row['id'] . '" data-field="contra_entrega" value="' . $row['contra_entrega'] . '"></td>';
            echo '<td><input type="text" class="form-control tarifa-input" data-id="' . $row['id'] . '" data-field="costo" value="' . $row['costo'] . '"></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo 'No se encontraron tarifas para esta empresa.';
    }
} else {
    echo 'Método no permitido';
}
?>
