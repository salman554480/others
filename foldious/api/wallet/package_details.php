<?php
// Set content type to JSON
header('Content-Type: application/json');

// Include the database connection file
require_once('../../parts/db.php');


// Check if package_id is provided
if (!isset($_GET['package_id']) || empty($_GET['package_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'package_id is required.'
    ]);
    exit;
}

// Sanitize the package_id
$package_id = $conn->real_escape_string($_GET['package_id']);

// Query to fetch the record from the package table
$sql = "SELECT * FROM package WHERE package_id = '$package_id'";
$result = $conn->query($sql);

// Initialize response
$response = [];

// Check if the query ran successfully
if ($result) {
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
        $response = [
            'status' => 'success',
            'data' => $package
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No record found for the given package_id.'
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
