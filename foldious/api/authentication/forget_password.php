<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Get form data
    $email = trim($input["email"]);


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

            // delete otp
            // $delete_otp = "DELETE FROM otp WHERE user_email='$email'";
            // $delete_result = mysqli_query($conn, $delete_otp);

            // Inserting OTP
            // $otp = rand(1000, 9999);
            // $insert_otp = "INSERT INTO otp(otp_code,user_email) VALUES('$otp','$email')";
            // $run_insert_otp =  mysqli_query($conn, $insert_otp);


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

            $update_user_password = "UPDATE user SET user_password='$password' where user_email='$email'";
            $run_update_user_password = mysqli_query($conn, $update_user_password);
            
            
             //send mail
                 $to = $email;
                 $subject = "Password Changed";
                 $message = "Your Updated password as follows:\n\n";
                 $message .= "Password: $password\n";
                 $headers = "From: support@foldious.com";
                 mail($to, $subject, $message, $headers);

            if ($run_update_user_password === true) {
                http_response_code(200); // status code
                echo json_encode(["status" => true, "messaage" => "Password updated and sent to mail"]);
            } else {
                http_response_code(400); // Bad request status code
                echo json_encode(["status" => false, "message" => "Something Went Wrong"]);
            }
        } else {
            http_response_code(400); // Bad request status code
            echo json_encode(["status" => false, "message" => "No Email Found"]);
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