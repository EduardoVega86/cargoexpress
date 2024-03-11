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
if (isset($_POST['id'])) {$id_empresa = $_POST['id'];}

if (isset($_POST['valor'])) {$precio_venta = $_POST['valor'];}
if (isset($_POST['origen'])) {$origen = $_POST['origen'];}
if (isset($_POST['destino'])) {$destino = $_POST['destino'];}
if (isset($_POST['estibadores'] )) {$estibadores = $_POST['estibadores'];}

if($estibadores==""){
   $estibadores=0; 
}
if (isset($_POST['tonelaje'])) {$tonelaje = $_POST['tonelaje'];}
if (isset($_POST['observacion'])) {$observaciones = $_POST['observacion'];}
if (isset($_POST['id_camion'])) {$id_camion = $_POST['id_camion']; $estado=2;}
if($id_camion==""){
   $estado=1; 
}
$user_id  = $_SESSION['id_users'];
if (!empty($id_empresa)  and !empty($precio_venta)) {
    // consulta para comparar el stock con la cantidad resibida
   
  $origen_lat= get_row('bodega', 'latitud', 'id', $origen);
  $origen_lon= get_row('bodega', 'longitud', 'id', $origen);
  $localidad_origen= get_row('bodega', 'localidad', 'id', $origen);
  
  $destino_lat= get_row('bodega', 'latitud', 'id', $destino);
  $destino_lon= get_row('bodega', 'longitud', 'id', $destino);
  $localidad_destino= get_row('bodega', 'localidad', 'id', $destino);
$total=$precio_venta+$estibadores;
    $fecha    = date("Y-m-d H:i:s");
    
        $sql_pedido="INSERT INTO pedido (`id_cliente`,`fecha_pedido`, `id_bodega_origen`, `id_bodega_destino`, `origen_localidad`, `origen_lat`, `origen_lon`, `destino_lat`, `destino_lon`, `destino_localidad`, `total`, `tonelaje`, `estado`, `id_usuario`, `observacion`) "
                . "VALUES ('$id_empresa','$fecha', '$origen','$destino','$localidad_origen','$origen_lat','$origen_lon','$destino_lat','$destino_lon','$localidad_destino','$total','$tonelaje','$estado','$user_id','$observaciones')";
       //echo $sql_pedido;
        $insert_tmp = mysqli_query($conexion, $sql_pedido);
        $id_pedido = mysqli_insert_id($conexion);
        
        $sql            = mysqli_query($conexion, "select * from  tmp_cotizacion where  tmp_cotizacion.session_id='" . $session_id . "' order by id_tmp");
$numero=0;
while ($row = mysqli_fetch_array($sql)) {
     $origen_localidad   = $row["origen_localidad"];
    $destino_localidad   = $row["destino_localidad"];
    $tipo = $row['tipo'];
    $precio_tmp   = $row['precio_tmp'];
    $desc_tmp   = $row['desc_tmp'];
     $sql_detalle="INSERT INTO detalle_pedido (`tipo`, `id_pedido`, `origen_localidad`, `destino_localidad`, `precio`, `desc_detalle`) "
                . "VALUES ($tipo, '$id_pedido','$origen_localidad','$destino_localidad','$precio_tmp','$desc_tmp')";
       //echo $sql_detalle;
        $insert_tmp = mysqli_query($conexion, $sql_detalle);
}

$delete = mysqli_query($conexion, "DELETE FROM tmp_cotizacion WHERE session_id='" . $session_id . "'");
   

if ($estado==2){
    $insert_prima = mysqli_query($conexion, "UPDATE camiones  set disponible=0 where id=$id_camion");
     $insert_prima = mysqli_query($conexion, "INSERT INTO creditos VALUES (NULL,'$id_pedido','$fecha','$id_empresa','$user_id','$total','$total','1','$user_id','1')");
     $insert_abono = mysqli_query($conexion, "INSERT INTO creditos_abonos VALUES (NULL,'$id_pedido','$fecha','$id_empresa','$total','0','$total','$user_id','1','CREDITO INICAL')");
}

echo 'ok';
  
       

       // echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
    

}

//$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>

