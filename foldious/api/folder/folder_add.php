<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Get form data
    $user_id = trim($input["user_id"]);
    $parent_id = trim($input["parent_id"]);
    $folder_name = trim($input["folder_name"]);
    $folder_password = trim($input["folder_password"]);


    // Inserting user deatials
    $folder_key = mt_rand(999999, 99999999);
    $insert_folder = "INSERT INTO folder(user_id,folder_key,folder_name,parent_id,folder_password) VALUES('$user_id','$folder_key','$folder_name','$parent_id','$folder_password');";
    $run_insert_folder = mysqli_query($conn, $insert_folder);

    if ($run_insert_folder === true) {
        http_response_code(200); // status code
        echo json_encode(["status" => true, "messaage" => "Folder Created", "folder_key" => $folder_key]);
    } else {
        http_response_code(400); // Bad request status code
        echo json_encode(["status" => false, "errors" => "Something Went Wrong"]);
    }
} else {
    http_response_code(400); // Bad request status code
    echo json_encode(["status" => false, "errors" => "Invalid request method"]);
}