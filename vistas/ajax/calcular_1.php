<?php
/*-------------------------

---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id = session_id();
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP
require_once "../funciones.php";
if (isset($_POST['tipo_servicio'])) {$id_tipo_servicio = $_POST['tipo_servicio'];}
if (isset($_POST['cantidad'])) {$cantidad = $_POST['cantidad'];}
if (isset($_POST['precio_venta'])) {$precio_venta = $_POST['precio_venta'];}
if (isset($_POST['descripcion_libre'])) {$descripcion_libre = $_POST['descripcion_libre'];}
if (isset($_POST['cod'])) {$cod = $_POST['cod'];}
if (isset($_POST['seguro'])) {$seguro = $_POST['seguro'];}
if (isset($_POST['cliente'])) {$cliente = $_POST['cliente'];}
if (isset($_POST['destino'])) {$destino = $_POST['destino'];}
//echo $descripcion_libre;
if (!empty($id_tipo_servicio)) {
    
    
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
    
    $origen = $_POST['origen'];   
    
    // consulta para comparar el stock con la cantidad resibida
  //  $id_stock=$_POST['id_stock'];  
   // echo "select stock_producto,inv_producto from productos,stock_lote where productos.id_producto=stock_lote.id_producto and id_stock ='$id_stock'"; 

    //Comprobamos si agregamos un producto a la tabla tmp_compra
    
@$latitud_origen= get_row('bodega', 'latitud', 'id', $origen);
@$longitud_origen= get_row('bodega', 'longitud', 'id', $origen);
@$localidad_origen= get_row('bodega', 'localidad', 'id', $origen);

@$latitud_destino= get_row('bodega', 'latitud', 'id', $destino);
@$longitud_destino= get_row('bodega', 'longitud', 'id', $destino);
@$localidad_destino= get_row('bodega', 'localidad', 'id', $destino);
@$valor_calculado=100;
$desc_tmp=0;
$largo = $_POST['largo'];
$alto = $_POST['alto'];
$kg = $_POST['kg'];
$ancho = $_POST['ancho'];

           $sql= "INSERT INTO `tmp_cotizacion` ( `tipo`, `id_bodega_origen`, `id_bodega_destino`, `origen_localidad`, `origen_lat`, "
                   . "`origen_lon`, `destino_lat`, `destino_lon`, `destino_localidad`,"
. " `valor`, `desc_tmp`, `session_id`, `peso`, `alto`, `largo`, `ancho`, `contraentrega`, `valor_cobrar`, `valor_seguro`) "
    . "VALUES ($id_tipo_servicio, '$origen', '$destino', '$localidad_origen', '$latitud_origen', '$longitud_origen', '$latitud_destino', '$longitud_destino',"
                   . " '$localidad_destino', '$valor_calculado', '$desc_tmp', '$session_id', '$kg', '$alto', '$largo', '$ancho', '$cod', '$valor_cobrar', '$valor_seguro')";
          // echo $sql; 
           $insert_tmp = mysqli_query($conexion, $sql);
            echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
       
        // fin codicion cantaidad
    

}
if (isset($_GET['id'])) //codigo elimina un elemento del array
{
    $id_tmp = intval($_GET['id']);
    $delete = mysqli_query($conexion, "DELETE FROM tmp_ventas WHERE id_tmp='" . $id_tmp . "'");
}
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>
<div class="table-responsive">
    <table  class="table table-sm">
        <thead class="thead-default">
            <tr>
               
                <th class='text-center'>ALTO.</th>
                <th class='text-center'>LARGO.</th>
                <th class='text-center'>PESO</th>
                  <th class='text-center'>ANCHO</th>
                <th class='text-center'>VALOR</th>
                <th class='text-center'>COD</th>
                <th class='text-center'>SEGURO</th>
                 <th class='text-center'>TOTAL A COBRAR</th>
                <th style="font-size: 9px" class='text-center'>ELIMINAR</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
          
          //echo $id_stock;
$impuesto       = get_row('perfil', 'impuesto', 'id_perfil', 1);
$nom_impuesto   = get_row('perfil', 'nom_impuesto', 'id_perfil', 1);
$sumador_total  = 0;
$total_iva      = 0;
$total_impuesto = 0;
$subtotal       = 0;
//echo "select * from productos, tmp_ventas, stock_lote where productos.id_producto=stock_lote.id_producto and productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'";
$sql            = mysqli_query($conexion, "select * from  tmp_cotizacion where session_id='" . $session_id . "'");
while ($row = mysqli_fetch_array($sql)) {
    $id_tmp          = $row["id_tmp"];
    $peso          = $row["peso"];
    $alto = $row['alto'];
    $largo    = $row['largo'];
    $ancho        = $row['ancho'];
    $valor        = $row['valor'];
    $valor_cobrar     = $row['valor_cobrar'];
   
   
  // echo 'imp'.$impuesto_unitario.'<br>';
    ?>
    <tr>
        <td class='text-center'><?php echo $peso; ?></td>
        <td class='text-center'><?php echo $alto; ?></td>
        <td class='text-center'><?php echo $largo; ?></td>
        <td class='text-center'><?php echo $ancho; ?></td>
        <td class='text-center'><?php echo $valor; ?></td>
                  <td class='text-center'><?php echo $valor_cobrar; ?></td>
         <td class='text-center'><?php echo $valor_seguro; ?></td>

        
        
      
        <td class='text-center'>
            <a href="#" class='btn btn-danger btn-sm waves-effect waves-light' onclick="eliminar('<?php echo $id_tmp ?>')"><i class="fa fa-remove"></i>
            </a>
        </td>
    </tr>
    <?php
}
$total_factura = $valor + $valor_cobrar+$valor_seguro;

?>
<tr>
    <td class='text-center' colspan=6>SUBTOTAL</td>
    <td class='text-center'><b><?php echo $simbolo_moneda . ' ' . number_format($total_factura, 2); ?></b></td>
    <td></td>
</tr>
<tr>
    <td class='text-center' colspan=5><?php echo $nom_impuesto; ?> (<?php echo $impuesto; ?>)% </td>
    <td class='text-center'><?php echo $simbolo_moneda . ' ' . number_format($total_impuesto, 2); ?></td>
    <td></td>
</tr>
<tr>
    <td style="font-size: 14pt;" class='text-center' colspan=5><b>TOTAL <?php echo $simbolo_moneda; ?></b></td>
    <td style="font-size: 16pt;" class='text-center'><span class="label label-danger"><b><?php echo number_format($total_factura, 2); ?></b></span></td>
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
        url: "../ajax/editar_desc_venta.php",
        data: "id_tmp=" + id_tmp + "&desc=" + desc,
        success: function(datos) {
           $("#resultados").load("../ajax/agregar_tmp.php");
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
            url: "../ajax/editar_precio_venta.php",
            data: "id_tmp=" + id_tmp + "&precio=" + precio,
            success: function(datos) {
               $("#resultados").load("../ajax/agregar_tmp.php");
               $.Notification.notify('success','bottom center','EXITO!', 'PRECIO ACTUALIZADO CORRECTAMENTE')
           }
       });
    });

    });
</script>