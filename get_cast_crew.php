<?php
// Minimum pour utiliser le call a l'api
require_once('vendor/autoload.php');
include_once('config.php');

function getCastCrewData(int $movieId)
{

    $client = new \GuzzleHttp\Client();
    // Importer la data
    $response = $client->request('GET', "https://api.themoviedb.org/3/movie/$movieId/credits?language=en-US", [
      'headers' => [
        'Authorization' => 'Bearer ' . MOVIEDB_TOKEN,
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
            // Ajoute son nom à une array pour tous les contenir
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
            // Ajoute son nom à une array pour tous les contenir
            $arrayActors[] = $member['name'];
        }
    }
    return $arrayActors;
}

function getCastCrew($movieId) {
    // Recuperation des cast and crew
    $response = getCastCrewData($movieId);
    // Extraction des producteurs
    $producers = getProducer($response);
    // Extraction des acteurs
    $actors = getActors($response);
    // On les mets dans une array
    $arrayProducersActors = [
        'producers' => $producers,
        'actors' => $actors
    ];
    $arrayProducers = &$arrayProducersActors['producers'];
    $arrayActors = &$arrayProducersActors['actors'];
    // Limitation des producteurs à 2 max
    if (count($arrayProducers) > 2) {
        $arrayProducers = array_slice($arrayProducers, 0, 2);
    }
    // Limitation des acteurs à 5 max
    if (count($arrayActors) > 5) {
        $arrayActors = array_slice($arrayActors, 0, 5);
    }
    // Transformation en string
    $arrayProducers = implode(', ', $arrayProducers);
    $arrayActors = implode(', ', $arrayActors);
    // On retourne l'array
    return $arrayProducersActors;
}