<?php
/*-------------------------
Autor: Delmar Lopez
Web: www.digitalsolution.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';

if ($action == 'agrega') {
    $servicio= $_REQUEST['servicio'];
   
    $id_edificio=$_REQUEST['id_producto'];
    
   $sql = "INSERT INTO `servicios_edificio` (`id_servicio`, `id_edificio`) VALUES "
           . " ('$servicio', '$id_edificio')";
   //echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Gasto ha sido ingresado con Exito.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        } 
}
if ($action == 'elimina') {
   
    $id_stock=$_REQUEST['id_stock'];
    
   $sql = "delete from `servicios_edificio` where id_servicio_edificio=".$id_stock;
   //echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Gasto ha sido ingresado con Exito.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        } 
}

    // escaping, additionally removing everything that could be (html/javascript-) code
  
    //$q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    //$aColumns = array(); //Columnas de busqueda
    $sTable   = "historial_pedido";
    $sWhere   = "where  id_pedido=".$_REQUEST['id_pedido']." order by fecha desc";
    
    include 'pagination.php'; //include pagination file
    //pagination variables
    
    //Count the total number of row in your table*/
   
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere ";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data


        ?>
<div style="padding-left: 10px; padding-right: 10px" class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <tr  class="info">
                    
                    <th class='text-center'>OBSERVACION</th>
                    <th class='text-center'>FECHA</th>
                    <th class='text-center'>ESTADO</th>
                    <th class='text-center' style="width: 36px;">PDF</th>
                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
     $id_stock     = $row['id_historial'];
            $observacion     = $row['observacion'];
            $imagen     = $row['imagen'];
            
            $fecha     = $row['fecha'];
            $estado     = $row['id_estado'];
            $estado_nombre= get_row('estados', 'estado', 'id_estado', $estado)
          
            
            ?>
                    <tr>
                       
                            <td><?php echo $observacion; ?></td>
                            <td ><span style="font-size: 12px"><?php echo $fecha; ?></span></td>
                             <td ><span style="font-size: 12px"><?php echo $estado_nombre; ?></span></td>
                            <td><?php if($imagen!='') {?><a href="<?php echo $imagen; ?>" target="blank"><img width="30px" src="../img/descargar.png" alt=""/><?php }?></a></td>
                      
                    </tr>
                    <?php
}
        ?>
             
              </table>
            </div>
            <?php


// fin else

?>