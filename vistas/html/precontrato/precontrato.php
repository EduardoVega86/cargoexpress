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

// Crear una marca de tiempo para la fecha específica
           setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');

$fecha = mktime(0, 0, 0, 1, 4, 2024); // 4 de enero del 2024

// Formatear la fecha
$fecha_formateada = strftime("%A %d de %B del %Y", $fecha);

//echo $fecha_formateada; // Muestra "jueves 4 de enero del 2024"

setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');

// Suponiendo que estas variables están definidas
$numero_dia = 4; // Por ejemplo, el día 4
$nombre_mes = 'enero'; // Por ejemplo, enero
$anio_actual = 2024; // Por ejemplo, el año 2024

// Convertir el nombre del mes a un número de mes
$meses = [
    'enero' => 1, 'febrero' => 2, 'marzo' => 3, 'abril' => 4,
    'mayo' => 5, 'junio' => 6, 'julio' => 7, 'agosto' => 8,
    'septiembre' => 9, 'octubre' => 10, 'noviembre' => 11, 'diciembre' => 12
];

$mes_numero = $meses[strtolower($nombre_mes)];

// Crear la marca de tiempo
$fecha = mktime(0, 0, 0, $mes_numero, $numero_dia, $anio_actual);

// Formatear la fecha
$fecha_formateada = strftime("%e días del mes de %B del año %Y", $fecha);

