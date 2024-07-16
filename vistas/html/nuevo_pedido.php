<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database */
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
//include 'is_logged.php'; 
$session_id = session_id();
//echo $session_id; 
$pais = get_row('perfil', 'pais', 'id_perfil', 1);

$empresa = $_GET['id'];



get_cadena($user_id);
$modulo = "Pedidos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title = "Ventas";
$nombre_usuario = get_row('users', 'usuario_users', 'id_users', $user_id);
?>

<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>

<!-- Begin page -->
<div id="wrapper" class="forced enlarged"> <!-- DESACTIVA EL MENU -->
    <?php require 'includes/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <?php if ($permisos_ver == 1) {
                    ?>
                    <div class="col-lg-12">
                        <div class="portlet">
                            <div class="portlet-heading bg-primary">
                                <h3 class="portlet-title">
                                    Nueva Guía
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-primary" class="panel-collapse collapse show">
                                <div class="portlet-body">
                                    <?php
                                    include "../modal/buscar_productos_ventas.php";
                                    include "../modal/registro_mensajero.php";
                                    include "../modal/registro_producto.php";
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-box">
                                                <div class="widget-chart">
                                                    <H5><strong>DATOS PARA LA GUÍA</strong></H5>
                                                    
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <span class="help-block">Origen </span>
                                                                <?php
                                                                //echo "select * from bodega where id_empresa=$empresa";
                                                                ?>
                                                                <select class="form-control" id="origen" name="origen">
                                                                    <option value="">Seleccione origen</option>
                                                                    <?php
                                                                    $sql2 = "select * from bodega where id_empresa=$empresa";
                                                                    $query2 = mysqli_query($conexion, $sql2);

                                                                    while ($row2 = mysqli_fetch_array($query2)) {
                                                                        $id = $row2['id'];
                                                                        $nombre = $row2['nombre'];
                                                                        $localidad = $row2['localidad'];
                                                                        $nombre_localidad = get_row('localidad', 'parroquia', 'codigo_parroquia', $localidad);

                                                                        // Obtener el valor almacenado en la tabla orgien_laar
                                                                        //$valor_seleccionado = $provinciadestino;

                                                                        // Verificar si el valor actual coincide con el almacenado en la tabla
                                                                        //$selected = ($valor_seleccionado == $cod_provincia) ? 'selected' : '';
                                                                        // Imprimir la opción con la marca de "selected" si es el valor almacenado
                                                                        //echo '<option value="' . $id . '" ' . $selected . '>' . $nombre . '</option>';
                                                                        echo "<option value='$id' > $nombre - $nombre_localidad</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <input type="hidden" class="form-control" id="session" name="session" value="<?php echo $session_id; ?>">
                                                                <input type="hidden" class="form-control" id="cliente" name="cliente" value="<?php echo $empresa; ?>">
                                                                <input type="hidden" class="form-control" id="id_camion" name="id_camion" value="">
                                                            </div>                                                            
                                                            <div class="col-md-2">
                                                                <span class="help-block">Destino </span>
                                                                <select class="form-control" id="destino" name="destino">
                                                                    <option value="">Seleccione destino</option>
                                                                    <?php
                                                                    $sql2 = "select * from bodega where id_empresa=$empresa";
                                                                    //echo $sql2;
                                                                    $query2 = mysqli_query($conexion, $sql2);

                                                                    while ($row2 = mysqli_fetch_array($query2)) {
                                                                        $id = $row2['id'];
                                                                        $nombre = $row2['nombre'];
                                                                        $localidad = $row2['localidad'];
                                                                        $nombre_localidad = get_row('localidad', 'parroquia', 'codigo_parroquia', $localidad);

                                                                        // Obtener el valor almacenado en la tabla orgien_laar
                                                                        //$valor_seleccionado = $provinciadestino;

                                                                        // Verificar si el valor actual coincide con el almacenado en la tabla
                                                                        //$selected = ($valor_seleccionado == $cod_provincia) ? 'selected' : '';
                                                                        // Imprimir la opción con la marca de "selected" si es el valor almacenado
                                                                        //echo '<option value="' . $id . '" ' . $selected . '>' . $nombre . '</option>';
                                                                        echo "<option value='$id' > $nombre - $nombre_localidad</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Nombre del Destinatario </span>
                                                                <input type="text" class="datos form-control" id="destinatario" name="destinatario" placeholder="Ingrese el nombre del destinatario" required>
                                                                </div>                                                            
                                                            <div class="col-md-2">
                                                                <span class="help-block">Ciudad </span>                                                                
                                                                <select class="form-control" id="nuevo-pedido-ciudad" name="nuevo-pedido-ciudad">
                                                                  <option value="">Seleccione Ciudad</option>                                                                    
                                                                    <option value="">Quito</option>
                                                                     <option value="">Guayaquil</option>
                                                                      <option value="">Cuenca</option>
                                                                       <option value="">Ambato</option>
                                                                </select>
                                                                </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Teléfono Destinatario </span>
                                                                <input type="text" class="datos form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp" required>
                                                                </div>
                                                                </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <span class="help-block">Tipo de servicio </span>
                                                                <select class="form-control" id="tipo_servicio" name="tipo_servicio">
                                                                    <option value="">Seleccione servicio</option>
                                                                    <?php
                                                                    $sql2 = "select * from servicios ";
                                                                    //echo $sql2;
                                                                    $query2 = mysqli_query($conexion, $sql2);

                                                                    while ($row2 = mysqli_fetch_array($query2)) {
                                                                        $id = $row2['id_servicio'];
                                                                        $nombre = $row2['nombre_servicio'];
                                                                    

                                                                        // Obtener el valor almacenado en la tabla orgien_laar
                                                                        //$valor_seleccionado = $provinciadestino;

                                                                        // Verificar si el valor actual coincide con el almacenado en la tabla
                                                                        //$selected = ($valor_seleccionado == $cod_provincia) ? 'selected' : '';
                                                                        // Imprimir la opción con la marca de "selected" si es el valor almacenado
                                                                        //echo '<option value="' . $id . '" ' . $selected . '>' . $nombre . '</option>';
                                                                        echo "<option value='$id' > $nombre</option>";
                                                                    }
                                                                    ?>
                                                                </select>

                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="help-block">Peso </span>
                                                              <input type="number" class="datos form-control" id="kg" name="kg" placeholder="Kg" required>  

                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="help-block">Largo </span>
                                                                <!-- <input style="width: 20px; height: 20px"  type="checkbox" id="miCheckbox" onchange="toggleInput(this)"> -->
                                                              <input type="number" class="form-control" id="largo" placeholder="cms"> 

                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="help-block">Alto </span>
                                                                <!-- <input style="width: 20px; height: 20px"  type="checkbox" id="miCheckbox" onchange="toggleInput(this)"> -->
                                                              <input type="number" class="form-control" id="alto" placeholder="cms"> 
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="help-block">Ancho </span>
                                                                <input type="number" class="datos form-control" id="ancho" name="ancho" placeholder="cms">
                                                            </div>
                                                           <div class="col-md-2">
                                                                <span class="help-block">Dirección Destino </span>
                                                                <input id="direccion_destino" name="direccion_destino" class="form-control " type="text" placeholder="Ingresa una dirección">
                                                                </div>                                                            
                                                            </div>
                                                        <br>
                                                        <div class="row">                                                        
                                                           <div class="col-md-2">
                                                                <span class="help-block">Indicaciones </span>
                                                                <input type="text" class="datos form-control" id="indicaciones" name="indicaciones" placeholder="" required>
                                                                </div>                                                               
                                                           <div class="col-md-1">
                                                                <span class="help-block">Hora de salida </span>
                                                                <input type="time" class="datos form-control" id="hora_salida" name="hora_salida" placeholder="Hora de salida (Opcional)">
                                                            </div>
                                                            <div class="col-md-1">
                                                                 <span class="help-block">Hora de entrega </span>
                                                                <input type="time" class="datos form-control" id="hora_entrega" name="hora_entrega" placeholder="Hora de entrega (Opcional)">
                                                            </div>
                                                           <div class="col-md-2">
                                                                <span class="help-block">Referencias adicionales (Opcional)</span>
                                                                <input type="text" class="datos form-control" id="observacion" name="observacion" placeholder="">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Cobro contra entrega </span>
                                                                        <input style="width: 20px; height: 20px" type="checkbox" id="cod" name="cod">


                                                                <input type="number" class="form-control" id="valor_cobrar" name="valor_cobrar" placeholder="Valor a Cobrar"> 
                                                            </div>
                                                           <div class="col-md-2">
                                                                <span class="help-block">Envío asegurado     </span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="seguro" name="seguro">
                                                                <input type="number" class="form-control" id="valor_seguro" name="valor_seguro" placeholder="Valor"> 
                                                            </div>                                                                              
                                                        </div>
                                                        <br>                                                        
                                                        <div class="row">
                                                            
 
 
                                                            <div class="col-md-2">
                                                                
                                                                <button style="height: 100%; width: 100%" onclick="calcular(); calcular_distancia(); " class="btn btn-primary">Calcular</button>

                                                            </div>
                                                        </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-7">
                                            <div class="card-box">

                                                <div class="widget-chart">
                                                    <div id="resultados_ajaxf" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
                                                    <form class="form-horizontal" role="form" id="barcode_form">
                                                        <div class="form-group row">
                                                           
                                                            
                                                            
                                                        </div>
                                                    </form>

                                                    <div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->

                                                </div>
                                            </div>

                                        </div>
<div class="col-md-5">
    <div id="disponibles" class='col-md-12' style="margin-top:0px"></div>
                                                                <button  onclick="guardar_pedido()" type="submit" style="width:100%; height: 100%; font-size: 20px" class="btn btn-primary"><span class="texto_boton"> Generar Orden</span></button>
                                                            </div>
                                        

                                    </div>
                                    <!-- end row -->


                                </div>
                            </div>
                        </div>
                    </div>
    <?php
} else {
    ?>
                    <section class="content">
                        <div class="alert alert-danger" align="center">
                            <h3>Acceso denegado! </h3>
                            <p>No cuentas con los permisos necesario para acceder a este módulo.</p>
                        </div>
                    </section>
    <?php
}
?>

            </div>
            <!-- end container -->
        </div>
        <!-- end content -->

<?php require 'includes/pie.php'; ?>

    </div>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php require 'includes/footer_start.php'
?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui-->
<!-- ============================================================== -->
<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
<script type="text/javascript" src="../../js/cotizacion.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-OWe4vKRnRiHQEx2ANZqxIGBT8z6Fo0&libraries=places&callback=initMap"></script>
<!-- ============================================================== -->
<script>
    function initAutocomplete() {
         var input = document.getElementById('direccion_destino');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setTypes(['address']);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            console.log(place);
        });
    }
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>

