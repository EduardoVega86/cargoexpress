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
if (isset($_POST['estibadores'])) {$estibadores = $_POST['estibadores'];}
if (isset($_POST['tonelaje'])) {$tonelaje = $_POST['tonelaje'];}

if (!empty($id_empresa)  and !empty($precio_venta)) {
    // consulta para comparar el stock con la cantidad resibida
   
  $origen_lat= get_row('bodega', 'latitud', 'id', $origen);
  $origen_lon= get_row('bodega', 'longitud', 'id', $origen);
  $localidad_origen= get_row('bodega', 'localidad', 'id', $origen);
  
  $destino_lat= get_row('bodega', 'latitud', 'id', $destino);
  $destino_lon= get_row('bodega', 'longitud', 'id', $destino);
  $localidad_destino= get_row('bodega', 'localidad', 'id', $destino);

    //Comprobamos si agregamos un producto a la tabla tmp_compra
    $comprobar = mysqli_query($conexion, "select * from tmp_cotizacion where session_id ='$session_id'");
    if ($row = mysqli_fetch_array($comprobar)) {
        //$cant = $row['cantidad_tmp'] + $cantidad;
// condicion si el stock e menor que la cantidad requerida
        $sql          = "delete from tmp_cotizacion  WHERE  session_id='" . $session_id . "'";
        $query_update = mysqli_query($conexion, $sql);
        
         $sql_flete="INSERT INTO tmp_cotizacion (`tipo`, `id_bodega_origen`, `id_bodega_destino`, `origen_localidad`, `origen_lat`, `origen_lon`, `destino_lat`, `destino_lon`, `destino_localidad`, `precio_tmp`, `desc_tmp`, `session_id`, `tonelaje`) "
                . "VALUES (1, '$origen','$destino','$localidad_origen','$origen_lat','$origen_lon','$destino_lat','$destino_lon','$localidad_destino','$precio_venta','0','$session_id','$tonelaje')";
       //echo $sql_flete;
        $insert_tmp = mysqli_query($conexion, $sql_flete);
        if($estibadores!=""){
           $sql_flete="INSERT INTO tmp_cotizacion (`tipo`, `id_bodega_origen`, `id_bodega_destino`, `origen_localidad`, `origen_lat`, `origen_lon`, `destino_lat`, `destino_lon`, `destino_localidad`, `precio_tmp`, `desc_tmp`, `session_id`, `tonelaje`) "
                . "VALUES (2, '','','','','','','','','$estibadores','0','$session_id','$tonelaje')";
       //echo $sql_flete;
        $insert_tmp = mysqli_query($conexion, $sql_flete); 
        }
        
        echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
    } else {
        $sql_flete="INSERT INTO tmp_cotizacion (`tipo`, `id_bodega_origen`, `id_bodega_destino`, `origen_localidad`, `origen_lat`, `origen_lon`, `destino_lat`, `destino_lon`, `destino_localidad`, `precio_tmp`, `desc_tmp`, `session_id`, `tonelaje`) "
                . "VALUES (1, '$origen','$destino','$localidad_origen','$origen_lat','$origen_lon','$destino_lat','$destino_lon','$localidad_destino','$precio_venta','0','$session_id','$tonelaje')";
       //echo $sql_flete;
        $insert_tmp = mysqli_query($conexion, $sql_flete);
        if($estibadores!=""){
           $sql_flete="INSERT INTO tmp_cotizacion (`tipo`, `id_bodega_origen`, `id_bodega_destino`, `origen_localidad`, `origen_lat`, `origen_lon`, `destino_lat`, `destino_lon`, `destino_localidad`, `precio_tmp`, `desc_tmp`, `session_id`, `tonelaje`) "
                . "VALUES (2, '','','','','','','','','$estibadores','0','$session_id','$tonelaje')";
       //echo $sql_flete;
        $insert_tmp = mysqli_query($conexion, $sql_flete); 
        }

        echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
    }

}
if (isset($_GET['id'])) //codigo elimina un elemento del array
{
    $id_tmp = intval($_GET['id']);
    $delete = mysqli_query($conexion, "DELETE FROM tmp_cotizacion WHERE id_tmp='" . $id_tmp . "'");
}
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>
<div class="table-responsive">
    <table class="table table-sm">
        <thead class="thead-default">
            <tr>
                <th class='text-center'>COD</th>
               
                <th class='text-center'>DESCRIP.</th>
                <th class='text-center'>PRECIO <?php echo $simbolo_moneda; ?></th>
                <th class='text-center'>DESC %</th>
                <th class='text-right'>TOTAL</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
