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
    
    //loop through fetched data
    $numrows=1;
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
           
            <button id="agregar_socio" onclick="activarcamion2()" class="form-control btn btn-primary" > <?php
            //ECHO get_row('users', 'habilitar_camion', 'id_users', $id_usuario);
              if (get_row('camiones', 'habilitado', 'id', $id_camion)==1){ 
                  echo'DESHABILITAR CAMION';
              }else{
                  echo'HABILITAR CAMION';
              }
                       ?></button>
                                                                                <br>
                                                                                    <br>
                                                                                       <br>
                                                                                
<?php
            
           
              
            ?>
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