 <?php
    if (isset($_POST["subscribe"])) {
        $user = $_POST["user"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        try {
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'users';
            //On établit la connexion
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
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
    ?>