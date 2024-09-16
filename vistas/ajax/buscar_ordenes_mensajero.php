<?php

/*-------------------------
Autor: Delmar Lopez
Web: softwys.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP
include "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Productos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q            = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    //$id_categoria = intval($_REQUEST['categoria']);
    $aColumns     = array('destinatario'); //Columnas de busqueda
    $sTable       = "pedidos";
    if ($user_id !=1) {
    $sWhere       = "where estado != 4 and estado != 6 and id_driver=$user_id";
    $busqueda1 = "";
    }
    else {
    $sWhere       = "";
    $busqueda1 = "where  id_driver=$user_id";
    }
    if ($_GET['q'] != "") {
        $sWhere = "$busqueda1 (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';

    }

    $sWhere .= " order by id_pedido desc";

    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row         = mysqli_fetch_array($count_query);
    $numrows     = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../html/productos.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
        ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped">
            <tr  class="info">
                <th>ID</th>
                <th>Destinatario</th>
                <th>Origen</th>
                <th>Destino</th>
                 <th>Estado</th>
                 <th>Mensajero</th>
                 <th>Fecha</th>
                 
               
                             
                <th class='text-right'>Acciones</th>

            </tr>
            <?php
while ($row = mysqli_fetch_array($query)) {
            $id          = $row['id_pedido'];
            $nombre      = $row['destino_nombre'];
            $origen     = $row['id_bodega_origen'];
            $destino = $row['id_bodega_destino'];
         
            $telefono      = $row['destino_telefono'];
            $fecha      = $row['fecha'];
            $id_estado      = $row['estado'];
            
            $id_driver      = $row['id_driver'];
            
            $fecha      = $row['fecha'];
            
           $estado= get_row('estados', 'estado', 'id_estado', $id_estado);
            
            //$id_imp_producto      = $row['id_imp_producto'];
           /* if ($status_producto == 1) {
                $estado = "<span class='badge badge-success'>Activo</span>";
            } else {
                $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }*/
            $direccion_origen= $row['origen_direccion'];
            $direccio_destino= $row['destino_direccion'];
                    
                    if($id_driver==0){
                     $driver='NO ASIGNADO'  ; 
                    }else{
                      $driver= get_row('users', 'nombre_users', 'id_users', $id_driver).' '.get_row('users', 'apellido_users', 'id_users', $id_driver) ;   
                    }
            ?>

               
                <input type="hidden" value="<?php echo $nombre; ?>" id="nombre<?php echo $id; ?>">
                <input type="hidden" value="<?php echo $origen; ?>" id="direccion<?php echo $id; ?>">
                <input type="hidden" value="<?php echo $destino; ?>" id="telefono<?php echo $id; ?>">
                <input type="hidden" value="<?php echo $estado; ?>" id="fecha<?php echo $id; ?>">
                <input type="hidden" value="<?php echo $id; ?>" id="id_pedido<?php echo $id; ?>">
                
                <tr>
                    <td><span class="badge badge-purple"><?php echo $id; ?></span></td>
                   
               
                    <td ><?php echo $nombre; ?></td>
                    <td ><?php echo $direccion_origen; ?></td>
                    <td ><?php echo $direccio_destino; ?></td>
                    <td ><?php echo $estado; ?></td>
                    <td ><?php echo $driver; ?></td>
                    <td ><?php echo $fecha; ?></td>
                    
                    <td >

                      <div class="btn-group dropdown pull-right">
                        <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <?php if (1 == 1) {?>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevaLinea" onclick="obtener_datos('<?php echo $id; ?>');"><i class='fa fa-edit'></i> Cambiar estado</a>
                           <?php }
            if ($permisos_editar == 1) {?>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#stock_ad" onclick="servicio_id(<?php echo $id_edificio; ?>)" data-id="<?php echo $id_edificio; ?>"><i class='fa fa-edit'></i> Servicios</a>
                           <!--<a class="dropdown-item" href="historial.php?id=<?php echo $id_producto; ?>"><i class='fa fa-calendar'></i> Historial</a>-->
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_edificio; ?>"><i class='fa fa-trash'></i> Anular</a>
                           
                           <?php }
            ?>


                       </div>
                   </div>

               </td>
           </tr>
           <?php
}
        ?>
       <tr>
        <td colspan=12><span class="pull-right">
            <?php
echo paginate($reload, $page, $total_pages, $adjacents);
        ?></span></td>
        </tr>
    </table>
</div>
<?php
}
//Este else Fue agregado de Prueba de prodria Quitar
    else {
        ?>
    <div class="alert alert-warning alert-dismissible" role="alert" align="center">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Aviso!</strong> No hay Registro de Producto
  </div>
  <?php
}
// fin else
}
?>
