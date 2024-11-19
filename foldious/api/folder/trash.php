<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['record_ids']) && is_array($input['record_ids'])) {
        // Get the IDs from the form submission
        $ids = $input['record_ids'];
        $status = $input['status'];
        $ids = implode(',', array_map('intval', $ids)); // Sanitize and prepare for SQL

        // SQL to update records
        $sql = "UPDATE file SET file_status='$status' WHERE file_access_key IN ($ids)";
        if ($conn->query($sql) === TRUE) {
            http_response_code(200); // status code
            echo json_encode(["status" => true, "message" => "Files Status Updated"]);
        } else {
            http_response_code(400); // Bad request status code
            echo json_encode(["status" => false, "errors" => "Something Went Wrong"]);
        }
    } else {
        http_response_code(400); // Bad request status code
        echo json_encode(["status" => false, "errors" => "No records selected for deletion"]);
    }

    // Close the connection
    $conn->close();
    // header("Location: dashboard.php");
    //exit();
}