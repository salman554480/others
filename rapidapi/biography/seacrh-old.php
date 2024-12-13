<?php

// Function to fetch data from Wikipedia API, including infobox and other attributes
function getWikipediaDataWithInfobox($personName)
{
    // Wikipedia API endpoint for querying
    $apiUrl = "https://en.wikipedia.org/w/api.php";

    // Build the query parameters
    $params = [
        'action' => 'query',
        'titles' => $personName,  // The title of the Wikipedia page
        'prop' => 'extracts|categories|sections|links|templates',  // Fetch various attributes
        'exintro' => true,         // Only get the introduction (biography)
        'explaintext' => true,     // Ensure it's in plain text, not HTML
        'format' => 'json',        // Response in JSON format
        'utf8' => 1
    ];

    // Build the URL with query parameters
    $url = $apiUrl . '?' . http_build_query($params);

    // Make the HTTP GET request to the Wikipedia API
    $response = file_get_contents($url);

    // Check if the response was successful
    if ($response !== false) {
        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if the page exists
        if (isset($data['query']['pages'])) {
            $pages = $data['query']['pages'];
            $pageId = key($pages);  // Get the page ID

            // Extracting the infobox from the templates
            $infobox = null;
            if (isset($pages[$pageId]['templates'])) {
                foreach ($pages[$pageId]['templates'] as $template) {
                    // Search for the infobox template (e.g., Infobox person)
                    if (strpos($template['title'], 'Infobox') !== false) {
                        $infobox = $template['title'];
                        break;
                    }
                }
            }

            // Prepare the result array with additional attributes
            $result = [
                'title' => $personName,
                'biography' => isset($pages[$pageId]['extract']) ? $pages[$pageId]['extract'] : null,
                'infobox' => $infobox,  // Infobox title (can further fetch specific details)
                'categories' => isset($pages[$pageId]['categories']) ? array_map(function ($category) {
                    return $category['title'];
                }, $pages[$pageId]['categories']) : [],
                'sections' => isset($pages[$pageId]['sections']) ? array_map(function ($section) {
                    return $section['line'];
                }, $pages[$pageId]['sections']) : [],
                'links' => isset($pages[$pageId]['links']) ? array_map(function ($link) {
                    return $link['title'];
                }, $pages[$pageId]['links']) : []
            ];

            return $result;
        } else {
            return ["error" => "No page found for '$personName'."];
        }
    } else {
        return ["error" => "Error fetching data from Wikipedia."];
    }
}

// Example usage: Fetching data for a person
if (isset($_GET['person'])) {
    $personName = $_GET['person']; // Get the person's name from the query parameter
    $result = getWikipediaDataWithInfobox($personName);
    header('Content-Type: application/json');
    echo json_encode($result);  // Return the result in JSON format
} else {
    // If no person name is provided, return an error
    echo json_encode(["error" => "Please provide a person's name in the query parameter 'person'."]);
}