<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class QueryService
{
    public function __construct(
        private HttpClientInterface $client,
        private readonly string $baseUrl,
        private readonly string $section,
    ){
    }

    // GET запрос
    public function queryGet(string $endpoint)
    {
        $response = $this->client->request('GET', $this->baseUrl . $this->section . $endpoint . '?limit=0');

        return json_decode($response->getContent(), true);
    }

    // POST запрос
    public function queryPost(string $endpoint, array $body)
    {
        $response = $this->client->request('POST', $this->baseUrl . $this->section . $endpoint, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body' => $body
        ]);

        return json_decode($response->getContent(), true);
    }
}