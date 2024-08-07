<?php
try {
    $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), getenv('DB_USERNAME_LOCAL'), getenv('DB_PASSWORD_LOCAL'));
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch. Prends juste le titre, le premier genre et le lien vers le poster. Il en prend 20 de manière aléatoire.
    $stmt = $conn->prepare("SELECT comment_id, user, content, comment_date, movie_title  FROM comments");
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
