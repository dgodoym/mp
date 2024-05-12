<?php
include('../conn.php');
$canal = $_GET['c'];
$query = mysqli_query($conn, "select * from channels
where channelId='" . $canal . "'");
$result = mysqli_fetch_assoc($query);
$source = base64_encode("https://channel-".$result['channelUrl']."-cdn.blim.com/manifest.mpd");
$key = $result['key'];
$key2 = $result['key2'];
echo '
<script>
    let source = "'.$source.'";
    let key = "'.$key.'";
    let key2 = "'.$key2.'";
</script>
'
?>
<style>
    body {
        background: #000;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 100%!important;
        height: 100vh!important;
    }
    #player {
        height: 100%!important;
        width: 100%!important;
    }
</style>
<script src="https://ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
<script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
<script>
    if (window.location.protocol != "https:") {
        location.href =   location.href.replace("http://", "https://");
    }
</script>
<div class="container">
    <div id="player"></div>
</div>
<script>
    var playerInstance = jwplayer("player");
    playerInstance.setup({
        playlist: [{
            "sources": [{
                "file": atob(source),
                "drm": {
                    "widevine": {
                        "headers": [{
                            "name": "authorization",
                            "value": atob("T0F1dGggb2F1dGhfY29uc3VtZXJfa2V5PTMzZWVlZjMyOWZkMzEyNzQzN2Q0YWJjZmFkN2U5MjE0NGM3ODUyMTVmZDA3MmUyZGRkMzYwMjhlZDVmNGIwNjMsIG9hdXRoX25vbmNlPURHQk01Qiwgb2F1dGhfc2lnbmF0dXJlPWxwa3NFSUM0TkhkbnV1U3Q5czNnOUR1bzdRQSUzRCwgb2F1dGhfc2lnbmF0dXJlX21ldGhvZD1ITUFDLVNIQTEsIG9hdXRoX3RpbWVzdGFtcD0xNjUwOTk1ODI2LCBvYXV0aF92ZXJzaW9uPTEuMA==")
                        }],
                        "url": atob("Ly9hcGkuYmxpbS5jb20vbGljZW5zZS93aWRldmluZQ==")
                    }
                }
            }]
        }],
        height: "100%",
        width: "100%",
        aspectratio: "16:9",
        stretching: "bestfit",
        mediaid: "player",
        mute: false,
        autostart: true,
        language: "es",
        cast: {
            appid: "player",
            logo: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
        },
        logo: {
            file: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
            hide: "false",
            position: "top-left",
        }
    });
    // Preview Hack
    setTimeout(function() {
        jwplayer().setMute(false);
        jwplayer().setControls(true);
    }, 1000);
    jwplayer().onTime(function(object) {
        if (object.position > object.duration - 1) {
            jwplayer().pause();
        }
    });

    function goFullscreen(id) {
        // Get the element that we want to take into fullscreen mode
        var element = document.getElementById("jwp");
        // These function will not exist in the browsers that don't support fullscreen mode yet,
        // so we'll have to check to see if they're available before calling them.
        if (element.mozRequestFullScreen) {
            // This is how to go into fullscren mode in Firefox
            // Note the "moz" prefix, which is short for Mozilla.
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullScreen) {
            // This is how to go into fullscreen mode in Chrome and Safari
            // Both of those browsers are based on the Webkit project, hence the same prefix.
            element.webkitRequestFullScreen();
        }
        // Hooray, now we're in fullscreen mode!
    }
</script>