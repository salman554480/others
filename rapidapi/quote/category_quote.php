<?php
// Database connection parameters
require_once('../db.php');

// Get the quote_category from the GET request
$quote_category = isset($_GET['category']) ? $_GET['category'] : '';

// Check if the quote_category is not empty
if (!empty($quote_category)) {
    // SQL query to fetch a random record based on the category
    $sql = "SELECT * FROM quote WHERE quote_category = ? ORDER BY RAND() LIMIT 1";

    // Prepare the SQL statement to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("s", $quote_category);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a quote is found
        if ($result->num_rows > 0) {
            // Fetch the random row
            $row = $result->fetch_assoc();
            // Return the data as a JSON response
            echo json_encode($row, JSON_PRETTY_PRINT);
        } else {
            // If no data is found for the category, return an empty JSON object
            echo json_encode([]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle SQL prepare error
        echo json_encode(['error' => 'Failed to prepare SQL statement']);
    }
} else {
    // If the quote_category is not provided or empty, return an error
    echo json_encode(['error' => 'quote_category parameter is required']);
}

// Close the database connection
$conn->close();