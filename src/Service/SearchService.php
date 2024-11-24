<?php
// Declares the file as PHP

namespace App\Service;
// Defines the namespace for this service class, following Symfony's structure

use App\Service\GoogleSearchEngine;
// Imports the GoogleSearchEngine class for use in this service

use App\Service\BingSearchEngine;
// Imports the BingSearchEngine class for use in this service

// Declares the SearchService class
class SearchService
{
    // Declares private properties for the Google and Bing search engine services
    private GoogleSearchEngine $google;
    private BingSearchEngine $bing;

    // Constructor to inject dependencies for Google and Bing search engine services
    public function __construct(GoogleSearchEngine $google, BingSearchEngine $bing)
    {
        $this->google = $google; // Assigns the GoogleSearchEngine instance to the class property
        $this->bing = $bing;     // Assigns the BingSearchEngine instance to the class property
    }

    // Defines the search method, which accepts a query string and returns an array of search results
    public function search(string $query): array
    {
        // Fetches search results from the Google search engine
        $googleResults = $this->google->fetchResults($query);

        // Fetches search results from the Bing search engine
        $bingResults = $this->bing->fetchResults($query);

        // Combines results from both search engines into a single array
        return array_merge($googleResults, $bingResults);
    }
}



