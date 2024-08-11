<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

try {
    $response = $client->request('GET', 'https://api.themoviedb.org/3/authentication', [
        'headers' => [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJkNTQ5MjE4ODljZjNkNTA2ZjlhMWM1NTJiYzkwZmNkZSIsIm5iZiI6MTcyMzQwMTM3Ny40NDYxODYsInN1YiI6IjY2OTk2YWZiOTU3YjM2NWNjOGZkNzE4YyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.PBtfz3nHbaI96gZQpI8b9vCOIoisAnbaOs4xru24qfg',
            'Accept'     => 'application/json',
        ],
    ]);

    // Verificar o código de status
    $statusCode = $response->getStatusCode();
    if ($statusCode === 200) {
        // Conexão bem-sucedida
        echo "Conexão bem-sucedida! Código de status: $statusCode\n";

        // Obtendo o corpo da resposta
        $body = $response->getBody()->getContents();

        // Convertendo a resposta JSON para um array PHP
        $data = json_decode($body, true);

        // Verificando se a decodificação foi bem-sucedida
        if (json_last_error() === JSON_ERROR_NONE) {
            // Exibindo o conteúdo da resposta
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else {
            echo 'Erro ao decodificar JSON.';
        }
    } else {
        // Código de status diferente de 200
        echo "Falha na conexão. Código de status: $statusCode\n";
    }
} catch (\GuzzleHttp\Exception\RequestException $e) {
    // Lidando com exceções da requisição
    echo 'Erro na requisição: ' . $e->getMessage();
}
