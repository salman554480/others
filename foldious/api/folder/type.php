<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection

// Set pagination variables
$records_per_page = 10;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the required parameters from the query string
    $user_id = isset($_GET['user_id']) ? trim($_GET['user_id']) : null;
    $file_type = isset($_GET['file_type']) ? trim($_GET['file_type']) : null;
    $page = isset($_GET['page']) ? (int)trim($_GET['page']) : 1;

    if ($user_id && $file_type && $page > 0) {
        // Calculate offset for pagination
        $offset = ($page - 1) * $records_per_page;

        // Query to fetch records for the current page
        $query = "SELECT * FROM file WHERE user_id='$user_id' AND file_type='$file_type' ORDER BY file_id DESC LIMIT $records_per_page OFFSET $offset";
        $result = mysqli_query($conn, $query);

        // Check if records are found
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch records and format each file's size
            $files = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $file_size = (int)$row['file_size'];

                // Format file size for each file
                if ($file_size < 1) {
                    $formatted_file_size = '0 KB';
                } elseif ($file_size < 1024) {
                    $formatted_file_size = $file_size . ' KB';
                } elseif ($file_size < 1048576) { // 1024 * 1024
                    $formatted_file_size = round($file_size / 1024, 2) . ' MB';
                } elseif ($file_size < 1073741824) { // 1024 * 1024 * 1024
                    $formatted_file_size = round($file_size / 1048576, 2) . ' GB';
                } else {
                    $formatted_file_size = round($file_size / 1073741824, 2) . ' TB';
                }

                // Add the formatted file size to the file record
                $row['file_size'] = $formatted_file_size;
                $files[] = $row;
            }

            // Total count of files for pagination info
            $total_count_query = "SELECT COUNT(*) AS total FROM file WHERE user_id='$user_id' AND file_type='$file_type'";
            $total_count_result = mysqli_query($conn, $total_count_query);
            $total_files = (int)mysqli_fetch_assoc($total_count_result)['total'];

            // Calculate files on the current page, remaining files, and if more data exists
            $files_on_current_page = count($files);
            $remaining_files = $total_files - ($page * $records_per_page);
            $have_more_data = ($remaining_files > 0);

            // Return the response in JSON format
            http_response_code(200);
            echo json_encode([
                "status" => true,
                "total_files" => $total_files,
                "current_page" => $page,
                "files_on_current_page" => $files_on_current_page,
                "remaining_files" => max(0, $remaining_files),
                "have_more_data" => $have_more_data,
                "files" => $files
            ]);
        } else {
            // No records found for the given parameters
            http_response_code(404);
            echo json_encode([
                "status" => false,
                "message" => "No files found."
            ]);
        }
    } else {
        // Invalid request if parameters are missing
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "Invalid request. Missing required parameters."
        ]);
    }
} else {
    // Method not allowed if it's not GET
    http_response_code(405);
    echo json_encode([
        "status" => false,
        "message" => "Method not allowed. Use GET request."
    ]);
}

// Close the database connection
$conn->close();