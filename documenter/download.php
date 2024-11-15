<?php
// Database connection
require_once('portal/parts/db.php');
$botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';

// Folder where files will be saved
$downloadDir = 'assets/downloads/';

if (isset($_POST['action']) && $_POST['action'] == 'download') {
    $file_id = $_POST['file_id']; // Get the file ID from the request
    $file_name = $_POST['file_name']; // Get the file name
    $file_access_key = $_POST['file_access_key']; // Get the file_access_key from the request

    if (preg_match('/_(\d{3})\.zip$/', $file_name, $matches)) {
        $chunk_number = $matches[1]; // This will contain "001"

    } else {
        echo "No match found.";
    }

    // Fetch the file record based on file_access_key and file_id, just in case you need more validation
    echo    $select_file = "SELECT * FROM data WHERE file_access_code='$file_access_key' AND data_file_id='$file_id' LIMIT 1";
    $result = mysqli_query($conn, $select_file);

    if (mysqli_num_rows($result) > 0) {
        // Get file path from Telegram API
        $row = mysqli_fetch_assoc($result);
        $url = "https://api.telegram.org/bot$botToken/getFile?file_id=$file_id";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($response, true);

        // Check if the file path was successfully retrieved
        if (isset($responseData['ok']) && $responseData['ok'] && isset($responseData['result']['file_path'])) {
            $filePath = $responseData['result']['file_path'];
            $download_url = "https://api.telegram.org/file/bot$botToken/$filePath";

            // Download the file
            $file_content = file_get_contents($download_url);

            // Save the file to the "downloads" directory
            if ($file_content) {
                $downloadedFilePath = $downloadDir . basename($file_name);
                if (file_put_contents($downloadedFilePath, $file_content)) {
                    echo json_encode([
                        'status' => 'success',
                        'file_name' => $file_name,
                        'chunk_number' => $chunk_number,
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'file_name' => $file_name,
                        'message' => 'Failed to save the file.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'file_name' => $file_name,
                    'message' => 'Failed to download the file.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'file_name' => $file_name,
                'message' => 'Failed to get file path from Telegram.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'file_name' => $file_name,
            'message' => 'File not found or invalid access key.'
        ]);
    }
}

exit;