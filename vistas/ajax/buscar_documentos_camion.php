<?php

/*-------------------------
Autor: Eduardo Vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Camiones";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
//Archivo de funciones PHP
require_once "../funciones.php";
$id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $id_usuario=$_GET['id_usuario'];
    
    $id_camion=$_GET['id_camion'];
    // escaping, additionally removing everything that could be (html/javascript-) code
    //$q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array(''); //Columnas de busqueda
    $sTable   = "docrequire";
    $sWhere   = "where doctype_id =3";
    
    $sWhere .= " order by id";
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
    $reload      = '../html/lineas.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere ";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
            <table id="camiones" class="table table-sm table-striped">
                <tr  class="info">
                    <th>Id</th>
                    <th>Requerimiento</th>
                    <th colspan="2">Documento</th>
                    <th>Expira</th>
                    <th>Entregado</th>
                    <th>Solicitar</th>
                    
                    

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
            $id     = $row['id'];
            $nombre      = $row['name'];
            $upload      = $row['upload'];
            $vigencia     = $row['vigencia'];
          
            
           // $date_added   = date('d/m/Y', strtotime($row['date_added']));
//            if ($estado_linea == 1) {
//                $estado = "<span class='badge badge-success'>Activo</span>";
//            } else {
//                $estado = "<span class='badge badge-danger'>Inactivo</span>";
//            }

//$placa=get_row('camiones', 'placa', 'id', $id_camion);
//echo 'zx'.$placa;

//echo $diabled;
$id_usuario= get_row('camiones', 'user_id', 'id', $id_camion);
$sql_check   = "SELECT * FROM  docuser where user_id=$id_usuario and docrequire_id=$id  and secundary=$id_camion ";
    //echo $sql_check;
    $query_check = mysqli_query($conexion, $sql_check);
    $check=0;
    while ($row_check = mysqli_fetch_array($query_check)) {
        $check=1;
        $url = $row_check['url_doc'];
    }
             
            ?>

   
  
    <tr >
        <td><span class="badge badge-purple"><?php echo $id; ?></span></td>
       
        <td><?php echo $nombre; ?></td>
        <td style="text-align: center"><?php if($upload==1){
            ?>
            <?php if($check > 0){ ?>
            <a href=" <?php echo $url;?>" target="blank"> <img width="40px" src="../../img/sistema/338851.png" alt=""/></a>
                <?php }else{?>
            <input type="file" class='form-control' name="imagefile<?php echo $id; ?>" id="imagefile<?php echo $id; ?>" onchange="upload_image_2(<?php echo $id; ?>,<?php echo $id_usuario; ?>,<?php echo $id_camion; ?>);">
      
        <?php    }}
?></td>
        <td>
            
        </td>  
      <td><?php if($vigencia==1){ ?>
          <input type="date" class="form-control" name="expira<?php echo $id; ?>" accept="image/*,application/pdf">
        <?php    }
?></td>  
<td>
    
    <input onclick="cargarDocumento(<?php echo $id;?>,<?php echo $id_camion;?>,<?php echo $id_usuario;?>)"  <?php if($check > 0){ echo 'checked'; }?>  class="form-check-input" style="margin-left:10px; width: 30px; height: 30px;" type="checkbox" id="check2"></td>
   <td>
    
    <a href="https://wa.me/593<?php echo get_row('users', 'telefono', 'id_users', $id_usuario);?>?text=Estimado <?php echo get_row('users', 'nombre_users', 'id_users', $id_usuario);?><?php echo get_row('users', 'apellido_users', 'id_users', $id_usuario);?> ,%20solicitamos el document: *<?php echo $nombre; ?>%20para%20poder%20continuar%20con%20su%20proceso." target="_blank">
        <img width="40px" src="../../images/klipartz.com.png" alt="Logo de WhatsApp">
</a>
   </td>
    </tr>
   <?php
}
        ?>

</table>
</div>
<?php
}
//Este else Fue agregado de Prueba de prodria Quitar
    else {
        ?>
    <div class="alert alert-warning alert-dismissible" role="alert" align="center">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Aviso!</strong> No hay Registro de Camiones
  </div>
  <?php
}
// fin else
}
?>