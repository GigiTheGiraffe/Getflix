<?php
include '../config/config.php';
try {
    $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME , DB_USERNAME , DB_PASSWORD);
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch et on enleve la possibilite de recommander le meme film
    $stmt = $conn->prepare("SELECT * FROM Movies WHERE (genre_1 = :genre OR genre_2 = :genre OR genre_3 = :genre) AND NOT (id = :id) ORDER BY RAND() LIMIT 7 ");
    $stmt->bindParam(':genre', $movieInfo['genre_1']);
    $stmt->bindParam(':id', $movieInfo['id'], PDO::PARAM_INT);
    // Set en mode fetch pour aller prendre les donnees
    $stmt->execute();
    $recommendations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Exécution de la requête
} catch (PDOException $e) {
    // Debug message
    //echo "Connection failed: " . $e->getMessage();
    exit;
} finally {
    $conn = null; // Ferme la connexion
}