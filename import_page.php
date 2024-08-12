<?php
require_once('vendor/autoload.php');
include_once('config.php');
function importPages($number)
{
  $client = new \GuzzleHttp\Client();

  $response = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?include_adult=true&include_video=false&language=en-US&page=$number&region=france&sort_by=vote_average.desc&vote_count.gte=1000", [
    'headers' => [
      'Authorization' => 'Bearer ' . MOVIEDB_TOKEN,
      'accept' => 'application/json',
    ],
  ]);
  $response = json_decode($response->getBody()->getContents(), true);
  return $response['results'];
}