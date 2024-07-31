<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Se connecter à Flouflix</title>
    <meta name="description" content="Créez votre compte et accèdez dès aujourd'hui à notre catalogue de films. Déjà membre ? Connectez-vous ici.">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <section>
        <article>
            <h1>Créez votre compte</h1>
            <form method="post">
                <label for="user">Nom de compte</label>
                <input id="user" type="text" name="user">
                <label for="email">Adresse mail</label>
                <input id="email" type="email" name="email">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password">
                <button type="submit" class="btn_contact mb-3" id="subscribe" name="subscribe">Créer un compte</button>
            </form>
        </article>
        <article>
            <form method="post">
                <label for="user">Nom de compte</label>
                <input id="user" type="text" name="user">
                <label for="email">Adresse mail</label>
                <input id="email" type="email" name="email">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password">
                <button type="submit" class="btn_contact mb-3" id="check" name="check">Se connecter</button>
            </form>
        </article>
        <?php
        if (isset($_POST["subscribe"])) {
            $user = $_POST["user"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            try {
                $db_servername = 'localhost';
                $db_username = 'root';
                $db_password = '';
                $db_name = 'users';
                //On établit la connexion
                $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username);
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
                    $sth->bindParam(':password', $password);
                    $sth->bindParam(':email', $email);
                    $sth->execute();
                    echo 'Compte créé avec succès.';
                }
            } catch (PDOException $e) {
                echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
            }
        }
        if (isset($_POST["check"])) {
            $user = $_POST["user"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            try {
                $db_servername = 'localhost';
                $db_username = 'root';
                $db_password = '';
                $db_name = 'users';
                //On établit la connexion
                $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sth = $conn->prepare("SELECT * FROM authentification WHERE user = :user AND email = :email AND password = :password");
                $sth->bindParam(':user', $user);
                $sth->bindParam(':email', $email);
                $sth->bindParam(':password', $password);
                $sth->execute();
                $result = $sth->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    echo "<p>Connexion réussie.</p>";
                    header("Location:index.html");
                    exit();
                } else {
                    echo 'Les identifiants sont invalides.';
                }
            } catch (PDOException $e) {
                echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
            }
        }
        ?>

        <?php /*
    if (isset($_POST['check'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
    }
    try {
            $db_servername = 'localhost';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'users';
            //On établit la connexion
            $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
        }
    $sth = $conn->prepare('SELECT * FROM authentification');
    */ ?>
    </section>
</body>

</html>