<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Robot Autonome PWA</title>
  <!-- Import de Socket.io -->
  <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
  <script src="js/app.js" defer></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Robot Autonome avec Arduino 🚀</h1>

  <!-- Affichage des données -->
  <div>
    <p>Température : <span id="temperature">-</span> °C</p>
    <p>Fumée détectée : <span id="smoke">-</span></p>
    <p>Distance : <span id="distance">-</span> cm</p>
  </div>

  <!-- Boutons de contrôle -->
  <button id="led">Allumer la LED</button>
  <button id="motor">Démarrer le moteur</button>

</body>
</html>
