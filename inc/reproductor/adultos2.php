<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    //include('../../401.php');
    //exit();
}
?>
<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
<script> //ConsoleBan.init({ redirect: '../../?p=401' }); </script>
<section class="container text-center pt-5 mt-2 mt-md-4 mt-lg-5">
    <style>
        .canal-card {
            cursor: pointer;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .embed-responsive {
            background-color: #000;
            position: relative;
            box-shadow: 2px 2px 8px 2px #6366f1;
            transition: all 0.3s ease;
            border-radius: 10px;
            height: 50vh;
            overflow: hidden;
            text-align: center;
            float: center;
        }

        #player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50vh;
        }

        #channelsList {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="embed-responsive">
                <div id="player">Selecciona un canal para cargar el reproductor</div>
            </div>
            <hr>
        </div>
</section>
<script>
    var player = jwplayer("player");
    var playlist = [];
    for (var i = 0; i < 31; i++) {
        var videoId = Math.floor(Math.random() * 2500);
        playlist.push({
            file: "//videos.pornworms.com/media/videos/mp4/" + videoId + ".mp4",
            image: getThumbnailUrl(videoId),
            title: "Video " + (i + 1)
        });
    }

    player.setup({
        playlist: playlist,
        height: '100%',
        width: '100%',
        image: getThumbnailUrl(videoId),
        autostart: true,
        repeat: true
    });

    player.on('playlistItem', function (event) {
        var playlistItem = player.getPlaylistItem(event.index);
        var previewImage = document.createElement('img');
        previewImage.setAttribute('src', playlistItem.image);
        previewImage.classList.add('jw-preview-image');
        document.querySelector('.jw-playlist-item-' + event.index + ' .jw-media-image-container').appendChild(previewImage);
    });

    function getThumbnailUrl(videoId) {
        var formattedVideoId = ('000000' + videoId).substr(-6);
        return "//images.pornworms.com/media/videos/tmb/000/" + formattedVideoId.substr(0, 3) + "/" + formattedVideoId.substr(3, 3) + "/" + videoId % 10 + ".jpg";
    }
</script>