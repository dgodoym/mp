<?php

function getAdsGeneratingJs($zoneId, $zoneType)
{
    $ch = curl_init("https://youradexchange.com/ad/s2sadblock.php?zone_id={$zoneId}&zone_type={$zoneType}&v=2");
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT_MS => 100,
        CURLOPT_TIMEOUT_MS => 200,
    ));
    $javascriptCode = curl_exec($ch);
    curl_close($ch);

    // js to render in your web page
    return $javascriptCode;
}

echo getAdsGeneratingJs("7721598", "suv4");