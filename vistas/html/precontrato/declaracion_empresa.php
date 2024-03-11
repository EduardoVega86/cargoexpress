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
                margin-top: 5cm;
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
                height: 20.5cm;
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
        <p style="text-align: center";><strong>
            DECLARACIÓN DE AUTORIZACIÓN EXPRESA
            <br>
          
            <br>
            <br>
            <p>De nuestra consideración</p>
            <br>
            <br>
            <p  style="text-align: justify;"><strong>Yo <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> </strong> con C.C. <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?> Declaro que entiendo y me fue explicado de manera 
                clara y precisa todo el proceso de negociación, calificación y/o afiliación que podrían vincularme con las diferentes empresas, frentes 
                laborales y condiciones de trabajo presentados por TRANSPORTES CUSHICONDOR S.A. de manera tal que, AUTORIZO a TRANSPORTES CUSHICONDOR S.A. 
                con ruc 1792475570001, para que a mi nombre y representación, pueda recibir y transferir cualquier valor correspondiente por concepto de 
                gestión administrativa, logística u otra que tenga que ver con la compra de acciones y/o participaciones en la compañía que fuere menester, 
                para el buen desenvolvimiento de mis futuras actividades, vinculadas al transporte y/o alquiler de vehículos de carga, así también, tengo 
                pleno conocimiento de los tiempos de tramitación del permiso de operaciones que se encuentra en proceso y entiendo que deberé esperar el 
                tiempo que sea necesario para este trámite y proceder con la legalización de mis documentos ante la Agencia Nacional de Tránsito del Ecuador
                 o ante las Agencias de Tránsito Municipales, de ser el caso.</p>
                 <p  style="text-align: justify;"> Declaro y entiendo, que dichos movimientos societarios futuros, que adquiera con esta compañía, solo podrán 
                    ser transferidos, vendidos o enajenados a terceros por mis propios medios y derechos, estando de acuerdo que, TRANSPORTES CUSHICONDOR S.A. 
                    me prestará el servicio de gestión de compra de las mismas y/o administración de costos logísticos y operativos que tengan que ver con este
                     tema y/o actividad. Este documento, sus anexos y ofertas presentadas por TRANSPORTES CUSHICONDOR S.A. contienen la totalidad del acuerdo 
                     entre las partes, y ninguna de éstas, estará obligada por ningún, compromiso, garantía o promesa que no esté convenido en este documento o sus anexos.
              </p>
              <table  width="40%" style="margin-top: 120px; text-align: center">
                <tr>
                    <td width="25%"></td>
                    <td width="50%">
                        <hr >
                        <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?><br>
                        CI: <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?><br><br>
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
$filename = "DeclaracionEmpresa_".get_row('users', 'nombre_users', 'id_users', $id_usuario).get_row('users', 'apellido_users', 'id_users', $id_usuario).'.pdf';
//file_put_contents($filename, $pdf);
ob_end_clean(); //limpiar para cargar mas imagenes
$dompdf->stream($filename);
?>
