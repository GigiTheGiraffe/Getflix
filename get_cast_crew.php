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

function getProducer($response) {
    // Initialise une array
    $arrayProducers = [];
    // Pour chaque producteur, on le stock dans une array
    // Itere dans l'array
    foreach($response['crew'] as $member) {
        // Est ce que c'est un producteur?
        if ($member['job'] == 'Director') {
            $arrayProducers[] = $member['name'];
        }
    }
    return $arrayProducers;
}

function getActors($response) {
    // Initialise une array
    $arrayActors = [];
    // Pour chaque acteur, on le stock dans une array
    // Itere dans l'array
    foreach($response['cast'] as $member) {
        // Est ce que c'est un acteur?
        if ($member['known_for_department'] == 'Acting') {
            $arrayActors[] = $member['name'];
        }
    }
    return $arrayActors;
}

function getCastCrew($movieId) {
    $response = getData($movieId);
    $producers = getProducer($response);
    $actors = getActors($response);

    return [
        'producers' => $producers,
        'actors' => $actors
    ];
}

$array = getCastCrew(68);
print_r($array);
echo implode(', ', $array['producers']);
echo implode(', ', $array['actors']);
