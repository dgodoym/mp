<?php
// URL del archivo JSON
$json_url = "https://www.tdtchannels.com/lists/radio.json";

// Obtener el contenido del archivo JSON
$json_data = file_get_contents($json_url);

// Decodificar el JSON a un array asociativo
$data = json_decode($json_data, true);

// Acceder a la información y mostrarla
$countries = $data['countries'];

foreach ($countries as $country) {
    $ambits = $country['ambits'];
    foreach ($ambits as $ambit) {
        $channels = $ambit['channels'];
        foreach ($channels as $channel) {
            // Información Adicional
            $extra_info = $channel['extra_info'];
            if (!empty($extra_info)) {
                foreach ($extra_info as $info) {
                }
            }
            // Opciones de transmisión
            $options = $channel['options'];
            foreach ($options as $option) {
                ?>
                <div class="canal mycard col-6 col-md-4 col-lg-3 col-xl-2">
                    <a href="?p=radio&source=<?= base64_encode($option['url']) ?>&format=<?= $option['format'] ?>&title=<?= base64_encode($channel['name']) ?>&img=<?= base64_encode($channel['logo']) ?>&info=<?= base64_encode($info) ?>">
                        <div class="card border-primary shadow-sm card-hover card-hover-gradient" aria-hidden="true">
                            <div class="position-relative placeholder-wave">
                                <div class="card-header">
                                    <img class="card-img-canal placeholder-wave" src="<?= $channel['logo'] ?>" alt="Card image">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title placeholder-glow">
                                        <?= $channel['name'] ?>
                                    </h5>
                                    <div class="card-footer fs-sm text-muted placeholder-glow">
                                        <?= $ambit['name'] ?>
                                        <i class="flag <?= strtolower($country['name']) ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
    }
}
?>