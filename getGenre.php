<?php
require_once('vendor/autoload.php');
include 'loadEnv.php';

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?language=fr', [
  'headers' => [
    'Authorization' => 'Bearer ' . $_ENV['MOVIEDB_TOKEN'],
    'accept' => 'application/json',
  ],
]);
$contents = $response->getBody()->getContents();
//print_r(json_decode($contents));
$array = (array) $contents[0];
print_r($array);
/*
//echo $response;
//print_r($contents);
echo '<br>';
$array = (array) $contents;
print_r($response);
echo '<br>';
*/
try {
// Ouverture connexion
$conn = new PDO('mysql:host=' . $_ENV['DB_SERVERNAME'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
// Mettre le mode erreur
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Utiliser la co
$stmt = $conn->prepare('SELECT * FROM genres');
$stmt->execute();
$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($genres);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
// et maintenant, fermez-la !
$conn = null;
?>