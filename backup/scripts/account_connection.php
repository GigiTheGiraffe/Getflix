<?php
include_once '../config/config.php';
if (isset($_POST["check"])) {
    $identifier = $_POST["identifier"];
    $password = $_POST["password"];

    // Expressions régulières pour valider les noms d'utilisateur et les mots de passe
    
    $passwordPattern = '/^[a-zA-Z0-9_-]+$/';

    if (!preg_match($passwordPattern, $password)) {
        echo "<p>Le mot de passe ne peut contenir que des lettres majuscules/minuscules, des chiffres, des tirets ou des underscores.</p>";
    } else {
        try {
            // On établit la connexion
            $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME , DB_USERNAME , DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparer et exécuter la requête pour vérifier l'utilisateur et l'email
            $sth = $conn->prepare("SELECT * FROM users WHERE user = :identifier OR email = :identifier");
            $sth->bindParam(':identifier', $identifier, PDO::PARAM_STR);
            $sth->execute();
            echo 'Requête exécutée avec succès.<br>';
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            // Pour le débogage : Afficher la variable result
            //echo '<pre>' . print_r($result, true) . '</pre>';

            if ($result) {
                echo 'Utilisateur trouvé.<br>';
                if (password_verify($password, $result['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['user_name'] = $result['user'];
                    $_SESSION['role'] = $result['role'];
                    header("Location: tendance.php");
                    exit();
                } else {
                    echo 'Mot de passe incorrect.<br>';
                }
            } else {
                echo 'Utilisateur non trouvé.<br>';
            }
        } catch (PDOException $e) {
            //echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage() . '<br>';
        }
    }
}
?>
