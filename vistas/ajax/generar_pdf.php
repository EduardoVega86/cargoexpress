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

        // QR Code (Optional)
        // $this->Image('qr_code.png', 160, 10, 30);

        // Label Content
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
        $this->Cell(95, 6, 'Indicaciones', 1, 0, 'L'); // Ajusta el ancho de la celda
        $this->Cell(95, 6, 'Firma de Recepcion', 1, 1, 'L'); // Ajusta el ancho de la celda

        $this->SetFont('Arial', '', 8);
        $this->Cell(95, 6, '', 1, 0, 'L'); // Indicaciones
        $this->Cell(95, 6, '', 1, 1, 'L'); // Firma de Recepcion

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
                $origen = get_row('bodega', 'direccion', 'id', $row['id_bodega_origen']);
                $destino = get_row('bodega', 'direccion', 'id', $row['id_bodega_destino']);
                $telefono = get_row('bodega', 'contacto', 'id', $row['id_bodega_origen']);
                
                $remitente = get_row('bodega', 'responsable', 'id', $row['id_bodega_origen']);
                $destinatario = get_row('bodega', 'responsable', 'id', $row['id_bodega_destino']);

                $data = array(
                    'fecha_hora' => $row['fecha'],
                    'remitente' => $remitente,
                    'destinatario' => $destinatario,
                    'direccion_remitente' => $origen,
                    'direccion_destinatario' => $destino,
                    'telefono_remitente' => $telefono,
                    'telefono_destinatario' => $row['telefono_destinatario'],
                );

                // Agregar la etiqueta con el offset
                $pdf->addLabel($data, $y_offset);

                // Ajustar el offset para la siguiente etiqueta
                $y_offset += 130; // Ajustar el valor según el tamaño de la etiqueta y el espacio entre ellas

                // Si la segunda etiqueta de la página está agregada, reiniciar el offset y agregar una nueva página
                if (($index + 1) % 2 == 0) {
                    $y_offset = 10;
                    $pdf->AddPage('P', array(210, 297));
                }
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
