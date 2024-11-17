# Senior PHP project

## Setup
- PHP 8.0+
- Composer
- Symfony

## Install Packages
``` composer install ```

## Start Server
``` symfony server:restart ```

This PHP (symfony) project is a web scraping tool designed to extract search results from two of the most popular search engines: Google and Bing. This project demonstrates how to automate the process of fetching search results programmatically by sending search queries to Google and Bing, then extracting relevant links and titles of the search results for further analysis or processing.

### Key Features:
Scraping Google and Bing: The tool sends search queries to Google and Bing, pulling back the result titles and URLs.
Clean Output: The results are displayed right in the console, showing the search titles from both search engines.
Modular Design: Built to be flexible, so adding more search engines in the future is super simple.
Lightweight and Fast: It uses Goutte, a lightweight and speedy PHP library, to scrape and parse HTML without needing heavy tools like Selenium—though you can add that later for more complex pages if needed
### Technologies Used:
PHP 8.2: The programming language used to build the scraper and handle web interactions.  
Goutte: A handy PHP library that makes it easy to navigate web pages and pull data from HTML.

### How It Works:
User Enters a Search Query: You type in something like "Docker tutorials," and the tool sends it to both Google and Bing.
#### Scraping Process:
    Google: The scraper makes a GET request to Google’s search page, grabs the HTML, and pulls out the titles of the search results.  
Bing: It does the same with Bing, fetching the HTML and extracting the titles and links of the results.  
Results Display: The scraper shows the titles from both Google and Bing right in the terminal, so you can easily see the search results.
### Potential Use Cases:
Competitive Intelligence: Gather search result data for specific keywords to analyze how competitors rank.  
SEO Tracking: Monitor search engine rankings over time to measure the success of SEO efforts.  
Research: Use search results for academic studies or industry-specific research.  
Search Engine Monitoring: Keep an eye on specific search results for updates, trends, or new entries.

### Future Enhancements:
Headless Browser Support: Use tools like Selenium or Symfony Panther to manage JavaScript-heavy pages, like dynamic search results.  
Proxies and User-Agent Switching: Add proxy rotation and user-agent changes to avoid getting blocked by search engines.  
Data Management: Save the scraped data in a database or export it as CSV files for easy analysis.  
More Search Engines: Expand the scraper to work with other search engines like DuckDuckGo, Yahoo, or Yandex.
