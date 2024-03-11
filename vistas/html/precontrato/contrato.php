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
         
        ol {
            list-style-type: lower-alpha; /* Cambia los números por letras (a, b, c, ...) */
        }
 

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
                font-size: 13px;
               
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
        <main style="margin-top:10px;   z-index: 2;">
        <!--h4 style=" margin-top:-20px; margin-left: 6cm; position: fixed; z-index:100 !important;0">RUC: 1792475570001</h4-->
      
        <p style="text-align: center";><strong>
        CONTRATO DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE DE CARGA PESADA.
        <br>
        </strong>
        </p>
        <br>
         <p style="text-align: center";><strong>
        COPARECIENTES.
        <br>
        </strong>
        </p>
        
            <p style="text-align: justify;">En la ciudad de SANGOLQUI, a los<?php echo $fecha_formateada?>, comparecen a celebrar el presente contrato por una parte:  
                <?php if(get_row('users', 'genero', 'id_users', $id_usuario)=='Sr'){ echo 'el';}else{ echo 'la';} ?> <?php echo get_row('users', 'genero', 'id_users', $id_usuario); ?>. <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?></strong>, con cédula de ciudadanía número <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?>, 
                de estado civil: <?php echo get_row('users', 'estado_civil', 'id_users', $id_usuario); ?>; 
                domiciliado en <?php echo get_row('users', 'direccion', 'id_users', $id_usuario); ?> ; quien se presenta en calidad de ARRENDATARIO y por otra parte el Sr.
RONAL ALFREDO HERNÁNDEZ MONTILVA como representante autorizado de la Compañía <strong>TRANSPORTES CUSHICONDOR S.A</strong> con RUC. 1792475570001, en calidad de ARRENDADOR. Los comparecientes, son
mayores de edad, legalmente capaces para contratar y poder obligarse libre y
voluntariamente convienen a celebrar el presente CONTRATO de prestación de
servicios de transporte, domiciliados en esta ciudad y quedando en acuerdo a
las siguientes Cláusulas: 
                
            </p>
<p style="text-align: justify;"><strong>PRIMERA.- ANTECEDENTES: </strong>La compañía de  <strong>TRANSPORTES CUSHICONDOR S.A</strong>, Se dedica al transporte de carga pesada a nivel nacional,
y producto de ello, tiene generada varias alianzas de estrategia comercial en la
rama del transporte, incluyendo la de albergar posibilidades laborales, para los
vehículos de carga pesada de sus asociados.
            </p>
            
            <p style="text-align: justify;"><strong>SEGUNDA.- OBJETO DEL CONTRATO: </strong>El objetivo del Presente Contrato es
la prestación de servicios de alquiler y/o prestación de servicio de transporte.
EL ARRENDATARIO reconoce y acepta que por la naturaleza de la obra y/o
actividad, <strong>TRANSPORTES CUSHICONDOR S.A </strong>podrá modificar a su sola
discreción en la lista de equipos prevista en caso de que ciertos vehículos ya no
sean requeridos por <strong> TRANSPORTES CUSHICONDOR S.A.</strong>
            </p>

            <p style="text-align: justify;">EL ARRENDATARIO, de conformidad con su oferta, puesta de manifiesto en el
presente CONTRATO, se obliga para con TRANSPORTES CUSHICONDOR
S.A, a la prestación de servicios de alquiler y/o prestación de servicio de
transporte. <?php if(get_row('users', 'genero', 'id_users', $id_usuario)=='Sr'){ echo 'El';}else{ echo 'La';} ?> <?php echo get_row('users', 'genero', 'id_users', $id_usuario); ?>. <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?> es propietario y/o
autorizado por los propietarios a administrar el siguiente vehículo:
            </p>
