<?php
if (isset($_POST["check"])) {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Expressions régulières pour valider les noms d'utilisateur et les mots de passe
    $usernamePattern = '/^[a-zA-Z0-9_-]+$/';
    $passwordPattern = '/^[a-zA-Z0-9_-]+$/';

    if (!preg_match($usernamePattern, $user)) {
        echo "<p>Le nom d'utilisateur ne peut contenir que des lettres majuscules/minuscules, des chiffres, des tirets ou des underscores.</p>";
    } elseif (!preg_match($passwordPattern, $password)) {
        echo "<p>Le mot de passe ne peut contenir que des lettres majuscules/minuscules, des chiffres, des tirets ou des underscores.</p>";
    } else {
        try {
            $servername = 'localhost';
            $db_username = 'root';
            $db_password = ''; // Mot de passe de la base de données
            $dbname = 'users';

            // On établit la connexion
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connexion à la base de données réussie.<br>';

            // Préparer et exécuter la requête pour vérifier l'utilisateur et l'email
            $sth = $conn->prepare("SELECT * FROM authentification WHERE user = :user AND email = :email");
            $sth->bindParam(':user', $user, PDO::PARAM_STR);
            $sth->bindParam(':email', $email, PDO::PARAM_STR);
            $sth->execute();
            echo 'Requête exécutée avec succès.<br>';
            $result = $sth->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo 'Utilisateur trouvé.<br>';
                if (password_verify($password, $result['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['user_name'] = $result['user'];
                    header("Location: index.php");
                    exit();
                } else {
                    echo 'Mot de passe incorrect.<br>';
                }
            } else {
                echo 'Utilisateur non trouvé.<br>';
            }
        } catch (PDOException $e) {
            echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage() . '<br>';
        }
    }
}
?>
