<?php
// Set content type to JSON
header('Content-Type: application/json');

// Include the database connection file
require_once('../../parts/db.php');


// Check if user_id is provided
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'user_id is required.'
    ]);
    exit;
}

// Sanitize the user_id
$user_id = $conn->real_escape_string($_GET['user_id']);

// Query to fetch records from the wallet table
$sql = "SELECT * FROM wallet WHERE user_id = '$user_id'";
$result = $conn->query($sql);

// Initialize response
$response = [];

// Check if the query ran successfully
if ($result) {
    if ($result->num_rows > 0) {
        $wallet_records = [];
        while ($row = $result->fetch_assoc()) {
            $wallet_records[] = $row;
        }
        $response = [
            'status' => 'success',
            'data' => $wallet_records
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No records found for the given user_id.'
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
