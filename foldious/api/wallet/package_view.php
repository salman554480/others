<?php
// Set content type to JSON
header('Content-Type: application/json');

// Include the database connection file
require_once('../../parts/db.php');


// Query to fetch records from the package table
$sql = "SELECT * FROM package";
$result = $conn->query($sql);

// Initialize response array
$response = [];

// Check if the query ran successfully
if ($result) {
    if ($result->num_rows > 0) {
        $packages = [];
        while ($row = $result->fetch_assoc()) {
            $packages[] = $row;
        }
        $response = [
            'status' => 'success',
            'data' => $packages
        ];
    } else {
        $response = [
            'status' => 'success',
            'data' => [],
            'message' => 'No records found in the package table.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Query failed: ' . $conn->error
    ];
}

// Close the database connection
$conn->close();

// Output the JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
?>
