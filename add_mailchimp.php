<?php
include_once 'config.php';
function addSubscriber($email) {
    $apiKey = MAILCHIMP_API; // Remplacez par votre clé API Mailchimp
    $listId = MAILCHIMP_AUDIENCE; // Remplacez par l'ID de votre liste Mailchimp
    $serverPrefix = substr($apiKey, strpos($apiKey, '-') + 1); // Récupérer le préfixe du serveur

    // URL de l'API Mailchimp pour ajouter un membre à la liste
    $url = "https://$serverPrefix.api.mailchimp.com/3.0/lists/$listId/members/";

    // Données à envoyer
    $data = [
        'email_address' => $email,
        'status'        => 'subscribed', // 'subscribed' pour s'abonner
    ];

    // Initialiser cURL
    $ch = curl_init($url);
    
    // Configuration de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retourner le transfert sous forme de chaîne
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: apikey ' . $apiKey // Authentification avec la clé API
    ]);
    curl_setopt($ch, CURLOPT_POST, true); // Méthode POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Convertir les données en JSON

    // Exécuter la requête cURL
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Récupérer le code HTTP de la réponse
    curl_close($ch); // Fermer la connexion cURL

    // Vérifier si l'abonné a été ajouté avec succès
    if ($httpCode == 200) {
        echo "Subscriber added to Mailchimp successfully.<br>";
    } else {
        echo "Failed to add subscriber to Mailchimp. Response: $response<br>";
    }
}
