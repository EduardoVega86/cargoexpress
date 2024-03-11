<?php
try {
    // Crear un cliente SOAP
    $client = new SoapClient('https://webcloud.satrack.com/WebServiceEventos/getEvents.asmx?WSDL');

    // Parámetros para la llamada al servicio web
    $params = [
        'UserName' => 'eduardovega1',
        'Password' => 'Evega1239*',
        'PhysicalID' => 'PAE1434' // Sustituye con la placa real
    ];

    // Llamada al método getLastEvent
    $response = $client->getLastEvent($params);
    print_r($response);
    // Verificar si se obtuvieron datos
    if (empty($response->getLastEventResult->any)) {
        echo "No hay datos de última posición...";
    } else {
        $datos = $response->getLastEventResult->any;

        // Aquí debes procesar los datos recibidos. 
        // Por ejemplo, si los datos están en formato XML, puedes convertirlos a un objeto o array de PHP
        // Si los datos ya están en un formato manejable, puedes imprimirlos directamente

        // Imprime los datos para depuración
        echo "<pre>";
        print_r($datos);
        echo "</pre>";
    }
} catch (SoapFault $ex) {
    // Manejo de errores de la llamada SOAP
    echo "Error al llamar al servicio web: " . $ex->getMessage();
}