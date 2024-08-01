<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion-test.php');
    exit;
}

include("database_connection.php");

$stmt = $conn->prepare('SELECT * FROM authentification WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
