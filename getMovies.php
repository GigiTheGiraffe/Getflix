<?php
require_once('vendor/autoload.php');
include 'loadEnv.php';
function importPages($number)
{
  $client = new \GuzzleHttp\Client();

  $response = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?include_adult=true&include_video=false&language=en-US&page=$number&region=france&sort_by=vote_average.desc&vote_count.gte=1000", [
    'headers' => [
      'Authorization' => 'Bearer ' . $_ENV['MOVIEDB_TOKEN'],
      'accept' => 'application/json',
    ],
  ]);
  $response = json_decode($response->getBody()->getContents(), true);
  //echo '<pre>';
  //print_r($response['results']);
  //echo '<\pre>';
  return $response['results'];
}
// Boucle pour obtenir la réponse JSON de 50 pages, soit 1000 film.
/*for ($i = 1; $i < 51; $i++) {
$responses = importPages($i);
}*/
$responses = importPages(1);
echo '<pre>';
//print_r($responses);
insertIntoDb($responses);

function insertIntoDb($responses)
{
  try {
    // Ouverture connexion
    $conn = new PDO('mysql:host=' . $_ENV['DB_SERVERNAME_LOCAL'] . ';dbname=' . $_ENV['DB_NAME_LOCAL'], $_ENV['DB_USERNAME_LOCAL'], $_ENV['DB_PASSWORD_LOCAL']);
    // Mettre le mode erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Repeter autant de fois qu'il y a de films
    foreach ($responses as $film) {
      $stmt = $conn->prepare("INSERT INTO movieslist (movie_DB_Id, vote_average, poster_path, backdrop_path, original_language, title, overview, release_date) VALUES (:movie_DB_Id, :vote_average, :poster_path, :backdrop_path, :original_language, :title, :overview, :release_date)");
      // Lier les valeurs aux paramètres
      $stmt->bindParam(':movie_DB_Id', $film['id']);
      $stmt->bindParam(':vote_average', $film['vote_average']);
      $stmt->bindParam(':poster_path', $film['poster_path']);
      $stmt->bindParam(':backdrop_path', $film['backdrop_path']);
      $stmt->bindParam(':original_language', $film['original_language']);
      $stmt->bindParam(':title', $film['title']);
      $stmt->bindParam(':overview', $film['overview']);
      $stmt->bindParam(':release_date', $film['release_date']);
      // Executer la requete
      $stmt->execute();
      // Preparer la requete pour inserer les genres de chaque film dans la bonne db
      $stmt = $conn->prepare("INSERT INTO moviegenres (movie_id, genre_id_1, genre_id_2, genre_id_3) VALUES (:movie_id, :genre_id_1, :genre_id_2, :genre_id_3);");
      $stmt->bindParam(':movie_id', $film['id']);
      $genre1 = $film['genre_ids'][0] ?? null;
      $genre2 = $film['genre_ids'][1] ?? null;
      $genre3 = $film['genre_ids'][2] ?? null;

      // Bind genre IDs
      $stmt->bindParam(':genre_id_1', $genre1);
      $stmt->bindParam(':genre_id_2', $genre2);
      $stmt->bindParam(':genre_id_3', $genre3);

      // Execute the genre insertion query
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
}
/*foreach ($responses as $film) {
  $tempArray = [];
  foreach ($film as $key => $value) {
    if (is_array($value)) {
      // Les genres sont encore en array
      $tempArray[$key] = $value;
    } else {
      $tempArray[$key] = $value;
    }
  }
  echo '<pre>';
  print_r($tempArray);
}*/