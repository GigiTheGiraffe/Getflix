<?php
// Minimum pour utiliser le call a l'api
require_once('vendor/autoload.php');
include 'load_env.php';
loadEnv(__DIR__ . '/.env');

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