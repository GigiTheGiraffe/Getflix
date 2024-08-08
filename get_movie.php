<?php
include 'load_env.php';

if (isset($_GET['title'])) {
    $filmTitle = $_GET['title'];
    $filmTitle = trim($filmTitle);
    $filmTitle = substr($filmTitle, 0, 68);
    try {
        $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), getenv('DB_USERNAME_LOCAL'), getenv('DB_PASSWORD_LOCAL'));
        // Ajout des erreurs de PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Préparation de la requête de fetch.
        $stmt = $conn->prepare("SELECT * FROM Movies WHERE title = :title");
        // Ajout du title en param pour la requete
        $stmt->bindParam(':title', $filmTitle);
        // Exécution de la requête
        $stmt->execute();
        // Set en mode fetch pour aller prendre les donnees
        $movieInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Debug message
        //echo "Connection failed: " . $e->getMessage();
        exit;
    } finally {
        $conn = null; // Ferme la connexion
    }
}
if (!isset($_GET['title']) || empty($movieInfo)) {
    $rand = rand(1, 1004);
    try {
        $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), getenv('DB_USERNAME_LOCAL'), getenv('DB_PASSWORD_LOCAL'));
        // Ajout des erreurs de PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Préparation de la requête de fetch
        $stmt = $conn->prepare("SELECT * FROM Movies WHERE id = :id");
        $stmt->bindParam(':id', $rand);
        // Set en mode fetch pour aller prendre les donnees
        $stmt->execute();
        $movieInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        // Exécution de la requête
    } catch (PDOException $e) {
        // Debug message
        //echo "Connection failed: " . $e->getMessage();
        exit;
    } finally {
        $conn = null; // Ferme la connexion
    }
}

// Generation de l'array avec les films à recommander en fonction du genre du film afficher
try {
    $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), getenv('DB_USERNAME_LOCAL'), getenv('DB_PASSWORD_LOCAL'));
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch et on enleve la possibilite de recommander le meme film
    $stmt = $conn->prepare("SELECT * FROM Movies WHERE (genre_1 = :genre OR genre_2 = :genre OR genre_3 = :genre) AND NOT (title = :title) ORDER BY RAND() LIMIT 5 ");
    $stmt->bindParam(':genre', $movieInfo['genre_1']);
    $stmt->bindParam(':title', $movieInfo['title']);
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

