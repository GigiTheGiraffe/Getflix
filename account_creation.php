<?php
if (isset($_POST["subscribe"])) {
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
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $servername = 'localhost';
            $username = 'root';
            $dbpassword = '';
            $dbname = 'users';

            // On établit la connexion
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sth = $conn->prepare("SELECT * FROM authentification WHERE user = :user OR email = :email");
            $sth->bindParam(':user', $user);
            $sth->bindParam(':email', $email);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<p>Le nom d'utilisateur ou l'adresse mail existe déjà.</p>";
            } else {
                // Insérer les nouvelles informations
                $sth = $conn->prepare("INSERT INTO authentification (user, password, email) VALUES(:user, :password, :email)");
                $sth->bindParam(':user', $user);
                $sth->bindParam(':password', $hashedPassword);
                $sth->bindParam(':email', $email);
                $sth->execute();
                echo 'Compte créé avec succès.';
            }
        } catch (PDOException $e) {
            echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
        }
    }
}
?>
