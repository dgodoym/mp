let xhr = new XMLHttpRequest();
let url = "https://iptv-org.github.io/iptv/categories/music.m3u";
let container = document.getElementById("canales");
let playerContainer = document.getElementById("playerContainer");
let titleContainer = document.getElementById("titleContainer");
let placeholder = document.querySelector(".list-cargando");
let categoryDropdown = document.getElementById("categoryDropdown");
let canalesContainer = document.getElementById("canales");
titleContainer.textContent = "Canales de TV Abierta";
// Default
cargarCanales("https://iptv-org.github.io/iptv/index.m3u");

categoryDropdown.addEventListener("click", function (event) {
    let target = event.target;
    if (target.tagName === "A") {
        let selectedCategory = target.getAttribute("data-category");
        
        if (selectedCategory === "all") {
            // Si se selecciona "Todo", cargar todos los canales
            canalesContainer.innerHTML = "";
            url = "https://iptv-org.github.io/iptv/index.m3u";
        } else {
            // Si se selecciona una categoría específica, cargar los canales desde la URL de esa categoría
            canalesContainer.innerHTML = "";
            url = `https://iptv-org.github.io/iptv/categories/${selectedCategory}.m3u`;
        }
        cargarCanales(url);
    }
});

function cargarCanales(url) {
    let xhr = new XMLHttpRequest();

    xhr.open("GET", url, true);

    xhr.onload = function () {
        if (xhr.status == 200) {
            let m3uContent = xhr.responseText;
            let lines = m3uContent.split("\n");

            for (let i = 0; i < lines.length; i++) {
                let line = lines[i].trim();
                console.log(i)

                if (line.startsWith("#EXTINF:")) {
                    let info = line.match(/tvg-id="([^"]*)" tvg-logo="([^"]*)" group-title="([^"]*)",(.*)/);
                    let channelUrl = lines[i + 1];

                    // Crear un nuevo elemento de lista
                    let listItem = document.createElement("a");
                    listItem.className = "list-group-item list-group-item-action";
                    listItem.href = "#top";
                    listItem.textContent = info[4]; // Nombre del canal
                    listItem.setAttribute("data-url", channelUrl); // Almacena la URL del canal como atributo de datos
                    listItem.addEventListener("click", function (event) {
                        event.preventDefault();
                        let channelUrl = this.getAttribute("data-url");
                        setupJWPlayer(channelUrl);
                        playerContainer.classList.remove("embed-responsive-16by9");
                        titleContainer.textContent = info[4];
                    });

                    // Agregar el elemento de lista al contenedor de canales
                    container.appendChild(listItem);

                    i++; // Saltar a la siguiente entrada de canal
                }
                placeholder.style.display = "none";
            }
        }
    };

    xhr.send();
}

function setupJWPlayer(channelUrl) {
    if (jwplayer("player")) {
        jwplayer("player").remove();
    }

    // Configurar el reproductor JW Player
    let playerInstance = jwplayer("player").setup({
        playlist: [
            {
                sources: [
                    {
                        default: false,
                        file: channelUrl,
                        type: "hls",
                    },
                ],
            },
        ],
        height: "100vh",
        width: "100%",
        aspectratio: "16:9",
        stretching: "bestfit",
        autostart: true,
        mute: false,
        language: "es",
        logo: {
            file: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
            hide: false,
            position: "top-left",
        }
    });
}


// FILTRO
let searchInput = document.querySelector('.form-control');
let canales = document.getElementById("canales").getElementsByClassName("list-group-item");

searchInput.addEventListener("input", function () {
    let searchTerm = searchInput.value.toLowerCase();

    for (let i = 0; i < canales.length; i++) {
        let canal = canales[i];
        let canalNombre = canal.textContent.toLowerCase();

        if (canalNombre.includes(searchTerm)) {
            canal.style.display = "block";
        } else {
            canal.style.display = "none";
        }
    }
});