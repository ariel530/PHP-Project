<?php
// Declares the file as PHP

namespace App\Controller;
// Defines the namespace for the class, following Symfony's project structure

use App\Service\SearchService;
// Imports the SearchService class for use in this controller

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// Imports the base controller class from Symfony, which provides helper methods like rendering templates

use Symfony\Component\HttpFoundation\JsonResponse;
// Imports the JsonResponse class to handle JSON responses

use Symfony\Component\HttpFoundation\Response;
// Imports the Response class to handle standard HTTP responses

use Symfony\Component\HttpFoundation\Request;
// Imports the Request class to handle HTTP request data

use Symfony\Component\Routing\Annotation\Route;
// Imports the Route annotation for defining routes in the controller

use App\Service\GoogleSearchEngine;
// Imports the GoogleSearchEngine service (not directly used in this code but likely part of the project)

// Declares the SearchController class, extending AbstractController to inherit Symfony controller functionality
class SearchController extends AbstractController
{
    // Declares a private property to hold an instance of SearchService
    private SearchService $searchService;

    // Constructor to inject the SearchService dependency
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService; // Assigns the injected service to the class property
    }

    // Defines the route for the home page
    #[Route('/', name: 'home', methods: ['GET'])]
    public function home(): Response
    {
        // Renders the 'search.html.twig' template and returns an HTTP response
        return $this->render('search.html.twig');
    }

    // Defines the route for the search API endpoint
    #[Route('/api/search', name: 'search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        // Retrieves the 'q' parameter from the request's query string, defaulting to an empty string
        $query = $request->query->get('q', '');

        // Uses the SearchService to perform a search with the given query
        $results = $this->searchService->search($query);

        // (Redundant) Encodes the results to JSON format (not needed here since JsonResponse handles it)
        json_encode($results);

        // Returns a JSON response with the search results
        return new JsonResponse($results);
    }
}
