<?php
require_once '../vendor/autoload.php';

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://api.themoviedb.org/3/authentication', [
  'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNTQ5MjE4ODljZjNkNTA2ZjlhMWM1NTJiYzkwZmNkZSIsIm5iZiI6MTcyMzQwMTM3Ny40NDYxODYsInN1YiI6IjY2OTk2YWZiOTU3YjM2NWNjOGZkNzE4YyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.PBtfz3nHbaI96gZQpI8b9vCOIoisAnbaOs4xru24qfg',
    'accept' => 'application/json',
  ],
]);

echo $response->getBody();