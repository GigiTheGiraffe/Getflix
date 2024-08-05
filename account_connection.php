<?php
if (isset($_POST["check"])) {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $servername = 'localhost';
        $db_username = 'root';
        $db_password = ''; // Mot de passe de la base de données
        $dbname = 'users';

        // On établit la connexion
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username);
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
                echo 'Connexion réussie. Redirection...<br>';
                header("Location: index.php");
                echo "Bienvenue, " + $_SESSION['user_name'];

                exit();
            } else {
                echo 'Mot de passe incorrect.<br>';
            }
        }
    } catch (PDOException $e) {
        echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage() . '<br>';
    }
}
?>
