<?php
// Verificar si canalTipo está definido y no es nulo
if (isset($_GET['c'])) {
    ?>
    <section class="container mb-5 pt-md-4">
        <div class="d-flex flex-sm-row flex-column align-items-center justify-content-between mb-4 pb-1 pb-md-3">
            <h2 class="h1 mb-sm-0">Canales Relacionados</h2>
            <a href="?p=tv" class="btn btn-lg btn-outline-primary ms-4">
                Ver Todo
                <i class="bx bx-right-arrow-alt ms-1 me-n1 lh-1 lead"></i>
            </a>
        </div>

        <!-- Carousel -->
        <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
            data-swiper-options="{
          &quot;slidesPerView&quot;: 1,
          &quot;spaceBetween&quot;: 24,
          &quot;pagination&quot;: {
            &quot;el&quot;: &quot;.swiper-pagination&quot;,
            &quot;clickable&quot;: true
          },
          &quot;breakpoints&quot;: {
            &quot;500&quot;: {
              &quot;slidesPerView&quot;: 2
            },
            &quot;768&quot;: {
              &quot;slidesPerView&quot;: 3
            },
            &quot;1000&quot;: {
              &quot;slidesPerView&quot;: 3
            },
            &quot;1200&quot;: {
              &quot;slidesPerView&quot;: 4
            }
          }
        }">
            <div class="swiper-wrapper" id="swiper-wrapper-4799ce1078136239e" aria-live="polite"
                style="transform: translate3d(0px, 0px, 0px);">
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
                        <!-- Item -->
                        <div class="swiper-slide h-auto pb-3 swiper-slide-active" style="width: 329.5px; margin-right: 24px;"
                            role="group" aria-label="1 / 4">
                            <article>
                                <div class="d-block position-relative rounded-3 mb-3">
                                    <span class="badge bg-dark position-absolute bottom-0 end-0 zindex-2 mb-3 me-3">
                                        <?= $canalCategoria ?>
                                    </span>
                                    <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>"
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"
                                        aria-label="Listen podcast"></a>
                                    <img style="height: 50px!important" src="assets/img/canales/<?= $canalImg ?>.png"
                                        class="card-img-canal" alt="Image">
                                    <br><br><br><br>
                                </div>
                                <h3 class="h5">
                                    <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>">
                                        <?= $canalNombre ?>
                                    </a>
                                </h3>
                                <div class="d-flex align-items-center text-muted">
                                </div>
                                <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>" class="btn btn-link px-0 mt-3">
                                    <i class="bx bx-play-circle fs-lg me-2"></i>
                                    Ver ahora
                                </a>
                            </article>
                        </div>
                    <?php }
                }
                // Sección de Canales
                $query = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.pais, fuentes.tipo, categorias.categoriaNombre
                FROM canales
                INNER JOIN fuentes ON canales.canalId = fuentes.canal
                INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
                WHERE canalCategoria='$categoria'
                ORDER BY RAND()
                DESC LIMIT 18";
                mostrarCanales($query);
                ?>
            </div>

            <!-- Pagination (bullets) -->
            <div
                class="swiper-pagination position-relative pt-2 pt-sm-3 mt-4 swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                    aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet"
                    tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet"
                    tabindex="0" role="button" aria-label="Go to slide 3"></span>
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
    </section>
<?php } ?>