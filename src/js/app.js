// Connexion Socket.io
const socket = io('http://localhost:8888');

// Écoute des capteurs
socket.on('temperature', (temperature) => {
  document.getElementById('temperature').innerText = temperature.toFixed(2);

  // Si la température dépasse 50°C => événement
  if (temperature > 50) {
    sendEventToPHP(1, 1); // Exemple : type_id = 1 (température), exploration_id = 1
  }
});

socket.on('smoke', (fumee) => {
  document.getElementById('smoke').innerText = fumee > 300 ? 'Fumée détectée !' : 'Normal';

  // Si fumée détectée => événement
  if (fumee > 300) {
    sendEventToPHP(2, 1); // type_id = 2 (fumée), exploration_id = 1
  }
});

socket.on('distance', (distance) => {
  document.getElementById('distance').innerText = distance;

  // Si distance inférieure à 10 cm => événement
  if (distance < 10) {
    sendEventToPHP(3, 1); // type_id = 3 (distance), exploration_id = 1
  }
});

// Fonction pour envoyer l'événement à PHP en utilisant async/await
async function sendEventToPHP(type_id, exploration_id) {
  try {
    // Utilisation de fetch avec await pour attendre la réponse
    const response = await fetch('../src/php/save_event.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `type_id=${type_id}&exploration_id=${exploration_id}`,
    });

    // Attendre la réponse et la convertir en texte
    const data = await response.text();

    // Afficher le message de succès ou d'erreur
    console.log('Événement enregistré :', data);
  } catch (error) {
    console.error('Erreur lors de l\'enregistrement de l\'événement:', error);
  }
}

// Fonction pour récupérer les événements en utilisant async/await
async function getEvents() {
  try {
    // Utilisation de fetch avec await pour attendre la réponse
    const response = await fetch('../src/php/data.php');

    // Attendre la réponse et la convertir en JSON
    const data = await response.json();

    // Afficher les événements récupérés
    console.log('Événements récupérés :', data);
  } catch (error) {
    console.error('Erreur lors de la récupération des événements:', error);
  }
}
