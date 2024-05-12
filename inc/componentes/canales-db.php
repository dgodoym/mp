<?php
function mostrarCanales($query)
{
    global $conn;
    $channels = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($channels)) {
        $canalId = $result['canalId'];
        $fuenteId = $result['fuenteId'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['fuenteNombre'];
        $canalCategoria = $result['categoriaNombre'];
        ?>
        <div class="canal mycard col-6 col-md-4 col-lg-3 col-xl-2">
            <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>">
                <div class="card border-primary shadow-sm card-hover card-hover-gradient" aria-hidden="true">
                    <div class="position-relative placeholder-wave">
                        <div class="card-header">
                            <img class="card-img-canal placeholder-wave" src="assets/img/canales/<?= $canalImg ?>.png" alt="Card image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                                <?= $canalNombre ?>
                            </h5>
                            <div class="card-footer fs-sm text-muted placeholder-glow">
                                <?= $canalCategoria ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php }
}

// Sección de Canales
if (isset($_GET['p']) && $_GET['p'] == "tv") {
    $query = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.pais, fuentes.tipo, categorias.categoriaNombre
    FROM canales
    INNER JOIN fuentes ON canales.canalId = fuentes.canal
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId";
    mostrarCanales($query);
} else {
    $query = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.pais, fuentes.tipo, categorias.categoriaNombre
    FROM canales
    INNER JOIN fuentes ON canales.canalId = fuentes.canal
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canales.canalCategoria = 11
    ORDER BY RAND()
    LIMIT 18";
    mostrarCanales($query);
}
?>