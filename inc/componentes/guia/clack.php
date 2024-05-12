<?php
// Obtener la hora local del usuario
date_default_timezone_set('America/Santiago'); // Configura la zona horaria según tu ubicación
$hora_local = date('H:i:s'); // Obtiene la hora local en formato HH:mm:ss

// Construir la URL de la API con la hora local del usuario
$url = "http://www.clacktv.cl/api/?api_key=ewisoq&q=" . date('Y-m-d') . "&time=" . urlencode($hora_local);

// Realizar la solicitud GET a la API
$response = file_get_contents($url);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Mostrar la información de los programas por cada canal
foreach ($data as $channelId => $channelData) {
    echo "Canal: " . $channelData['canal']['Channel'] . "<br>";
    foreach ($channelData['schelude'] as $program) {
        echo "Programa: " . $program['ProgramName'] . " - Hora: " . $program['Hour'] . "<br>";
    }
    echo "<br>";
}
?>