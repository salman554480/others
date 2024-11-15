<?php
// Database connection
require_once('portal/parts/db.php');

// Get the file_access_key from the GET request
$file_access_key = isset($_GET['file_access_key']) ? $_GET['file_access_key'] : ''; // Fetch the dynamic key

if (empty($file_access_key)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No file access key provided.'
    ]);
    exit;
}

// Fetch all file records from the database using the file_access_key
$select_data = "SELECT * FROM data WHERE file_access_code='$file_access_key' ORDER BY data_id DESC";
$result = mysqli_query($conn, $select_data);

if (mysqli_num_rows($result) > 0) {
    $files = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $files[] = [
            'data_file_id' => $row['data_file_id'],
            'data_file_name' => $row['data_file_name'],
            'data_file_size' => $row['data_file_size']
        ];
    }

    echo json_encode([
        'status' => 'success',
        'files' => $files
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No files found for the provided access key.'
    ]);
}

exit;