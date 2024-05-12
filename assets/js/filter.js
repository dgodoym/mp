document.addEventListener('DOMContentLoaded', function () {
    var input = document.querySelector('.form-control');
    var dropdown = document.querySelectorAll('.dropdown-item');
    var canales = document.querySelectorAll('.canal');
    var adultosCheckbox = document.getElementById("adultos");
    // Filtro de búsqueda
    input.addEventListener('input', function () {
        var searchTerm = input.value.toLowerCase();
        // Ciclo para determinar mostrar/ocultar
        canales.forEach(function (card) {
            var channelName = card.querySelector('.card .card-title').textContent.toLowerCase();
            if (channelName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    // Filtro de Categorías
    dropdown.forEach(function (item) {
        item.addEventListener('click', function () {
            var category = item.getAttribute('data-category').toLowerCase();
            canales.forEach(function (card) {
                var cardCategory = card.getAttribute('data-category').toLowerCase();
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    // Filtro para canales adultos
    adultosCheckbox.addEventListener('change', function () {
        localStorage.setItem('mostrarAdultos', adultosCheckbox.checked);
        canales.forEach(function (card) {
            var cardCategory = card.getAttribute('data-category').toLowerCase();
            var mostrarAdultos = localStorage.getItem('mostrarAdultos') === 'true';

            if (mostrarAdultos || (cardCategory !== '22' && cardCategory !== 'adultos')) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    // Elección del usuario
    var mostrarAdultos = localStorage.getItem('mostrarAdultos') === 'true';
    adultosCheckbox.checked = mostrarAdultos;
    canales.forEach(function (card) {
        var cardCategory = card.getAttribute('data-category').toLowerCase();
        if (mostrarAdultos || cardCategory !== '22') {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Fake Player
var playerFake = document.getElementById("playerFake");
var playerContainer = document.getElementById("playerContainer");
var twitchChatEmbed = document.getElementById("twitch-chat-embed");

playerFake.addEventListener("click", function () {
    console.log("Click en player fake");
    playerContainer.classList.remove("hidden");
    twitchChatEmbed.classList.remove("hidden");
    playerFake.style.display = "none";
});
