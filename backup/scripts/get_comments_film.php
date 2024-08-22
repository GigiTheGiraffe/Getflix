<?php
include_once '../config/config.php';
try {
    $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME , DB_USERNAME , DB_PASSWORD);
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch. Prends toutes les infos des commentaires existants
    $stmt = $conn->prepare("SELECT *  FROM Comments WHERE movie_DB_Id = :movie_DB_Id ORDER BY RAND() LIMIT 3");
    if (!isset($movieInfo["movie_DB_Id"])) {
        $movieInfo["movie_DB_Id"] = $movieInfo["id"];
    }
    $stmt->bindParam(':movie_DB_Id', $movieInfo['movie_DB_Id']);
    // Set en mode fetch pour aller prendre les donnees
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Exécution de la requête
} catch (PDOException $e) {
    // Debug message
    //echo "Connection failed: " . $e->getMessage();
    exit;
}
// ferme connection
$conn = null;