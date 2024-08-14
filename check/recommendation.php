<?php
include_once 'config/config.php';
try {
    $conn = new PDO("mysql:host=" . DB_SERVERNAME_LOCAL . ";dbname=" . DB_NAME_LOCAL . ";charset=utf8mb4", DB_USERNAME_LOCAL, DB_PASSWORD_LOCAL);
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch et on enleve la possibilite de recommander le meme film
    $stmt = $conn->prepare("SELECT title, id, poster_path FROM Movies ORDER BY RAND() LIMIT 5");
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