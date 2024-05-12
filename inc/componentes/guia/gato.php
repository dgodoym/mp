<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Incluir la biblioteca PHP Simple HTML DOM Parser
include('scraper.php');

// Array con los canales que queremos verificar
$canalesEnVivo = array("hbo_2_latinoamerica", "discovery_turbo_latinoamerica", "izzi_mexico");

// URL del sitio web con la tabla HTML
$url = "https://www.gatotv.com/";

// Obtener el contenido HTML de la URL
$html = file_get_html($url);
echo $html;

// Iterar a través de los canales
foreach ($canalesEnVivo as $canal) {
    // Obtener el contenido HTML específico del canal
    $canalHtml = file_get_html($url . "canal/$canal");
    
    // Encontrar la tabla con la clase "tbl_EPG"
    $table = $canalHtml->find('table.tbl_EPG', 0);

    // Obtener todas las filas de la tabla
    $rows = $table->find('tr');

    // Variable para controlar si se encontró el programa en vivo
    $programaEnVivo = false;

    // Iterar a través de las filas y extraer los datos
    foreach ($rows as $row) {
        // Verificar si la fila contiene datos
        if ($row->find('td', 0)) {
            // Verificar si esta fila corresponde al programa en vivo
            if ($row->hasClass('tbl_EPG_row_selected')) {
                // Si es el programa en vivo, mostrarlo
                echo "Canal: $canal<br>";
                echo "En Vivo:<br>";
                echo "Hora Inicio: " . $row->find('td', 0)->plaintext . "<br>";
                echo "Hora Fin: " . $row->find('td', 1)->plaintext . "<br>";
                echo "Programa: " . $row->find('td', 2)->find('span', 0)->plaintext . "<br>";
                echo "Descripción: " . $row->find('td', 2)->find('div', 1)->plaintext . "<br><br>";
                
                // Indicar que se encontró el programa en vivo
                $programaEnVivo = true;
            }
        }
    }

    // Si no se encontró el programa en vivo para el canal, mostrar un mensaje
    if (!$programaEnVivo) {
        echo "Canal: $canal<br>";
        echo "No hay programa en vivo en este momento.<br><br>";
    }

    // Liberar la memoria ocupada por el objeto HTML del canal
    $canalHtml->clear();
}

// Liberar la memoria ocupada por el objeto HTML principal
$html->clear();
?>