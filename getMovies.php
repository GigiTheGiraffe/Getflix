<?php
require_once('vendor/autoload.php');
function importPages($number) {
$client = new \GuzzleHttp\Client();

$response = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?include_adult=true&include_video=false&language=en-US&page=$number&region=france&sort_by=vote_average.desc&vote_count.gte=1000", [
  'headers' => [
    'Authorization' => 'Bearer ' . $_ENV['MOVIEDB_TOKEN'],
    'accept' => 'application/json',
  ],
]);
echo $response->getBody();
}