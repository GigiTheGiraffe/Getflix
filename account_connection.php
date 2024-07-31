<?php
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
