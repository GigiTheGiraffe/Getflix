<?php
if (isset($_POST["reset"])) {
    $email = $_POST["email"];

    // Connexion à la base de données
    $servername = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $dbname = 'users';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'email existe dans la base de données
        $sth = $conn->prepare("SELECT * FROM authentification WHERE email = :email");
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Générer un token unique
            $token = bin2hex(random_bytes(50));
            $expiry = date("Y-m-d H:i:s", strtotime("+3 hour"));

            // Insérer le token dans la base de données avec une expiration
            $sth = $conn->prepare("INSERT INTO password_resets (email, token, expiry) VALUES (:email, :token, :expiry)");
            $sth->bindParam(':email', $email, PDO::PARAM_STR);
            $sth->bindParam(':token', $token, PDO::PARAM_STR);
            $sth->bindParam(':expiry', $expiry, PDO::PARAM_STR);
            $sth->execute();

            // Envoyer l'email
            $resetLink = "localhost/getflix/forgotten_password.php?token=" . $token;
            $subject = "Réinitialisation du mot de passe";
            $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $resetLink;
            $headers = "From: martin.gausseran@gmail.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "Un email de réinitialisation a été envoyé à votre adresse email.";
            } else {
                echo "Une erreur est survenue lors de l'envoi de l'email.";
            }
        } else {
            echo "Aucun compte n'est associé à cet email.";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
