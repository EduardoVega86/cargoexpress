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
    $sTable   = "servicios_edificio, servicios";
    $sWhere   = "where servicios_edificio.id_servicio=servicios.id_servicio and id_edificio=".$_REQUEST['id_producto'];
    
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
                    
                    <th class='text-center'>SERVICIO</th>
                    <th class='text-center' style="width: 36px;"></th>
                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
     $id_stock     = $row['id_servicio_edificio'];
            $servicio     = $row['nombre_servicio'];
          
            
            ?>
                    <tr>
                       
                            <td><?php echo $servicio; ?></td>
                      
                        
                        
                        
                        
                        
                        <td class='text-center'>
                        <a class='btn btn-danger' href="#" title="Eliminar Stock" onclick="eliminar_stock('<?php echo $id_stock ?>')"><i class="fa fa-trash"></i>
                        </a>
                        </td>
                    </tr>
                    <?php
}
        ?>
             
              </table>
            </div>
            <?php


// fin else

?>