<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

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

            // Envoyer l'email de réinitialisation avec PHPMailer
            $resetLink = "http://localhost/getflix/reset_password.php?token=" . $token;

            $mail = new PHPMailer(true);

            try {
                // Paramètres du serveur
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'martin.gausseran@gmail.com'; // Votre adresse email Gmail
                $mail->Password = 'ajib ceop naog lnxx'; // Mot de passe d'application
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Utiliser PHPMailer::ENCRYPTION_STARTTLS
                $mail->Port = 587;

                // Désactiver la vérification SSL (optionnel)
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                // Destinataires
                $mail->setFrom('martin.gausseran@gmail.com', 'Martin Gausseran');
                $mail->addAddress($email);

                // Contenu de l'email
                $mail->isHTML(true);
                $mail->Subject = 'Réinitialisation du mot de passe';
                $mail->Body    = 'Cliquez sur ce lien pour réinitialiser votre mot de passe : <a href="' . $resetLink . '">' . $resetLink . '</a>';

                $mail->send();
                echo 'Un email de réinitialisation a été envoyé à votre adresse email.';
            } catch (Exception $e) {
                echo "Une erreur est survenue lors de l'envoi de l'email : {$mail->ErrorInfo}";
            }
        } else {
            echo "Aucun compte n'est associé à cet email.";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
