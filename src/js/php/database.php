<?php
// database.php - Connexion à la base de données
$host = 'localhost'; // Hôte
$dbname = 'ton_nom_de_base_de_donnees'; // Remplace par le nom de ta base de données
$username = 'ton_utilisateur'; // Remplace par ton utilisateur MySQL
$password = 'ton_mot_de_passe'; // Remplace par ton mot de passe MySQL

try {
    // Connexion avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pour gérer les erreurs
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage(); // Si la connexion échoue
}
?>
