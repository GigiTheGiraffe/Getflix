<?php
// Minimum pour utiliser le call a l'api
require_once('vendor/autoload.php');
include 'load_env.php';
loadEnv(__DIR__ . '/.env');

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/movie/157336/credits?language=en-US', [
  'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDg1ZjQ2NWJlYjYzZTQ5ZTkzNWVlNTVhYzQyNDEwZiIsIm5iZiI6MTcyMjMzNTg5OC41Nzg2NDEsInN1YiI6IjY2YTg4ZmUwYWM0MDMyODNhNGYyYTY2NCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.545yIdGFN9y0ZE8cLVy-1l2g6ZGyacqC_5vsJa8Dh4c',
    'accept' => 'application/json',
  ],
]);
function getData(int $movieId)
{

    $client = new \GuzzleHttp\Client();
    // Importer la data
    $response = $client->request('GET', "https://api.themoviedb.org/3/movie/$movieId/credits?language=en-US", [
      'headers' => [
        'Authorization' => 'Bearer ' . $_ENV['MOVIEDB_TOKEN'],
        'accept' => 'application/json',
      ],
    ]);
    // Transformer la réponse en array
    $response = json_decode($response->getBody()->getContents(), true);
    // Retourne l'array prete a etre utilise
    return $response;
}
echo $response->getBody();