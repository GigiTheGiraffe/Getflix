<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include("database_connection.php");

$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
/* On écho un message de bienvenue pour vérifier que la connexion se fasse correctement */
echo "Bienvenue, " . $_SESSION['user_name'];
?>
