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

$id_cliente = $_GET['id'];
//echo $id_cliente;
$nombre = get_row('users', 'nombre_users', 'id_users', $id_cliente).' '.get_row('users', 'apellido_users', 'id_users', $id_cliente);


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
                                   REGISTRAR ESTADO
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
                                    include "../modal/registro_cliente.php";
                                    include "../modal/registro_producto.php";
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-box">
                                                <div class="widget-chart">
                                                    <H5><strong><?php echo get_row('users', 'nombre_users', 'id_users', $id_cliente).' '.get_row('users', 'apellido_users', 'id_users', $id_cliente); ?></strong></H5>
                                                    
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <span class="help-block">Estado </span>
                                                                <input type="text" class="datos form-control" id="mensajero-estado" name="mensajero-estado" placeholder="" required>
                                                                </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Comentario </span>
                                                                <input type="text" class="datos form-control" id="mensajero-comentario" name="mensajero-comentario" placeholder="" required>
                                                                </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Subir Foto </span>
                                                                <input type="file" class="datos form-control" id="mensajero-subir-foto" name="mensajero-subir-foto" placeholder="" required>
                                                                </div>
                                                           <div class="col-md-2">
                                                                <span class="help-block">Efectivo </span>
                                                                <input style="width: 20px; height: 20px; margin-top: 30px"  type="radio" id="mensajero-efectivo" name="mensajero-efectivo" onchange="toggleInput(this)">
                                                                <span class="help-block">Transferencia </span>
                                                                <input style="width: 20px; height: 20px; margin-top: 30px"  type="radio" id="mensajero-transferencia" name="mensajero-transferencia" onchange="toggleInput(this)">
                                                            </div>
                                                           

                                                            </div>
                                                            
                                                                </div>
                                                 </div>
                                             </div>
                                         </div>
                                                       <!--  <div class="row">
                                                     <H6><strong>Información de Matriz y Sucursales</strong></H6>   
                                                     <br><br>                                                            
                                                            <div class="col-md-2">
                                                                <button style="height: 100%; width: 100%" onclick="agregar_sucursal(); " class="btn btn-primary">Agregar Sucursal</button>
                                                            </div>
                                                            </div>
                                                            <br>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                 <span class="help-block">Hora de entrega </span>
                                                                <input type="time" class="datos form-control" id="hora_entrega" name="hora_entrega" placeholder="Hora de entrega (Opcional)">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Referencias adicionales </span>
                                                                <input type="text" class="datos form-control" id="observacion" name="observacion" placeholder="Referencias Adicionales (Opcional)">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Cobro contra entrega </span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="cobroce" onchange="toggleInput(this)">
                                                                <input type="number" class="form-control" id="alto" placeholder="Valor a Cobrar"> 

                                                            </div> 
                                                     <H6><strong>INFORMACIÓN DE LOS SERVICIOS A LOS QUE ACCEDE</strong></H6>   
                                                     <br><br>
                                                         <div class="col-md-12">
                                                                <span class="help-block">Servicio Express </span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-express" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Servicio Ilimitado</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-ilimitado" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Servicio Básico</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-basico" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Servicio Delivery</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-delivery" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Servicio Especial</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-especial" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Interprovincial</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-interprovincial" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Interprovincial Express</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-interprovincial-express" onchange="toggleInput(this)">
                                                                </div>
                                                                </div>
                                                            <div class="row">
                                                                <div class="" id="servicios_cliente">
                                                                    
                                                                </div>  
                                                            </div>
                                                                <br>
                                                        <div class="row">
                                                    <H6><strong>PREFERENCIAS EN LAS NOTIFICACIONES</strong></H6> 
                                                         <div class="col-md-10">
                                                                <span class="help-block">Entrega (cuando el mensajero registre la entrega)</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-express" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Alerta envío (cuando el mensajero notifique la novedad)</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-ilimitado" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Envío no efectivo (cuando el mensajero registre la novedad)</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-basico" onchange="toggleInput(this)">
                                                                </div>
                                                         <div class="col-md-10">
                                                                <span class="help-block">Retiro (cuando el mensajero registre el retiro)</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-delivery" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Alerta retiro (cuando el mensajero notifique la novedad)</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-especial" onchange="toggleInput(this)">
                                                                <span class="help-block">&nbsp;&nbsp;&nbsp;Retiro no efectivo (cuando el mensajero registre la novedad)</span>
                                                                <input style="width: 20px; height: 20px"  type="checkbox" id="servicio-interprovincial" onchange="toggleInput(this)">
                                                                </div>
                                                            </div>
                                                            <br>
                                                       <div class="row">
                                                    <H6><strong>Información Bancaria (para usuarios clientes que deseen cobranza contra entrega)</strong></H6> 
                                                            <div class="col-md-2">
                                                                <button style="height: 100%; width: 100%" onclick="agregar_sucursal(); " class="btn btn-primary">Agregar cuenta bancaria</button>
                                                            </div>
                                                            </div>
                                                            <br> -->
                                                        <div class="row">
                                                     <div class="col-md-2">
                                                                
                                                                <button style="height: 100%; width: 100%" onclick="agregar_cliente();" class="btn btn-primary">Guardar </button>

                                                            </div>
                                                </div>
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
<!-- ============================================================== -->
<!-- Codigos Para el Auto complete de Clientes -->
<script>
     function calcular_distancia() {
    var origen = (-0.1763603, -78.47949419999999) 
var destino = (-78.503773, -0.1329112) 
resultado = gmaps.distance_matrix(origen, destino, mode='driving')


distancia = resultado['rows'][0]['elements'][0]['distance']['text']
alert(distancia)
  }
     function agregar_pedido() {
    var valor = document.getElementById('valor').value;
    var estibadores = document.getElementById('estibadores').value;
    var origen = document.getElementById('origen').value;
    var destino = document.getElementById('destino').value;
    var cliente = document.getElementById('cliente').value;
    var tonelaje = document.getElementById('tonelaje').value;
    //Inicia validacion
    if (isNaN(valor)) {
        $.Notification.notify('error', 'bottom center', 'NOTIFICACIÓN', 'LA CANTIDAD NO ES UN NUMERO, INTENTAR DE NUEVO')
        document.getElementById('valor').focus();
        return false;
    }
    if (isNaN(estibadores)) {
        $.Notification.notify('error', 'bottom center', 'NOTIFICACIÓN', 'EL PRECIO NO ES UN NUMERO, INTENTAR DE NUEVO')
        document.getElementById('estibadores').focus();
        return false;
    }
    //Fin validacion
    $.ajax({
        type: "POST",
        url: "../ajax/agregar_tmp_modalcot.php",
        data: "id=" + cliente + "&valor=" + valor + "&estibadores=" + estibadores+ "&origen=" + origen+ "&destino=" + destino+ "&tonelaje=" + tonelaje + "&operacion=" + 2,
        beforeSend: function(objeto) {
            $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
            $("#resultados").html(datos);
            $.ajax({
        type: "POST",
        url: "../ajax/buscar_camion_disponible.php",
        data: "tonelaje=" + tonelaje,
        
        success: function(datos_disponibles) {
            $("#disponibles").html(datos_disponibles);
        }
    });
        }
    });
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
    //Inicia validacion
    
    
    //Fin validacion
    $.ajax({
        type: "POST",
        url: "../ajax/guardar_pedido.php",
        data: "id=" + cliente + "&valor=" + valor + "&estibadores=" + estibadores+ "&origen=" + origen+ "&destino=" + destino+ "&tonelaje=" + tonelaje + "&observacion=" + observacion+ "&id_camion=" + id_camion,
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
function seleccionarUnico(checkboxSeleccionado, id_camion) {
    // Obtener todos los checkboxes con el nombre 'filaSeleccionada'
    //alert(id_camion)
     $('#id_camion').val(id_camion);
    var checkboxes = document.getElementsByName('filaSeleccionada');
    
    // Recorrer todos los checkboxes y deseleccionar todos excepto el que fue seleccionado
    for(var i=0; i < checkboxes.length; i++) {
        if(checkboxes[i] !== checkboxSeleccionado) {
            checkboxes[i].checked = false;
        }
    }
}

$(function () {
                                                                                                                                                $("#nombre_cliente").autocomplete({
                                                                                                                                                    source: "../ajax/autocomplete/clientes.php",
                                                                                                                                                    minLength: 2,
                                                                                                                                                    select: function (event, ui) {
                                                                                                                                                        event.preventDefault();
                                                                                                                                                        $('#id_cliente').val(ui.item.id_cliente);
                                                                                                                                                        $('#nombre_cliente').val(ui.item.nombre_cliente);
                                                                                                                                                        $('#tel1').val(ui.item.fiscal_cliente);
                                                                                                                                                        $('#em').val(ui.item.email_cliente);
                                                                                                                                                        $.Notification.notify('success', 'bottom right', 'EXITO!', 'CLIENTE AGREGADO CORRECTAMENTE')
                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                            });

                                                                                                                                            $("#nombre_cliente").on("keydown", function (event) {
                                                                                                                                                if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
                                                                                                                                                    $("#id_cliente").val("");
                                                                                                                                                    $("#tel1").val("");
                                                                                                                                                    $("#em").val("");
                                                                                                                                                }
                                                                                                                                                if (event.keyCode == $.ui.keyCode.DELETE) {
                                                                                                                                                    $("#nombre_cliente").val("");
                                                                                                                                                    $("#id_cliente").val("");
                                                                                                                                                    $("#tel1").val("");
                                                                                                                                                    $("#em").val("");
                                                                                                                                                }
                                                                                                                                            });
</script>
<!-- FIN -->
<script>
    // print order function
    function printFactura(id_factura) {
        $('#modal_vuelto').modal('hide');
        if (id_factura) {
            $.ajax({
                url: '../pdf/documentos/imprimir_cotizacion.php',
                type: 'post',
                data: {
                    id_factura: id_factura
                },
                dataType: 'text',
                success: function (response) {
                    var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>Facturación</title>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');
                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10
                    mywindow.print();
                    mywindow.close();
                } // /success function

            }); // /ajax function to fetch the printable order
        } // /if orderId
    } // /print order function
</script>
<script>
    function obtener_caja(user_id) {
        $(".outer_div3").load("../modal/carga_caja.php?user_id=" + user_id); //carga desde el ajax
    }
</script>
<script>
    function showDiv(select) {
        if (select.value == 4) {
            $("#resultados3").load("../ajax/carga_prima.php");
        } else {
            $("#resultados3").load("../ajax/carga_resibido.php");
        }
    }

    function cargar_provincia_pedido() {

        var id_provincia = $('#provinica').val();
        //alert($('#provinica').val())
        //var data = new FormData(formulario);

        $.ajax({
            url: "../../../ajax/cargar_ciudad_pedido.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: {
                provinica: id_provincia,

            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'text', // To send DOMDocument or non processed data file it is set to false
            success: function (data) // A function to be called if request succeeds
            {



                $('#div_ciudad').html(data);


            }
        });

    }
    
  
</script>

<script>
        document.getElementById('prefijo').addEventListener('change', function() {
            var inputValue = this.value;
alert(inputValue);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'actualizar_usuario.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Respuesta del servidor:', xhr.responseText);
                }
            };

            xhr.send('valor=' + encodeURIComponent(inputValue));
        });
    </script>

<?php require 'includes/footer_end.php'
?>
