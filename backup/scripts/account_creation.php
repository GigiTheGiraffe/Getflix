<?php
include_once '../config/config.php';
if (isset($_POST["subscribe"])) {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        echo "<p>Les mots de passe ne correspondent pas.</p>";
    } else {
    
    // Expressions régulières pour valider les noms d'utilisateur et les mots de passe
    $usernamePattern = '/^[a-zA-Z0-9_-]+$/';
    $passwordPattern = '/^[a-zA-Z0-9_-]+$/';

    if (!preg_match($usernamePattern, $user)) {
        echo "<p>Le nom d'utilisateur ne peut contenir que des lettres majuscules/minuscules, des chiffres, des tirets ou des underscores.</p>";
    } elseif (!preg_match($passwordPattern, $password)) {
        echo "<p>Le mot de passe ne peut contenir que des lettres majuscules/minuscules, des chiffres, des tirets ou des underscores.</p>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {

            // On établit la connexion
            $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME , DB_USERNAME , DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sth = $conn->prepare("SELECT * FROM users WHERE user = :user OR email = :email");
            $sth->bindParam(':user', $user);
            $sth->bindParam(':email', $email);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<p>Le nom d'utilisateur ou l'adresse mail existe déjà.</p>";
            } else {
                // Insérer les nouvelles informations
                $sth = $conn->prepare("INSERT INTO users (user, password, email) VALUES(:user, :password, :email)");
                $sth->bindParam(':user', $user);
                $sth->bindParam(':password', $hashedPassword);
                $sth->bindParam(':email', $email);
                $sth->execute();
                echo 'Compte créé avec succès.';
            }
        } catch (PDOException $e) {
            //echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
        }
    }
}
}
?>
