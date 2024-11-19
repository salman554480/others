<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../db.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $input = json_decode(file_get_contents("php://input"), true);

    // Check if all required fields are provided
    if (isset($input['user_id']) && isset($input['transaction_amount']) && isset($input['transaction_date']) && isset($input['transaction_expiry_date']) && isset($input['transaction_source'])) {
        
        $user_id = intval($input['user_id']);
        $transaction_amount = floatval($input['transaction_amount']);
        $transaction_date = $input['transaction_date']; // Expecting format 'YYYY-MM-DD'
        $transaction_expiry_date = $input['transaction_expiry_date']; // Expecting format 'YYYY-MM-DD'
        $transaction_source = $input['transaction_source']; // Source of the transaction (e.g., 'bank', 'card', etc.)

        // Insert the record into the transaction table
        $insert_query = "INSERT INTO transaction (user_id, transaction_amount, transaction_date, transaction_expiry_date, transaction_source) 
                         VALUES ('$user_id', '$transaction_amount', '$transaction_date', '$transaction_expiry_date', '$transaction_source')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Success response for insert
            http_response_code(201); // Created status code
            echo json_encode([
                "status" => true,
                "message" => "Transaction inserted successfully."
            ]);
        } else {
            // Error response for insert
            http_response_code(500); // Internal server error status code
            echo json_encode([
                "status" => false,
                "message" => "Failed to insert transaction."
            ]);
        }
    } else {
        // Invalid or missing fields
        http_response_code(400); // Bad request status code
        echo json_encode([
            "status" => false,
            "message" => "Invalid input data. Required fields: user_id, transaction_amount, transaction_date, transaction_expiry_date, transaction_source."
        ]);
    }
}

// Close the database connection
$conn->close();
