<?php
//include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
$id_provincia=$_GET['id_provincia'];


 
 ?>
<select class="form-control" onchange="cambio_canton()" name="canton" id="canton">
    <option value="">-- Selecciona cantón--</option>                             
  <?php

	 
	$query_canton=mysqli_query($conexion,"select distinct codigo_canton, canton from localidad where codigo_provincia=$id_provincia ORDER BY canton");
	
         while ($row_provincia=mysqli_fetch_array($query_canton)){
             
                         $codigo_provincia=$row_provincia['codigo_canton'];
                         $provincia=$row_provincia['canton'];
                ?>
                 <option value="<?php echo $codigo_provincia;?>"><?php echo $provincia;?></option>
                                          
                                                                  <?php

         }      ?>
                                        </select>
                                      