<!-- Codigos Para el Auto complete de Clientes -->
<script>
     function calcular_distancia() {
//    var origen = (-0.1763603, -78.47949419999999) 
//var destino = (-78.503773, -0.1329112) 
//resultado = gmaps.distance_matrix(origen, destino, mode='driving')
//
//
//distancia = resultado['rows'][0]['elements'][0]['distance']['text']
//alert(distancia)
  }
     

function guardar_venta() {
    var valor = document.getElementById('valor').value;
    var estibadores = document.getElementById('estibadores').value;
    var origen = document.getElementById('origen').value;
    var destino = document.getElementById('destino').value;
    var cliente = document.getElementById('cliente').value;
    var tonelaje = document.getElementById('tonelaje').value;
    var id_camion = document.getElementById('id_camion').value;
    var observacion = document.getElementById('observacion').value;
    var cod = document.getElementById('cod').value;
    //Inicia validacion
    
    
    //Fin validacion
    $.ajax({
        type: "POST",
        url: "../ajax/guardar_pedido.php",
        data: "id=" + cliente + "&valor=" + valor + "&estibadores=" + estibadores+ "&origen=" + origen+ "&destino=" + destino+ "&tonelaje=" + tonelaje + "&observacion=" + observacion+ "&id_camion=" + id_camion+ "&cod=" + cod,
        beforeSend: function(objeto) {
            $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
            alert(datos)
             if (datos == "ok") {
              // alert();
                  Swal.fire({
                    title: "¡Pedido ingresado con éxito!",
                    icon: "success",
                    confirmButtonText: "¡Aceptar!",
                  }).then(() => {
                    window.location.reload();
                  });
                }else{
               window.location.reload();     
     }
  
        }
    });
}
        
   function toggleInput(checkbox) {
    var inputText = document.getElementById("estibadores");
    inputText.disabled = !checkbox.checked; // Deshabilita si no está marcado, habilita si está marcado
    //inputText.value(0)
}   

  function prepareForm() {
            var codCheckbox = document.getElementById('cod');
            var codHiddenInput = document.getElementById('codValue');
            codHiddenInput.value = codCheckbox.checked ? '1' : '0';
        }
        
