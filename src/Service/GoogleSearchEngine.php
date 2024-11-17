<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleSearchEngine
{
    private string $apiKey;
    private string $searchEngineId;
    private HttpClientInterface $httpClient;

    public function __construct(string $apiKey, string $searchEngineId, HttpClientInterface $httpClient)
    {
        $this->apiKey = $apiKey;
        $this->searchEngineId = $searchEngineId;
        $this->httpClient = $httpClient;
    }

    public function fetchResults(string $query): array
    {
        $url = sprintf(
            'https://www.googleapis.com/customsearch/v1?key=%s&cx=%s&q=%s',
            urlencode($this->apiKey),
            urlencode($this->searchEngineId),
            urlencode($query)
        );

        $response = $this->httpClient->request('GET', $url);
        $data = $response->toArray();

        return $data['items'] ?? [];

        return $results;
    }
}
