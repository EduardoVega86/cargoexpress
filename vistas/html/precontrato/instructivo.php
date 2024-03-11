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
      
        <p style="text-align: center";><strong>
    INSTRUCTIVO DE MATERIALIZACIÓN DE LOS DISTINTOS FINES (COMERCIALES Y NO COMERCIALES) DE LA COMPAÑÍA CUSHICONDOR S.A.
        <br>
        </strong>
        </p>
        <br>
    

        <p style="text-align: center";><strong>
            CAPÍTULO PRIMERO. PRINCIPIOS Y GENERALIDADES.
               
                </strong>
                </p>
            <p style="text-align: justify;"><strong>Artículo 1.- Definiciones. -</strong> El presente instructivo pretende canalizar los fines pertinentes para alcanzar el objeto social del estatuto de la 
                compañía Cushicondor S.A. sin alejarse de la realidad económica nacional.
            </p>

            <p style="text-align: justify;"><strong>Artículo 2.- Ámbito de Aplicación. -</strong> Todos los socios, directivos, empleados y asociados de la compañía Cushicondor S.A deberán acatar irrestrictamente las disposiciones emanadas a partir de este instructivo. 

            </p>

            <br>
            <p style="text-align: center";><strong>
                CAPÍTULO SEGUNDO. RÉGIMEN DE COMPETENCIAS.                   
                    </strong>
                    </p>
                    <p style="text-align: justify;"><strong>Artículo 3.- Del Directorio de la Empresa. -</strong> El directorio de la empresa Transportes Cushicondor S.A. corresponde al Presidente y Gerente General, quienes han sido designados por la Junta General correspondiente, a quienes se les notificará de cada acción y/o decisión adoptada que no demande aprobación por la Junta General de acuerdo a los Estatutos.
                    </p>
        
                    <p style="text-align: justify;"><strong>Artículo 4.- De los Socios de la Empresa. -</strong> Para adquirir la calificación de Socio de la empresa Transportes Cushicondor S.A. es indispensable y sin excepción de ninguna estirpe cumplir los siguientes requisitos: 
                    </p>
                    <ol>
                        <li>Haber suscrito la adquisición de acciones según corresponda.</li>
                        <li>Haber suscrito el “PRECONTRATO DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE DE CARGA PESADA POR ARRENDAMIENTO”.</li>
                        <li>Haber suscrito el “CONTRATO DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE DE CARGA PESADA POR ARRENDAMIENTO”.</li>
                        <li>Generar la aportación que para el efecto de ingreso establecerá La Directiva.</li>
                    </ol>

                    <p style="text-align: justify;"><strong>Artículo 5.- De los Directivos. -</strong> Para estos efectos en primer lugar, serán considerados Directivos el Gerente General y el Presidente y a continuación todos los demás que la Junta General vía Asamblea determine. 
                    </p>

                    <p style="text-align: justify;"><strong>Artículo 6.- De los Empleados. - </strong> La capacidad para generar contratación individual, bajo relación de dependencia de cualquier trabajador será de única y exclusiva competencia del Directorio de Cushicondor S.A.

                    </p>

                    <p style="text-align: justify;"><strong>Artículo 7.- De los Asociados.-</strong> Se considerará asociado de la empresa Transportes Cushicondor S.A. a toda persona con la capacidad de generar ingresos adicionales a la compañía, superiores a VEINTE MIL DÓLARES DE LOS ESTADOS UNIDOS DE NORTEAMÉRICA ($20.000), recibiendo por dicha gestión una comisión del 10% del valor total ingresado a las arcas de la empresa; si quien lograre ingresar un capital adicional, en algún tipo de negocio inherente al giro comercial de la empresa fuere un socio, su comisión no podrá superar el 5% del valor total ingresado.

                    </p>
