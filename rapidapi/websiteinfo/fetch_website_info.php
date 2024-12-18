<?php
// Check if the URL is passed via GET request
if (isset($_GET['url'])) {
    // Sanitize and validate the URL
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        // API endpoint and API key
        $api_url = "https://api.linkpreview.net/?q=" . urlencode($url);
        $api_key = "697bf202bc2fc22836b6bec248cc82ef";

        // Initialize cURL
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-Linkpreview-Api-Key: $api_key"
        ]);

        // Execute cURL request and get the response
        $response = curl_exec($ch);

        // Check if the cURL request was successful
        if ($response === false) {
            // Output error if request fails
            echo json_encode(["error" => "Failed to fetch data from API"]);
        } else {
            // Output the response as JSON
            echo $response;
        }

        // Close the cURL session
        curl_close($ch);
    } else {
        // If the URL is not valid
        echo json_encode(["error" => "Invalid URL provided"]);
    }
} else {
    // If no URL is provided
    echo json_encode(["error" => "No URL parameter provided"]);
}
