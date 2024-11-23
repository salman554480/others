<?php
// Database connection parameters
require_once('../db.php');

// SQL query to fetch a random record from the 'quote' table
$sql = "SELECT * FROM quote ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch the data (just one row since we are limiting to 1)
    $row = $result->fetch_assoc();

    // Return the data as a JSON response
    echo json_encode($row, JSON_PRETTY_PRINT);
} else {
    // If no data is found, return an empty JSON object
    echo json_encode([]);
}

// Close the database connection
$conn->close();