<br>
                    <p style="text-align: center";><strong>
                        CAPÍTULO TERCERO. APORTACIONES.
                 
                            </strong>
                            </p>

                            <p style="text-align: justify;"><strong>Artículo 8.- Costos de Operatividad Económica Mensual. - </strong> El aporte mensual que deberá erogar de forma periódica mensual por cada socio calificado de la empresa Transportes Cushicondor S.A. para el eficiente desenvolvimiento comercial de la empresa será aprobado por el Directorio de la compañía, que para el ejercicio económico 2022 - 2023 está pactado en CINCUENTA DÓLARES DE LOS ESTADOS UNIDOS DE NORTEAMÉRICA ($50). 

                            </p>

                            <p style="text-align: justify;"><strong>Artículo 9.- Costeo Adicional de Amortización Empresarial. -</strong> El valor comercial de APORTACIÓN por cada socio de forma individual será de $50 CINCUENTA DÓLARES de los estados unidos de Norteamérica, que deberán ser cancelados de manera mensual para gastos de mantenimiento y administración de las oficinas la compañía y de considerarse necesario serán sujetos a cambio y aprobados por El Directorio de la compañía Cushicondor S.A., de no encontrarse al día con sus obligaciones el socio no podrá acceder a ningún tipo de documento que solicite ante la compañía para regularización del vehículo cooperado o cualquier otro trámite que desee realizar ante instituciones públicas o privadas.
                                
                            </p>
                            <p style="text-align: center";><strong>
                                CAPÍTULO CUARTO. RÉGIMEN DISCIPLINARIO.
                         
                                    </strong>
                                    </p>
                                    <p style="text-align: justify;"><strong>Artículo 10.- De las Sanciones. - </strong> Son obligaciones del directorio, socios, empleados y asociados, además de lo establecido en los estatutos. Las siguientes: 


                                    </p>
                                    <ol>
                                        <li>ACUDIR a la mediación, como mecanismo de solución de los conflictos relacionados a la compañía como mecanismo alternativo, sea con otros socios, sus órganos, directivos y/o entidades de control pertinentes; de no cumplir esta disposición serán sancionados con pena de multa económica de hasta 2.500$ USD. DOS MIL QUINIENTOS DÓLARES DE LOS ESTADOS UNIDOS DE NORTEAMÉRICA, que serán avalados por la junta general de socios;
                                        </li>
                                        <li>Abstenerse de difundir rumores, publicidad engañosa, confidencialidades de los giros de negocios corporativo o futuras negociaciones de la empresa; la integridad e imagen de la compañía o de sus dirigentes, de no cumplir con esta disposición serán sancionados con una multa económica de entre 10.000$ a 20.000$ DIEZ MIL A VEINTE MIL DÓLARES DE LOS ESTADOS UNIDOS DE NORTEAMÉRICA, previo informe favorable del directorio;
                                        </li>
                                        <li>Todos los asociados tienen prohibición de expresar por cualquier medio, los asuntos inherentes al desempeño económico, financiero, social y jurídico de la empresa Transportes Cushicondor S.A. De no cumplir recibirán una multa económica de 12.500$. DOCE MIL QUINIENTOS DÓLARES DE LOS ESTADO UNIDOS DE NORTEAMÉRICA, previo informe favorable de la Directiva.
                                            </li>
                                        
                                    </ol>

                                    <p style="text-align: justify;"><strong>Artículo 11.- Aplicabilidad de sanción para una convocatoria realizada por El Directorio para aplicar a un contrato. - </strong> Todo directivo, socio, empleado o asociado debe acudir a las convocatorias establecidas por El Directorio de acuerdo al Estatuto para el desarrollo de las actividades comerciales de la compañía, de no cumplir con esta disposición serán sancionados con una multa económica de entre previo informe favorable de la Directiva. 

                                    </p>

                                    <p style="text-align: center";><strong>
                                        CAPÍTULO QUINTO. DISPOSICIONES GENERALES.
                                 
                                            </strong>
                                            </p>
                                            <p style="text-align: justify;"><strong>Artículo 12.- Aplicabilidad Normativa. - </strong> Corresponderá única y exclusivamente al Directorio de la Compañía Transportes Cushicondor S.A, la reforma, modificación, disminución y/o aumento en las sanciones aquí aplicables, a partir del análisis circunstancial del Directorio, que será previamente socializada a la Junta de Accionistas y/o Socios de Transportes Cushicondor S.A.


                                            </p>
                                            <p style="text-align: justify;"><strong>Décima Octava. - Aceptación, Ratificación Y Suscripción. - </strong>  La parte declara y se comprometen a lo siguiente: 

                                            </p>

                                            <p style="text-align: justify;">Este instrumento ha sido leído y entendido en su totalidad, estipulado de forma libre y voluntaria, por así convenir a los intereses de las partes. Estas declaran que no se requiere de ulteriores registros, aprobaciones ni demás trámites para que tenga plena validez y vigor.
                                            </p>
                                            <p style="text-align: justify;">En fe de lo cual, el contrato ha sido sustentado por los presentes, en forma libre y voluntaria en unidad de acto y por triplicado. 
                                            </p>
            
            
                                            <table  width="40%" style="margin-top: 120px; text-align: center">
                                                <tr>
                                                    <td width="25%"></td>
                                                    <td width="50%">
                                                        <hr >
                                                        <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?><br>
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
$filename = "Instructivo".get_row('users', 'nombre_users', 'id_users', $id_usuario).get_row('users', 'apellido_users', 'id_users', $id_usuario).'.pdf';

//file_put_contents($filename, $pdf);
ob_end_clean(); //limpiar para cargar mas imagenes
$dompdf->stream($filename);
?>
