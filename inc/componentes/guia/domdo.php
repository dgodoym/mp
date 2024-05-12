<?php
// URL del sitio web con la tabla HTML
$url = "https://www.gatotv.com/canal/hbo_2_latinoamerica";

// Obtener el contenido HTML de la URL
$html = file_get_contents($url);

// Crear un nuevo objeto DOMDocument
$dom = new DOMDocument;

// Cargar el HTML en el objeto DOMDocument
@$dom->loadHTML($html);

// Obtener todos los elementos de la clase "tbl_EPG_row"
$rows = $dom->getElementsByTagName('tr');

// Iterar a través de las filas y extraer los datos
foreach ($rows as $row) {
    // Obtener las celdas de la fila
    $cells = $row->getElementsByTagName('td');
    
    // Verificar si la fila contiene datos
    if ($cells->length > 0) {
        // Obtener los datos de las celdas
        $horaInicio = $cells[0]->textContent;
        $horaFin = $cells[1]->textContent;
        $programaTitulo = $cells[2]->getElementsByTagName('span')[0]->textContent;
        $programaDescripcion = $cells[2]->getElementsByTagName('div')[1]->textContent;
        
        // Imprimir los datos
        echo "Hora Inicio: $horaInicio<br>";
        echo "Hora Fin: $horaFin<br>";
        echo "Programa: $programaTitulo<br>";
        echo "Descripción: $programaDescripcion<br><br>";
    }
}
?>
