<?php

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, [
    CURLOPT_URL => "https://google-search74.p.rapidapi.com/?query=salman554480&limit=10&related_keywords=true",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: google-search74.p.rapidapi.com",
        "x-rapidapi-key: 2c1f20796dmsh715554c7f1e4795p12a973jsn467122944bd1" // Replace with your actual API key
    ],
]);

// Execute cURL request and get the response
$response = curl_exec($curl);
$err = curl_error($curl);

// Close cURL session
curl_close($curl);

// Check for cURL errors
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // Decode JSON response
    $data = json_decode($response, true);

    // Start HTML output
    echo "<html><head><title>Search Results for Nike</title></head><body style='font-family: Arial, sans-serif; margin: 20px;'>";

    // Display Knowledge Panel
    if (isset($data['knowledge_panel'])) {
        $knowledge_panel = $data['knowledge_panel'];
        echo "<h2>Knowledge Panel</h2>";
        echo "<h3>" . htmlspecialchars($knowledge_panel['name']) . "</h3>";
        echo "<p><strong>Label:</strong> " . htmlspecialchars($knowledge_panel['label']) . "</p>";
        echo "<p><strong>Description:</strong> <a href='" . htmlspecialchars($knowledge_panel['description']['url']) . "' target='_blank'>" . htmlspecialchars($knowledge_panel['description']['text']) . "</a></p>";

        // Display image if available
        if (isset($knowledge_panel['image']['url'])) {
            echo "<img src='" . htmlspecialchars($knowledge_panel['image']['url']) . "' alt='Nike Image' width='225' height='225' />";
        }

        echo "<h4>Additional Information</h4><ul>";
        if (isset($knowledge_panel['info']) && is_array($knowledge_panel['info'])) {
            foreach ($knowledge_panel['info'] as $info) {
                echo "<li><strong>" . htmlspecialchars($info['title']) . ":</strong> " . implode(", ", array_map('htmlspecialchars', $info['labels'])) . "</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No knowledge panel found.</p>";
    }

    // Display Search Results
    if (isset($data['results']) && is_array($data['results'])) {
        echo "<h2>Search Results</h2><ul>";
        foreach ($data['results'] as $result) {
            echo "<li><strong><a href='" . htmlspecialchars($result['url']) . "' target='_blank'>" . htmlspecialchars($result['title']) . "</a></strong><br>";
            echo "<p>" . htmlspecialchars($result['description']) . "</p></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No search results found.</p>";
    }

    // Display Related Keywords
    if (isset($data['related_keywords']['keywords']) && is_array($data['related_keywords']['keywords'])) {
        echo "<h2>Related Keywords</h2><ul>";
        foreach ($data['related_keywords']['keywords'] as $keyword) {
            echo "<li>";
            if (isset($keyword['knowledge']['image'])) {
                echo "<img src='" . htmlspecialchars($keyword['knowledge']['image']) . "' alt='Keyword Image' width='30' height='30' style='margin-right: 10px;'>";
            }
            echo "<strong>" . htmlspecialchars($keyword['keyword']) . "</strong></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No related keywords found.</p>";
    }

    // End HTML output
    echo "</body></html>";
}