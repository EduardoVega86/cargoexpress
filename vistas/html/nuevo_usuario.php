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
$sql="select * from users where id_users=$id_cliente";
$query = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_array($query)) {
    $prefijo = $row['prefijo'];
    $empresa = $row['empresa'];
    $representante = $row['represetante'];
    $cedula = $row['cedula'];
     $cedula_ruc = $row['cedula_ruc'];
     $url_cedula=$row['url_cedula_ruc'];
     $foto=$row['foto'];
   // $prefijo = $row['prefijo'];
}


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
                                   INFORMACIÓN DE CLIENTES
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
                                                            <div class="col-md-3">
                                                                <span class="help-block">Prefijo </span>
                                                                <input type="hidden" class="datos form-control" id="id_usuario" name="id_usuario" value="<?php echo $id_cliente;?>">
                                                                <input type="text" class="datos form-control" id="prefijo" name="prefijo" placeholder="" value="<?php echo $prefijo;?>" required>
                                                                </div>
                                                            <div class="col-md-3">
                                                                <span class="help-block">Nombre de la Empresa / Persona </span>
                                                                <input type="text" class="datos form-control" id="empresa" name="empresa" value="<?php echo $empresa;?>" placeholder="" required>
                                                                </div>
                                                            <div class="col-md-3">
                                                                <span class="help-block">Cédula / RUC / Pasaporte </span>
                                                                <input type="text" class="datos form-control" id="cedula" name="cedula" placeholder="" value="<?php echo $cedula;?>" required>
                                                                </div>
                                                            <div class="col-md-3">
                                                                <span class="help-block">Nombre del representante Legal </span>
                                                                <input type="text" class="datos form-control" id="representante" name="representante" placeholder="" value="<?php echo $representante;?>" required>
                                                                </div>
                                                            </div>
                                                    <div style="margin-top: 15px" class="row">
                                                        </br>
                                                           <div class="col-md-3">
                                                                <span class="help-block">CI </span>
                                                                <input style="width: 20px; height: 20px"  type="radio" id="ci" name="tipoidentificacion" value="1" <?php if ($cedula_ruc == 1) echo 'checked'; ?> onchange="radio(this)">
                                                                <span class="help-block">RUC </span>
                                                                <input style="width: 20px; height: 20px"  type="radio" id="ruc" name="tipoidentificacion" value="2" <?php if ($cedula_ruc == 2) echo 'checked'; ?> onchange="radio2(this)">
                                                                 <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" class="form-control" id="subir-ci-ruc" name="file" onchange="uploadFile()" placeholder="Subir PDF">
                <?php if (!empty($url_cedula)) { ?>
                    <a href="<?php echo htmlspecialchars($url_cedula); ?>" class="btn btn-primary ml-2" download>Descargar</a>
                <?php } ?>
            </div>
        </form>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span class="help-block">Subir Foto / Logo </span>
                                                                <form id="uploadForm2" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" class="form-control" id="subir-foto" name="file" onchange="uploadFile2()" placeholder="Subir PDF">
                <?php if (!empty($foto)) { ?>
                    <a href="<?php echo htmlspecialchars($foto); ?>" class="btn btn-primary ml-2" download>Descargar</a>
                <?php } ?>
            </div>
        </form>
                                                                </div>

                                                            </div>
                                                            
                                                                </div>
                                                 </div>
                                             </div>
                                         </div>

                                                      
                                                        <br>
                                                        <div class="row">
                                                             <div class="col-lg-12">
                                                                 
                                                     <H6><strong>Información de Matriz y Sucursales</strong></H6>   
                                                     </div>
                                                            <div class="col-lg-12">
                                                            <div class="table-responsive">
          <table class="table table-sm table-striped">
            <tr  class="info">
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Localidad</th>
                 <th>Responsable</th>
                 <th>Telefono</th>
                                                     <?php
                                                     $sql="select * from bodega where id_empresa=$id_cliente";
$query = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_array($query)) {
    

       $id          = $row['id'];
            $nombre      = $row['nombre'];
            $direccion      = $row['direccion'];
            $localidad = $row['localidad'];
            $responsable      = $row['responsable'];
            $contacto      = $row['contacto'];
     ?>
              <tr>
                    <td><span class="badge badge-purple"><?php echo $id; ?></span></td>
                   
               
                    <td ><?php echo $nombre; ?></td>
                    <td ><?php echo $direccion; ?></td>
                    <td ><?php echo $localidad; ?></td>
                    <td ><?php echo $responsable; ?></td>
                    <td ><?php echo $contacto; ?></td>
                    
                    
           </tr>                                              
     <?php
}
     // $prefijo = $row['prefijo'];
?>
           </table>
                  </div>
                 </div>
                                                            <div class="col-md-2">
                                                                <a style="height: 100%; width: 100%" href="agregar_bodega_empresa.php?id=<?php echo $id_cliente;?>" class="btn btn-primary">Agregar Sucursal</a>
                                                            </div>
                                                            </div>
                                                            <br>
                                                        <div class="row">
                                                            <!-- <div class="col-md-2">
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

                                                            </div> -->
                                                               <div class="col-md-6">
                                                     <H6><strong>INFORMACIÓN DE LOS SERVICIOS A LOS QUE ACCEDE</strong></H6>   
                                                                                                     
                                                               <?php
                                                     $sql="select * from servicios";
