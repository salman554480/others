<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Get form data
    $email = trim($input["email"]);
    $password = trim($input["password"]);
    $social = trim($input["social"]);

    if ($social == 1) {
        $select_user = "SELECT * FROM user WHERE user_email='$email'";
        $result_user = mysqli_query($conn, $select_user);
        if (mysqli_num_rows($result_user) > 0) {
            $row_user = mysqli_fetch_assoc($result_user);
            $user_id =  $row_user['user_id'];
            $package_id =  $row_user['package_id'];
            $login = "ok";
        } else {
            $insert_user = "INSERT INTO user(package_id,user_name,user_email,user_password) VALUES('1','User','$email','')";
            $result_user = mysqli_query($conn, $insert_user);
            $select_social_user = "SELECT * FROM user WHERE user_email='$email'";
            $result_social_user = mysqli_query($conn, $select_social_user);
            $row_user = mysqli_fetch_assoc($result_social_user);
            $user_id = $row_user['user_id'];
            $package_id = $row_user['package_id'];

            //Activate Drive Folder 
            $folder_key = mt_rand(999999, 99999999);
            $insert_folder = "INSERT INTO folder(user_id,folder_key,folder_name,parent_id) VALUES('$user_id','$folder_key','Drive','0');";
            $run_insert_folder = mysqli_query($conn, $insert_folder);

            $login = "ok";
        }
    } else {
        $select_inserted_user = "SELECT * FROM user WHERE user_email='$email' and user_password='$password'";
        $result_inserted_user = mysqli_query($conn, $select_inserted_user);
        if (mysqli_num_rows($result_inserted_user) > 0) {
            $row_user = mysqli_fetch_assoc($result_inserted_user);
            $user_id = $row_user['user_id'];
            $package_id = $row_user['package_id'];
            $login = "ok";
        } else {
            $login = "notok";
        }
    }





    // Response
    if ($login == "ok") {



        // Respond with the combined data
        http_response_code(200); // OK status code
        echo json_encode(["status" => true, "user_id" => $user_id]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => true, "alert" => "Invalid Login"]);
    }
} else {
    http_response_code(400); // Bad request status code
    echo json_encode(["status" => false, "errors" => "Invalid request method"]);
}