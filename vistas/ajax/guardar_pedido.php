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
   
$tipo_servicio = $_POST['tipo_servicio'];

$peso = $_POST['peso'];
$cliente = $_POST['cliente'];


$id_bodega_origen = $_POST['id_bodega_origen'];
$id_bodega_destino = $_POST['id_bodega_destino'];

$ciudad_origen = $_POST['ciudad_origen'];
$origen_lat = $_POST['origen_lat'];
$origen_lon = $_POST['origen_lon'];
$nombre_origen = $_POST['nombre_origen'];
$telefono_origen = $_POST['telefono_origen'];
$direccion_origen = $_POST['direccion_origen'];

$destino_lat = $_POST['destino_lat'];
$destino_lon = $_POST['destino_lon'];
$ciudad_destinatario = $_POST['ciudad_destinatario'];
$nombre_destinatario = $_POST['nombre_destinatario'];
$contacto_destinatario = $_POST['contacto_destinatario'];
$direccion_destino = $_POST['direccion_destino'];
$valor = $_POST['valor'];
$peso = $_POST['peso'];
$cod = $_POST['cod'];
$seguro = $_POST['seguro'];
$valor_seguro = $_POST['valor_seguro'];
$valor_cobrar = $_POST['valor_cobrar'];
$observacion = $_POST['observacion'];
$distancia = $_POST['distancia'];



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
    
        $sql_pedido="INSERT INTO `pedidos` (`id_cliente`, `id_bodega_origen`, "
                . "`id_bodega_destino`, `origen_ciudad`, `origen_lat`, "
                . "`origen_lon`, `origen_nombre`, `origen_telefono`, "
                . "`origen_direccion`, `destino_lat`, `destino_lon`, "
                . "`destino_ciudad`, `destino_nombre`, `destino_telefono`, "
                . "`destino_direccion`, `valor_pedido`, `peso`, "
                . "`contraentrega`, `seguro`, `valor_cobrar`, "
                . "`valor_seguro`, `id_tipo_servicio`, `id_driver`, `distancia`, "
                . "`estado`,  `indicaciones`, "
                . " `hora_pedido`) VALUES "
                . "($cliente, $id_bodega_origen, "
                . "$id_bodega_destino, '$ciudad_origen', '$origen_lat', "
                . "'$origen_lon', '$nombre_origen', '$telefono_origen', "
                . "'$direccion_origen', '$destino_lat', '$destino_lon', "
                . "'$ciudad_destinatario', '$nombre_destinatario', '$contacto_destinatario',"
                . " '$direccion_destino', '$valor', '$peso', "
                . "'$cod', '$seguro', '$valor_cobrar',"
                . " '$valor_seguro', '$tipo_servicio', '0','$distancia', "
                . "'1',  '$observacion',  current_timestamp());";
       //echo $sql_pedido;
        $insert_tmp = mysqli_query($conexion, $sql_pedido);
        $id_pedido = mysqli_insert_id($conexion);
        


echo 1;
  
       

       // echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
    

}

//$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>

