<div class="col-6">
    <div class="d-flex justify-content-start">
        <!-- Dropend -->
        <div class="btn-group dropup">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-loader-circle fs-5 lh-1 me-1"></i>
                Fuente
            </button>
            <div class="dropdown-menu mx-1">
                <a href="javascript:void(0)" class="dropdown-item">
                    Fuentes:
                    <?= $canalNombre ?>
                </a>
                <hr class="dropdown-divider">
                <?php
                $fuentes = mysqli_query($conn, "SELECT * FROM fuentes
                INNER JOIN paises ON fuentes.pais = paises.paisId
                WHERE canal = $canal");
                while ($result = mysqli_fetch_assoc($fuentes)):
                    $fuenteId = $result['fuenteId'];
                    $fuenteNombre = $result['fuenteNombre'];
                    $canalId = $result['canal'];
                    $paisNombre = $result['paisNombre'];
                    // Conteo
                    $totalFuentes = mysqli_num_rows($fuentes);
                    if ($totalFuentes > 0):
                        ?>
                        <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>"
                            class="dropdown-item <?= (isset($_GET['f']) && $_GET['f'] == $fuenteId) ? "active" : ""; ?>">
                            <i class="flag <?=$paisNombre?>"></i>
                            <?= $fuenteNombre ?>
                        </a>
                    <?php endif; endwhile; ?>
            </div>
        </div>
    </div>
</div>