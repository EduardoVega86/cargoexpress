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
        <main style='margin-top:10px'>
        <!--h4 style=' margin-top:-20px; margin-left: 6cm; position: fixed; z-index:100 !important;0'>RUC: 1792475570001</h4-->
      
           <p>
            RONAL ALFREDO HERNANDEZ MONTILVA<br>
            Gerente General de Transportes Cushicondor S.A<br>
            Presente.
            </p>
            <br>
            <br>
            <p>De nuestra consideración</p>
            <br>
            <br>
            <p  style='text-align: justify;'>Se sirva dar el trámite correspondiente a la transferencia de UNA ACCIÓN, 
              con un valor nominal de UN DÓLAR AMERICANO, acción pagada en un 100% entre el señor RONAL ALFREDO HERNANDEZ MONTILVA, 
              portador de la cedula de ciudadanía número 175860525-5 en calidad de Cedente <?php if(get_row('users', 'genero', 'id_users', $id_usuario)=='Sr'){echo 'al';
              }else{
               echo 'a la';
              } ?> 
              <?php echo get_row('users', 'genero', 'id_users', $id_usuario); ?>.  <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?>, portador de la cédula de ciudadanía <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?>. En calidad de Cesionario, de conformidad con el Art.  191 de la ley de compañías.</p>
              <table width='100%' style='margin-top: 120px'>
                <tr>
                    <td width='50%'>
                        <hr> 
                        RONAL ALFREDO HERNANDEZ MONTILVA<br>
                        CI: 1758605255<br><br>
                        Cedente
                    </td>
                    <td width='50%'>
                        <hr>
                        <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?><br>
                        CI: <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?><br><br>
                        Cesionario
                    </td>
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
$filename = "CesionDerechos_".get_row('users', 'nombre_users', 'id_users', $id_usuario).get_row('users', 'apellido_users', 'id_users', $id_usuario).'.pdf';
//file_put_contents($filename, $pdf);
ob_end_clean(); //limpiar para cargar mas imagenes
$dompdf->stream($filename);
?>
