<?php

/*-------------------------

---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Proveedores";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $id        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['id'], ENT_QUOTES)));
    $aColumns = array('personal'); //Columnas de busqueda
    $sTable   = "personal, users, servicios";
    $sWhere   = "where servicios.id_servicio=personal.id_servicio and users.id_users=personal.id_usuario and id_edificio=$id";
    if ($_GET['q'] != "") {
        $sWhere .= " and (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    $sWhere .= " order by personal.id_servicio";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    
   // echo "SELECT count(*) AS numrows FROM $sTable  $sWhere";
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row         = mysqli_fetch_array($count_query);
    $numrows     = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../html/proveedores.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <tr  class="info">
                    <th>Numero</th>
                    <th>Personal</th>
                    <th>Servicio</th> 
                    
                    <th>Estado</th>
                    <th class='text-right'>Acciones</th>

                </tr>
                <?php
                $nume_dep=0;
while ($row = mysqli_fetch_array($query)) {
    $nume_dep+=$nume_dep+1;
            $nombre       = $row['nombre_users'];
            $apellido   = $row['apellido_users'];
            $servicio    = $row['nombre_servicio'];
          
          
            $estado_dep    = $row['status'];
           // $date_added          = date('d/m/Y', strtotime($row['date_added']));
            if ($estado_dep == 1) {
                $estado = "<span class='badge badge-success'>Activo</span>";
            } else {
                $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }

            ?>
                    <input type="hidden" value="<?php echo $departamento; ?>" id="nombre<?php echo $id_departamento; ?>">
                    <input type="hidden" value="<?php echo $descripcion; ?>" id="descripcion<?php echo $id_departamento; ?>">





                    <input type="hidden" value="<?php echo $estado_dep; ?>" id="estado_proveedor<?php echo $id_proveedor; ?>">

                    <tr>
                    <td><span class="badge badge-purple"><?php echo $nume_dep; ?></span></td>
                       
                    </td>
                    <td><?php echo $nombre.' '.$apellido; ?></td>
                    <td><?php echo $servicio; ?></td>
                    
                    
                    <td><?php echo $estado; ?></td>

                    <td >
                        <div class="btn-group dropdown pull-right">
                            <button type="button" class="btn btn-warning btn-rounded btn-sm waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                            <div class="dropdown-menu dropdown-menu-right">
                             <?php if ($permisos_editar == 1) {?>
                             <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarDep" onclick="obtener_datos('<?php echo $id_departamento; ?>');"><i class='fa fa-edit'></i> Editar</a>
                             <?php }
            if ($permisos_eliminar == 1) {?>
                             <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_proveedor; ?>"><i class='fa fa-trash'></i> Borrar</a>
                             <?php }?>


                         </div>
                     </div>

                 </td>

             </tr>
             <?php
}
        ?>
         <tr>
            <td colspan="7">
                <span class="pull-right">
                    <?php
echo paginate($reload, $page, $total_pages, $adjacents);
        ?></span>
                </td>
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
      <strong>Aviso!</strong> No hay Registro de Departamentos
  </div>
  <?php
}
// fin else
}
?>