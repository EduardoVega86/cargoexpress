<?php

/*-------------------------
Autor: Eduardo vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Categorias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
//Archivo de funciones PHP
require_once "../funciones.php";
$id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);

$tonelaje = (isset($_POST['tonelaje']) && $_POST['tonelaje'] != null) ? $_POST['tonelaje'] : '';
if ($tonelaje != '') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    //$q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array('placa'); //Columnas de busqueda
    $sTable   = "camiones";
    $sWhere   = "where habilitado=1 and disponible=1 and weight_id=$tonelaje";
  
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
    echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <tr  class="info">
                  <th>Id</th>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Tonelaje</th>
                    <th>Año</th>
                    <th style="text-align: center">Disponible</th>
                     <th style="text-align: center">Seleccionar</th>
                   

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
           $id     = $row['id'];
            $placa      = $row['placa'];
            $brand_id  = $row['brand_id'];
            $vantype_id = $row['vantype_id'];
            $weight_id = $row['weight_id'];
            $anio = $row['anio'];
            $estado_id = $row['estado_id'];
            $habilitado= $row['habilitado'];
            $disponible = $row['disponible'];
            
            if($habilitado==1){
              $path_habilitado='../../img/sistema/habilitado.png';  
            }else{
               $path_habilitado='../../img/sistema/apagado.png'; 
            }
            

            if($disponible==1 && $habilitado==1){
              $path_disponible='../../img/sistema/disponible.png';  
            }else{
               $path_disponible='../../img/sistema/nodisponible.png'; 
            }
            ?>

     <input type="hidden" value="<?php echo $placa; ?>" id="placa<?php echo  $id; ?>">
    <input type="hidden" value="<?php echo $brand_id; ?>" id="brand_id<?php echo  $id; ?>">
    <input type="hidden" value="<?php echo $vantype_id; ?>" id="vantype_id<?php echo  $id; ?>">
    <input type="hidden" value="<?php echo $weight_id; ?>" id="weight_id<?php echo  $id; ?>">
    <input type="hidden" value="<?php echo $anio; ?>" id="anio<?php echo  $id; ?>">
    <input type="hidden" value="<?php echo $estado_id; ?>" id="estado<?php echo  $id; ?>">
    
    <tr onclick="" id="camion<?php echo $id; ?>">
        <td><span class="badge badge-purple"><?php echo $id; ?></span></td>
        <td><?php echo $placa; ?></td>
        <td><?php echo get_row('brand', 'name', 'id', $brand_id); ?></td>
        <td><?php echo get_row('vantype', 'name', 'id', $vantype_id); ?></td>
         <td><?php echo get_row('weight', 'name', 'id', $weight_id); ?></td>
        <td><?php echo $anio; ?></td>
      
        <td style="text-align: center">
            <img width="50px" src="<?php echo $path_disponible; ?>" alt=""/>
        </td>
        <td style="text-align: center"><input type='checkbox' style="width: 20px; height: 20px;" name='filaSeleccionada' onclick='seleccionarUnico(this, <?php echo $id; ?>);'></td>
        
       
        
        

   </tr>
   <?php
}
        ?>
<tr>
    
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
      <strong>Aviso!</strong> No hay Registro de Linea
  </div>
  <?php
}
// fin else
}
?>