$impuesto       = get_row('perfil', 'impuesto', 'id_perfil', 1);
$nom_impuesto   = get_row('perfil', 'nom_impuesto', 'id_perfil', 1);
$sumador_total  = 0;
$total_iva      = 0;
$total_impuesto = 0;
$subtotal       = 0;
//echo "select * from  tmp_cotizacion where  tmp_cotizacion.session_id='" . $session_id . "'";
$sql            = mysqli_query($conexion, "select * from  tmp_cotizacion where  tmp_cotizacion.session_id='" . $session_id . "' order by id_tmp");
$numero=0;
while ($row = mysqli_fetch_array($sql)) {
    $id_tmp          = $row["id_tmp"];
    $origen_localidad   = $row["origen_localidad"];
    $destino_localidad   = $row["destino_localidad"];
   // $codigo_producto = $row['codigo_producto'];
    //$id_producto     = $row['id_producto'];
    //$cantidad        = $row['cantidad_tmp'];
    //$desc_tmp        = $row['desc_tmp'];
    $tipo = $row['tipo'];
    if($tipo==1){
        $descripcion='TRANSPORTE: '.get_row('localidad', 'parroquia', 'codigo_parroquia', $origen_localidad).'-'.get_row('localidad', 'parroquia', 'codigo_parroquia', $destino_localidad);
    }else{
       $descripcion='ESTIBADORES'; 
    }
   // if($tipo)
    //$nombre_producto = $row['nombre_producto'];

    $precio_tmp   = $row['precio_tmp'];
    $desc_tmp   = $row['desc_tmp'];
    
    $precio_venta_f = $precio_tmp; //Formateo variables
    $precio_venta_r = str_replace(",", "", $precio_venta_f); //Reemplazo las comas
    $precio_total   = $precio_venta_r;
    $final_items    = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
    /*--------------------------------------------------------------------------------*/
    
    
   /*--------------------------------------------------------------------------------*/
     $impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
        $valor= (0/100)+1;
	$precio_venta=$final_items;
	$precio_venta_f=$precio_venta;//Formateo variable
	$precio_venta_r1=str_replace(",","",$precio_venta_f);//Reemplazo las comas  
        //PRECIO DESGLOSADO
        $precio_venta_desglosado=$precio_venta_r1/$valor;
        $impuesto_unitario=$precio_venta_f-$precio_venta_desglosado;
    /*--------*/
    $precio_total_f = number_format($final_items, 2); //Precio total formateado
    $precio_total_r = str_replace(",", "", $precio_total_f); //Reemplazo las comas
    $sumador_total += $precio_venta_desglosado; //Sumador
    $final_items = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
    $subtotal    = number_format($sumador_total, 2, '.', '');
  /*  if ($row['iva_producto'] == 1) {
        $total_iva = $impuesto_unitario;
    } else {
        $total_iva = iva($precio_venta_desglosado);
    }*/
    //$total_impuesto += rebajas($subtotal, $desc_tmp) * $cantidad;
    $total_impuesto=$total_impuesto+$impuesto_unitario;
    
    
    /*------------------------*/
    ?>
    <tr>
        <td class='text-center'><?php echo $numero; ?></td>
        <td class='text-center'><?php echo $descripcion; ?></td>
        
        <td class='text-center'>
            <div class="input-group">
                <input type="text" class="form-control" style="text-align:center" value="<?php echo number_format($precio_tmp,2); ?>" id="<?php echo $id_tmp; ?>">   
            </div>
        </td>
        <td align="right" width="15%">
                <input type="text" class="form-control txt_desc" style="text-align:center" value="<?php echo $desc_tmp; ?>" id="<?php echo $id_tmp; ?>">
        </td>
        <td class='text-right'><?php echo $simbolo_moneda . ' ' . number_format($final_items, 2); ?></td>
        <td class='text-center'>
            <a href="#" class='btn btn-danger btn-sm waves-effect waves-light' onclick="eliminar('<?php echo $id_tmp ?>')"><i class="fa fa-remove"></i>
            </a>
        </td>
    </tr>
    <?php
    $numero++;
}
$total_factura = $subtotal + $total_impuesto;
?>
<tr>
    <td class='text-right' colspan=5>SUBTOTAL</td>
    <td class='text-right'><b><?php echo $simbolo_moneda . ' ' . number_format($subtotal, 2); ?></b></td>
    <td></td>
</tr>
<tr>
    <td class='text-right' colspan=5><?php echo $nom_impuesto; ?> (<?php echo $impuesto; ?>)% </td>
    <td class='text-right'><?php echo $simbolo_moneda . ' ' . number_format($total_impuesto, 2); ?></td>
    <td></td>
</tr>
<tr>
    <td style="font-size: 14pt;" class='text-right' colspan=5><b>TOTAL <?php echo $simbolo_moneda; ?></b></td>
    <td style="font-size: 16pt;" class='text-right'><span class="label label-danger"><b><?php echo number_format($total_factura, 2); ?></b></span></td>
    <td></td>
</tr>
</tbody>
</table>
</div>
<script>
    $(document).ready(function () {
        $('.txt_desc').off('blur');
        $('.txt_desc').on('blur',function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
        // if(keycode == '13'){
            id_tmp = $(this).attr("id");
            desc = $(this).val();
             //Inicia validacion
             if (isNaN(desc)) {
                $.Notification.notify('error','bottom center','ERROR', 'DIGITAR UN DESCUENTO VALIDO')
                $(this).focus();
                return false;
            }
    //Fin validacion
    $.ajax({
        type: "POST",
        url: "../ajax/editar_desc_cot.php",
        data: "id_tmp=" + id_tmp + "&desc=" + desc,
        success: function(datos) {
           $("#resultados").load("../ajax/agregar_tmp_cot.php");
           $.Notification.notify('success','bottom center','EXITO!', 'DESCUENTO ACTUALIZADO CORRECTAMENTE')
       }
   });
        // }
    });
     $(".employee_id").on("change", function(event) {
         id_tmp = $(this).attr("id");
        precio = $(this).val();
        $.ajax({
            type: "POST",
            url: "../ajax/editar_precio_cot.php",
            data: "id_tmp=" + id_tmp + "&precio=" + precio,
            success: function(datos) {
               $("#resultados").load("../ajax/agregar_tmp_cot.php");
               $.Notification.notify('success','bottom center','EXITO!', 'PRECIO ACTUALIZADO CORRECTAMENTE')
           }
       });
    });

    });
</script>