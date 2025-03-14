// Importation des modules
const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const five = require("johnny-five");

// Création du serveur Express
const app = express();
const server = http.createServer(app);
const io = socketIo(server);

// Connexion à Arduino
const board = new five.Board();

board.on("ready", () => {
  console.log("Arduino est connecté ✅");

  // Capteur de température (exemple avec LM35)
  const temperature = new five.Thermometer({
    controller: "LM35",
    pin: "A0",
  });

  // Capteur de fumée (MQ2 par exemple)
  const smokeSensor = new five.Sensor("A1");

  // Capteur de distance (Ultrason)
  const sonar = new five.Sensor({
    pin: "A2",
    freq: 100,
  });

  // Écoute des données des capteurs
  temperature.on("data", () => {
    io.emit("temperature", temperature.celsius); // Envoie la température au client
  });

  smokeSensor.on("change", () => {
    io.emit("smokeDetected", smokeSensor.value); // Envoie la fumée au client
  });

  sonar.on("change", () => {
    io.emit("distance", sonar.value); // Envoie la distance au client
  });

  // Écoute les commandes depuis le client
  io.on("connection", (socket) => {
    console.log("Client connecté 🚀");

    // Éteindre la LED depuis le client
    socket.on("ledOff", () => {
      console.log("LED éteinte");
    });

    // Démarrer le moteur depuis le client
    socket.on("motorStart", () => {
      console.log("Moteur démarré");
    });
  });
});

// Démarrer le serveur sur le port 8888
server.listen(8888, () => {
  console.log("Serveur Socket.io en ligne sur http://localhost:8888");
});
