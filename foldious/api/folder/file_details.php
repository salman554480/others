<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get file_access_key from GET request
    if (isset($_GET['file_access_key']) && is_numeric($_GET['file_access_key'])) {
        $file_access_key = intval($_GET['file_access_key']);
        $select_file = "SELECT * FROM file WHERE file_access_key='$file_access_key'";
        $result = mysqli_query($conn, $select_file);
        if (mysqli_num_rows($result) > 0) {
            $row_files = mysqli_fetch_assoc($result);

            $file_unique_id = $row_files['file_unique_id'];
            $file_type = $row_files['file_type'];

            $file_size = $row_files['file_size'];
            $file_size_mb =  round($file_size / 1024);

            if ($file_size_mb <= 20 && $file_unique_id != '' && $file_type != 'application') {
                $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
                $url = "https://api.telegram.org/bot$botToken/getFile?file_id=$file_unique_id";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $responseData = json_decode($response, true);
                if (isset($responseData['ok']) && $responseData['ok'] && isset($responseData['result']['file_path'])) {
                    $filePath = $responseData['result']['file_path'];
                    $download_path = "https://api.telegram.org/file/bot$botToken/$filePath";
                } else {
                    echo "Failed to fetch the file path.\n";
                    if (isset($responseData['description'])) {
                        echo "Error: " . $responseData['description'] . "\n";
                    }
                }
            }

            if ($file_size < 1024) {
                $formatted_file_size = $file_size . ' KB';
            } elseif ($file_size < 1048576) { // 1024 * 1024
                $formatted_file_size = round($file_size / 1024, 2) . ' MB';
            } elseif ($file_size < 1073741824) { // 1024 * 1024 * 1024
                $formatted_file_size = round($file_size / 1048576, 2) . ' GB';
            } else {
                $formatted_file_size = round($file_size / 1073741824, 2) . ' TB'; // Optional for very large files
            }

            $row_files['file_size'] = $formatted_file_size;
            if ($file_size_mb <= 20 && $file_unique_id != '' && $file_type != 'application') {
                $row_files['file_download_path'] = $download_path;
            }


            http_response_code(200); // OK status code
            echo json_encode(["status" => true, "data" => $row_files]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => true, "alert" => "No file found"]);
        }
    }
}


// Close the database connection
$conn->close();
