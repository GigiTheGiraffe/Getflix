<?php
include_once 'config/config.php';
// Charger le jeton depuis le fichier token.php
$apiUrl = 'https://api.themoviedb.org/3/trending/movie/day?language=en-US';
$apiToken = MOVIEDB_TOKEN;

// Initialiser cURL
$ch = curl_init();

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

    function getGenreName($genreId) {
        $genres = [
            28 => 'Action',
            12 => 'Adventure',
            16 => 'Animation',
            35 => 'Comedy',
            80 => 'Crime',
            99 => 'Documentary',
            18 => 'Drama',
            10751 => 'Family',
            14 => 'Fantasy',
            36 => 'History',
            27 => 'Horror',
            10402 => 'Music',
            9648 => 'Mystery',
            10749 => 'Romance',
            878 => 'Science Fiction',
            10770 => 'TV Movie',
            53 => 'Thriller',
            10752 => 'War',
            37 => 'Western'
        ];
        return isset($genres[$genreId]) ? $genres[$genreId] : 'Unknown';
    }

}

curl_close($ch);