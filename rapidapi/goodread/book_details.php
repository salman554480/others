<?php
// Set Content-Type to JSON
header('Content-Type: application/json');

// Database connection parameters
require_once('../db.php');

// Get the goodread_id from the query string (GET request)
if (isset($_GET['goodread_id'])) {
    $goodread_id = $_GET['goodread_id'];

    // Create the SQL query to fetch the record
    $query = "SELECT * FROM goodread WHERE goodread_id = $goodread_id";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the record as an associative array
        $record = mysqli_fetch_assoc($result);

        // Check if a record was found
        if ($record) {
            // Send the record as a JSON response
            echo json_encode(array("status" => "success", "data" => $record));
        } else {
            // If no record is found, return an error message
            echo json_encode(array("status" => "error", "message" => "Record not found"));
        }
    } else {
        // If there was an error with the query, return an error message
        echo json_encode(array("status" => "error", "message" => "Error executing query"));
    }
} else {
    // If goodread_id is not provided, return an error message
    echo json_encode(array("status" => "error", "message" => "goodread_id parameter is required"));
}