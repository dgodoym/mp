<?php
function mostrarCanalesFromJson($jsonData, $categoriaFiltro = null, $limit = null)
{
    $canales = json_decode($jsonData, true);
    $canalesCategoria22 = array_filter($canales, function ($canal) {
        return $canal['categoriaNombre'] === 'Adultos';
    });
    if (isset($_GET['p']) && $_GET['p'] == "tv") { ?>
        <div class="canal mycard col-6 col-md-4 col-lg-3 col-xl-2" data-category="22">
            <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="card border-primary shadow-sm card-hover card-hover-gradient" aria-hidden="true">
                    <div class="position-relative placeholder-wave">
                        <div class="card-header">
                            <img class="card-img-canal placeholder-wave" src="https://i.ibb.co/w0qg9JF/trans.png"
                                alt="Card image"
                                style="background-image: url('assets/img/canales/18.png'); background-size: contain; background-repeat: no-repeat;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                                Adultos
                            </h5>
                            <div class="card-footer fs-sm text-muted placeholder-glow">
                                <i class="flag spain"></i>
                                +18
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu my-1">
                <a href="?p=tv&adultos" class="dropdown-item">
                    VOD
                </a>
                <div class="dropdown-divider"></div>
                <?php foreach ($canalesCategoria22 as $canalCategoria22) { ?>
                <a href="?p=tv&c=<?= $canalCategoria22['canal'] ?>&f=<?= $canalCategoria22['fuenteId'] ?>" class="dropdown-item">
                    <?= $canalCategoria22['fuenteNombre'] ?>
                </a>
                <?php } ?>
            </div>
        </div>
        <?php
    }
    $count = 0;
    foreach ($canales as $canal) {
        if ($categoriaFiltro && $canal['categoriaNombre'] !== $categoriaFiltro) {
            continue;
        }

        // Verificar el límite de canales a mostrar
        if ($limit && $count >= $limit) {
            break;
        }

        $canalId = $canal['canal'];
        $fuenteId = $canal['fuenteId'];
        $canalImg = $canal['canalImg'];
        $canalNombre = $canal['fuenteNombre'];
        $canalCategoria = $canal['categoriaNombre'];
        $categoria = $canal['canalCategoria'];
        $pais = $canal['paisNombre'];
        ?>
        <div class="canal mycard col-6 col-md-4 col-lg-3 col-xl-2" data-category="<?= $categoria ?>">
            <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>">
                <div class="card border-primary shadow-sm card-hover card-hover-gradient" aria-hidden="true">
                    <div class="position-relative placeholder-wave">
                        <div class="card-header">
                            <img class="card-img-canal placeholder-wave" src="https://i.ibb.co/w0qg9JF/trans.png"
                                alt="Card image"
                                style="background-image: url('assets/img/canales/<?= $canalImg ?>.png'); background-size: contain; background-repeat: no-repeat;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                                <?= $canalNombre ?>
                            </h5>
                            <div class="card-footer fs-sm text-muted placeholder-glow">
                                <i class="flag <?= $pais ?>"></i>
                                <?= $canalCategoria ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
        $count++;
    }
}

// Leer datos desde el archivo JSON
$jsonData = file_get_contents('canales.json');

// Sección de Canales
if (isset($_GET['p']) && $_GET['p'] == "tv") {
    mostrarCanalesFromJson($jsonData);
} else {
    mostrarCanalesFromJson($jsonData, 'Deportes', 18);
}
?>