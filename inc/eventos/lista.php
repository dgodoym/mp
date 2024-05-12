<section class="container pb-2 pb-md-4 pb-lg-5 mb-3">
    <h1 class="pb-4">Eventos de
        <?= ucfirst($tipo) ?> en Vivo
    </h1>
    <div class="row row-cols-1 row-cols-md-2">
        <?php
        $ligas = mysqli_query($conn, "SELECT * FROM ligas");
        while ($result = mysqli_fetch_array($ligas)):
            // Cantidad de Juegos
            $ligaId = $result['ligaId'];
            $ligaNombre = $result['ligaNombre'];
            $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE liga = $ligaId AND tipo='$tipo' ORDER BY fecha_hora ASC");
            $totalGames = mysqli_num_rows($queryQty);
            if ($totalGames > 0) { ?>
                <!-- Item -->
                <div class="col col-sm-6 col-md-3 py-4 my-2 my-sm-3">
                    <div
                        class="card flex-column flex-sm-row flex-md-column flex-xxl-row align-items-center card-hover border-primary h-100">
                        <img src="assets/img/ligas/sf/<?= $ligaId ?>.png" width="80"
                            alt="<?= $ligaNombre ?>">
                        <div
                            class="card-body text-center text-sm-start text-md-center text-xxl-start pb-3 pb-sm-2 pb-md-3 pb-xxl-2">
                            <h3 class="h5 mb-3 mt-n4 mt-sm-0 mt-md-n4 mt-xxl-0">
                                <?= $ligaNombre ?>
                            </h3>

                            <p class="fs-sm mb-1"><?=$totalGames?> juegos.</p>

                            <a href="?p=eventos&tipo=<?= $tipo ?>&liga=<?= $ligaId ?>"
                                class="btn btn-link stretched-link px-0"><i class="bx bx-right-arrow-alt fs-xl ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
            ;
        endwhile; ?>
    </div>
</section>