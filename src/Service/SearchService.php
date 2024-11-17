<?php
namespace App\Service;

use App\Service\GoogleSearchEngine;
use App\Service\BingSearchEngine;

class SearchService
{
    private GoogleSearchEngine $google;
    private BingSearchEngine $bing;

    public function __construct(GoogleSearchEngine $google, BingSearchEngine $bing)
    {
        $this->google = $google;
        $this->bing = $bing;
    }

    public function search(string $query): array
    {
        $googleResults = $this->google->fetchResults($query);
        $bingResults = $this->bing->fetchResults($query);

        return array_merge($googleResults, $bingResults);
    }
}
