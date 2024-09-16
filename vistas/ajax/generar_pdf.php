<?php
require('../fpdf186/fpdf.php');
require_once "../db.php";
require_once "../php_conexion.php";
// Archivo de funciones PHP
include "../funciones.php";
// Inicia Control de Permisos
include "../permisos.php";

class PDF extends FPDF {
    function Header() {
        // No header needed for this label
    }

    function Footer() {
        // No footer needed for this label
    }

    function addLabel($data, $y_offset) {
        $this->SetY($y_offset);
        $this->SetX(10); // Ajusta el margen izquierdo

        // Logo
        $this->Image('../img/logo.png', 10, $this->GetY(), 20); // Ajusta el tamaño del logo
        $this->SetFont('Arial', 'B', 10); // Reduce el tamaño de la fuente
        $this->Cell(190, 6, 'CARGO XPRESS', 0, 1, 'C'); // Ajusta el ancho de la celda
        $this->SetFont('Arial', '', 8); // Reduce el tamaño de la fuente
        $this->Cell(190, 6, 'MENSAJERIA Y LOGISTICA EMPRESARIAL', 0, 1, 'C'); // Ajusta el ancho de la celda
        $this->Cell(190, 6, '0999979075 - 0999017127', 0, 1, 'C'); // Ajusta el ancho de la celda
        $this->Cell(190, 6, 'supervisor@web-cargoxpress.com', 0, 1, 'C'); // Ajusta el ancho de la celda

        $this->SetFont('Arial', 'B', 8); // Reduce el tamaño de la fuente
        $this->Cell(190, 6, 'ID Y USUARIO 002-489 COLCAN GESTION', 1, 1, 'C'); // Ajusta el ancho de la celda
        $this->Cell(95, 6, 'Fecha y Hora', 1, 0); // Ajusta el ancho de la celda
        $this->Cell(95, 6, 'Tipo de Servicio', 1, 1); // Ajusta el ancho de la celda

        $this->SetFont('Arial', '', 8); // Reduce el tamaño de la fuente
        $this->Cell(95, 6, utf8_decode($data['fecha_hora']), 1, 0); // Ajusta el ancho de la celda
        $this->Cell(95, 6, utf8_decode('Envio Xpress'), 1, 1); // Ajusta el ancho de la celda

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(95, 6, 'Remitente', 1, 0); // Ajusta el ancho de la celda
        $this->Cell(95, 6, 'Destinatario', 1, 1); // Ajusta el ancho de la celda

        $this->SetFont('Arial', '', 8);
        $this->Cell(95, 6, utf8_decode($data['remitente']), 1, 0); // Ajusta el ancho de la celda
        $this->Cell(95, 6, utf8_decode($data['destinatario']), 1, 1); // Ajusta el ancho de la celda

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(95, 6, utf8_decode('Direccion Remitente'), 1, 0); // Ajusta el ancho de la celda
        $this->Cell(95, 6, utf8_decode('Direccion Destinatario'), 1, 1); // Ajusta el ancho de la celda

        $this->SetFont('Arial', '', 8);
        $this->MultiCell(95, 6, utf8_decode($data['direccion_remitente']), 1, 'L');
        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetXY($x + 95, $y - 6);
        $this->MultiCell(95, 6, utf8_decode($data['direccion_destinatario']), 1, 'L');

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(95, 6, 'Telefono Remitente', 1, 0, 'L'); // Ajusta el ancho de la celda
        $this->Cell(95, 6, 'Telefono Destinatario', 1, 1, 'L'); // Ajusta el ancho de la celda

        $this->SetFont('Arial', '', 8);
        $this->Cell(95, 6, utf8_decode($data['telefono_remitente']), 1, 0, 'L'); // Ajusta el ancho de la celda
        $this->Cell(95, 6, utf8_decode($data['telefono_destinatario']), 1, 1, 'L'); // Ajusta el ancho de la celda

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(190, 12, 'Indicaciones', 1, 1, 'L'); // Aumenta el tamaño de la celda

        $this->SetFont('Arial', '', 8);
        $this->Cell(190, 12, '', 1, 1, 'L'); // Celda más grande para "Indicaciones"

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(190, 6, 'COBRO CONTRA-ENTREGA', 1, 1, 'C'); // Ajusta el ancho de la celda
    }
}

// Recibe los datos (en este caso, usando POST como ejemplo)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ids'])) {
        $ids = json_decode($_POST['ids'], true); // Decodificar el JSON a un arreglo de PHP
        $pdf = new PDF();

        // Agregar una nueva página para cada par de etiquetas
        $pdf->AddPage('P', array(210, 297));

        $y_offset = 10; // Inicializamos el offset

        // Conectar a la base de datos y obtener la información necesaria para cada ID
        foreach ($ids as $index => $id) {
            $query = mysqli_query($conexion, "SELECT * FROM pedidos WHERE id_pedido='$id'");
            $row = mysqli_fetch_array($query);

            if ($row) {
                $origen = $row['origen_direccion'];
                $destino = $row['destino_direccion'];
                $telefono =  $row['origen_telefono'];
                $telefono_destino =  $row['destino_telefono'];
                
                $remitente = $row['origen_nombre'];
                $destinatario = $row['destino_nombre'];

                $data = array(
                    'fecha_hora' => $row['fecha'],
                    'remitente' => $remitente,
                    'destinatario' => $destinatario,
                    'direccion_remitente' => $origen,
                    'direccion_destinatario' => $destino,
                    'telefono_remitente' => $telefono,
                    'telefono_destinatario' => $telefono_destino,
                );

                // Agregar la etiqueta dos veces (duplicado)
                $pdf->addLabel($data, $y_offset); // Primera etiqueta
                $pdf->addLabel($data, $y_offset + 140); // Segunda etiqueta en la misma página

                // Ajustar el offset para la siguiente página
                $y_offset = 10;
                $pdf->AddPage('P', array(210, 297)); // Nueva página para las siguientes etiquetas
            }
        }

        // Guardar el PDF en el servidor
        $file_name = 'guia_' . time() . '.pdf';
        $file_path = '../guias/' . $file_name; // Cambia '/path/to/save/' por la ruta donde quieras guardar los PDFs
        $pdf->Output('F', $file_path);

        // Devolver la URL del archivo generado
        echo json_encode(['url' => $file_path]);
    } else {
        echo json_encode(['error' => 'No se recibieron IDs.']);
    }
} else {
    echo json_encode(['error' => 'Método de solicitud no permitido.']);
}
?>
