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
    $id_categoria = intval($_REQUEST['categoria']);
    $aColumns     = array('nombre', 'direccion'); //Columnas de busqueda
    $sTable       = "proceso";
    $sWhere       = "";
    if ($id_categoria > 0) {
        $sWhere .= " ";
    }
    if ($_GET['q'] != "") {
        $sWhere = "WHERE(";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';

    }

    $sWhere .= " order by nombre asc";

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
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
        ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped">
            <tr  class="info">
                <th>ID</th>
                <th></th>
                <th></th>
                <th>Cliente</th>
                <th>Proceso</th>
                
                <th>Fecha Contrato</th>
                <th>Días</th>
                 
               
                    <th>Subprocesos</th>
                
                <th class='text-right'>Acciones</th>

            </tr>
            <?php
while ($row = mysqli_fetch_array($query)) {
            $id_proceso          = $row['id_proceso'];
            $proceso    = $row['nombre'];
            $id_cliente    = $row['id_cliente'];
            $fecha      = $row['fecha'];
            $estado = $row['estado'];
            $image_path = $row['url_image'];
            
            $fecha_dada = $fecha;

// Obtiene la fecha actual
$fecha_actual = date("Y-m-d");

// Convierte las fechas a objetos DateTime
$fecha_inicial = new DateTime($fecha_dada);
$fecha_final = new DateTime($fecha_actual);

// Calcula la diferencia en días
$diferencia = $fecha_inicial->diff($fecha_final);

// Obtiene la diferencia en días
$dias = $diferencia->days;
        
            //$id_imp_producto      = $row['id_imp_producto'];
           /* if ($status_producto == 1) {
                $estado = "<span class='badge badge-success'>Activo</span>";
            } else {
                $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }*/
            ?>

               
                <input type="hidden" value="<?php echo $nombre; ?>" id="nombre<?php echo $id_edificio; ?>">
                <input type="hidden" value="<?php echo $direccion; ?>" id="direccion<?php echo $id_edificio; ?>">
                <input type="hidden" value="<?php echo $telefono; ?>" id="telefono<?php echo $id_edificio; ?>">
                <input type="hidden" value="<?php echo $fecha_contrato; ?>" id="fecha<?php echo $id_edificio; ?>">
                
                <tr>
                    <td><span class="badge badge-purple"><?php echo $id_proceso; ?></span></td>
                    <td> <form action="subir1.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="registro_id" value="<?php echo $id_proceso; ?>">
    <input type="file" name="imagen_<?php echo $id_proceso; ?>" accept="image/*">
    <input type="submit" value="Subir Imagen" name="submit_<?php echo $id_proceso; ?>">
</form></td>
                    <td class='text-center'>
                        <?php
if ($image_path == null) {
                echo '<img src="../../img/productos/default.jpg" class="" width="60">';
            } else {
                echo '<img src="' . $image_path . '" class="" width="60">';
            }

            ?>
                        <!--<img src="<?php echo $image_path; ?>" alt="Product Image" class='rounded-circle' width="60">-->
                    </td>
                <td ><?php echo get_row('users', 'razon_social', 'id_users', $id_cliente); ?></td>
                    <td ><?php echo $proceso; ?></td>
                   
                    
                    <td ><?php echo $fecha; ?></td>
                     <td ><?php echo $dias; ?></td>
                    
                    <td ><a href="procesos2.php?id=<?php echo $id_proceso ?>"> <img width="30px" src="../../img/4149678.png" alt=""/>GESTIONAR </a></td>
               
                    
               
                    <!--td class='text-center'><?php echo stock($stock_producto); ?></td-->
               
                    <td >

                      <div class="btn-group dropdown pull-right">
                        <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <?php if ($permisos_ver == 1) {?>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarProducto" onclick="obtener_datos('<?php echo $id_edificio; ?>');carga_img('<?php echo $id_edificio; ?>');"><i class='fa fa-edit'></i> Editar</a>
                           <?php }
            if ($permisos_editar == 1) {?>
                        
                           <!--<a class="dropdown-item" href="historial.php?id=<?php echo $id_producto; ?>"><i class='fa fa-calendar'></i> Historial</a>-->
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_edificio; ?>"><i class='fa fa-trash'></i> Borrar</a>
                           
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