<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class BingSearchEngine
{
    private string $apiKey;
    private HttpClientInterface $httpClient;

    public function __construct(string $apiKey, HttpClientInterface $httpClient)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }

    public function fetchResults(string $query): array
    {
        $url = sprintf('https://api.bing.microsoft.com/v7.0/search?q=%s', urlencode($query));

        try {
            $response = $this->httpClient->request('GET', $url, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->apiKey,
                ]
            ]);

            $data = $response->toArray();

            if (isset($data['webPages']['value'])) {
                return $data['webPages']['value'];
            }

            return [];

        } catch (TransportExceptionInterface $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
