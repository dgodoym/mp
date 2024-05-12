<?php
if(isset($_GET['p']) && $_GET['p'] == 401){ require_once('401.php'); exit();}
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// BD
include('inc/conn.php');
// Header
include('inc/header.php');
echo '<div id="notificacion"></div>';
// Navegación
// Parámetro "p" del método GET
if(isset($_GET['p'])) {
    // Escapar caracteres peligrosos
    $paginaSolicitada = basename($_GET['p']);
    // Ruta al directorio de páginas
    $rutaDirectorio = __DIR__ . '/';
    // Verificar
    if(file_exists($rutaDirectorio . $paginaSolicitada . ".php")) {
        // Si existe, cárgala
        include($rutaDirectorio . $paginaSolicitada . ".php");
    } else {
        // Si no existe, 404.php
        //echo "No existe";
        include("404.php");
    }
} elseif (isset($_GET['updateChannels'])) {
    $sql = "SELECT f.`fuenteId`, f.`fuenteNombre`, f.`canal`, f.`pais`, f.`status`,  c.`canalImg`, c.`canalCategoria`, c2.`categoriaNombre`, p.`paisNombre`
    FROM `fuentes` f
    JOIN `canales` c ON f.`canal` = c.`canalId`
    JOIN `categorias` c2 ON c.`canalCategoria` = c2.`categoriaId`
    JOIN `paises` p ON f.`pais` = p.`paisId`
    WHERE f.`status` = 1";
    $result = $conn->query($sql);
    $canales = array();
    while ($row = $result->fetch_assoc()) {$canales[] = $row;}
    $jsonData = json_encode($canales);
    file_put_contents('canales.json', $jsonData);
    echo "Datos guardados";
} else {
    // Si no se proporciona ningún parámetro, carga la página predeterminada (index.php)
    include("home.php");
}
// Footer
include('inc/footer.php');