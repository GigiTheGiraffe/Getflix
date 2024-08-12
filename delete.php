<?php
include_once 'config.php';
// Suppression user
if (isset($_POST['deleteUser']))  {
try {
    $conn = new PDO("mysql:host=" . DB_SERVERNAME_LOCAL . ";dbname=" . DB_NAME_LOCAL , DB_USERNAME_LOCAL , DB_PASSWORD_LOCAL);
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Recuperation de l'id a delete
    $id = $_POST['deleteUser'];
        $stmt = $conn->prepare("DELETE FROM Users WHERE id = :id");
            // Liaison du parametre
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    // Exécution de la requete
    header("Location: " . $_SERVER['PHP_SELF']);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
$conn = null;
}
// Suppression commentaire
if (isset($_POST['deleteComment']))  {
    try {
        $conn = new PDO("mysql:host=" . DB_SERVERNAME_LOCAL . ";dbname=" . DB_NAME_LOCAL , DB_USERNAME_LOCAL , DB_PASSWORD_LOCAL);
        // Ajout des erreurs de PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Recuperation de l'id a delete
        $id = $_POST['deleteComment'];
            $stmt = $conn->prepare("DELETE FROM Comments WHERE comment_id = :comment_id");
                // Liaison du parametre
            $stmt->bindParam(':comment_id', $id);
            $stmt->execute();
        // Exécution de la requete
        header("Location: " . $_SERVER['PHP_SELF']);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }
    $conn = null;
    }