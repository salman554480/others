<?php
// Define the celebrity's name (e.g., "Tom Hanks")
if (isset($_GET['person'])) {
    $personName = $_GET['person'];
    $celebrityName = $personName;

    // Wikipedia API endpoint to fetch data in JSON format
    $apiUrl = "https://en.wikipedia.org/w/api.php?action=query&prop=revisions&rvslots=main&rvprop=content&titles=" . urlencode($celebrityName) . "&format=json";

    // Use file_get_contents or cURL to send the request
    $response = file_get_contents($apiUrl);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Extract the page ID
    $pageId = key($data['query']['pages']);

    // Prepare the response array
    $responseArray = [];

    if (isset($data['query']['pages'][$pageId]['revisions'][0]['slots']['main']['*'])) {
        // Get the raw wikitext content
        $wikitext = $data['query']['pages'][$pageId]['revisions'][0]['slots']['main']['*'];

        // Extract the infobox (if it exists in the wikitext)
        preg_match('/\{\{Infobox.*?}}/s', $wikitext, $infoboxMatches);

        $responseArray['celebrity'] = $celebrityName;
        $responseArray['biography'] = strip_tags($wikitext); // Use the raw wikitext as biography

        $responseArray['status'] = 'success';
    } else {
        $responseArray['status'] = 'error';
        $responseArray['message'] = 'Biography or data not found.';
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($responseArray, JSON_PRETTY_PRINT);
}