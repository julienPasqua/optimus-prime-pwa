const five = require("johnny-five");
const http = require("http");
const socketIo = require("socket.io");

const server = http.createServer((req, res) => {
  res.writeHead(200, { 'Content-Type': 'text/plain' });
  res.end('Serveur en marche');
});

const io = socketIo(server);

const board = new five.Board();

board.on("ready", function() {
  console.log("Arduino est prêt!");

  // Capteur de température
  const thermometer = new five.Temperature({
    controller: "LM35",
    pin: "A0"
  });

  thermometer.on("data", function() {
    console.log("Température : " + this.celsius + "°C");
    io.emit('temperature', this.celsius);
  });

  // Capteur de fumée (analogue)
  const smokeSensor = new five.Sensor({
    pin: "A1",
    freq: 250
  });

  smokeSensor.on("data", function() {
    const smokeValue = this.value;
    console.log("Niveau de fumée : " + smokeValue);
    
    if (smokeValue > 300) {  // Ajuste ce seuil selon ton capteur
      console.log("Fumée détectée !");
      io.emit('smokeDetected', smokeValue);  // Envoi au client web
    }
  });

  // Capteur de distance (si tu utilises un capteur ultrasonique, ajuste le code si nécessaire)
  const distanceSensor = new five.Sensor({
    pin: "A2",
    freq: 500
  });

  distanceSensor.on("data", function() {
    const distanceValue = this.value;
    console.log("Distance : " + distanceValue + " cm");
    io.emit('distance', distanceValue);  // Envoi au client web
  });

  // Exemple : contrôler une LED ou un moteur comme dans ton code précédent
  const led = new five.Led(13);
  led.on();
  
  const motor = new five.Motor(9);
  motor.start(255);

  io.on('connection', (socket) => {
    console.log('Utilisateur connecté');
    
    socket.on('ledOff', () => {
      led.off();
      console.log('LED éteinte');
    });
    
    socket.on('motorStart', () => {
      motor.start(255);
      console.log('Moteur démarré');
    });
  });
});

// Démarrer le serveur sur le port 8888
server.listen(8888, () => {
  console.log("Serveur en écoute sur le port 8888");
});
