<?php
include_once 'config/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    // Sanitize and remove <script> tags from the message
    $message = strip_tags($_POST['message'], '<b><i><u><strong><em><p><br>'); // Keep some formatting tags if needed
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    if (!empty($message)) {
        try {
            $conn = new PDO("mysql:host=" . DB_SERVERNAME_LOCAL . ";dbname=" . DB_NAME_LOCAL , DB_USERNAME_LOCAL , DB_PASSWORD_LOCAL);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insert the comment into the database
            $stmt = $conn->prepare("INSERT INTO Comments (movie_DB_Id, content, user, comment_date) VALUES (:movie_DB_Id, :content, 'Anonymous', NOW())");
            if (!isset($movieInfo['movie_DB_Id'])) {
                $movieInfo['movie_DB_Id'] = $movieInfo['id'];
            }
            $stmt->bindParam(':movie_DB_Id', $movieInfo['movie_DB_Id'], PDO::PARAM_INT);
            $stmt->bindParam(':content', $message);
            $stmt->execute();

        } catch (PDOException $e) {
            // echo "Erreur : " . $e->getMessage();
        } finally {
            $conn = null; // Close the connection
        }
        // Redirect avec les parametres get
        $queryString = http_build_query($_GET); // Get param
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . "?" . $queryString); // Redirect
        exit; // Toujours exit, jsp pq
    }
}
