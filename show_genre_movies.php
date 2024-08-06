<?php
include_once 'load_env.php';

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = 20;
$genre = isset($_GET['genre']) ? $_GET['genre'] : null; // Récupérer le genre à partir des paramètres GET

try {
    // Connexion à la base de données
    $conn = new PDO(
        "mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), 
        getenv('DB_USERNAME_LOCAL'), 
        getenv('DB_PASSWORD_LOCAL')
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête en fonction de la présence du genre
    if ($genre) {
        $stmt = $conn->prepare("SELECT * FROM movieslist WHERE genre_1 = :genre ORDER BY id LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    } else {
        $stmt = $conn->prepare("SELECT * FROM movieslist ORDER BY id LIMIT :limit OFFSET :offset");
    }

    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Renvoyer les films en JSON
    header('Content-Type: application/json');
    echo json_encode($movies);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
