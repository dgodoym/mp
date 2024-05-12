<?php
// Generar
$json_url = 'https://deportestvhd2.com/star.json';
// Obtener el contenido del JSON desde la URL
$json_content = file_get_contents($json_url);
// Verificar si la solicitud fue exitosa
if ($json_content !== false) {
    // Guardar el contenido en un archivo llamado "starbr.json"
    file_put_contents('datos.json', $json_content);
} else {
    echo 'Error al obtener el contenido del JSON, por favor comuníquelo al admin';
}
?>
<section class="container">
    <!-- Page title + Filters -->
    <div class="d-lg-flex align-items-center justify-content-between py-4 mt-lg-2">
        <h1 class="me-3">Star+</h1>
        <div class="d-md-flex mb-3">
            <div class="position-relative" style="min-width: 300px;">
                <input id="filtroInput" type="text" class="form-control pe-5" placeholder="Buscar evento">
                <i class="bx bx-search text-nav fs-lg position-absolute top-50 end-0 translate-middle-y me-3"></i>
            </div>
        </div>
    </div>
    <!-- Events grid -->
    <div id="eventos" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 mt-n2 mt-sm-0">
        <script src="inc/eventos/star.js"></script>
    </div>
</section>