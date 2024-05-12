var player = new Clappr.Player({
    source: atob(getURL),
    parentId: "#player",
    watermark: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
    position: "top-left",
    plugins: [LevelSelector, ClapprPip.PipButton, ClapprPip.PipPlugin, DashShakaPlayback, ChromecastPlugin, ClapprPip.PipButton, ClapprPip.PipPlugin],
    events: {
        onReady: function () {
            var plugin = this.getPlugin("click_to_pause");
            plugin && plugin.disable();
        },
    },
    chromecast: {
        appId: "9DFB77C0",
        contentType: "video/mp4",
    },
    gaAccount: "G-Z7958KV9CY",
    gaTrackerName: "MyPlayerInstance",
    height: "100%",
    width: "100%",
    autoPlay: true,
    muted: false,
    shakaConfiguration: {
        preferredAudioLanguage: "es-MX",
        drm: {
            clearKeys: {getKEY},
        },
    },
});