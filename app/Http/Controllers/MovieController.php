<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MovieController
{
    private $client;
    private $apiUrl = 'https://api.themoviedb.org/3';
    private $apiKey;

    public function __construct()
    {
        // Carregando o token de acesso de uma variável de ambiente
        $this->apiKey = getenv('TMDB_ACCESS_TOKEN') ?: 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNTQ5MjE4ODljZjNkNTA2ZjlhMWM1NTJiYzkwZmNkZSIsIm5iZiI6MTcyMzQwMTM3Ny40NDYxODYsInN1YiI6IjY2OTk2YWZiOTU3YjM2NWNjOGZkNzE4YyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.PBtfz3nHbaI96gZQpI8b9vCOIoisAnbaOs4xru24qfg';	

        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getPopularMovies()
    {
        try {
            $response = $this->client->request('GET', '/movie/popular');
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                $body = $response->getBody()->getContents();
                $data = json_decode($body, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    return $this->sendResponse($data, 200);
                } else {
                    return $this->sendResponse(['error' => 'Erro ao decodificar JSON.'], 500);
                }
            } else {
                return $this->sendResponse(['error' => "Falha na conexão. Código de status: $statusCode"], $statusCode);
            }
        } catch (RequestException $e) {
            return $this->sendResponse(['error' => 'Erro na requisição: ' . $e->getMessage()], 500);
        }
    }

    private function sendResponse($data, $statusCode)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}
