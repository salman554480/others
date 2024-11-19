<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the 'file_access_key' from the query string
    $file_access_key = isset($_GET['file_access_key']) ? trim($_GET['file_access_key']) : null;

    if ($file_access_key) {
        // Query to fetch all records based on file_access_key
        $query = "SELECT * FROM data WHERE file_access_code = '$file_access_key'";
        $result = mysqli_query($conn, $query);

        // Check if any records are found
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch all records and return them in the response
            $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
            http_response_code(200); // Success status code
            echo json_encode([
                "status" => true,
                "data" => $records
            ]);
        } else {
            // No records found for the provided file_access_key
            http_response_code(404); // Not found status code
            echo json_encode([
                "status" => false,
                "message" => "No records found for the provided file_access_key."
            ]);
        }
    } else {
        // Invalid request if 'file_access_key' is missing
        http_response_code(400); // Bad request status code
        echo json_encode([
            "status" => false,
            "message" => "Invalid request. Missing required parameter 'file_access_key'."
        ]);
    }
} else {
    // Method not allowed if it's not GET
    http_response_code(405); // Method not allowed status code
    echo json_encode([
        "status" => false,
        "message" => "Method not allowed. Use GET request."
    ]);
}

// Close the database connection
$conn->close();