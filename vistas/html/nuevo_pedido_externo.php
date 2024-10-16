<?php
session_start();

/* Connect To Database */
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_GET['id'];
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup </title>
<style>
        /* Estilos para el popup */
        #popup {
            display: none; /* Oculto por defecto */
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            width: 1200px; 
            height: 600px; 
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Fondo oscuro detrás del popup */
        #popup-background {
            display: none; /* Oculto por defecto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
    </head>
    <body>
<div id="popup-background"></div>
<div id="popup">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGulcdBtz_Mydtmu432GtzJz82J_yb-rs&libraries=places"></script>
		<!-- Start popup -->
		<div class="content">
			<div class="container">
                            <h3 class="portlet-title">
							Agregar	Destinatario
                                                        <button class="btn btn-danger" onclick="colocarMarcadorUbicacionActual()">Usar ubicación actual</button>

							</h3>
<?php if ($permisos_ver == 1) {
    ?>
                             <div class="row">
                            <div class="col-md-4">
                                <form id="formularioDatos" method="post" action="../ajax/guardar_bodega.php">
       
				<div class="form-group row">
										<div class="col-md-12">
                                                                                    <?php if (@$rol == 1) {
                                                                                        
                                                                                    
    ?>
    <br>
                                                                                        <input id="nombre-sucursal" name="nombre-sucursal" class="form-control " type="text" placeholder="Nombre de la sucursal" required> <br>
</select>
                                                                <select class="form-control" id="direccion-ciudad" name="direccion-ciudad">
                                                                  <option value="">--Ciudad--</option>                                                                    
                                                                    <option value="">Quito</option>
                                                                     <option value="1">Guayaquil</option>
                                                                      <option value="">Cuenca</option>
                                                                       <option value="">Ambato</option>
                                                                </select>
                                                                                            <br>                                                                                            
                                                                                    <select  class='form-control' name='empresa' id='empresa' required>
												<option value="">-- Selecciona cliente--</option>
												<?php

    $query_categoria = mysqli_query($conexion, "select * from users where cargo_users=4 order by apellido_users;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
													<option value="<?php echo $rw['id_users']; ?>"><?php echo $rw['apellido_users']; ?></option>
													<?php
}
    ?>
											</select>
                                                                                                                                   <?php
                                                                                        
                                                                                    }else{
    ?>
                                                                                    <input id="empresa" name="empresa" class="form-control " type="hidden" value="<?php echo $user_id; ?>">
                                 <?php
                                                                                        
                                                                                    }
    ?>
                                                                                     <select class="form-control" id="ciudad_p" name="ciudad_p">
                                                                  <option value="">--Ciudad--</option>                                                                    
                                                                    <option value="Quito">Quito</option>
                                                                     <option value="Guayaquil">Guayaquil</option>
                                                                      <option value="Cuenca">Cuenca</option>
                                                                       <option value="Ambato">Ambato</option>
                                                                </select>
                                                                                    
											<br>
                                                                                        <input id="nombre" name="nombre" class="form-control " type="text" placeholder="Nombre" required>
                                                                                            <br>
                                                                                             <input id="direccion" name="direccion" class="form-control " type="text" placeholder="Dirección">
                                                                                             <br>
                                                                                             <div class="form-group row">
										<div class="col-md-12">
											<div class="input-group">
                                                                                           
                                                                                            <input readonly id="latitud" name="latitud" class="form-control" type="text" placeholder="Lat">
                                                                                            <input readonly id="longitud" name="longitud" class="form-control" type="text" placeholder="Long">   
                                                                                    </div>
                                                                                    </div>
                                       </div>
                                                                                           <!-- <select onchange="cambio_provincia()" class='form-control' name='provincia' id='provincia' required>
												<option value="">-- Selecciona Provincia--</option> -->
												<?php 

    $query_categoria = mysqli_query($conexion, "select distinct provincia, codigo_provincia from localidad order by codigo_parroquia;");
    while ($rw = mysqli_fetch_array($query_categoria)) {
        ?>
												<!--	<option value="<?php echo $rw['codigo_provincia']; ?>"><?php echo $rw['provincia']; ?></option>
													<?php
}
    ?>
											</select>
                                                                                          <br> 
                                                                                          <!-- <div id="div_canton">
                                                                                             <!-- <select   class='form-control' name='canton' id='canton' required>
												<option value="">-- Selecciona Cantón--</option>
												
											</select>   
                                                                                            </div>
                                                                                          <br> 
                                                                                          <div id="div_parroquia">
                                                                                              <select   class='form-control' name='parroquia' id='parroquia' required>
												<option value="">-- Selecciona Parroquia--</option>
												
											</select>   
                                                                                            </div> --> 
                                                                                            <input readonly id="direccion_completa" name="direccion_completa" class="form-control" type="hidden" placeholder="Ingresa una dirección">
                                                                                             <input readonly id="telefono" name="telefono" class="form-control " type="text" placeholder="Telefono">
                                                                                            <br>
                                                                                              <input readonly id="referencia" name="referencia" class="form-control " type="text" placeholder="Referencia"> 
                                                                                            <div class="input-group">
                                                                                            
													<?php
                                                                                                        //echo '<h2>'. get_row('edificio', 'nombre', 'id_edificio', $id_edificio).'</h2>';
                                                                                                        ?>
												</div>
                                                                                    	</div>
                                    </div>
                                   
                                                                                   <div class="form-group row">
										<div class="col-md-12">
											<div class="input-group">
                                                                                      
                                                                                               
                                                                                    </div>
											</div>
											
											

										</div>
                                    <div class="form-group row">
										<div class="col-md-12">
											<div class="input-group">
                                                    
                                                    <input class="btn btn-primary" type="button" onclick="guardar_origen()" id=id="save-popup" value="Guardar Origen">
    
                                                                                            <input class="btn btn-warning" onclick="guardar_destino()" type="button" onclick="" id=id="save-popup" value="Guardar Destino">  
                                                                                             <input class="btn btn-danger" onclick="cerrar()" type="button" onclick="" id=id="save-popup" value="X">  
                                                                                               
                                                                                    </div>
											</div>
											
											

										</div>
      
        </form>
                            </div>  
                            <div class="col-md-8">                      
  <div id="mapa" style="height: 100%;"></div>
  <div id="infoDireccion"></div>
</div>  
                                 </div>  
  <script>
    // Inicializar el mapa
    function initMap() {
      var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 0, lng: -78},
        zoom: 7
      });

      var geocoder = new google.maps.Geocoder();
      var infowindow = new google.maps.InfoWindow();

      // Autocompletado de direcciones
      var input = document.getElementById('direccion');
      //alert(input);
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      // Crear un marcador inicial
      var marker = new google.maps.Marker({
        position: {lat: 0, lng: -78},
        map: map,
        draggable: true // Hacer el marcador arrastrable
      });

      // Al seleccionar una dirección, centrar el mapa en esa ubicación y colocar el marcador
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
       
        if (!place.geometry) {
          window.alert("No se encontraron detalles de la dirección: '" + place.name + "'");
          return;
        }

        map.setCenter(place.geometry.location);
        map.setZoom(15);

        marker.setPosition(place.geometry.location);

        // Obtener la dirección mediante geocodificación inversa
        geocoder.geocode({'location': place.geometry.location}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent('Dirección: ' + results[0].formatted_address);
              infowindow.open(map, marker);
             
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });

      // Al mover el marcador, obtener la nueva dirección
      marker.addListener('dragend', function() {
        var latlng = marker.getPosition();

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent('Dirección: ' + results[0].formatted_address);
              infowindow.open(map, marker);
               var latitud = results[0].geometry.location.lat();
      var longitud = results[0].geometry.location.lng();
      alert(latlng)
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGulcdBtz_Mydtmu432GtzJz82J_yb-rs&libraries=places&callback=initMap"></script>

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
      <script>
    // Inicializar el mapa
    function initMap() {
      var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 0, lng: -78},
        zoom: 7
      });

      var geocoder = new google.maps.Geocoder();
      var infowindow = new google.maps.InfoWindow();

      // Autocompletado de direcciones
      var input = document.getElementById('direccion');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      // Crear un marcador inicial
      var marker = new google.maps.Marker({
        position: {lat: 0, lng: -78},
        map: map,
        draggable: true // Hacer el marcador arrastrable
      });

      // Al seleccionar una dirección, centrar el mapa en esa ubicación y colocar el marcador
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("No se encontraron detalles de la dirección: '" + place.name + "'");
          return;
        }

        map.setCenter(place.geometry.location);
        map.setZoom(15);

        marker.setPosition(place.geometry.location);

        // Obtener la dirección mediante geocodificación inversa
        geocoder.geocode({'location': place.geometry.location}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent('Dirección: ' + results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });

      // Al mover el marcador, obtener la nueva dirección
      marker.addListener('dragend', function() {
        var latlng = marker.getPosition();

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent( results[0].formatted_address);
              infowindow.open(map, marker);
              var latitud = results[0].geometry.location.lat();
      var longitud = results[0].geometry.location.lng();
      $("#latitud").val(latitud);
      $("#longitud").val(longitud);
           direccionCompleta=  results[0].formatted_address
           $("#direccion_completa").val(direccionCompleta);
var addressComponents = direccionCompleta.split(',');

// Obtener la penúltima parte (posiblemente el código postal)
var penultimatePart = addressComponents[addressComponents.length - 2].trim();

// Verificar si la penúltima parte es un código postal (puedes ajustar la expresión regular según el formato)
//var codigoPostal = /^\d{6}$/.test(penultimatePart) ? penultimatePart : '';
let ultimosSeisSubstring = penultimatePart.substring(penultimatePart.length - 6);
// Mostrar el código postal
 $("#localidad").val(ultimosSeisSubstring);
$('#localidad, #direccion_completa, #latitud, #longitud, #referencia, #numero_casa, #nombre_contacto, #telefono').prop('readonly', false);
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-OWe4vKRnRiHQEx2ANZqxIGBT8z6Fo0&libraries=places&callback=initMap"></script>
	<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="../../js/bodegas.js"></script>
<script>
 

      </script>
      <script type="text/javascript">
      
        
    
    
    // Función para colocar un marcador en la ubicación actual del usuario
function colocarMarcadorUbicacionActual() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var map = new google.maps.Map(document.getElementById('mapa'), {
        center: pos,
        zoom: 15
      });

      // Crea el objeto Geocoder
      var geocoder = new google.maps.Geocoder();

      var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title: "Arrástrame para seleccionar una ubicación",
        draggable: true // Hace el marcador arrastrable
      });

      // InfoWindow inicial (vacío hasta que se complete el arrastre)
      var infowindow = new google.maps.InfoWindow();

      // Actualiza la dirección cuando el usuario termine de arrastrar el marcador
          marker.addListener('dragend', function() {
        var latlng = marker.getPosition();

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent( results[0].formatted_address);
              infowindow.open(map, marker);
              var latitud = results[0].geometry.location.lat();
      var longitud = results[0].geometry.location.lng();
      $("#latitud").val(latitud);
      $("#longitud").val(longitud);
           direccionCompleta=  results[0].formatted_address
           $("#direccion_completa").val(direccionCompleta);
var addressComponents = direccionCompleta.split(',');

// Obtener la penúltima parte (posiblemente el código postal)
var penultimatePart = addressComponents[addressComponents.length - 2].trim();

// Verificar si la penúltima parte es un código postal (puedes ajustar la expresión regular según el formato)
//var codigoPostal = /^\d{6}$/.test(penultimatePart) ? penultimatePart : '';
let ultimosSeisSubstring = penultimatePart.substring(penultimatePart.length - 6);
// Mostrar el código postal
 $("#localidad").val(ultimosSeisSubstring);
$('#localidad, #direccion_completa, #latitud, #longitud, #referencia, #numero_casa, #nombre_contacto, #telefono').prop('readonly', false);
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      });

      // Evento de clic en el marcador para abrir el InfoWindow con la dirección actual
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      });

      // Geocodificación inversa inicial para obtener y mostrar la dirección
      geocoder.geocode({'location': pos}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
            infowindow.setContent('<div><strong>Tu ubicación actual:</strong><br>' + results[0].formatted_address + '</div>');
            infowindow.open(map, marker);
          }
        }
      });

      map.setCenter(pos);
    }, function() {
      handleLocationError(true, map.getCenter());
    });
  } else {
    // El navegador no soporta Geolocalización
    handleLocationError(false, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, pos) {
  console.log(browserHasGeolocation ?
                'Error: El servicio de Geolocalización falló.' :
                'Error: Tu navegador no soporta geolocalización.');
}
      </script>			
			<!-- end popup -->
</div>
</body>
</html>
<!-- Begin page -->
<div id="wrapper" class="forced enlarged"> <!-- DESACTIVA EL MENU -->
  

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
                                    Nuevo Envío
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
                                                  
                                                         <H6><strong>REMITENTE</strong></H6>
                                                         <div class="row">
                                                         <div class="col-md-2">
                                                             
                                                                <span class="help-block">Nombre del Remitente </span>
                                                                <input type="text" class="datos form-control" id="nombre_remitente" name="nombre_remitente" placeholder="Ingrese el nombre del destinatario" required>
                                                                </div>                                                            
                                                            <div class="col-md-2">
                                                                <span class="help-block">Ciudad </span>                                                                
                                                                <input type="text" class="datos form-control" id="ciudad_remitente" name="ciudad_remitente" placeholder="Ciudad" required>
                                                                </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Teléfono Remitente </span>
                                                                <input type="text" class="datos form-control" id="contacto_remitente" name="contacto_remitente" placeholder="Whatsapp" required>
                                                                </div>
                                                             <div class="col-md-2">
                                                                <span class="help-block">Direccion Remitente </span>
                                                                <input type="text" class="datos form-control" id="direccion_remitente" name="direccion_remitente" placeholder="Direccion" required>
                                                                </div>
                                                                </div>
                                                         
                                                           <br>
                                                           <H6><strong>DESTINATARIO</strong></H6>
                                                    
                                                        

                                                         <div class="row">
                                                            <div class="col-md-2">
                                                              
                                                                <?php
                                                                //echo "select * from bodega where id_empresa=$empresa";
                                                                ?>
                                                                
                                                                <input type="hidden" class="form-control" id="session" name="session" value="<?php echo $session_id; ?>">
                                                                <input type="hidden" class="form-control" id="cliente" name="cliente" value="<?php echo $empresa; ?>">
                                                                
                                                                <input type="hidden" class="form-control" id="id_camion" name="id_camion" value="">
                                                                <input type="hidden" class="form-control" id="latitud_destinatario" name="latitud_destinatario" value="">
                                                                <input type="hidden" class="form-control" id="longitud_destinatario" name="longitud_destinatario" value="">
                                                           
                                                            <input type="hidden" class="form-control" id="latitud_remitente" name="latitud_remitente" value="">
                                                                <input type="hidden" class="form-control" id="longitud_remitente" name="longitud_remitente" value="">
                                                                
                                                          
                                                                <span class="help-block">Nombre del Destinatario </span>
                                                                <input type="text" class="datos form-control" id="nombre_destinatario" name="nombre_destinatario" placeholder="Ingrese el nombre del destinatario" required>
                                                                </div>                                                            
                                                            <div class="col-md-2">
                                                                <span class="help-block">Ciudad </span>                                                                
                                                                <input type="text" class="datos form-control" id="ciudad_destinatario" name="ciudad_destinatario" placeholder="Ciudad" required>
                                                                </div>
                                                            <div class="col-md-2">
                                                                <span class="help-block">Teléfono Destinatario </span>
                                                                <input type="text" class="datos form-control" id="contacto_destinatario" name="contacto_destinatario" placeholder="Whatsapp" required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                <span class="help-block">Dirección Destinatario </span>
                                                            <input type="text" class="form-control" id="direccion_destino" name="direccion_destino" value=""><!-- comment -->
                                                             </div>
                                                            
                                                            <div class="col-md-2">
														<button type="button" class="btn btn-success waves-effect waves-light" id="show-popup"><i class="fa fa-plus"></i> Nuevo</button>
													</div>
                                                         </div>
                                                            </div>
                                                            <br>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <span class="help-block">Tipo de servicio </span>
                                                                <?php
                                                                 
                                                                    ?>
                                                                <select onchange="calcular_distancia(); " class="form-control" id="tipo_servicio" name="tipo_servicio">
                                                                    <option value="">Seleccione servicio</option>
                                                                    <?php
                                                                    $sql2 = "select * from servicios_empresa se, servicios s where se.id_servicio=s.id_servicio and id_empresa=$empresa";
                                                                    echo $sql2;
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
                                                              <input onblur="calcular_distancia(); " type="number" class="datos form-control" id="kg" name="kg" placeholder="Kg" required>  

                                                            </div>
                                                            
                                                            
                                                            
                                                           <div class="col-md-4">
                                                                <span class="help-block">Indicaciónes</span>
                                                                <input id="observacion" name="observacion" class="form-control " type="text" placeholder="Ingresa una observacion">
                                                                </div>                                                            
                                                            </div>
                                                        <br>
                                                        <div class="row">                                                        
                                                                                                                        
                                                          
                                                          
                                                        
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
                                                                
                                                            
                                                                 <input  class="form-control" id="resultado_valor"  style="font-size:30px; background-color: #F2DEDE" name="resultado_valor" placeholder="Valor" readonly> 
                                                            </div>
                                                            <div class="col-md-2">
                                                                
                                                            
                                                                 <input  class="form-control" id="resultado_distancia" style="font-size:30px; background-color: #F2DEDE" name="resultado_distancia" placeholder="Distancia" readonly> km
                                                            </div>
                                                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
<script type="text/javascript" src="../../js/cotizacion.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAj-OWe4vKRnRiHQEx2ANZqxIGBT8z6Fo0&libraries=places&callback=initMap"></script>
<script>
    // Mostrar el popup cuando se hace clic en el botón "Mostrar Popup"
    document.getElementById('show-popup').onclick = function() {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('popup-background').style.display = 'block';
    };

    // Cerrar el popup cuando se hace clic en el botón "Cerrar"
    document.getElementById('save-popup').onclick = function() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('popup-background').style.display = 'none';
    };
    
    function guardar_origen() {
       document.getElementById('popup').style.display = 'none';
       document.getElementById('popup-background').style.display = 'none'; 
       
       ciudad=$("#ciudad_p").val()
         $("#nombre_remitente").val($("#nombre").val());
          $("#ciudad_remitente").val(ciudad);
            $("#direccion_remitente").val($("#direccion").val()+" "+$("#referencia").val());
            $("#latitud_remitente").val($("#latitud").val());
            $("#longitud_remitente").val($("#longitud").val());
            $("#contacto_remitente").val($("#telefono").val());
          //  alert(ciudad)
           
            
            
    }
    function guardar_destino() {
       document.getElementById('popup').style.display = 'none';
       document.getElementById('popup-background').style.display = 'none';  
       ciudad=$("#ciudad_p").val()
        $("#nombre_destinatario").val($("#nombre").val());
            $("#direccion_destino").val($("#direccion").val()+" "+$("#referencia").val());
            $("#latitud_destinatario").val($("#latitud").val());
            $("#longitud_destinatario").val($("#longitud").val());
            $("#contacto_destinatario").val($("#telefono").val());
            $("#ciudad_destinatario").val(ciudad);
       
       
    }
    function cerrar() {
       document.getElementById('popup').style.display = 'none';
       document.getElementById('popup-background').style.display = 'none';  
    }
</script>
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
         
           // var valor = document.getElementById('latitu').value;
  
            origen_lat=$("#latitud_remitente").val();
            origen_lon=$("#longitud_remitente").val();

            destino_lat=$("#latitud_destinatario").val();
            destino_lon=$("#longitud_destinatario").val();
            
            cliente=$("#cliente").val();
            
            
                 var tipo_servicio = document.getElementById('tipo_servicio').value;
        var kg = document.getElementById('kg').value;
       
        
        
         var codCheckbox = document.getElementById('cod');
            var cod = codCheckbox.checked ? '1' : '0';
            
             var codCheckbox = document.getElementById('seguro');
            var seguro = codCheckbox.checked ? '1' : '0';
          var valor_seguro = document.getElementById('valor_seguro').value;
          var valor_cobrar = document.getElementById('valor_cobrar').value;
      
      
           //alert(origen_lat)
            
    // Verificar si alguna coordenada está vacía
if (!origen_lat || !origen_lon || !destino_lat || !destino_lon) {
    Swal.fire({
        title: "Error",
        text: "Por favor, complete las coordenadas de origen y destino.",
        icon: "error",
        confirmButtonText: "Aceptar"
    });
    
    
    
    
}else{
    

            
        var origin = {lat: parseFloat(origen_lat), lng: parseFloat(origen_lon)};
var destination = {lat: parseFloat(destino_lat), lng: parseFloat(destino_lon)};

            var service = new google.maps.DistanceMatrixService();

            service.getDistanceMatrix({
                origins: [origin],
                destinations: [destination],
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.METRIC
            }, function(response, status) {
                if (status === 'OK') {
                    var results = response.rows[0].elements[0];
                    if (results.status === 'OK') {
                        var distance = results.distance.text;
                       // alert('La distancia por carretera es: ' + distance);
                         $("#resultado_distancia").val(distance);
                        // alert(distance);
    $.ajax({
        type: "POST",
        url: "../ajax/calcular_pedido_externo.php",
        data: "tipo_servicio=" + tipo_servicio + "&kg=" + kg + "&cod=" + cod+ "&seguro=" + seguro+ "&valor_seguro=" + valor_seguro+ "&valor_cobrar=" + valor_cobrar+ "&origen_lat=" + origen_lat+ "&origen_lon=" + origen_lon+ "&destino_lat=" + destino_lat+ "&destino_lon=" + destino_lon+ "&distance=" + distance+ "&cliente=" + cliente,
        beforeSend: function(objeto) {
            $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
            ///alert(datos)
          
              
                $("#resultado_valor").val(datos);
                
               
  
        }
    });
    
                    } else {
                        alert('No se pudo obtener la distancia: ' + results.status);
                    }
                } else {
                    alert('Error en la solicitud: ' + status);
                }
            });
            
            }
            
        
    
      
   
      
    
  }
     

        
 
    
  function guardar_origen1(cliente) {
    var origen = $("#origen").val();

    $.ajax({
        url: '../ajax/datos_origen.php', // Cambia esto por la ruta a tu script PHP
        type: 'POST',
        data: { origen: origen },
        success: function(response) {
            var data = JSON.parse(response);

            // Asignar los valores a los campos de entrada con jQuery
            //alert(data.localidad);
            $("#nombre_destinatario").val(data.responsable);
            $("#direccion_destino").val(data.direccion);
            $("#latitud_destinatario").val(data.latitud);
            $("#longitud_destinatario").val(data.longitud);
            $("#contacto_destinatario").val(data.contacto);
            $("#ciudad_destinatario").val(data.localidad);
        },
        error: function(xhr, status, error) {
            console.error('Error en la petición AJAX: ' + error);
        }
    });
}
  
  function guardar_destino1(cliente) {
    var origen = $("#destino").val();

    $.ajax({
        url: '../ajax/datos_origen.php', // Cambia esto por la ruta a tu script PHP
        type: 'POST',
        data: { origen: origen },
        success: function(response) {
            var data = JSON.parse(response);

            // Asignar los valores a los campos de entrada con jQuery
            //alert(data.longitud);
            $("#nombre_remitente").val(data.responsable);
            $("#direccion_remitente").val(data.direccion);
            $("#latitud_remitente").val(data.latitud);
            $("#longitud_remitente").val(data.longitud);
            $("#contacto_remitente").val(data.contacto);
            $("#ciudad_remitente").val(data.localidad);
        },
        error: function(xhr, status, error) {
            console.error('Error en la petición AJAX: ' + error);
        }
    });
}

    function guardar_pedido() {
  //  alert()
  
  var cliente=$("#cliente").val();
            
            
var tipo_servicio = document.getElementById('tipo_servicio').value;
var peso = document.getElementById('kg').value;
    origen_lat=$("#latitud_remitente").val();
            origen_lon=$("#longitud_remitente").val();
           destino_lat=$("#latitud_destinatario").val();
            destino_lon=$("#longitud_destinatario").val();
            
            
var nombre_origen = document.getElementById('nombre_remitente').value;
var ciudad_origen = document.getElementById('ciudad_remitente').value;
var telefono_origen = document.getElementById('contacto_remitente').value;
var direccion_origen = document.getElementById('direccion_remitente').value;

var nombre_destinatario = document.getElementById('nombre_destinatario').value;
var ciudad_destinatario = document.getElementById('ciudad_destinatario').value;
var contacto_destinatario = document.getElementById('contacto_destinatario').value;
var direccion_destino = document.getElementById('direccion_destino').value;

var observacion = document.getElementById('observacion').value;

var valor= $("#resultado_valor").val();
var distancia= $("#resultado_distancia").val();

var destino= $("#origen").val();
var origen= $("#destino").val();


//alert(telefono)


  var codCheckbox = document.getElementById('cod');
            var cod = codCheckbox.checked ? '1' : '0';
            
             var codCheckbox = document.getElementById('seguro');
            var seguro = codCheckbox.checked ? '1' : '0';

 var valor_seguro = document.getElementById('valor_seguro').value;
          var valor_cobrar = document.getElementById('valor_cobrar').value;
          

  $.ajax({
        type: "POST",
        url: "../ajax/guardar_pedido_externo.php",
        data: "cliente=" + cliente + "&tipo_servicio=" + tipo_servicio 
        + "&id_bodega_origen=" + origen+ "&id_bodega_destino=" + destino
                + "&ciudad_origen=" + ciudad_origen+ "&origen_lat=" + origen_lat 
        + "&origen_lon=" + origen_lon+ "&nombre_origen=" + nombre_origen 
                + "&telefono_origen=" + telefono_origen+ "&direccion_origen=" + direccion_origen
                + "&destino_lat=" + destino_lat+ "&destino_lon=" + destino_lon
                + "&ciudad_destinatario=" + ciudad_destinatario+ "&nombre_destinatario=" + nombre_destinatario
                + "&contacto_destinatario=" + contacto_destinatario+ "&direccion_destino=" + direccion_destino
                + "&valor=" + valor+  "&peso=" + peso
        + "&cod=" + cod+  "&seguro=" + seguro
      + "&valor_seguro=" + valor_seguro+  "&valor_cobrar=" + valor_cobrar
       + "&tipo_servicio=" + tipo_servicio+  "&observacion=" + observacion+  "&distancia=" + distancia,
        beforeSend: function(objeto) {
            $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
                
                
        success: function(datos) {
          //  alert(datos)
             $("#resultados").html(datos);
            // alert(datos)
             if (datos ==1) {
                
           //  alert();
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