function calcular() {
  //  alert()
var tipo_servicio = document.getElementById('tipo_servicio').value;
var kg = document.getElementById('kg').value;
var largo = document.getElementById('largo').value;
var alto = document.getElementById('alto').value;
var direccion_destino = document.getElementById('direccion_destino').value;
var indicaciones = document.getElementById('indicaciones').value;
var hora_salida = document.getElementById('hora_salida').value;
var hora_entrega = document.getElementById('hora_entrega').value;
var observacion = document.getElementById('observacion').value;
var valor_cobrar = document.getElementById('valor_cobrar').value;
var valor_seguro = document.getElementById('valor_seguro').value;
var cliente = document.getElementById('cliente').value;
var destino = document.getElementById('destino').value;
var origen = document.getElementById('origen').value;
var ancho = document.getElementById('ancho').value;
var destinatario = document.getElementById('destinatario').value;

 var codCheckbox = document.getElementById('cod');
            var cod = codCheckbox.checked ? '1' : '0';
            
             var codCheckbox = document.getElementById('seguro');
            var seguro = codCheckbox.checked ? '1' : '0';
//var cod = document.getElementById('cod').value;


  $.ajax({
        type: "POST",
        url: "../ajax/calcular.php",
        data: "cliente=" + cliente + "&tipo_servicio=" + tipo_servicio + "&kg=" + kg+ "&largo=" + largo+ "&alto=" + alto+ "&direccion_destino=" + direccion_destino + "&indicaciones=" + indicaciones+ "&hora_salida=" + hora_salida+ "&hora_entrega=" + hora_entrega+ "&observacion=" + observacion+ "&valor_cobrar=" + valor_cobrar+ "&valor_seguro=" + valor_seguro+ "&cod=" + cod+ "&seguro=" + seguro+ "&destino=" + destino+ "&origen=" + origen+ "&ancho=" + ancho+ "&destinatario=" + destinatario,
        beforeSend: function(objeto) {
            $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
          //  alert(datos)
             $("#resultados").html(datos);
             if (datos == "ok") {
                
              // alert();
                  Swal.fire({
                    title: "¡Pedido ingresado con éxito!",
                    icon: "success",
                    confirmButtonText: "¡Aceptar!",
                  }).then(() => {
                   // window.location.reload();
                  });
                }else{
      //         window.location.reload();     
     }
  
        }
    });
    //Inicia validacion
    
    
    //Fin validacion
   
    }
    
    function guardar_pedido() {
  //  alert()
var tipo_servicio = document.getElementById('tipo_servicio').value;
var kg = document.getElementById('kg').value;
var largo = document.getElementById('largo').value;
var alto = document.getElementById('alto').value;
var direccion_destino = document.getElementById('direccion_destino').value;
var indicaciones = document.getElementById('indicaciones').value;
var hora_salida = document.getElementById('hora_salida').value;
var hora_entrega = document.getElementById('hora_entrega').value;
var observacion = document.getElementById('observacion').value;
var valor_cobrar = document.getElementById('valor_cobrar').value;
var valor_seguro = document.getElementById('valor_seguro').value;
var cliente = document.getElementById('cliente').value;
var destino = document.getElementById('destino').value;
var origen = document.getElementById('origen').value;
var ancho = document.getElementById('ancho').value;

var indicaciones = document.getElementById('indicaciones').value;
var hora_salida = document.getElementById('hora_salida').value;
var hora_llegada = document.getElementById('hora_entrega').value;

var telefono = document.getElementById('whatsapp').value;
alert(telefono)



 var codCheckbox = document.getElementById('cod');
            var cod = codCheckbox.checked ? '1' : '0';
            
             var codCheckbox = document.getElementById('seguro');
            var seguro = codCheckbox.checked ? '1' : '0';
//var cod = document.getElementById('cod').value;


  $.ajax({
        type: "POST",
        url: "../ajax/guardar_pedido.php",
        data: "cliente=" + cliente + "&tipo_servicio=" + tipo_servicio + "&kg=" + kg+ "&largo=" + largo+ "&alto=" + alto+ "&direccion_destino=" + direccion_destino + "&indicaciones=" + indicaciones+ "&hora_salida=" + hora_salida+ "&hora_entrega=" + hora_entrega+ "&observacion=" + observacion+ "&valor_cobrar=" + valor_cobrar+ "&valor_seguro=" + valor_seguro+ "&cod=" + cod+ "&seguro=" + seguro+ "&destino=" + destino+ "&origen=" + origen+ "&ancho=" + ancho+ "&indicaciones=" + indicaciones+ "&hora_salida=" + hora_salida+ "&hora_llegada=" + hora_llegada+ "&telefono=" + telefono,
        beforeSend: function(objeto) {
            $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
          //  alert(datos)
             $("#resultados").html(datos);
             if (datos == "ok") {
                
              // alert();
                  Swal.fire({
                    title: "¡Pedido ingresado con éxito!",
                    icon: "success",
                    confirmButtonText: "¡Aceptar!",
                  }).then(() => {
                   // window.location.reload();
                  });
                }else{
      //         window.location.reload();     
     }
  
        }
    });
    //Inicia validacion
    
    
    //Fin validacion
   
    }



      </script>
<!-- FIN -->
<script>
    // print order function
    
</script>



<?php require 'includes/footer_end.php'
?>
