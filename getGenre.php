<?php
require_once('vendor/autoload.php');
include 'loadEnv.php';

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?language=en', [
  'headers' => [
    'Authorization' => 'Bearer ' . $_ENV['MOVIEDB_TOKEN'],
    'accept' => 'application/json',
  ],
]);

$contents = $response->getBody()->getContents();
$contents = json_decode($contents, true);

// Mnt qu'on a les genres dans une array, on va les enregistrer sur la db
try {
  // Ouverture connexion
  $conn = new PDO('mysql:host=' . $_ENV['DB_SERVERNAME_LOCAL'] . ';dbname=' . $_ENV['DB_NAME_LOCAL'], $_ENV['DB_USERNAME_LOCAL'], $_ENV['DB_PASSWORD_LOCAL']);
  // Mettre le mode erreur
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Repeter autant de fois qu'il y a de genre
  foreach ($contents['genres'] as $genre) {
      // Préparer la requête avec des paramètres
      $stmt = $conn->prepare("INSERT INTO genres (id, genre_name) VALUES (:id, :genre_name)");
      // Lier les valeurs aux paramètres
      $stmt->bindParam(':id', $genre['id'], PDO::PARAM_INT);
      $stmt->bindParam(':genre_name', $genre['name'], PDO::PARAM_STR);
      // Exécuter la requête
      $stmt->execute();
  }
  // Si une erreur apparait, le catch l'affichera
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
} finally {
  // Fermer la connexion dans tout les cas
  $conn = null;
}
?>