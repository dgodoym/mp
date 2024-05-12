<?php
// Collapse Events
// Juego
$getJuego = $_GET['juego'];
if ($getJuego == $index){
    $collapse = "show";
    $aria = "true";
} else {
    $collapse = "";
    $aria = "false";
}

if (!isset($result['fecha_hora'])){
    $fecha = $ress['fecha_hora'];
} else {
    $fecha = $result['fecha_hora'];
}

$mm = substr($fecha, 5, 2);
$dd = substr($fecha, 8, 2);
$hh = substr($fecha, 11, 2);
$m = substr($fecha, 14, 2);
?>
<script>
var yyyy = 2024;
var mm = '<?=$mm-1?>';
var dd = '<?=$dd?>';
var hh = '<?=$hh?>';
var m = '<?=$m?>';

var textLive = "<p style='position: absolute;' class='live-text'><div class='d-flex align-items-center me-4'><i class='bx bxs-circle bx-flashing fs-xl me-1'></i> EN VIVO</div></p>";
var textEnd = "Finalizó";



    // Set the date we're counting down to
    // Year, Month ( 0 for January ), Day, Hour, Minute, Second, , Milliseconds
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    //::::::::::::                                       ::::::::::::
    //::::::::::::              12:00 AM                  ::::::::::::
    //::::::::::::                                       ::::::::::::
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    //                                              (AAAA, MM, DD, HH, MM, SS));
    var countDownDate<?=$index?> = new Date(Date.UTC(yyyy, mm, dd, hh, m, 00));

    // Update the count down every 1 second
    var x<?=$index?> = setInterval(function () {

    // Get todays date and time
    var now<?=$index?> = new Date().getTime();

    // Find the distance between now an the count down date
    // GMT/UTC Adjustment at the end of the function. 0 = GMT/UTC+0; 1 = GMT/UTC+1.
    var distance<?=$index?> = countDownDate<?=$index?> - now<?=$index?> - (3600000 * 2);

    // Time calculations for days, hours, minutes and seconds
    var days<?=$index?> = Math.floor(distance<?=$index?> / (1000 * 60 * 60 * 24));
    var hours<?=$index?> = Math.floor((distance<?=$index?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes<?=$index?> = Math.floor((distance<?=$index?> % (1000 * 60 * 60)) / (1000 * 60));
    var seconds<?=$index?> = Math.floor((distance<?=$index?> % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    if (days<?=$index?> == 1){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("Mañana")
        }
    } else if (days<?=$index?> > 0 && days<?=$index?> < 7){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = (days<?=$index?> + "d " + hours<?=$index?> + "h ")
        }
    } else if (days<?=$index?> > 6 && days<?=$index?> < 14){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("Próx. Semana")
        }
    } else if (days<?=$index?> > 13 && days<?=$index?> < 21){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("2 Semanas")
        }
    } else if (days<?=$index?> > 20 && days<?=$index?> < 28){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("3 Semanas")
        }
    } else if (days<?=$index?> > 27 && days<?=$index?> < 60){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("Próx. Mes")
        }
    } else if (days<?=$index?> > 59 && days<?=$index?> < 90){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("2 Meses")
        }
    } else if (days<?=$index?> > 89 && days<?=$index?> < 120){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = ("3 Meses")
        }
    } else if (days<?=$index?> == 0){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = (hours<?=$index?> + "h " + minutes<?=$index?> + "m " + seconds<?=$index?> + "s")
        }
    } else if (hours<?=$index?> == 0 && days<?=$index?> == 0){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = (minutes<?=$index?> + "m " + seconds<?=$index?> + "s")
        }
    } else if (hours<?=$index?> == 0 && minutes<?=$index?> == 0){
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = (seconds<?=$index?> + "s")
        }
    } else {
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")){
            ele.innerHTML = (days<?=$index?> + "d " + hours<?=$index?> + "h "
            + minutes<?=$index?> + "m " + seconds<?=$index?> + "s")
        }
    }
    // If the count down is over, write some text
    if (distance<?=$index?> < 0) {
        for (const ele of document.getElementsByClassName("cntdwn-<?=$index?>")) {
            ele.innerHTML = textLive;
        }
        // 3 hs
        if (distance<?=$index?> + 10800000 < 0) {
            for (const allEllements of document.getElementsByClassName("cntdwn-<?=$index?>")) {
                allEllements.innerHTML = textEnd;
            }
        }
        // 6 meses
        if (distance<?=$index?> > 15778800000) {
            for (const allEllements of document.getElementsByClassName("cntdwn-<?=$index?>")) {
                allEllements.innerHTML = "Por definir";
            }
        }
    }
}, 1000);
</script>