echo $fecha_formateada;

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
                margin-top: 4.5cm;
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
                z-index: 0;
              
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
        <main style="margin-top:10px;   z-index: 2;">
        <!--h4 style=" margin-top:-20px; margin-left: 6cm; position: fixed; z-index:100 !important;0">RUC: 1792475570001</h4-->
      
        <p style="text-align: center";><strong>
        PRECONTRATO DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE DE CARGA PESADA POR ARRENDAMIENTO.
        <br>
        </strong>
        </p>
        <br>
        
            <p style="text-align: justify;"><strong>PRIMERA.- COMPARECIENTES: </strong>En la ciudad de SANGOLQUI, a los<?php echo $fecha_formateada?>, comparecen a celebrar el 
                presente instrumento, por una parte:  
                <?php if(get_row('users', 'genero', 'id_users', $id_usuario)=='Sr'){ echo 'el';}else{ echo 'la';} ?> <?php echo get_row('users', 'genero', 'id_users', $id_usuario); ?>. <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?></strong>, con cédula de ciudadanía número <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?>, 
                de estado civil: <?php echo get_row('users', 'estado_civil', 'id_users', $id_usuario); ?>; 
                domiciliado en <?php echo get_row('users', 'direccion', 'id_users', $id_usuario); ?> ; quien se presenta en calidad de FUTURO ARRENDADOR; y por otra parte, el Sr. RONAL ALFREDO HERNANDEZ MONTILVA. 
                como representante autorizado de la Compañía <strong>TRANSPORTES CUSHICONDOR S.A</strong> con RUC. 1792475570001, en calidad de FUTURO ARRENDATARIO. Los comparecientes, 
                son mayores de edad, hábiles en derecho para contratar y obligarse; quienes libre y voluntariamente convienen en celebrar el presente: 
                PRECONTRATO DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE CARGA PESADA POR ARRENDAMIENTO, singularizado en las cláusulas siguientes:
            </p>

            <p style="text-align: justify;"><strong>SEGUNDA.- OBJETO DEL CONTRATO: </strong>EL FUTURO ARRENDADOR, se obligará, una vez en posesión del vehículo de carga pesada, 
                (o cuando la empresa facilitadora de adquirirlo, así lo determine oportunamente), para con <strong>TRANSPORTES CUSHICONDOR S.A</strong>, a la prestación de servicios de 
                alquiler y/o prestación de servicio de transporte. <?php if(get_row('users', 'genero', 'id_users', $id_usuario)=='Sr'){ echo 'el';}else{ echo 'la';} ?> <?php echo get_row('users', 'genero', 'id_users', $id_usuario); ?><?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?>, 
                será el propietario/a y/o autorizado/a por los propietarios a administrar el siguiente vehículo; 
                <strong> MARCA:</strong> <?php echo get_row('brand', 'name', 'id', get_row('camiones', 'brand_id', 'id', $id_camion)) ; ?> <strong>AÑO:</strong> <?php echo get_row('camiones', 'anio', 'id', $id_camion); ?> <strong>CLASE: </strong>CAMION <strong>TIPO:</strong> <?php echo get_row('vantype', 'name', 'id', get_row('camiones', 'vantype_id', 'id', $id_camion)) ; ?> <?php echo get_row('weight', 'name', 'id', get_row('camiones', 'weight_id', 'id', $id_camion)) ; ?> TON.  El vehículo en mención deberá acreditar perfecto estado mecánico y operativo, sin perjuicio de las revisiones adicionales a que hubiese lugar.
            </p>

            <p style="text-align: justify;">EL FUTURO ARRENDADOR reconoce y acepta que por la naturaleza de la obra y/o actividad, <strong>TRANSPORTES CUSHICONDOR S.A.</strong> podrá modificar a 
                su sola discreción, la lista de automotores prevista, en caso de que ciertos vehículos ya no sean requeridos por <strong>TRANSPORTES CUSHICONDOR S.A.</strong>

            </p>

            <p style="text-align: justify;"><strong>TERCERA.- VIGENCIA MÁXIMA DEL PRECONTRATO:</strong> El plazo para la ejecución del presente precontrato es de doce (12) meses, 
                contados a partir de la presente suscripción, luego del cual, se deberá suscribir el de Arrendamiento, una vez sea entregado el automotor al respectivo titular de dominio o a su representante legal.
                
            </p>

            <p style="text-align: justify;"><strong>CUARTA.- MODIFICACIÓN DEL PRECONTRATO:</strong> Este precontrato podrá ser ampliado, modificado o complementado 
                debido a causas imprevistas, como el caso fortuito o fuerza mayor, ajenas a las voluntades contratantes, presentadas en su ejecución, 
                siempre que se mantengan en la misma naturaleza.

            </p>
            
            <p style="text-align: justify;"><strong>QUINTA.- CUANTÍA Y PRECIOS DEL FUTURO CONTRATO:</strong> El FUTURO ARRENDATARIO pagará por la prestación de
                 servicios de transporte, el valor sujeto a la tabla de pagos presentada por los diferentes proveedores con los cuales <strong> TRANSPORTES CUSHICONDOR S.A.</strong> 
                  esté prestando el servicio de transporte de carga, según las distancias y valores. Dichos valores están sujetos a modificaciones de acuerdo al 
                  cumplimiento efectivo del transporte objeto de alquiler, y a la capacidad, rendimiento y especificaciones del vehículo alquilado.

            </p>
            
            <p style="text-align: justify;"><strong>SEXTA.- FORMAS FUTURAS DE PAGO: </strong> Los pagos se realizarán mediante Sistema de Pagos interbancarios del FUTURO ARRENDATARIO,
                 a través de cheques o transferencias a la cuenta del FUTURO ARRENDADOR y se realizará contra presentación de su respectiva factura y recepción de 
                 planillas, las cuales serán verificadas por la Administración del ARRENDATARIO de manera mensual y aprobadas por la empresa a la cual se le esté 
                 prestado los servicios de transporte de carga. El camión podrá facturar tan solo el tiempo que se encuentre laborando y esto será confirmado 
                 mediante planillas de trabajo diario o de carga, indistintamente con la fecha que se encuentre firmado el contrato. 

            </p>

            <p style="text-align: justify;"><strong>SÉPTIMA.- ENTRADA EN VIGENCIA DEL CONTRATO FUTURO DE ARRENDAMIENTO:</strong>  Las partes declaran que el presente precontrato estará vigente por el tiempo señalado en la 
                cláusula cuarta del presente instrumento, sin embargo, se obligan a mantenerlo activo, hasta que culmine la entrega del automotor adquirido por el 
                FUTURO ARRENDADOR y puesto a consideración del FUTURO ARRENDATARIO, en una suerte de reciprocidad mercantil por las gestiones realizadas por la 
                empresa facilitadora de la adquisición del automotor que será puesto en alquiler futuro, es así que, el FUTURO CONTRATO DE ARRENDAMIENTO, no 
                entrará en vigencia hasta que EL FUTURO ARRENDADOR entregue a TRANSPORTES CUSHICONDOR S.A todos y cada uno de los documentos solicitados y 
                que éste último, pueda validar y procesar las operaciones de inicio de alquiler del vehículo, tiempo que normalmente demora de 2 a 7 días hábiles, 
                tomado en cuenta el día en que el vehículo sea presentado en el frente laboral. 
           </p>

           <p style="text-align: justify;"><strong>OCTAVA.- RÉGIMEN DE SANCIONES:</strong>   EL FUTURO ARRENDADOR se obliga con TRANSPORTES CUSHICONDOR S.A 
            a poner a trabajar el automotor objeto del futuro arrendamiento, los trescientos sesenta y cinco días del año de los cuales podrá disponer 1 
            día a la semana o 2 días a la quincena para  mantenimiento preventivo y/o correctivo, en el caso de incumplir con los servicios, el 
            FUTURO ARRENDADOR se obliga pagar una multa equivalente al valor estipulado  por cada día de ausencia a partir de la primera ausencia, 
            para la aplicación de la multa bastara la simple información de TRANSPORTES CUSHICONDOR S.A. Así también, se aplicará una multa en caso que 
            el FUTURO ARRENDADOR retire su vehículo antes de la fecha pactada en el futuro y pertinente contrato, de manera unilateral y arbitraria, dicho 
            valor será el equivalente al promedio de valor facturado mensual del vehículo. B) Si el FUTURO ARRENDADOR, no acepta o una vez en labores 
            renuncia a cualquiera de las ofertas laborales que hará el FUTURO ARRENDATARIO, éste último, quedará exento de toda responsabilidad, en torno 
            al ingreso del primero, al entorno comercial del transporte en el Ecuador.
       </p>

       <p style="text-align: justify;"><strong>NOVENA.- CLÁUSULA PENAL:</strong>    En caso de que EL FUTURO ARRENDADOR incumpliere con su obligación 
        aquí adquirida, de suscribir un contrato de arrendamiento futuro, dicho incumplimiento llevará consagrada además, una penalidad económica de: 
        USS. 10.000,00 que ambas partes convienen en aceptarlo de consumo.
   </p>

   <p style="text-align: justify;"><strong> DÉCIMA.- SEGURO OBLIGATORIO:</strong>    El FUTURO ARRENDADOR, bajo su peculio, dispondrá de un seguro 
    adecuado y específico de alquiler, obligatorio para su vehículo, para resguardar cualquier imprevisto o novedad en labores. Adicionalmente la 
    adquisición obligatoria de un dispositivo de rastreo satelital para la vinculación con la plataforma de monitoreo/rastreo de EL FUTURO 
    ARRENDADOR, con el fin de mejorar la calidad del servicio prestado a los clientes finales, la seguridad del chofer, el vehículo y la mercadería en 
    transporte. El proveedor de rastreo será asignado a discreción por EL FUTURO ARRENDADOR.
