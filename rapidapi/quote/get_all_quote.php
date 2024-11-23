<?php
// Database connection parameters
require_once('../db.php');

// SQL query to fetch all data from the 'quote' table
$sql = "SELECT * FROM quote";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Initialize an array to hold the quotes
    $quotes = array();

    // Fetch the data row by row and add it to the array
    while ($row = $result->fetch_assoc()) {
        $quotes[] = $row;
    }

    // Return the data as a JSON response
    echo json_encode($quotes, JSON_PRETTY_PRINT);
} else {
    // If no data is found, return an empty JSON array
    echo json_encode([]);
}

// Close the database connection
$conn->close();