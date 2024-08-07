<?php
require_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/token.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', 'https://api.themoviedb.org/3/authentication', [
    'query' => [
        'api_key' => getenv('API_TOKEN')
    ]
]);

echo $response->getBody();

$data = json_decode($response->getBody(), true);

// Fonction pour mapper les IDs de genres aux noms des genres
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
