<?php
if (isset($_GET['fileId'])) {
    $file_id = $_GET['fileId'];
    $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';

    // Step 1: Get the file path using the Telegram Bot API
    $url = "https://api.telegram.org/bot$botToken/getFile?file_id=$file_id";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Step 2: Parse the response
    $responseData = json_decode($response, true);
    if (isset($responseData['ok']) && $responseData['ok'] && isset($responseData['result']['file_path'])) {
        $filePath = $responseData['result']['file_path'];

        // Step 3: Generate the download URL
        $downloadUrl = "https://api.telegram.org/file/bot$botToken/$filePath";

        // Step 4: Download the file to the 'downloads' folder
        $fileContent = file_get_contents($downloadUrl);
        if ($fileContent === false) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to download file.']);
            http_response_code(500); // Internal Server Error
            exit;
        }

        // Define the local file path to save the file in the 'downloads' directory
        $downloadDirectory = 'downloads/';  // Ensure this folder exists and is writable by the server
        $fileName = basename($filePath);
        $localFilePath = $downloadDirectory . $fileName;

        // Step 5: Save the file locally
        if (file_put_contents($localFilePath, $fileContent) === false) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save the file.']);
            http_response_code(500); // Internal Server Error
            exit;
        }
        
        $localFilePath = "https://scripts.vaultifier.space/rapidapi/telegram/" . $localFilePath;
        
        // Step 6: Return the file path as part of the response with 200 status code
        echo json_encode(['status' => 'success', 'file_path' => $localFilePath]);
        http_response_code(200); // OK
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to fetch the file path.']);
        if (isset($responseData['description'])) {
            echo "Error: " . $responseData['description'] . "\n";
        }
        http_response_code(400); // Bad Request
    }
}
?>
