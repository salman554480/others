<?php
// Define the celebrity's name (e.g., "Tom Hanks")
$celebrityName = 'Tom_Hanks';

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

    if (!empty($infoboxMatches)) {
        // Extract data from the infobox (using regex or manual parsing if needed)
        $infoboxText = $infoboxMatches[0];

        // Parse relevant fields (like full name, birth date, etc.)
        preg_match('/\| name\s*=\s*(.*?)\n/', $infoboxText, $fullNameMatch);
        preg_match('/\| birth_date\s*=\s*(.*?)\n/', $infoboxText, $birthDateMatch);
        preg_match('/\| birth_place\s*=\s*(.*?)\n/', $infoboxText, $birthPlaceMatch);
        preg_match('/\| nationality\s*=\s*(.*?)\n/', $infoboxText, $nationalityMatch);
        preg_match('/\| occupation\s*=\s*(.*?)\n/', $infoboxText, $occupationMatch);
        preg_match('/\| known_for\s*=\s*(.*?)\n/', $infoboxText, $knownForMatch);
        preg_match('/\| awards\s*=\s*(.*?)\n/', $infoboxText, $awardsMatch);

        // Prepare the output as HTML
        $htmlOutput = "<h1>Celebrity Information: {$celebrityName}</h1>";

        // Display extracted details in a structured HTML format
        $htmlOutput .= "<table border='1' cellpadding='10'>";
        $htmlOutput .= "<tr><th>Full Name</th><td>" . ($fullNameMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "<tr><th>Birth Date</th><td>" . ($birthDateMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "<tr><th>Birth Place</th><td>" . ($birthPlaceMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "<tr><th>Nationality</th><td>" . ($nationalityMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "<tr><th>Occupation</th><td>" . ($occupationMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "<tr><th>Known For</th><td>" . ($knownForMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "<tr><th>Awards</th><td>" . ($awardsMatch[1] ?? 'N/A') . "</td></tr>";
        $htmlOutput .= "</table>";

        // Add the biography (wikitext, stripped of tags) as a separate section
        $htmlOutput .= "<h2>Biography</h2>";
        $htmlOutput .= "<p>" . nl2br(htmlspecialchars(strip_tags($wikitext))) . "</p>";

        echo $htmlOutput;
    } else {
        echo "<p>Error: Infobox not found in the article.</p>";
    }
} else {
    echo "<p>Error: Biography or data not found.</p>";
}