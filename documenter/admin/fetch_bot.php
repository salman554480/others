<?php

// Replace with your bot token
$botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';

// Define the API URL for getUpdates
$apiUrl = "https://api.telegram.org/bot$botToken/getUpdates";

// Initialize a cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout to 10 seconds

// Execute cURL request
echo $response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    echo '<br>';
    echo 'cURL info: ' . print_r(curl_getinfo($ch), true);
} else {
    // Decode the JSON response
    $updates = json_decode($response, true);

    // Print the response in HTML format
    echo "<html><body>";
    echo "<h1>Telegram Bot Updates</h1>";

    if ($updates['ok']) {
        if (empty($updates['result'])) {
            echo "<p>No updates found.</p>";
        } else {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>File</th></tr>";

            foreach ($updates['result'] as $update) {
                $updateId = $update['update_id'];
                $messageId = $update['message']['message_id'];
                $fromUserId = $update['message']['from']['id'];
                $firstName = $update['message']['from']['first_name'];
                $lastName = $update['message']['from']['last_name'];
                $username = $update['message']['from']['username'];
                $messageDate = date('Y-m-d H:i:s', $update['message']['date']);
                $messageText = htmlspecialchars($update['message']['text'] ?? '');

                $fileHtml = '';
                if (isset($update['message']['document'])) {
                    $fileId = $update['message']['document']['file_id'];
                    $fileName = htmlspecialchars($update['message']['document']['file_name']);
                    $fileUrl = "https://api.telegram.org/file/bot$botToken/" . $fileId; // Construct the file URL
                    $fileHtml = "<a href='$fileUrl' target='_blank'>Download $fileName</a>";
                } 

                echo "<tr>";
                echo "<td>$fileId</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
    } else {
        echo "<p>Failed to fetch updates.</p>";
    }

    echo "</body></html>";
}

// Close cURL session
curl_close($ch);

?>