<p style="text-align: justify;">
                <strong> MARCA:</strong> <?php echo get_row('brand', 'name', 'id', get_row('camiones', 'brand_id', 'id', $id_camion)) ; ?> <strong>PLACAS:</strong><?php echo get_row('camiones', 'placa', 'id', $id_camion); ?> <strong>AÑO:</strong> <?php echo get_row('camiones', 'anio', 'id', $id_camion); ?> <strong>TIPO:</strong> <?php echo get_row('vantype', 'name', 'id', get_row('camiones', 'vantype_id', 'id', $id_camion)) ; ?> <strong>TON: </strong> <?php echo get_row('weight', 'name', 'id', get_row('camiones', 'weight_id', 'id', $id_camion)) ; ?> <strong>CLASE: </strong>CAMION  <strong>NÚMERO DE CHASIS: </strong> <?php echo get_row('camiones', 'chasis', 'id', $id_camion); ?>.
            </p>
            <p style="text-align: justify;">El vehículo en mención se encuentra en perfectas condiciones de
funcionamiento. Se adjuntan, copia de cédula y papeleta de votación, Matrícula,
documentos que forman parte integrante de este contrato.
            </p>
            <p style="text-align: justify;"><strong>TERCERA.- EL VEHÍCULO:</strong> EL ARRENDATARIO declara que el vehículo en
mención es de su propiedad y que sobre estos no pesan gravámenes, vicios
ocultos u otras limitaciones, que pudieran afectar el uso libre y efectivo de
equipo por parte de TRANSPORTES CUSHICONDOR S.A. o cualquier
subcontratista del ARRENDATARIO.   
            </p>
            <p style="text-align: justify;"><strong>3.1.- Inspección del equipo y/o camión:</strong> El automotor será inspeccionado por
TRANSPORTES CUSHICONDOR S.A. antes de la firma de este documento,
para determinar que este cumpla con las especificaciones técnicas y no tengan
defectos de calidad. Estipulándose que, aunque TRANSPORTES
CUSHICONDOR S.A. no encuentre defectos durante esta inspección, EL
ARRENDATARIO será responsable de cualquier defecto que se evidencie en el
vehículo a posterior, sea por daño oculto pre-existente y/o defecto de fábrica,
desgaste, novedad mecánica y otros. En caso de presentarse un daño dentro del
trabajo, el propietario es único responsable de solventar la reparación inmediata
para lo que cuenta con 48 horas, de presentarse una demora mayor la unidad
debe ser reemplazada y se da por terminado el presente instrumento.   
            </p>
               <p style="text-align: justify;"><strong>3.2.- Funcionamiento del vehículo: </strong> EL ARRENDATARIO garantiza al
ARRENDADOR el perfecto funcionamiento del automotor señalado.  
            </p>

            <p style="text-align: justify;"><strong>CUARTA. - VIGENCIA MÁXIMA DEL CONTRATO:</strong> El plazo para la
ejecución del presente contrato es de doce (12) meses, contados a partir de la
presente fecha, transcurrido este tiempo, se toma como renovado por el mismo
tiempo establecido y podrá ser renovable hasta (2) dos veces consecutivas, los
primeros noventa (90) días se consideran de prueba donde a satisfacción y
evaluación del contratante, podrá autorizar el resto de tiempo de trabajo
señalado en este contrato y podrá prorrogarse por acuerdo entre las partes con
cinco días de antelación a la fecha de su expiración mediante la celebración de
un adéndum al contrato original, que deberá constar por escrito o por una
simple notificación vía e-mail de parte de TRANSPORTES CUSHICONDOR
S.A.

            </p>
            
            <p style="text-align: justify;"><strong>QUINTA. - MODIFICACIÓN DEL CONTRATO: </strong> Este contrato podrá ser
ampliado, modificado o complementado debido a causas imprevistas
presentadas en su ejecución, siempre que se mantenga la misma naturaleza de
trabajo. Esto basado en las etapas, procesos y modos de evaluación que precise
los acuerdos realizados entre <strong>TRANSPORTES CUSHICONDOR S.A.</strong> y el
Receptor del servicio final del servicio de transporte.
            </p>
            
            <p style="text-align: justify;"><strong>SEXTA. - CUANTÍA Y PRECIOS DEL CONTRATO: </strong> El ARRENDADOR
pagará por la prestación de servicios de transporte el valor sujeto a la tabla de
precios presentada por los diferentes proveedores con los cuales
<strong>TRANSPORTES CUSHICONDOR S.A.</strong> esté prestando el servicio de
transporte según las distancias y valores. Dichos valores están sujetos a
modificaciones de acuerdo al cumplimiento efectivo del transporte y a la
capacidad, rendimiento y especificaciones del vehículo.

            </p>

            <p style="text-align: justify;"><strong>SÉPTIMA. - FORMAS DE PAGO:</strong>  Los pagos se realizarán mediante Sistema de
