<?php
// iframes
if (isset($_GET['ifr'])) {
    if (isset($_GET['nba'])) {
        $chnImg = "nbalp";
        $canalNombre = "NBA League Pass";
    } elseif (isset($_GET['nfl'])) {
        $chnImg = "nfl";
        $canalNombre = "NFL TV";
    } elseif (isset($_GET['mlb'])) {
        $chnImg = "mlb";
        $canalNombre = "MLB TV";
    }
} else {
    // Star
    if (isset($_GET['r']) && isset($_GET['key'])) {
        $chnImg = "starplus";
        $canalNombre = $_GET['title'];
    } elseif (isset($_GET['v'])) {
        $chnImg = "vix";
        $canalNombre = $_GET['title'];
    } else {
        $chnImg = $result['canalImg'];
        $chnTxt = $result['canalNombre'];
    }
}
?>