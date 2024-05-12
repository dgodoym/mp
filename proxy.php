<?php
// Habilitar CORS
header("Access-Control-Allow-Origin: *");

// Obtener datos JSON del servidor remoto
$jsonData = file_get_contents("https://www.tdtchannels.com/lists/tv.json");

// Enviar datos JSON al cliente
header("Content-Type: application/json");
echo $jsonData;
?>
