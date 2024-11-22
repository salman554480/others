<?php
require_once('../parts/db.php');  // Include your DB connection file

// Check if category_id is set
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Query to get subcategories based on selected category
    $select_subcategory = "SELECT * FROM subcategory WHERE category_id = $category_id";
    $result_subcategory = mysqli_query($conn, $select_subcategory);

    // Prepare an array to store subcategory data
    $subcategories = array();

    while ($row_subcategory = mysqli_fetch_array($result_subcategory)) {
        $subcategories[] = array(
            'subcategory_id' => $row_subcategory['subcategory_id'],
            'subcategory_name' => $row_subcategory['subcategory_name']
        );
    }

    // Return the subcategory data as JSON
    echo json_encode($subcategories);
}