<?php
// Establecer la zona horaria a 'Europe/Madrid'
date_default_timezone_set('Europe/Madrid');
// Obtener el contenido del archivo XML
$xml = file_get_contents('https://www.tdtchannels.com/epg/TV.xml');

// Crear un objeto SimpleXMLElement a partir del contenido del archivo XML
$sxml = new SimpleXMLElement($xml);

// Obtener la hora actual
$now = time();
?>
<!-- Multiple slides responsive slider with external Prev / Next buttons and bullets outside -->
<div class="position-relative px-xl-5">

    <!-- Slider prev/next buttons -->
    <button type="button" id="prev-program"
        class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex"
        aria-label="Previous">
        <i class="bx bx-chevron-left"></i>
    </button>
    <button type="button" id="next-program"
        class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex"
        aria-label="Next">
        <i class="bx bx-chevron-right"></i>
    </button>

    <!-- Slider -->
    <div class="px-xl-2">
        <div class="swiper mx-n2" data-swiper-options='{
            "slidesPerView": 2,
            "loop": true,
            "pagination": {
                "el": ".swiper-pagination",
                "clickable": true
            },
            "navigation": {
                "prevEl": "#prev-program",
                "nextEl": "#next-program"
            },
            "breakpoints": {
                "0": {
                "slidesPerView": 1
                },
                "560": {
                "slidesPerView": 2
                },
                "992": {
                "slidesPerView": 3
                }
            }
        }'>
            <div class="swiper-wrapper">
                <?php
                // Recorrer los nodos de programa y mostrar la información
                foreach ($sxml->programme as $programme) {
                    $start_time = strtotime((string) $programme['start']);
                    $end_time = strtotime((string) $programme['stop']);
                    $channel = (string) $programme['channel'];
                    $title = (string) $programme->title;
                    $description = (string) $programme->desc;
                    $category = (string) $programme->category;
                    $logo = (string) $programme->icon['src'];

                    if (isset($channel_to_show)) {
                        if ($start_time <= $now && $end_time > $now) { ?>
                            <?php
                        } else {
                            // No mostramos
                        }
                    } else {
                        // Si el programa está en vivo, mostrar la información del programa en la página web
                        if ($start_time <= $now && $end_time > $now) {
                            // Obtener los canales existentes en BD
                            $queryCanales = mysqli_query($conn, "SELECT * FROM canales WHERE epg = '$channel'");
                            while ($resultado = mysqli_fetch_array($queryCanales)) {
                                $canalId = $resultado['canalId'];
                                // Verificamos canales existentes para imprimir
                                if ($resultado['epg'] == $channel) {
                                    // Obtenemos las fuentes del canal
                                    $queryFuentes = mysqli_query($conn, "SELECT fuenteId FROM fuentes WHERE canal = $canalId");
                                    $resultado2 = mysqli_fetch_array($queryFuentes);
                                    $fuenteId = $resultado2['fuenteId'];
                                    ?>
                                    <!-- Item -->
                                    <div class="swiper-slide h-auto pb-3">
                                        <article class="card border-primary card-hover p-md-3 p-2 hadow-sm card-hover-primary h-100 mx-2">
                                            <div class="position-relative">
                                                <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>"
                                                    class="position-absolute top-0 start-0 w-100 h-100" aria-label="Ver Ahora"></a>
                                                <img src="<?= $logo ?>" class="card-img-top programa-img" alt="<?= $channel ?>">
                                            </div>
                                            <div class="card-body pb-4">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>"
                                                        class="badge fs-sm text-nav bg-secondary text-decoration-none">
                                                        <?= date('H:i', $start_time) ?> -
                                                        <?= date('H:i', $end_time) ?>
                                                    </a>
                                                    <span class="fs-sm text-muted">
                                                        <i class="flag es"></i>
                                                    </span>
                                                </div>
                                                <h3 class="h5 mb-0">
                                                    <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>">
                                                        <?= $title ?>
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="card-footer py-4">
                                                <a href="#" class="d-flex align-items-center text-decoration-none">
                                                    <img src="assets/img/canales/<?= $resultado['canalImg'] ?>.png" class="rounded-circle"
                                                        width="48" alt="Avatar">
                                                    <div class="ps-3">
                                                        <h6 class="fs-base fw-semibold mb-0">
                                                            <?= $resultado['canalNombre'] ?>
                                                        </h6>
                                                        <span class="fs-sm text-muted">
                                                            <?= $category ?>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                    <?php
                                } else { // NO IMPRIMOS
                                }
                            }
                        }
                    }
                }
                ?>
            </div>

            <!-- Pagination (bullets) -->
            <div class="swiper-pagination position-relative bottom-0 mt-4 mb-lg-2"></div>
        </div>
    </div>
</div>