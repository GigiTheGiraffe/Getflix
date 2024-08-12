<?php
include_once '../config/config.php';
if (isset($_POST["update"])) {
    $token = $_POST["token"];
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Connexion à la base de données
    try {
        $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME , DB_USERNAME , DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier le token et son expiration
        $sth = $conn->prepare("SELECT * FROM password_resets WHERE token = :token AND expiry > NOW()");
        $sth->bindParam(':token', $token, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "Votre token existe";
            // Mettre à jour le mot de passe dans la table des utilisateurs
            $email = $result['email'];
            $sth = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
            $sth->bindParam(':password', $new_password, PDO::PARAM_STR);
            $sth->bindParam(':email', $email, PDO::PARAM_STR);
            $sth->execute();

            // Supprimer le token de réinitialisation
            $sth = $conn->prepare("DELETE FROM password_resets WHERE token = :token");
            $sth->bindParam(':token', $token, PDO::PARAM_STR);
            $sth->execute();

            echo "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            echo "Le lien de réinitialisation est invalide ou a expiré.";
        }
    } catch (PDOException $e) {
        //echo 'Erreur : ' . $e->getMessage();
    }
}
?>