Pagos interbancarios del ARRENDADOR a través de cheques o transferencias a
la cuenta del ARRENDATARIO y se realizarán contra presentación de su
respectiva factura y recepción de planillas, las cuales serán verificadas por la
Administración del ARRENDADOR, de manera mensual y aprobadas por la
empresa a la cual se le esté prestando los servicios de transporte, calculados de
acuerdo al presente contrato estarán sujetos a las retenciones determinadas en
la Ley de Régimen Tributario Interno; así como el cobro por gastos
administrativos si fueren necesarios de acuerdo a el traslado logístico y
administración del vehículo en labores. Una vez verificados los valores de las
facturas, de no haber objeciones se tramitará el pago dentro de los siguientes 30
días hábiles contados a partir de la cancelación por parte del CLIENTE FINAL,
al cual se le esté prestando el servicio de transporte serán canceladas única y
exclusivamente las planillas de trabajo correspondiente a su periodo, y aquellos
valores objetados como días adicionales de alquiler podrán ser nuevamente
facturados en planillas separadas.
El camión podrá facturar tan solo el tiempo que se encuentre laborando y esto
será confirmado mediante planillas de trabajo diario o de carga, indistintamente
que la fecha que se encuentre firmada el contrato.
           </p>

           <p style="text-align: justify;"><strong>ENTRADA EN VIGENCIA DEL CONTRATO: </strong>   Las partes
declaran que el presente contrato no entrará en vigencia sino, hasta que EL
ARRENDATARIO entregué a TRANSPORTES CUSHICONDOR S.A. todos y
cada uno de los documentos solicitados y que éste último pueda validar y
procesar las operaciones de inicio de alquiler de vehículo, tiempo que
normalmente demora de 2-7 días hábiles tomado en cuenta el día en que el
vehículo sea presentado en el frente laboral. EL ARRENDATARIO reconoce el
derecho del ARRENDADOR a solicitar originales o copias de estos documentos
en cualquier momento dentro del plazo del Contrato y se compromete a
entregar en un plazo de máximo de cinco (5) días hábiles después de la
solicitud por escrito de <strong>TRANSPORTES CUSHICONDOR S.A.</strong>
       </p>

       <p style="text-align: justify;"><strong>NOVENA: MULTAS: </strong>    EL ARRENDATARIO se obliga con TRANSPORTES
CUSHICONDOR S.A. a trabajar los trescientos sesenta y cinco días del año de
los cuales podrá disponer (1) un día a la quincena para mantenimiento
preventivo y/o correctivo con previa notificación de por lo menos 72 horas, en el
caso de incumplir con los servicios el ARRENDATARIO se obliga pagar una
multa equivalente al valor estipulado por cada día de ausencia a partir de la
primera ausencia, para la aplicación de la multa bastará la simple información
de TRANSPORTES CUSHICONDOR S.A y este será el único elemento para
establecer la mora de EL ARRENDATARIO así también se aplicará una multa
en caso que el ARRENDATARIO retire su vehículo antes de la fecha pautada en
el presente documento de manera unilateral y arbitraria dicho valor será el
equivalente al promedio de valor facturado mensual del vehículo. El
ARRENDATARIO declara aceptar la multa equivalente a noventa días de
trabajo del vehículo en caso que éste gestione el ingreso a labores de manera
directa a los diferentes contratantes de TRANSPORTES CUSHICONDOR S.A,
como multa por falta ética y daños y perjuicios hacia TRANSPORTES
CUSHICONDOR S.A, así haya terminado el presente contrato y durante el
tiempo de vigencia de la relación comercial entre TRANSPORTES
CUSHICONDOR S.A. y su CLIENTE FINAL. Esto aplica también para los
propietarios, apoderados, socios y camiones mencionados en el presente
documento que ingresen en labores con otros subcontratistas que presten
servicios en el mismo proyecto.
   </p>
