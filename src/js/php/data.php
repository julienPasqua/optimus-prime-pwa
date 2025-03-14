<?php
// data.php - Récupérer les événements depuis la base de données
include 'database.php'; // Inclure la connexion à la base de données

// Récupérer tous les événements
$query = $pdo->query("SELECT * FROM events");
$events = $query->fetchAll(PDO::FETCH_ASSOC); // Récupérer les résultats

// Convertir les événements en JSON pour les envoyer au JavaScript
echo json_encode($events); // Afficher les événements en JSON
?>
