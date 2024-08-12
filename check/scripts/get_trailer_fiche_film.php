<?php
include_once '../config/config.php';
function getTrailerFicheFilm($response) {
    // Cree le debut de l'url
    $urlYoutube = 'https://www.youtube.com/watch?v=';
    // Cherche dans chaque array UNE clé qui correspond à la fin de l'url et s'arrete quand l'array comprend bien un trailer sur youtube
    foreach ($response['results'] as $media) {
        if ($media['site'] == "YouTube" && $media['type'] == 'Trailer') {
            // Combine l'url avec la cle pour avoir une url valide et la retourne
            return $urlYoutube . $media['key'];
        }
    }
}

//  Sert à obtenir l'array de l'api dans laquelle chercher le trailer
function getTrailerDataCurl(int $id)
{
// Initialiser cURL
$ch = curl_init();
$apiUrl = "https://api.themoviedb.org/3/movie/$id/videos?language=en-US";
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . MOVIEDB_TOKEN,
    'Accept: application/json',
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    //echo 'Error:' . curl_error($ch);
    exit;
} else {
    $data = json_decode($response, true);
}

curl_close($ch);
    // Retourne l'array prete a etre utilise
    return $data;
}
function getTrailerLinkFicheFilm($id) {
    $response = getTrailerDataCurl($id);
    return getTrailerFicheFilm($response);
}