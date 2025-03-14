<?php
include 'php/database.php';

// Récupérer tous les événements
$query = $pdo->query("SELECT * FROM event");
$events = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Historique des événements</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Historique des événements</h1>

  <table>
    <tr>
      <th>ID</th>
      <th>Type d'événement</th>
      <th>Exploration</th>
      <th>Date</th>
    </tr>
    <?php foreach($events as $event): ?>
      <tr>
        <td><?= $event['id'] ?></td>
        <td><?= $event['type_id'] ?></td>
        <td><?= $event['exploration_id'] ?></td>
        <td><?= $event['date_event'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