$query = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_array($query)) {
    $id_servicio      = $row['id_servicio'];
            $nombre_servicio      = $row['nombre_servicio'];

?>
                                                               
                                                                <input <?php 
                                                                
                                                                $sql_check = "SELECT * FROM servicios_empresa WHERE id_servicio = $id_servicio AND id_empresa = $id_cliente";
$result = mysqli_query($conexion, $sql_check);

if (mysqli_num_rows($result) > 0) { 
  echo 'checked';  
}    ?>

    style="width: 20px; height: 20px"  type="checkbox" id="servicio-express"  onchange="activar_servicio(<?php echo $id_servicio; ?>)"> <span class="help-block"><?php echo $nombre_servicio; ?></span>
                                                                <br>
            <?php                                                    
                  }
?>                 
                                                                
                                                                
                                                                
                                                          
                                                                </div>
                                                            <div class="col-md-6">
                                                     <H6><strong>PREFERENCIAS EN LAS NOTIFICACIONES</strong></H6>   
                                                                                                     
                                                               <?php
                                                     $sql="select * from notificaciones";
$query = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_array($query)) {
    $id_notificacion     = $row['id'];
            $notificacion      = $row['notificacion'];

?>
                                                               
                                                                <input <?php 
                                                                
                                                                $sql_check = "SELECT * FROM notificacion_cliente WHERE id_notificacion = $id_notificacion AND id_empresa = $id_cliente";
$result = mysqli_query($conexion, $sql_check);

if (mysqli_num_rows($result) > 0) { 
  echo 'checked';  
}    ?>

    style="width: 20px; height: 20px"  type="checkbox" id="servicio-express"  onchange="activar_notificacion(<?php echo $id_notificacion; ?>)"> <span class="help-block"><?php echo $notificacion; ?></span>
                                                                <br>
            <?php                                                    
                  }
?>                 
                                                                
                                                                
                                                                
                                                          
                                                                </div>
                                                                </div>
                                                            <div class="row">
                                                                <div class="" id="servicios_cliente">
                                                                    
                                                                </div>  
                                                            </div>
                                                                <br>
                                                        
                                                            <br>
                                                       <div class="row">
                                                    <H6><strong>Información Bancaria (para usuarios clientes que deseen cobranza contra entrega)</strong></H6> 
                                                            <div class="col-md-2">
                                                                <button style="height: 100%; width: 100%" onclick="agregar_sucursal(); " class="btn btn-primary">Agregar cuenta bancaria</button>
                                                            </div>
                                                            </div>
                                                            <br>
                                                        <div class="row">
                                                     
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

<!-- FIN -->




<script>
    document.getElementById('prefijo').addEventListener('change', function() {
        var prefijoValue = this.value;
        var otraVariable = 'valor2'; // Aquí puedes definir el valor de la segunda variable
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/actualizar_usuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'campo=prefijo' + '&valor=' + encodeURIComponent(prefijoValue) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
    });
    
     document.getElementById('empresa').addEventListener('change', function() {
        var prefijoValue = this.value;
        var otraVariable = 'valor2'; // Aquí puedes definir el valor de la segunda variable
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/actualizar_usuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'campo=empresa' + '&valor=' + encodeURIComponent(prefijoValue) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
    });
    
    document.getElementById('cedula').addEventListener('change', function() {
        var prefijoValue = this.value;
        var otraVariable = 'valor2'; // Aquí puedes definir el valor de la segunda variable
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/actualizar_usuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'campo=cedula' + '&valor=' + encodeURIComponent(prefijoValue) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
    });
    
    document.getElementById('representante').addEventListener('change', function() {
        var prefijoValue = this.value;
        var otraVariable = 'valor2'; // Aquí puedes definir el valor de la segunda variable
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/actualizar_usuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'campo=represetante' + '&valor=' + encodeURIComponent(prefijoValue) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
    });
    
    function radio(valor){
        var prefijoValue = 1;
        var otraVariable = 'valor2'; // Aquí puedes definir el valor de la segunda variable
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/actualizar_usuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'campo=cedula_ruc' + '&valor=' + encodeURIComponent(prefijoValue) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
    }
    
    function radio2(valor){
        var prefijoValue = 2;
        var otraVariable = 'valor2'; // Aquí puedes definir el valor de la segunda variable
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/actualizar_usuario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'campo=cedula_ruc' + '&valor=' + encodeURIComponent(prefijoValue) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
    }
    
    function uploadFile() {
            var formData = new FormData(document.getElementById('uploadForm'));
            formData.append('id_usuario', $('#id_usuario').val());
            $.ajax({
                url: '../ajax/subir_cedula.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#result').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#result').html('Error al subir el archivo: ' + textStatus);
                }
            });
        }
        
        function uploadFile2() {
            var formData = new FormData(document.getElementById('uploadForm2'));
            formData.append('id_usuario', $('#id_usuario').val());
            $.ajax({
                url: '../ajax/subir_foto.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#result').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#result').html('Error al subir el archivo: ' + textStatus);
                }
            });
        }
        
          function activar_servicio(servicio) {
         
             var servicio = servicio;
     
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/activar_servicio.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'servicio=' + encodeURIComponent(servicio) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
        }
        
        function activar_notificacion(notificacion) {
         
             var notificacion = notificacion;
     
 var id_usuario = $('#id_usuario').val(); 
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../ajax/activar_notificacion.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        };

        var params = 'notificacion=' + encodeURIComponent(notificacion) +  '&id_usuario=' + id_usuario;
        xhr.send(params);
        }
</script>


<?php require 'includes/footer_end.php'
?>