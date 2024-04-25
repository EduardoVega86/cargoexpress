<?php

// Coordenadas de origen y destino (latitud y longitud)
$origen_lat = 37.4220041;
$origen_lng = -122.0862462;
$destino_lat = 37.331669;
$destino_lng = -122.030156;

// Formato de la solicitud a la API
$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" . $origen_lat . "," . $origen_lng . "&destinations=" . $destino_lat . "," . $destino_lng . "&key=AIzaSyAj-OWe4vKRnRiHQEx2ANZqxIGBT8z6Fo0";

// Realizar la solicitud a la API
$response = file_get_contents($url);

// Decodificar la respuesta JSON
$resultado = json_decode($response, true);

// Verificar si la solicitud fue exitosa
if ($resultado['status'] == 'OK') {
    // Obtener la distancia y duración del viaje
    $distancia = $resultado['rows'][0]['elements'][0]['distance']['text'];
    $duracion = $resultado['rows'][0]['elements'][0]['duration']['text'];

    // Imprimir los resultados
    echo "Distancia: " . $distancia . "<br>";
    echo "Duración: " . $duracion;
} else {
    // Imprimir un mensaje de error si la solicitud falló
    echo "Error al calcular la distancia.";
}

?>