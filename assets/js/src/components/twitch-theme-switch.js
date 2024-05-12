const twitchThemeSwitch = (() => {
    let themeSwitch = document.querySelector('[data-bs-toggle="mode"]');
    if (themeSwitch === null) return;

    let checkbox = themeSwitch.querySelector('.form-check-input');
    const twitchChat = document.getElementById('twitch-chat-embed');

    // Función para cambiar el modo del chat de Twitch
    function toggleChatMode() {
        const isDarkMode = checkbox.checked;
        const chatMode = isDarkMode ? 'darkpopout' : 'lightpopout';
        twitchChat.src = `https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&${chatMode}`;
    }

    // Configurar el evento clic para cambiar el modo del chat de Twitch
    themeSwitch.addEventListener('click', toggleChatMode);

    return {
        // Puedes exponer funciones o variables aquí si las necesitas fuera del módulo.
    };
})();