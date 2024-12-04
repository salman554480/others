<?php
// Set Content-Type to JSON
header('Content-Type: application/json');

// Database connection parameters
require_once('../db.php');

// Get the page number from the GET parameters
$page_no = isset($_GET['page_no']) ? (int)$_GET['page_no'] : 1; // Default to page 1 if not set
$records_per_page = 10; // Number of records per page

// Get the course_institution filter from the GET parameters (if provided)
$course_institution = isset($_GET['course_institution']) ? $_GET['course_institution'] : null;

// Calculate the starting record for the query based on the page number
$offset = ($page_no - 1) * $records_per_page;

// SQL query to get the total number of records in the 'course' table (with optional filter)
$sql_total = "SELECT COUNT(*) as total_records FROM course";
if ($course_institution) {
    // If a filter is provided, apply the WHERE clause
    $sql_total .= " WHERE course_institution = '$course_institution'";
}
$result_total = $conn->query($sql_total);
$total_records = 0;

if ($result_total->num_rows > 0) {
    $row = $result_total->fetch_assoc();
    $total_records = $row['total_records'];
}

// SQL query to fetch the data for the current page (with optional filter)
$sql = "SELECT * FROM course";
if ($course_institution) {
    // If a filter is provided, apply the WHERE clause
    $sql .= " WHERE course_institution = '$course_institution'";
}
$sql .= " LIMIT $offset, $records_per_page";

$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Initialize an array to hold the reviews
    $reviews = array();

    // Fetch the data row by row and add it to the array
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    // Check if there are more records available (next page)
    $next_records_available = ($page_no * $records_per_page) < $total_records ? 'yes' : 'no';

    // Prepare the response
    $response = array(
        'total_records' => $total_records,
        'records_on_page' => count($reviews),
        'next_records_available' => $next_records_available,
        'page_no' => $page_no,
        'reviews' => $reviews
    );

    // Return the response as a JSON object
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    // If no data is found, return an empty JSON object
    echo json_encode([
        'total_records' => $total_records,
        'records_on_page' => 0,
        'next_records_available' => 'no',
        'page_no' => $page_no,
        'reviews' => []
    ]);
}

// Close the database connection
$conn->close();