<?php
// Obtenemos el tipo de evento por url
$tipo = $_GET['tipo'];
// Mostramos los partidos utilizando la liga filtrada
if (isset($_GET['liga'])) {
    include('inc/eventos/partidos.php');
} // Mostramos las ligas con partidos disponibles
else {
    include('inc/eventos/lista.php');
}
?>