<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Get form data
    $username = trim($input["username"]);
    $email = trim($input["email"]);


    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }



    // Check for errors before inserting into the database
    if (empty($errors)) {
        // Check if the email is already registered
        $check_user = "SELECT * FROM user WHERE user_email ='$email'";
        $result = mysqli_query($conn, $check_user);
        if (mysqli_num_rows($result) > 0) {
            http_response_code(400); // Bad request status code
            echo json_encode(["status" => false, "error" => "Email Already Exist"]);
        } else {
            // Insert user data into the database
            $date =  date('Y-m-d');


            $length = 6;

            // Define characters to use in the password
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';

            // Initialize the password variable
            $password = '';

            // Loop to generate the password
            for ($i = 0; $i < $length; $i++) {
                // Randomly pick a character from the $characters string
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }

            $insert_user = "INSERT INTO user(package_id,user_name,user_email,user_password) VALUES('1','$username','$email','$password')";
            $run_insert = mysqli_query($conn, $insert_user);
            if ($run_insert === true) {
                // Fetching Latest User
                $select_user = "SELECT * FROM user WHERE user_email='$email'";
                $result_user = mysqli_query($conn, $select_user);
                $user_data =  mysqli_fetch_array($result_user);
                $user_id = $user_data['user_id'];

                // Inserting user deatials
                $folder_key = mt_rand(999999, 99999999);
                $insert_folder = "INSERT INTO folder(user_id,folder_key,folder_name,parent_id) VALUES('$user_id','$folder_key','Drive','0');";
                $run_insert_folder = mysqli_query($conn, $insert_folder);

                //send mail
                 $to = $email;
                 $subject = "Your Account Details";
                 $message = "Your Account Details are as follows:\n\n";
                 $message .= "Username: $username\n";
                 $message .= "Email: $email\n";
                 $message .= "Password: $password\n";
                 $headers = "From: support@foldious.com";
                 mail($to, $subject, $message, $headers);




                if ($run_insert_folder === true) {
                    http_response_code(200); // status code
                    echo json_encode(["status" => true, "message" => "Your Email & Password has sent to your email address.", "user_id" => $user_id]);
                } else {
                    http_response_code(400); // Bad request status code
                    echo json_encode(["status" => false, "message" => "Package not activated"]);
                }
            } else {
                http_response_code(400); // Bad request status code
                echo json_encode(["status" => false, "message" => "User not Inserted"]);
            }
        }
    } else {
        // Validation errors occurred
        http_response_code(400); // Bad request status code
        echo json_encode(["status" => false, "message" => $errors]);
    }
} else {
    http_response_code(400); // Bad request status code
    echo json_encode(["status" => false, "message" => "Invalid request method"]);
}