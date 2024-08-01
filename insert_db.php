<?php
include 'switch_genre.php';
include 'get_trailer_link.php';
function insertIntoDb($responses) {
  $imageBaseUrl = 'https://image.tmdb.org/t/p/original';
  try {
    // Ouverture connexion
    $conn = new PDO('mysql:host=' . $_ENV['DB_SERVERNAME_LOCAL'] . ';dbname=' . $_ENV['DB_NAME_LOCAL'], $_ENV['DB_USERNAME_LOCAL'], $_ENV['DB_PASSWORD_LOCAL']);
    // Mettre le mode erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Repeter autant de fois qu'il y a de films
    foreach ($responses as $film) {
      $trailerLink = getTrailerLink($film['id']);
      $stmt = $conn->prepare("INSERT INTO movieslist (movie_DB_Id, vote_average, poster_path, backdrop_path, original_language, title, overview, release_date, genre_1, genre_2, genre_3, trailer_link) VALUES (:movie_DB_Id, :vote_average, :poster_path, :backdrop_path, :original_language, :title, :overview, :release_date, :genre_1, :genre_2, :genre_3, :trailer_link)");
      // Lier les valeurs aux paramètres
      $stmt->bindParam(':movie_DB_Id', $film['id']);
      $stmt->bindParam(':vote_average', $film['vote_average']);
      $poster = $imageBaseUrl . $film['poster_path'];
      $backdrop = $imageBaseUrl . $film['backdrop_path'];
      $stmt->bindParam(':poster_path', $poster);
      $stmt->bindParam(':backdrop_path', $backdrop);
      $stmt->bindParam(':original_language', $film['original_language']);
      $stmt->bindParam(':title', $film['title']);
      $stmt->bindParam(':overview', $film['overview']);
      $stmt->bindParam(':release_date', $film['release_date']);
      $stmt->bindParam(':trailer_link', $trailerLink);
      // Prendre les int
      $genre1 = $film['genre_ids'][0] ?? null;
      $genre2 = $film['genre_ids'][1] ?? null;
      $genre3 = $film['genre_ids'][2] ?? null;
      // Transformer les int en string
      $genre1 = getGenreName($genre1);
      $genre2 = getGenreName($genre2);
      $genre3 = getGenreName($genre3);
      // Bind les genres aux colomnes
      $stmt->bindParam(':genre_1', $genre1);
      $stmt->bindParam(':genre_2', $genre2);
      $stmt->bindParam(':genre_3', $genre3);
      // Executer la requete
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