<?php

include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id = session_id();
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP
require_once "../funciones.php";
if (isset($_POST['tipo_servicio'])) {$id_tipo_servicio = $_POST['tipo_servicio'];}
if (isset($_POST['kg'])) {$cantidad = $_POST['kg'];}
if (isset($_POST['cod'])) {$cod = $_POST['cod'];}
if (isset($_POST['seguro'])) {$seguro = $_POST['seguro'];}
if (isset($_POST['cliente'])) {$cliente = $_POST['cliente'];}
if (isset($_POST['destino'])) {$destino = $_POST['destino'];}



//echo $descripcion_libre;
if (!empty($id_tipo_servicio)) {
    
    
    if($cod==1){
    $valor_cobrar = $_POST['valor_cobrar'];    
    }else{
     $valor_cobrar=0;   
    }
    
    if($seguro==1){
    $valor_seguro = $_POST['valor_seguro'];    
    }else{
     $valor_seguro=0;   
    }
    
    
    
    // consulta para comparar el stock con la cantidad resibida
  //  $id_stock=$_POST['id_stock'];  
   // echo "select stock_producto,inv_producto from productos,stock_lote where productos.id_producto=stock_lote.id_producto and id_stock ='$id_stock'"; 

    //Comprobamos si agregamos un producto a la tabla tmp_compra
   $distancia= $_POST['distance'];
   
 if (strpos($distancia, 'km') !== false) {
        // Si ya está en km, simplemente se remueve el texto 'km' y se devuelve el número
        $distancia_total= floatval($distancia);
    } elseif (strpos($distancia, 'm') !== false) {
        // Si está en metros, se remueve 'm' y se convierte a km
        $metros = floatval($distancia);
        $distancia_total= $metros / 1000; // Convertir metros a kilómetros
    } else {
         $distancia_total= 0;  // En caso de un formato inesperado, devuelve 0
    }
  
   $tipo_servicio= $_POST['tipo_servicio'];
   $id_empresa=$_POST['cliente'];
   $valor_base_km = get_row2('servicios_empresa', 'valor', 'id_servicio', $tipo_servicio, 'id_empresa', $id_empresa);
   $valor_adicional = get_row2('servicios_empresa', 'km_adicional', 'id_servicio', $tipo_servicio, 'id_empresa', $id_empresa);
   $valor_adicional_peso = get_row2('servicios_empresa', 'volumen', 'id_servicio', $tipo_servicio, 'id_empresa', $id_empresa);
   $peso=$_POST['kg'];
   
   if($tipo_servicio==1){
       if ($distancia_total > 5) {
    // Calculamos los km adicionales
    $km_adicionales = $distancia_total - 5;
    
    // Sumar el valor adicional por cada km extra
    $valor_total = $valor_base_km + ($km_adicionales * $valor_adicional);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_base_km;
}
     
   if ($peso > 5) {
    // Calculamos los km adicionales
    $kg_adicional = $peso - 5;
// Sumar el valor adicional por cada km extra
    $valor_total = $valor_total + ($kg_adicional * $valor_adicional_peso);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_total;
}
}

if($tipo_servicio==2){
   $valor_total = $valor_base_km; 
    if ($peso > 2) {
    // Calculamos los km adicionales
    $kg_adicional = $peso - 2;
    
    // Sumar el valor adicional por cada km extra
    $valor_total = $valor_total + ($kg_adicional * $valor_adicional_peso);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_total;
}
}

if($tipo_servicio==3){
   $valor_total = $valor_base_km; 
    if ($peso > 2) {
    // Calculamos los km adicionales
    $kg_adicional = $peso - 2;
    
    // Sumar el valor adicional por cada km extra
    $valor_total = $valor_total + ($kg_adicional * $valor_adicional_peso);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_total;
}
}

if($tipo_servicio==4){
       if ($distancia_total > 5) {
    // Calculamos los km adicionales
    $km_adicionales = $distancia_total - 5;
    
    // Sumar el valor adicional por cada km extra
    $valor_total = $valor_base_km + ($km_adicionales * $valor_adicional);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_base_km;
}
     
   if ($peso > 5) {
    // Calculamos los km adicionales
    $kg_adicional = $peso - 5;
// Sumar el valor adicional por cada km extra
    $valor_total = $valor_total + ($kg_adicional * $valor_adicional_peso);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_total;
}
}

if($tipo_servicio==5){
   $valor_total = $valor_base_km; 
    if ($peso > 2) {
    // Calculamos los km adicionales
    $kg_adicional = $peso - 2;
    
    // Sumar el valor adicional por cada km extra
    $valor_total = $valor_total + ($kg_adicional * $valor_adicional_peso);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_total;
}
}

if($tipo_servicio==6){
   $valor_total = $valor_base_km; 
    if ($peso > 2) {
    // Calculamos los km adicionales
    $kg_adicional = $peso - 2;
    
    // Sumar el valor adicional por cada km extra
    $valor_total = $valor_total + ($kg_adicional * $valor_adicional_peso);
} else {
    // Si no hay km adicionales, el valor total es solo el valor base
    $valor_total = $valor_total;
}
}

@$valor_calculado=$valor_total;
    
echo $valor_calculado;
}


?>

