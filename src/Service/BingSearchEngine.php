<?php
// Declares the file as PHP

namespace App\Service;
// Defines the namespace for the BingSearchEngine service class

use Symfony\Contracts\HttpClient\HttpClientInterface;
// Imports the HttpClientInterface for sending HTTP requests

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
// Imports the TransportExceptionInterface for handling HTTP transport-related errors

// Declares the BingSearchEngine class
class BingSearchEngine
{
    // Declares private properties for the API key and HTTP client
    private string $apiKey;
    private HttpClientInterface $httpClient;

    // Constructor to initialize the API key and HTTP client
    public function __construct(string $apiKey, HttpClientInterface $httpClient)
    {
        $this->apiKey = $apiKey;         // Stores the Bing API key
        $this->httpClient = $httpClient; // Stores the HTTP client instance for making requests
    }

    // Method to fetch search results from Bing based on a query
    public function fetchResults(string $query): array
    {
        // Constructs the Bing Search API URL with the query
        $url = sprintf('https://api.bing.microsoft.com/v7.0/search?q=%s', urlencode($query));

        try {
            // Sends a GET request to the Bing Search API with the required API key in the headers
            $response = $this->httpClient->request('GET', $url, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->apiKey, // Adds the API key as a header for authentication
                ]
            ]);

            // Converts the JSON response into a PHP array
            $data = $response->toArray();

            // Checks if the 'webPages' key exists in the response and extracts its 'value' key
            if (isset($data['webPages']['value'])) {
                return $data['webPages']['value']; // Returns the search results
            }

            // Returns an empty array if the 'webPages' key is missing
            return [];

        } catch (TransportExceptionInterface $e) {
            // Catches HTTP transport errors and returns an error message as part of the response
            return ['error' => $e->getMessage()];
        }
    }
}
