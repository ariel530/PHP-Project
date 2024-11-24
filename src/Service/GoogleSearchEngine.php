<?php
// Declares the file as PHP

namespace App\Service;
// Defines the namespace for the service class

use Symfony\Contracts\HttpClient\HttpClientInterface;
// Imports the HttpClientInterface for making HTTP requests

// Declares the GoogleSearchEngine class
class GoogleSearchEngine
{
    // Declares private properties for the API key, search engine ID, and HTTP client
    private string $apiKey;
    private string $searchEngineId;
    private HttpClientInterface $httpClient;

    // Constructor to initialize the class with required dependencies
    public function __construct(string $apiKey, string $searchEngineId, HttpClientInterface $httpClient)
    {
        $this->apiKey = $apiKey;                 // Stores the Google API key
        $this->searchEngineId = $searchEngineId; // Stores the search engine ID (Custom Search Engine identifier)
        $this->httpClient = $httpClient;         // Stores the HTTP client for making requests
    }

    // Method to fetch search results from Google based on a query
    public function fetchResults(string $query): array
    {
        // Constructs the Google Custom Search API URL with the query, API key, and search engine ID
        $url = sprintf(
            'https://www.googleapis.com/customsearch/v1?key=%s&cx=%s&q=%s',
            urlencode($this->apiKey),          // Encodes the API key for safe usage in the URL
            urlencode($this->searchEngineId), // Encodes the search engine ID for the URL
            urlencode($query)                 // Encodes the query string for the URL
        );

        // Sends a GET request to the constructed URL
        $response = $this->httpClient->request('GET', $url);

        // Converts the JSON response into a PHP array
        $data = $response->toArray();

        // Returns the 'items' key from the response data if it exists; otherwise, returns an empty array
        return $data['items'] ?? [];
    }
}

