<?php
/*-------------------------
Autor: Eduardo Vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id = session_id();
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP
require_once "../funciones.php";


$user_id  = $_SESSION['id_users'];
if (!empty($_POST['tipo_servicio'])  and !empty($_POST['cliente'])) {
    // consulta para comparar el stock con la cantidad resibida
   
if (isset($_POST['tipo_servicio'])) {$id_tipo_servicio = $_POST['tipo_servicio'];}
if (isset($_POST['cantidad'])) {$cantidad = $_POST['cantidad'];}
if (isset($_POST['precio_venta'])) {$precio_venta = $_POST['precio_venta'];}
if (isset($_POST['descripcion_libre'])) {$descripcion_libre = $_POST['descripcion_libre'];}
if (isset($_POST['cod'])) {$cod = $_POST['cod'];}
if (isset($_POST['seguro'])) {$seguro = $_POST['seguro'];}
if (isset($_POST['cliente'])) {$cliente = $_POST['cliente'];}
if (isset($_POST['destino'])) {$destino = $_POST['destino'];}
 $origen = $_POST['origen'];  
 
 @$latitud_origen= get_row('bodega', 'latitud', 'id', $origen);
@$longitud_origen= get_row('bodega', 'longitud', 'id', $origen);
@$localidad_origen= get_row('bodega', 'localidad', 'id', $origen);

@$latitud_destino= get_row('bodega', 'latitud', 'id', $destino);
@$longitud_destino= get_row('bodega', 'longitud', 'id', $destino);
@$localidad_destino= get_row('bodega', 'localidad', 'id', $destino);

$valor=100;

$largo = $_POST['largo'];
$alto = $_POST['alto'];
$kg = $_POST['kg'];
$ancho = $_POST['ancho'];

$telefono = $_POST['telefono'];



$indicaciones = $_POST['indicaciones'];

$referencia = $_POST['observacion'];

$destinatario = $_POST['destinatario'];

  if($cod==1){
    $valor_cobrar = $_POST['valor_cobrar'];    
    }else{
     $valor_cobrar=0;   
    }
    
    if($seguro==1){
    $valor_seguro = $_POST['valor_seguro'];    
    }else{
     $valor_seguro=0;   
    }
    
        $sql_pedido="INSERT INTO `pedidos` ( `tipo`, `id_bodega_origen`, "
                . "`id_bodega_destino`, `origen_localidad`, `origen_lat`, "
                . "`origen_lon`, `destino_lat`, `destino_lon`, "
                . "`destino_localidad`, `valor`, "
                . "`peso`, `alto`, "
                . "`largo`, `ancho`, `contraentrega`, "
                . "`valor_cobrar`, `valor_seguro`, `id_tipo_servicio`, "
                . "`id_driver`, `estado`,  "
                . "`indicaciones`,   `telefono_destinatario`,"
                . "`referencias_adicionales`, `nombre_destinatario`, `id_cliente`) VALUES "
                . "('$id_tipo_servicio','$origen',"
                . "'$destino','$localidad_origen','$latitud_origen',"
                . "'$longitud_origen','$latitud_destino','$longitud_destino',"
                . "'$localidad_destino','$valor',"
                . "'$kg','$alto',"
                . "'$largo','$ancho','$cod',"
                . "'$valor_cobrar','$valor_seguro','$id_tipo_servicio',"
                . "'0','1',"
                . "'$indicaciones','$telefono',"
                . "'$referencia','$destinatario','$cliente')";
      // echo $sql_pedido;
        $insert_tmp = mysqli_query($conexion, $sql_pedido);
        $id_pedido = mysqli_insert_id($conexion);
        


echo 1;
  
       

       // echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
    

}

//$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>

