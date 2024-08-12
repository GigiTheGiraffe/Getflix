<?php
include_once('config.php');
try {
    $conn = new PDO("mysql:host=" . DB_SERVERNAME_LOCAL . ";dbname=" . DB_NAME_LOCAL , DB_USERNAME_LOCAL , DB_PASSWORD_LOCAL);
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch. Prends toutes les infos des commentaires existants
    $stmt = $conn->prepare("SELECT *  FROM Comments");
    // Set en mode fetch pour aller prendre les donnees
    $stmt->execute();
    $commentsMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Exécution de la requête
} catch (PDOException $e) {
    // Debug message
    echo "Connection failed: " . $e->getMessage();
    exit;
}
// ferme connection
$conn = null;
