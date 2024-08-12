<?php
require_once('vendor/autoload.php');
include_once('config.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=fr-FR&page=1&sort_by=popularity.desc', [
  'headers' => [
    'Authorization' => 'Bearer ' . MOVIEDB_TOKEN,
    'accept' => 'application/json',
  ],
]);

echo $response->getBody();
