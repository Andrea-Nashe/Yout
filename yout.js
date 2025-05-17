const axios = require('axios');

const headers = {
  Authorization: "API_KEY"
};

const videoUrl = Buffer.from("VIDEO_URL").toString('base64');

const data = {
  video_url: videoUrl,
  start_time: false,
  end_time: false,
  title: "Hello world",
  artist: "Hello world",
  audio_quality: "128k"
};

axios
  .post("https://dvr.yout.com/mp3", data, { headers })
  .then(response => {
    const fs = require('fs');
    const fileStream = fs.createWriteStream("audio.mp3");

    response.data.pipe(fileStream);

    fileStream.on('finish', () => {
      console.log("Archivo descargado con éxito como audio.mp3");
    });

    fileStream.on('error', error => {
      console.error("Error al escribir el archivo:", error);
    });
  })
  .catch(error => {
    console.error("Error en la solicitud:", error);
  });