<p style="text-align: justify;"><strong> TRANSPORTES CUSHICONDOR S.A </strong>    se reserva el derecho –y así lo autoriza
EL ARRENDATARIO– de descontar las multas mencionadas de manera
automática de las planillas o facturas que estén pendientes de pago al
ARRENDATARIO.
</p>
   <p style="text-align: justify;"><strong> DÉCIMA. - OBLIGACIONES DE EL ARRENDATARIO:</strong>    Además de sus
obligaciones generales contenidas en el código civil, EL ARRENDATARIO se
obliga a:
</p>
<p style="text-align: justify;"><strong> 10.1.- </strong>   Mantenimiento periódico y eventual del vehículo, tanto correctivo como
preventivo.
</p>
<p style="text-align: justify;"><strong> 10.2.- </strong>Notificar con al menos setenta y dos (72 horas de anticipación que se
realizará el mantenimiento del automotor, por vía escrita a los correos
<strong> OPERACIONES@TRANSCUSHICONDOR.COM</strong>  Y
<strong> LOGISTICA@TRANSCUSHICONDOR.COM</strong> . Será obligación del
ARRENDADOR reemplazar el vehículo en un lapso de (5) días si este presenta
daños irreparables, en el caso del ARRENDATARIO de no cumplir con los
tiempos establecidos dicho contrato se dará por terminado.
</p>
<p style="text-align: justify;"><strong> 10.3.- </strong>EL ARRENDATARIO debe prestar sus servicios en la o las diferentes
zonas, a nivel nacional, o plazas trabajo que le designe TRANSPORTES
CUSHICONDOR S.A. dentro de todo el territorio del Ecuador.
</p>
<p style="text-align: justify;"><strong> 10.4.- </strong>Asumir la total responsabilidad respecto del cuidado en la transportación
de la carga entregada por el ARRENDADOR, en caso de cualquier pérdida,
accidente de tránsito, etc.; en el que, por impericia, estado de embriaguez,
descuido del conductor, etc. afecte la mercadería, el ARRENDATARIO será
responsable del cien por ciento de la mercadería afectada;
</p>

<p style="text-align: justify;"><strong> 10.5.- </strong>Mantener una adecuada imagen e higiene del conductor del vehículo y
del propio vehículo, la limpieza del vehículo debe ser diaria tanto interna como
externamente;
</p>
<p style="text-align: justify;"><strong> 10.6.- </strong>Deberá entregar la carga sin demora ni entorpecimiento alguno al
destinatario o consignatario. De no hacerlo, se constituye responsable de todos
los daños y perjuicios que por la demora se causen al propietario, el destinatario
o el consignatario de la mercadería.
</p>
<p style="text-align: justify;"><strong> 10.7.- </strong>La adquisición de un dispositivo de rastreo satelital para la vinculación
con la plataforma de monitoreo/rastreo del ARRENDADOR, con el fin de
mejorar la calidad del servicio prestado a los clientes finales, la seguridad del
chofer, el vehículo y la mercadería en transporte. El proveedor de rastreo será
asignado a discreción por el ARRENDADOR.
</p>
<p style="text-align: justify;"><strong> 10.8.- </strong>Poner a disposición del ARRENDADOR, en conjunto con el camión, un
chofer que cumpla con los estándares, normativas y reglamentos de los
diferentes clientes del ARRENDADOR. Además, el chofer, debe poseer la
documentación establecida y NO POSEER DEMANDAS O JUICIOS que
puedan poner en riesgo el transporte de la mercadería.
</p>



<p style="text-align: justify;"><strong> DÉCIMA PRIMERA. - TERMINACION DEL CONTRATO:</strong>  Este Contrato
terminará al cumplirse cualquiera de los hechos siguientes: 
</p>

<p style="text-align: justify;"><strong> 11.1.- Por acuerdo de las partes: </strong>Las partes mediante acuerdo mutuo podrán
terminar este Contrato y las obligaciones pendientes.
</p>
<p style="text-align: justify;"><strong> 11.2.- Por decisión de TRANSPORTES CUSHICONDOR S.A </strong>podrá terminar
el Contrato cuando exista un incumplimiento contractual de los contemplados
en la legislación civil y mercantil, por parte de EL ARRENDATARIO, no
previsto en los términos del presente Contrato, sin necesidad de laudo arbitral o
sentencia judicial. Para hacer efectiva esa terminación, deberá enviar una
comunicación a EL ARRENDATARIO detallando el incumplimiento contractual
y dando el término de cinco (5) días para subsanarlo. Si a criterio de
<strong>TRANSPORTES CUSHICONDOR S.A </strong>, EL ARRENDATARIO no ha
subsanado su incumplimiento contractual, EL ARRENDADOR tendrá derecho
a terminar el Contrato mediante una notificación enviada AL ARRENDATARIO
con cinco (5) días de anticipación a la fecha en que dicha terminación se hará
efectiva. EL ARRENDATARIO acepta esta forma de terminación, por haber sido
libre y voluntariamente convenida.
</p>




<p style="text-align: justify;"><strong> 11.3- Por abandono del frente de trabajo. – </strong>Una vez ingresada la unidad y
chofer a un frente de trabajo, en caso de que el socio decida abandonar dicho
frente, sin previa notificación de 15 días laborables, se declarará terminado el
contrato por abandono del frente de trabajo. En caso de que el contrato se dé
por finalizado bajo esta cláusula, EL ARRENDADOR se reservará el derecho de
asignar un nuevo frente de trabajo al ARRENDATARIO
</p>

<p style="text-align: justify;"><strong> 11.4.-Por fuerza Mayor. - </strong>Cualquiera de las partes tendrá derecho a terminar el
presente Contrato con notificación previa de al menos cinco (5) días hábiles de
anticipación, si sucede en caso de caso fortuito o fuerza mayor.
En caso de terminación del Contrato de conformidad con las cláusulas 11.1, 11.2
y 11.3, TRANSPORTES CUSHICONDOR S.A no será responsable de
compensar o indemnizar al ARRENDATARIO bajo ninguna circunstancia, y
únicamente procederá a liquidar las obligaciones pendientes en un lapso de
noventa días una vez finalizada la relación contractual.
</p>

<p style="text-align: justify;"><strong> DÉCIMA SEGUNDA.- INCUMPLIMIENTODEL ARRENDATARIO:</strong>  En caso
de que EL ARRENDATARIO incumpliere con sus obligaciones bajo el presente
Contrato y dicho incumplimiento llevará a <strong>TRANSPORTES CUSHICONDOR
S.A.</strong> a incumplir con sus obligaciones bajo cualquiera de las empresas y/o
personas naturales a las que estuviere prestando servicios, EL
ARRENDATARIO indemnizará a <strong>TRANSPORTES CUSHICONDOR S.A.</strong> con
el mismo monto y bajo las mismas condiciones que TRANSPORTES
CUSHICONDOR S.A. deba indemnizar a cualquiera de las empresas y/o
personas naturales a la que prestare servicios, por dicho incumplimiento. 
</p>

<p style="text-align: justify;"><strong> DÉCIMA TERCERA. - SEGURO OBLIGATORIO: </strong>  El ARRENDATARIO
dispondrá obligatoriamente de un seguro adecuado y específico de alquiler
para su vehículo, en virtud de resguardar cualquier imprevisto o novedad en
labores.
</p>
<ol>
        <li>
            El Tribunal Arbitral será escogido de conformidad con los procedimientos establecidos en la Ley de Mediación y Arbitraje del Ecuador.
        </li>
        <li>
            Las partes renuncian al derecho a acudir a la jurisdicción ordinaria, y convienen en aceptar la decisión arbitral y a no iniciar ninguna acción legal demanda en contra de tal decisión.
        </li>
        <li>
            Para la ejecución de medidas cautelares, el Tribunal Arbitral queda autorizado por las partes a solicitar ayuda a los funcionarios públicos, inclusive judiciales, de la política y administrativos, sin necesidad de acudir a los jueces o cortes.
        </li>
        <li>
            El arbitraje será en derecho.
        </li>
        <li>
            El procedimiento arbitral será confidencial y tendrá lugar en el local del Centro de Arbitraje de Comercio de Quito.
        </li>
    </ol>
<p style="text-align: justify;"><strong>DÉCIMA QUINTA. - CESIÓN DE DERECHOS:  </strong>  Las partes no podrán ceder o
traspasar, total o parcialmente, los derechos y obligaciones originados en este
Contrato, sin una autorización previa y por escrito a la otra parte. De hacerlo,
tal cesión será nula y la parte agraviante responderá por los daños y perjuicios
que se puedan ocasionar.
</p>
<p style="text-align: justify;"><strong>DÉCIMA SEXTA. - PAGO DE TRIBUTOS:  </strong>  Corresponderá de la siguiente
forma:
</p>

<p style="text-align: justify;"><strong>16.1.-  </strong>  Las partes pagarán todos los impuestos con respecto al desarrollo de sus
obligaciones bajo este Contrato, incluyendo el impuesto a la renta u otros
impuestos nacionales o locales. TRANSPORTES CUSHICONDOR S.A. no
pagará ningún impuesto a la renta, retenciones u otros impuestos con que se
grabe al ARRENDATARIO.
</p>

<p style="text-align: justify;"><strong>16.2.-  </strong>  Cualquier otro impuesto o pagos relacionados con las autorizaciones
gubernamentales incurridos durante el uso de los negocios de cualquiera de las
partes y que no hayan sido asignados mediante el Contrato a ninguna de las
otras partes, serán pagados por la parte que incurre en dicho impuesto o pago.
</p>
<p style="text-align: justify;"><strong>16.3.-  </strong>  EL ARRENDATARIO declara estar de acuerdo con el descuento del 7%
de cada facturación quincenal o mensual por gastos administrativos-logísticos
generados por la ejecución del presente contrato, así como a las retenciones que
el Servicio de Rentas Internas exija ejecutar.
</p>

<p style="text-align: justify;"><strong>DÉCIMA SÉPTIMA.- CONFIDENCIALIDAD: </strong> EL ARRENDATARIO declara
que entiende y acepta que por políticas de trabajo y confidencialidad en la
seguridad industrial de éste giro comercial, el vehículo en mención, será
tomado en cuenta como equipo exclusivo de TRANSPORTES CUSHICONDOR
S.A. por tal razón, se acuerda prudencia y sigilo ante la comunidad y el entorno
donde se llevarán a cabo las actividades de trabajo incluyendo los acuerdos
realizados entre los propietarios, contratantes y contratistas relacionados en el
presente instrumento. Entendiendo también que, cualquier acto o comentario
del operador y/o conductor del vehículo es responsabilidad única del
ARRENDATARIO .
</p>
<p style="text-align: justify;"><strong>DÉCIMA OCTAVA. - ACEPTACIÓN, RATIFICACIÓN Y SUSCRIPCIÓN. - </strong> Las partes declaran y se comprometen a lo siguiente:
</p>

<p style="text-align: justify;"><strong>18.1.- </strong> Este instrumento ha sido leído y entendido en su totalidad, estipulado de
forma libre y voluntaria, por así convenir a los intereses de las partes. Estas
declaran que no se requiere de ulteriores registros, aprobaciones ni demás
trámites para que tenga plena validez y vigor.
</p>
<p style="text-align: justify;"><strong>18.2.- </strong> Este documento, sus anexos y ofertas presentadas por EL ARRENDADOR
contienen la totalidad del acuerdo entre las partes, y ninguna de las éstas, estará
obligada por ningún, compromiso, garantía o promesa que no esté convenido
en este contrato.
</p>
<p style="text-align: justify;"><strong>18.3.- </strong> En fe de lo cual, el contrato ha sido sustentado por los presentes, en forma
libre y voluntaria en unidad de acto y por triplicado.
</p>

            <br>
            <br>
            
              <table width="100%" style="margin-top: 120px; font-size: 13px !important;">
                <tr>
                    <td width="50%">
                        <hr> 
                        RONAL ALFREDO HERNANDEZ MONTILVA<br>
                        CI: 1758605255<br><br>
                        ARRENDADOR
                    </td>
                    <td width="50%">
                        <hr>
                        <?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario); ?> <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario); ?><br>
                        CI: <?php echo get_row('users', 'identificacion', 'id_users', $id_usuario); ?><br><br>
                        ARRENDATARIO
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
$filename = "Contrato_".get_row('users', 'nombre_users', 'id_users', $id_usuario).get_row('users', 'apellido_users', 'id_users', $id_usuario).'.pdf';

//file_put_contents($filename, $pdf);
ob_end_clean(); //limpiar para cargar mas imagenes
$dompdf->stream($filename);
?>
