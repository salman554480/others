<?php
// Database connection parameters
require_once('../db.php');

// Get the review_restaurant from the GET request
$review_restaurant = isset($_GET['restaurant']) ? $_GET['restaurant'] : '';

// Check if the review_restaurant is not empty
if (!empty($review_restaurant)) {
    // SQL query to fetch all records based on the restaurant (no LIMIT)
    $sql = "SELECT * FROM europe_hotel_review WHERE restaurant_name = ? ORDER BY RAND()";

    // Prepare the SQL statement to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("s", $review_restaurant);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any reviews are found
        if ($result->num_rows > 0) {
            $rows = [];
            // Fetch all rows and store them in an array
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            // Return the data as a JSON response
            echo json_encode($rows, JSON_PRETTY_PRINT);
        } else {
            // If no data is found for the restaurant, return an empty JSON array
            echo json_encode([]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle SQL prepare error
        echo json_encode(['error' => 'Failed to prepare SQL statement']);
    }
} else {
    // If the review_restaurant is not provided or empty, return an error
    echo json_encode(['error' => 'review_restaurant parameter is required']);
}

// Close the database connection
$conn->close();
