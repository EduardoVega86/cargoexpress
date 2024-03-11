<?php
//include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
$id_canton=$_GET['id_canton'];

 
 ?>
<select class="form-control"  name="parroquia" id="parroquia">
    <option value="">-- Selecciona parroquia--</option>                             
  <?php

	 
	$query_canton=mysqli_query($conexion,"select distinct codigo_parroquia, parroquia from localidad where codigo_canton=$id_canton ORDER BY parroquia");
	
         while ($row_provincia=mysqli_fetch_array($query_canton)){
             
                         $codigo_provincia=$row_provincia['codigo_parroquia'];
                         $provincia=$row_provincia['parroquia'];
                ?>
                 <option value="<?php echo $codigo_provincia;?>"><?php echo $provincia;?></option>
                                          
                                                                  <?php

         }      ?>
                                        </select>
                                       