<?php
// Charger le jeton depuis le fichier token.php
include_once 'config/config.php';
$apiToken = MOVIEDB_TOKEN;
include 'get_trailer_fiche_film.php';
function getMovieApi($id, $apiToken)
{
    // Initialiser cURL
    $ch = curl_init();
    $apiUrl = 'https://api.themoviedb.org/3/movie/' . $id . '?language=en-US';
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiToken,
        'Accept: application/json',
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $data = json_decode($response, true);
    }

    curl_close($ch);
    // si la requete ne fonctionne pas
    if (isset($data["status_code"])) {
        return $data;
    } else {
        // Formatage des donnees pour les utiliser de la meme maniere que quand ça vient de la db
        return $movieInfo = [
            'id' => $data['id'],
            'genre_1' => $data['genres'][0]['name'],
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'vote_average' => $data['vote_average'],
            'backdrop_path' => "https://image.tmdb.org/t/p/original" . $data['backdrop_path'],
            'overview' => $data['overview'],
            'trailer_link' => getTrailerLinkFicheFilm($id),
        ];
    }
}
