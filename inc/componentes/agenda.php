<!-- Page content -->
<section class="position-relative px-xl-5">
    <!-- Slider prev/next buttons -->
    <button type="button" id="prev-news"
        class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex"
        aria-label="Anterior">
        <i class="bx bx-chevron-left"></i>
    </button>
    <button type="button" id="next-news"
        class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex"
        aria-label="Siguiente">
        <i class="bx bx-chevron-right"></i>
    </button>

    <!-- Slider -->
    <div class="swiper swiper-nav-onhover mx-n2" data-swiper-options='{
    "slidesPerView": 1,
    "spaceBetween": 8,
    "pagination": {
        "el": ".swiper-pagination",
        "clickable": true
    },
    "navigation": {
        "prevEl": "#prev-news",
        "nextEl": "#next-news"
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
            // Obtener y tratar fecha
            date_default_timezone_set('Europe/Madrid');
            $date = date('Y/m/d H:i:s');
            $mm_0 = substr($date, 5, 2);
            $dd_0 = substr($date, 8, 2);
            $hh_0 = substr($date, 11, 2);
            $m_0 = substr($date, 14, 2);
            $partidos = mysqli_query($conn, "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.vix, 
                e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
                e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
                e3.ligaNombre AS partido_liga,
                c1.canalId AS id_canal1, c1.canalNombre AS nombre_canal1,
                c2.canalId AS id_canal2, c2.canalNombre AS nombre_canal2,
                c3.canalId AS id_canal3, c3.canalNombre AS nombre_canal3,
                c4.canalId AS id_canal4, c4.canalNombre AS nombre_canal4,
                c5.canalId AS id_canal5, c5.canalNombre AS nombre_canal5,
                c6.canalId AS id_canal6, c6.canalNombre AS nombre_canal6,
                c7.canalId AS id_canal7, c7.canalNombre AS nombre_canal7,
                c8.canalId AS id_canal8, c8.canalNombre AS nombre_canal8,
                c9.canalId AS id_canal9, c9.canalNombre AS nombre_canal9,
                c10.canalId AS id_canal10, c10.canalNombre AS nombre_canal10
                FROM partidos p
                JOIN equipos e1 ON p.local = e1.equipoId
                JOIN equipos e2 ON p.visitante = e2.equipoId
                JOIN ligas e3 ON p.liga = e3.ligaId
                LEFT JOIN canales c1 ON p.canal1 = c1.canalId
                LEFT JOIN canales c2 ON p.canal2 = c2.canalId
                LEFT JOIN canales c3 ON p.canal3 = c3.canalId
                LEFT JOIN canales c4 ON p.canal4 = c4.canalId
                LEFT JOIN canales c5 ON p.canal5 = c5.canalId
                LEFT JOIN canales c6 ON p.canal6 = c6.canalId
                LEFT JOIN canales c7 ON p.canal7 = c7.canalId
                LEFT JOIN canales c8 ON p.canal8 = c8.canalId
                LEFT JOIN canales c9 ON p.canal9 = c9.canalId
                LEFT JOIN canales c10 ON p.canal10 = c10.canalId
                ORDER BY
                fecha_hora ASC
                ");
            while ($result = mysqli_fetch_array($partidos)):
                // Teams
                $index = $result['id'];
                $local = $result['equipo_local'];
                $local_id = $result['id_local'];
                $visitante = $result['equipo_visitante'];
                $visitante_id = $result['id_visitante'];
                $liga_id = $result['liga'];
                $liga = $result['partido_liga'];
                $fecha = $result['fecha_hora'];
                $hora = substr($fecha, 11, 5);
                $tipo = $result['tipo'];
                $starp = $result['starp'];
                $vix = $result['vix'];
                // Obtener y tratar fecha de JSON
                $mm_1 = substr($fecha, 5, 2);
                $dd_1 = substr($fecha, 8, 2);
                $hh_1 = substr($fecha, 11, 2);
                $m_1 = substr($fecha, 14, 2);
                // Calculamos que los juegos sean para hoy y los mostramos
                if ($mm_0 === $mm_1):
                    if ($dd_0 === $dd_1):
                        // Canales
                        $canal1_id = $result['id_canal1'];
                        $canal1_nombre = $result['nombre_canal1'];

                        $canal2_id = $result['id_canal2'];
                        $canal2_nombre = $result['nombre_canal2'];

                        $canal3_id = $result['id_canal3'];
                        $canal3_nombre = $result['nombre_canal3'];

                        $canal4_id = $result['id_canal4'];
                        $canal4_nombre = $result['nombre_canal4'];

                        $canal5_id = $result['id_canal5'];
                        $canal5_nombre = $result['nombre_canal5'];

                        $canal6_id = $result['id_canal6'];
                        $canal6_nombre = $result['nombre_canal6'];

                        $canal7_id = $result['id_canal7'];
                        $canal7_nombre = $result['nombre_canal7'];

                        $canal8_id = $result['id_canal8'];
                        $canal8_nombre = $result['nombre_canal8'];

                        $canal9_id = $result['id_canal9'];
                        $canal9_nombre = $result['nombre_canal9'];

                        $canal10_id = $result['id_canal10'];
                        $canal10_nombre = $result['nombre_canal10'];
                        ?>
                        <!-- Item -->
                        <div class="swiper-slide h-auto py-3" data-id="<?= $index ?>">
                            <article class="card border-primary card-hover p-md-3 p-2 hadow-sm card-hover-primary h-100 mx-2">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="?p=eventos&tipo=<?= $tipo ?>"
                                        class="badge fs-sm text-nav bg-secondary text-decoration-none position-relative zindex-2">
                                        <?= ucfirst($tipo) ?>
                                    </a>
                                    <span class="fs-sm text-muted">
                                        <p class="counter cntdwn-<?= $index ?>"></p>
                                    </span>
                                </div>
                                <a href="?p=eventos&tipo=<?= $tipo ?>&liga=<?= $liga_id ?>&juego=<?= $index ?>">
                                    <div class="mini-league">
                                        <img width="50px"
                                            src="assets/img/ligas/sf/<?= $liga_id ?>.png"
                                            alt="">
                                        <h5>
                                            <?= $liga ?>
                                        </h5>
                                    </div>
                                    <div class="main-event">
                                        <div class="match">
                                            <div class="team">
                                                <img src="assets/img/equipos/sf/<?= $local_id ?>.png"
                                                    class="image" alt="image">
                                                <h4><?= ucfirst($local) ?></h4>
                                            </div>
                                            <h5 class="vs">vs</h5>
                                            <div class="team">
                                                <img src="assets/img/equipos/sf/<?= $visitante_id ?>.png"
                                                    class="image" alt="image">
                                                <h4><?= ucfirst($visitante) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>

                        <script>
                            var yyyy = 2024;
                            var mm = '<?= $mm_1 - 1 ?>';
                            var dd = '<?= $dd_1 ?>';
                            var hh = '<?= $hh_1 ?>';
                            var m = '<?= $m_1 ?>';

                            var textLive = "<div class='d-flex align-items-center me-4'><i class='bx bxs-circle bx-flashing fs-xl me-1'></i>EN VIVO</div>";
                            var textEnd = "Finalizó";



                            // Set the date we're counting down to
                            // Year, Month ( 0 for January ), Day, Hour, Minute, Second, , Milliseconds
                            //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                            //::::::::::::                                       ::::::::::::
                            //::::::::::::              12:00 AM                  ::::::::::::
                            //::::::::::::                                       ::::::::::::
                            //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                            //                                              (AAAA, MM, DD, HH, MM, SS));
                            var countDownDate<?= $index ?> = new Date(Date.UTC(yyyy, mm, dd, hh, m, 00));

                            // Update the count down every 1 second
                            var x<?= $index ?> = setInterval(function () {

                                // Get todays date and time
                                var now<?= $index ?> = new Date().getTime();

                                // Find the distance between now an the count down date
                                // GMT/UTC Adjustment at the end of the function. 0 = GMT/UTC+0; 1 = GMT/UTC+1.
                                var distance<?= $index ?> = countDownDate<?= $index ?> - now<?= $index ?> - (3600000 * 2);

                                // Time calculations for days, hours, minutes and seconds
                                var days<?= $index ?> = Math.floor(distance<?= $index ?> / (1000 * 60 * 60 * 24));
                                var hours<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60)) / 1000);

                                // Output the result in an element with id="demo"
                                if (days<?= $index ?> > 0) {
                                    for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                        ele.innerHTML = (days<?= $index ?> + "d " + hours<?= $index ?> + "h "
                                            + minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                    }
                                } else if (hours<?= $index ?> == 0) {
                                    for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                        ele.innerHTML = (minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                    }
                                } else if (minutes<?= $index ?> == 0) {
                                    for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                        ele.innerHTML = (seconds<?= $index ?> + "s")
                                    }
                                } else {
                                    for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                        ele.innerHTML = (hours<?= $index ?> + "h "
                                            + minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                    }
                                }
                                // If the count down is over, write some text
                                if (distance<?= $index ?> < 0) {
                                    for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                        ele.innerHTML = textLive;
                                    }
                                    if (distance<?= $index ?> + 10800000 < 0) {
                                        for (const allEllements of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                            allEllements.innerHTML = textEnd;
                                        }
                                    }
                                }
                            }, 1000
                                //5000
                            );
                        </script>
                    <?php endif; endif; endwhile; ?>
        </div>

        <!-- Pagination (bullets) -->
        <div class="swiper-pagination position-relative pt-2 pt-sm-3 mt-4"></div>
    </div>
</section>