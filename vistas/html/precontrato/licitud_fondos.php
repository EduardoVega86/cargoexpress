<?php 
    ob_start();
    require_once "../../db.php";
    require_once "../../php_conexion.php";
    require_once "../../funciones.php";
    $id_usuario=$_GET['id_usuario'];
    $id_camion=$_GET['id_camion'];
 ?>

 <!DOCTYPE html>

<?php
$path = '../images/footer.webp';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$footerbase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path = '../images/header.webp';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$headerbase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
           

            @page {
                margin: 0cm 0cm;
            }

    
            /** Define now the real margins of every page in the PDF **/
            body {
                font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
                margin-top: 4cm;
                margin-bottom: 5cm;
                margin-left: 3cm;
                margin-right: 3cm;
                z-index: 1;
                font-size: 12px;
               
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
              
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 20cm;
            }

            table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            border: none;
          
        
        }

    
     
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src='<?php echo $headerbase64; ?>' style='opacity: 0.7;' width='100%' />
        </header>

        <footer>
            <img src='<?php echo $footerbase64; ?>' style='opacity: 0.7;' width='100%' />
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="margin-top:10px">
        <!--h4 style=" margin-top:-20px; margin-left: 6cm; position: fixed; z-index:100 !important;0">RUC: 1792475570001</h4-->
      
           <p>
           Quito, <?php 
// Crear una marca de tiempo para la fecha específica
           setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');

//$fecha = mktime(0, 0, 0, 1, 4, 2024); // 4 de enero del 2024

$fechaActual = time(); // Obtiene la marca de tiempo actual
//echo date('Y-m-d H:i:s', $fechaActual); // Formatea y muestra la fecha y hora actual

// Formatear la fecha
$fecha_formateada = strftime("%A %d de %B del %Y", $fechaActual);

echo $fecha_formateada; // Muestra "jueves 4 de enero del 2024"
?> 
            </p>
            <br>
            <br>
            <p style="text-align: center";><strong>
        DECLARACIÓN LICITUD DE FONDOS Y AUTORIZACIÓN DE TRANSFERENCIA DE VALORES
        <br>
            <br>
            <br>
            <p  style="text-align: justify;">Yo, <strong><?php echo  get_row('users', 'nombre_users', 'id_users', $id_usuario).' '.get_row('users', 'apellido_users', 'id_users', $id_usuario)?></strong> con C.C. <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario)?>, declaro bajo 
                juramento que el origen de los fondos entregados a 
                <strong>TRANSPORTES CUSHICONDOR S.A.</strong> con RUC. 179247557001, es lícito y no proviene de actividades ilícitas, 
                ilegales o vinculadas a negocios de lavado de dinero, producto de narcotráfico de sustancias ilegales, 
                y demás giros no regulados por la ley, por lo que, EXIMO a la empresa mencionada de toda responsabilidad, aún ante terceros, si la presente declaración no fuese veraz. 
     </p>
     <table  width="40%" style="margin-top: 120px; text-align: center">
        <tr>
            <td width="25%"></td>
            <td width="50%">
                <hr >
                <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario).' '.get_row('users', 'apellido_users', 'id_users', $id_usuario)?><br>
                CI: <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario)?><br><br>
                Cesionario
            </td>
            <td width="25%"></td>
        </tr>
    </table>
        </main>
    </body>
</html>


<?php
require_once("../dompdf/vendor/autoload.php");
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$pdf = $dompdf->output();
$filename = "LicitudDeFondos_".get_row('users', 'nombre_users', 'id_users', $id_usuario).get_row('users', 'apellido_users', 'id_users', $id_usuario).'.pdf';

//file_put_contents($filename, $pdf);
ob_end_clean(); //limpiar para cargar mas imagenes
$dompdf->stream($filename);
?>
