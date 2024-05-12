<section class="container pb-2 pb-md-4 pb-lg-5 mb-3">
    <h1 class="pb-4">Eventos de Motor En Vivo
    </h1>
    <div class="container">
        <div class="row">
            <?php
            //error_reporting(E_ALL);
            //ini_set('display_errors', '1');
            date_default_timezone_set('Europe/Madrid');
            // Season Info
            $apiSeason = "https://api.sofascore.com/api/v1/stage/sport/motorsport/featured";
            $data = file_get_contents($apiSeason);
            $jsonData = json_decode($data, true);
            $index = 0;
            foreach ($jsonData["stages"] as $key => $value) {
                $index++;
                $seasonId = $value['id'];
                $eventName = $value['name'];
                $type = $value['uniqueStage']['category']['name'];
                $typeId = $value['uniqueStage']['id'];
                $slug = $value['uniqueStage']['slug'];
                $countryName = $value['country']['name'];
                $countryCode = $value['country']['alpha2'];
                $startTime = date('Y-m-d H:i:s', $value['startDateTimestamp']);
                $endTime = date('Y-m-d H:i:s', $value['endDateTimestamp']);
                $mm_0 = substr($startTime, 5, 2);
                $dd_0 = substr($startTime, 8, 2);
                $hh_0 = substr($startTime, 11, 2);
                $m_0 = substr($startTime, 14, 2);
                // Adicional
                $circuitName = $value['info']['circuit'];
                $circuitCity = $value['info']['circuitCity'];
                ?>
                <!-- Elemento -->
                <div class="col-12 mycard">
                    <a data-bs-toggle="collapse" href="#juego<?= $index ?>" role="button" aria-expanded="<?= $aria ?>"
                        aria-controls="juego<?= $index ?>">
                        <div class="card product-card">
                            <div class="main-event">
                                <div class="league">
                                    <img src="https://www.sofascore.com/static/images/flags/<?= $slug ?>.png"
                                        alt="League" />
                                    <p class="counter cntdwn-<?= $index ?>"></p>
                                </div>
                                <div class="match">
                                    <div class="team">
                                        <img width="50px"
                                            src="https://www.sofascore.com/static/images/flags/<?= strtolower($countryCode) ?>.png"
                                            alt="" />
                                        <h4>
                                            <?= ucfirst($eventName) ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="channel">
                                    <img src="assets/img/canales/dazn.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="collapse <?= $collapse ?>" id="juego<?= $index ?>">
                        <div class="card card-body">
                            <div class="list-group text-center">
                                <?php
                                if ($typeId == 40) { //F1 ?>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=1&f=3">
                                        <i class="flag es"></i>
                                        DAZN F1
                                    </a>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=314&f=191">
                                        <i class="flag mx"></i>
                                        Fox Sports
                                    </a>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=316&f=193">
                                        <i class="flag mx"></i>
                                        Fox Sports 3
                                    </a>
                                    <a class="justify-content-center list-group-item list-group-item-action" href="?p=star">
                                        <i class="flag ar"></i>
                                        Star+
                                    </a>
                                <?php } elseif ($typeId == 17 || $typeId == 16 || $typeId == 15) { // MotoGP ?>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=1&f=1">
                                        <i class="flag es"></i>
                                        DAZN 1
                                    </a>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=1&f=2">
                                        <i class="flag es"></i>
                                        DAZN 2
                                    </a>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=39&f=219">
                                        <i class="flag us"></i>
                                        TNT Sports 2
                                    </a>
                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&c=7&f=30">
                                        <i class="flag nl"></i>
                                        Ziggo Select
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <script>
                        var yyyy = 2023;
                        var mm = '<?= $mm_0 - 1 ?>';
                        var dd = '<?= $dd_0 ?>';
                        var hh = '<?= $hh_0 ?>';
                        var m = '<?= $m_0 ?>';

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
                            var distance<?= $index ?> = countDownDate<?= $index ?> - now<?= $index ?> - (3600000 * 0);

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
                    <?php
            }
            ?>
            </div>
        </div>
</section>