<?php
require_once('parts/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_FILES['fileChunk']) && isset($_POST['chunkIndex']) && isset($_POST['totalChunks']) && isset($_POST['fileName'])) {
        $chunkIndex = intval($_POST['chunkIndex']);
        $totalChunks = intval($_POST['totalChunks']);
        $user_id = intval($_POST['UserId']);
        $folder_key = intval($_POST['FolderId']);
        $fileName = basename($_POST['fileName']);
        $uploadDir = 'assets/upload/';

        // Split the filename by underscore
        $parts = explode('_', $fileName);
        // Get the 8-digit code
        $access_key = $parts[0];

        // Create uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Append the chunk to the final file
        $filePath = $uploadDir . $fileName;
        $chunk = $_FILES['fileChunk']['tmp_name'];

        // Open the file in append mode and write the chunk
        $out = fopen($filePath, 'ab');
        if ($out) {
            fwrite($out, file_get_contents($chunk));
            fclose($out);
        }

        // If it's the last chunk, check the file size and upload to Telegram if it's less than 20 MB
        if ($chunkIndex === $totalChunks - 1) {
            $fileSize = filesize($filePath); // Get the final file size
            $fileType = mime_content_type($filePath);
            // Extract the main type (the part before the slash)
            $fileType = explode('/', $fileType)[0];
            // Get file extension
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            $fileSizeKb = round($fileSize / 1024);
            if ($fileSize < 20 * 1024 * 1024) { // Check if file size is less than 20 MB
                // Your Telegram Bot Token and Chat ID
                $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
                $chatId = '-1002230179133'; // Correct chat ID

                // Prepare and execute cURL request to send the document
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$botToken/sendDocument");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, [
                    'chat_id' => $chatId,
                    'document' => new CURLFile(realpath($filePath)), // Use CURLFile for file upload
                    'caption' => "File: $fileName"
                ]);

                // Execute the cURL request
                $apiResponse = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                // Decode the Telegram API response
                $apiResponseData = json_decode($apiResponse, true);

                if ($httpCode == 200 && isset($apiResponseData['ok']) && $apiResponseData['ok']) {
                    $file_id = $apiResponseData['result']['document']['file_id'];
                    $insert = "INSERT INTO file(user_id,folder_key,file_name,file_access_key,file_size,file_unique_id,file_type,file_extension) VALUES('$user_id','$folder_key','$fileName','$access_key','$fileSizeKb','$file_id','$fileType','$fileExtension')";
                    $run =  mysqli_query($conn, $insert);


                    unlink($filePath);
                    echo json_encode(['status' => 'success', 'message' => 'File uploaded and sent to Telegram']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'File uploaded but failed to send to Telegram', 'apiResponse' => $apiResponseData]);
                }
            } else {
                $insert = "INSERT INTO file(user_id,folder_key,file_name,file_access_key,file_size,file_type,file_extension,file_state) VALUES('$user_id','$folder_key','$fileName','$access_key','$fileSizeKb','$fileType','$fileExtension','wait')";
                $run =  mysqli_query($conn, $insert);
                echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully, size exceeds 20 MB, not sent to Telegram']);
            }
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Chunk uploaded']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid upload']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}