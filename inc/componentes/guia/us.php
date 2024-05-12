<style>
    .title-epg {
        margin: 0;
    }

    .desc-epg {
        margin-top: 1%;
    }

    .title-emision,
    .title-epg {
        font-size: 1.75rem;
        font-weight: 450;
    }
</style>
<?php
// Establecer la zona horaria a 'Europe/Madrid'
date_default_timezone_set('Europe/Madrid');
// Obtener el contenido del archivo XML
$xml = file_get_contents('https://raw.githubusercontent.com/acidjesuz/EPG/master/guide.xml');

// Crear un objeto SimpleXMLElement a partir del contenido del archivo XML
$sxml = new SimpleXMLElement($xml);

// Obtener la hora actual
$now = time();

// Especificar el canal que se desea mostrar
// $channel_to_show = 'La1.TV';
$channel_to_show = $canalEpg;

// Recorrer los nodos de programa y mostrar la información
foreach ($sxml->programme as $programme) {
    $start_time = strtotime((string) $programme['start']);
    $end_time = strtotime((string) $programme['stop']);
    $channel = (string) $programme['channel'];
    $title = (string) $programme->title;
    $description = (string) $programme->desc;
    $logo = (string) $programme->icon['src'];

    if (isset($channel_to_show)) {
        if ($start_time <= $now && $end_time > $now && $channel == $channel_to_show) { ?>
            <div class="col-12" id="guia" style="margin-left: 10px; margin-right: 10px;">
                <div style="display: flex;">
                    <img src="<?=$logo?>" alt="<?=$title?>"
                        style="max-width: 100px; max-height: 100%; margin-top: 10px; margin-bottom: 10px;">
                    <div style="margin-left: 10px;">
                        <h6 class="title-epg"><?=$title?></h6>
                        <p class="desc-epg">
                            <i><?=date('H:i', $start_time)?> - <?=date('H:i', $end_time)?></i>
                            <?=$description?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        } else {
            // No mostramos
        }
    } else {
        // Si el programa está en vivo, mostrar la información del programa en la página web
        if ($start_time <= $now && $end_time > $now) {
            echo '<p>Canal: ' . $channel . '</p>';
            echo '<p>Hora de inicio: ' . date('H:i', $start_time) . '</p>';
            echo '<p>Hora de fin: ' . date('H:i', $end_time) . '</p>';
            echo '<p>Título: ' . $title . '</p>';
            echo '<p>Descripción: ' . $description . '</p>';
        }
    }
}
?>