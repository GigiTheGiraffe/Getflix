<?php
// Chargement du mdp et username
include_once 'load_env.php';
/* Function pour avoir des films en aléatoire
function getRandomnFilm()
{
    try {
        $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), getenv('DB_USERNAME_LOCAL'), getenv('DB_PASSWORD_LOCAL'));
        // Ajout des erreurs de PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Préparation de la requête de fetch. Prends juste le titre, le premier genre et le lien vers le poster. Il en prend 20 de manière aléatoire.
        $stmt = $conn->prepare("SELECT poster_path, title, genre_1 FROM movies_list ORDER BY RAND() LIMIT 20");
        // Set en mode fetch pour aller prendre les donnees
        $stmt->execute();
        $resultMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Exécution de la requête
    } catch (PDOException $e) {
        //echo "Connection failed: " . $e->getMessage();
        exit;
    }
    $conn = null;
    return $resultMessage;
}
*/
$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
$genre = isset($_POST['genre']) ? $_POST['genre'] : null; // Récupérer le genre à partir des paramètres POST
$sort = isset($_POST['sort']) ? $_POST['sort'] : null; // Récupérer la valeur de sort à partir des paramètres POST
if ($sort) {
    $sort = strtoupper($sort);
}
try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_LOCAL') . ";dbname=" . getenv('DB_NAME_LOCAL'), getenv('DB_USERNAME_LOCAL'), getenv('DB_PASSWORD_LOCAL'));
    // Mettre le mode erreur pour savoir ce qui ne va pas
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête en fonction de la présence du genre
    if ($genre && !$sort) {
        $stmt = $conn->prepare("SELECT poster_path, title FROM Movies  WHERE genre_1 = :genre OR genre_2 = :genre OR genre_3 = :genre ORDER BY id LIMIT 20 OFFSET :offset");
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    } elseif ($sort && !$genre) {
        $stmt = $conn->prepare("SELECT poster_path, title, genre_1, release_date FROM Movies ORDER BY release_date $sort LIMIT 20 OFFSET :offset");
    } elseif ($sort && $genre) {
        $stmt = $conn->prepare("SELECT poster_path, title FROM Movies WHERE genre_1 = :genre OR genre_2 = :genre OR genre_3 = :genre ORDER BY release_date $sort LIMIT 20 OFFSET :offset");
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    } else {
        $stmt = $conn->prepare("SELECT poster_path, title, genre_1 FROM Movies ORDER BY id LIMIT 20 OFFSET :offset");
    }

    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Renvoyer les films en JSON
    header('Content-Type: application/json');
    // Le echo sert a envoyer des données en format json avec json_encode
    echo json_encode($movies);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
