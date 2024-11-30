<?php
// Database connection parameters
require_once('../db.php');

// SQL query to fetch all distinct quote restaurants
$sql = "SELECT DISTINCT sentiment FROM europe_hotel_review";

$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Initialize an array to hold the restaurants
    $restaurants = array();

    // Fetch the data row by row and add it to the array
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row['sentiment'];
    }

    // Return the data as a JSON response
    echo json_encode($restaurants, JSON_PRETTY_PRINT);
} else {
    // If no restaurants are found, return an empty JSON array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
