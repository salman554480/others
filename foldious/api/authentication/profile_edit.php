<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Get form data
    $user_id = trim($input["user_id"]);
    $user_name = trim($input["user_name"]);
    $user_password = trim($input["user_password"]);
    $user_image = trim($input["user_image"]);
    $user_contact = trim($input["user_contact"]);
    
    $update_user = "UPDATE user SET user_name='$user_name', user_password='$user_password',user_image='$user_image',user_contact='$user_contact' WHERE user_id='$user_id'";
    $run_update_user = mysqli_query($conn,$update_user);
    if($run_update_user === true){
        http_response_code(200); // OK status code
        echo json_encode(["status" => true, "message" => 'Profile updated.']);
    }else{
        http_response_code(404);
        echo json_encode(["status" => true, "alert" => "Something went wrong"]);
    }

}