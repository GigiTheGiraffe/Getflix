<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?language=fr', [
  'headers' => [
    'Authorization' => "Bearer $token",
    'accept' => 'application/json',
  ],
]);

echo $response->getBody();