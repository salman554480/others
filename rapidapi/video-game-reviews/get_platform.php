<?php
// Set Content-Type to JSON
header('Content-Type: application/json');
// Database connection parameters
require_once('../db.php');

// SQL query to fetch all distinct quote categories
$sql = "SELECT DISTINCT platform FROM video_game_reviews";

$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Initialize an array to hold the categories
    $categories = array();

    // Fetch the data row by row and add it to the array
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['platform'];
    }

    // Return the data as a JSON response
    echo json_encode($categories, JSON_PRETTY_PRINT);
} else {
    // If no categories are found, return an empty JSON array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
