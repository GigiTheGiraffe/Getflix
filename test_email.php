<?php
if (isset($_POST["reset"])) {
$to = 'martin.gausseran@gmail.com';
$subject = 'Test de l\'envoi de mail';
$message = 'Ceci est un test pour vérifier que la fonction mail() fonctionne.';
$headers = 'From: martin.gausseran@gmail.com';

if (mail($to, $subject, $message, $headers)) {
    echo 'Email envoyé avec succès.';
} else {
    echo 'Échec de l\'envoi de l\'email.';
}
}
?>
