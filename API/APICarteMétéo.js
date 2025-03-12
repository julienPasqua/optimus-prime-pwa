let map = L.map('map').setView([41.952834, 8.784623], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let robotMarker = L.marker([41.952834, 8.784623]).addTo(map)
    .bindPopup("Position du Robot")
    .openPopup();

function updateRobotPosition(lat, lng) {
    robotMarker.setLatLng([lat, lng])
        .bindPopup(`Position: ${lat}, ${lng}`)
        .openPopup();
    map.setView([lat, lng], 15); // Recentrer la carte sur le robot
}

setInterval(() => {
    fetch("position_robot.json") // Récupération des données depuis un fichier ou API
        .then(response => response.json())
        .then(data => {
            updateRobotPosition(data.lat, data.lng);
        })
        .catch(error => console.log("Erreur récupération GPS:", error));
}, 2000); // Mise à jour toutes les 2 secondes

let robotLocation = { latitude: 41.952834, longitude: 8.784623};

// Fonction pour obtenir la géolocalisation
function getRobotLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                robotLocation.latitude = position.coords.latitude;
                robotLocation.longitude = position.coords.longitude;
                console.log("Position du robot :", robotLocation);
                           
                getWeather();
            },
            (error) => {
                console.error("Erreur de géolocalisation :", error);
            }
        );
    } else {
        console.error("Géolocalisation non supportée par ce navigateur.");
    }
}

function getWeather() {
    const apiKey = "f39bcc0de34ae6344d2cd29dd3e2831c";     
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${robotLocation.latitude}&lon=${robotLocation.longitude}&appid=${apiKey}&units=metric&lang=fr`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log("Météo :", data);
            document.getElementById("weather").innerHTML = 
                `Température : ${data.main.temp}°C<br>🌤️ ${data.weather[0].description}`;
        })
        .catch((error) => console.error("Erreur API météo :", error));
}


getRobotLocation();
