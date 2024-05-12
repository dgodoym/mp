const fs = require('fs');
const twitch = require("twitch-m3u8");

const canales = ["chavo8tv", "roier", "staryuuki"];
const datosCanales = [];

async function obtenerYGuardarCanales() {
  for (let i = 0; i < canales.length; i++) {
    try {
      const data = await twitch.getStream(canales[i]);
      const canalInfo = {
        nombre: canales[i],
        datos: data
      };
      datosCanales.push(canalInfo);
      console.log(`Datos de ${canales[i]} obtenidos y guardados.`);
    } catch (error) {
      console.error(`Error al obtener datos de ${canales[i]}: ${error}`);
    }
  }

  fs.writeFileSync('datos_canales_twitch.json', JSON.stringify(datosCanales, null, 2));
  console.log('Datos guardados en datos_canales_twitch.json');
}

obtenerYGuardarCanales();