</p>

<p style="text-align: justify;"><strong>  DÉCIMA PRIMERA.- RENUNCIA A JURISDICCIÓN, COMPETENCIA Y SOMETIMIENTO A ARBITRAJE: </strong>  Cualquier desacuerdo 
    que surja o se relacione con este precontrato, será resuelto por un  tribunal Arbitral de la Cámara de Comercio del Ecuador y los reglamentos del 
    Centro de Arbitraje y Mediación de la Cámara de Comercio de Quito, y las siguientes normas: 
</p>

<p style="text-align: justify;"><strong>  Las partes renuncian al derecho a acudir a la jurisdicción ordinaria, y convienen en aceptar la decisión arbitral 
    y a no iniciar ninguna acción legal y/o demanda en contra de tal decisión.
</p>

<p style="text-align: justify;"><strong>DÉCIMA SEGUNDA.- PROHIBICIÓN DE CESIÓN ARBITRARIA: </strong>   Las partes no podrán ceder o traspasar, total o parcialmente, los 
    derechos y obligaciones originados en este instrumento, sin una autorización previa y por escrito a la otra parte. De incumplir lo aquí estipulado, 
    al cesión será nula y la parte agraviante responderá por los daños y perjuicios que se puedan ocasionar.

</p>

<p style="text-align: justify;"><strong>  DÉCIMA TERCERA.- GASTOS OPERATIVOS Y/O ADMIRATIVOS: </strong>  Todos los gastos que devengan de la ejecución 
    fiel del presente instrumento, serán asumidos a prorrata por los aquí contratantes.
</p>

<p style="text-align: justify;"><strong> DÉCIMA CUARTA.- CONFIDENCIALIDAD: </strong>   EL FUTURO ARRENDADOR, declara que entiende y acepta que por 
    políticas de trabajo y seguridad de confidencialidad industrial, el vehículo que recibirá y que por éste instrumento, estará obligado de dar en 
    arrendamiento, será tomado en cuenta como equipo exclusivo de TRANSPORTES CUSHICONDOR S.A por tal razón, se acuerda prudencia y sigilo ante la 
    comunidad y el entorno donde se llevarán a cabo las actividades de trabajo, incluyendo los acuerdos realizados entre los propietarios, contratantes 
    y contratistas en el futuro. Entendiendo también que, cualquier acto o comentario, en desmedro de la empresa, del operador y/o conductor del vehículo 
    será responsabilidad única del FUTURO ARRENDADOR.

</p>
<p style="text-align: justify;"><strong> DÉCIMA QUINTA.- RATIFICACIÓN, ACEPTACIÓN Y SUSCRIPCIÓN: </strong>  Este instrumento ha sido estipulado y 
    entendido en su totalidad por los contratantes, celebrado de forma libre y voluntaria y por así convenir a los intereses de las partes, éstas 
    declaran que no se requiere de ulteriores registros, aprobaciones ni consentimiento para que tenga plena validez y vigor.
</p>

            <br>
            <br>
            
              <table width="100%" style="margin-top: 120px">
                <tr>
                    <td width="50%">
                        <hr> 
                        RONAL ALFREDO HERNANDEZ MONTILVA<br>
                        CI: 1758605255<br><br>
                        Cedente
                    </td>
                    <td width="50%">
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
$filename = "Precontrato_".get_row('users', 'nombre_users', 'id_users', $id_usuario).get_row('users', 'apellido_users', 'id_users', $id_usuario).'.pdf';

//file_put_contents($filename, $pdf);
ob_end_clean(); //limpiar para cargar mas imagenes
$dompdf->stream($filename);
?>
