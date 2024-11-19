<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the package_id from the query parameters
    $user_id = isset($_GET['user_id']) ? trim($_GET['user_id']) : null;

    $select_social_user = "SELECT * FROM user WHERE user_id='$user_id'";
    $result_social_user = mysqli_query($conn, $select_social_user);
    if (mysqli_num_rows($result_social_user) > 0) {
        $row_user = mysqli_fetch_assoc($result_social_user);
        $package_id = $row_user['package_id'];



        // Fetch user details data from the user_details table
        $folder_query = "SELECT * FROM folder WHERE user_id='$user_id'";
        $run_folder_query = mysqli_query($conn, $folder_query);
        $folder_details = mysqli_fetch_assoc($run_folder_query);

        $package_query = "SELECT * FROM package WHERE package_id='$package_id'";
        $run_package_query = mysqli_query($conn, $package_query);
        $package_details = mysqli_fetch_assoc($run_package_query);
        $package_storage = $package_details['package_storage'];
        $package_storage_Gb = $package_storage . " GB";


        $transaction_query = "SELECT * FROM transaction WHERE user_id='$user_id' order by transaction_id DESC LIMIT 1";
        $run_transaction_query = mysqli_query($conn, $transaction_query);
        if (mysqli_num_rows($run_transaction_query) > 0) {
            $transaction_details = mysqli_fetch_assoc($run_transaction_query);
        } else {
            $transaction_details = [
                "transaction_id" => "",
                "user_id" => "",
                "package_id" => "",
                "transaction_amount" => "",
                "transaction_source" => "",
                "transaction_date" => "",
                "transaction_expiry_date" => ""
            ];
        }





        $select_account_size = "SELECT SUM(file_size) AS file_size FROM file WHERE user_id='$user_id' and  file_status!='delete' ";
        $run_account_size = mysqli_query($conn, $select_account_size);
        if (mysqli_num_rows($run_account_size) > 0) {
            $row_account_size =  mysqli_fetch_array($run_account_size);
            $total_storage_used =  $row_account_size['file_size'];
            $total_storage_used_gb =  $total_storage_used / 1048576;

            if ($total_storage_used < 1024) {
                $formatted_storage_used = $total_storage_used . ' KB';
            } elseif ($total_storage_used < 1048576) { // 1024 * 1024
                $formatted_storage_used = round($total_storage_used / 1024, 2) . ' MB';
            } elseif ($total_storage_used < 1073741824) { // 1024 * 1024 * 1024
                $formatted_storage_used = round($total_storage_used / 1048576, 2) . ' GB';
            } else {
                $formatted_storage_used = round($total_storage_used / 1073741824, 2) . ' TB'; // Optional for very large files
            }
        } else {
            $total_storage_used = "0 Kb";
        }

        $remaining_storage = $package_storage - round($total_storage_used_gb);
        $usage_percentage = $total_storage_used_gb * 100 / $package_storage;






        // Function to get the total number of rows and total size for a specific file type
        function getFileData($conn, $fileType, $userId)
        {
            // Ensure user ID is properly escaped to prevent SQL injection
            $fileType = mysqli_real_escape_string($conn, $fileType);
            $userId = mysqli_real_escape_string($conn, $userId);

            // Query to count files
            $count_query = "SELECT COUNT(*) AS total_files FROM file WHERE file_type='$fileType' AND user_id='$userId'";
            $count_result = mysqli_query($conn, $count_query);
            if ($count_result) {
                $count_row = mysqli_fetch_assoc($count_result);
                $total_files = $count_row['total_files'];
            } else {
                echo "Error counting files: " . mysqli_error($conn);
                $total_files = 0;
            }

            // Query to sum file sizes
            $size_query = "SELECT SUM(file_size) AS total_size FROM file WHERE file_type='$fileType' AND user_id='$userId'";
            $size_result = mysqli_query($conn, $size_query);
            if ($size_result) {
                $size_row = mysqli_fetch_assoc($size_result);
                $total_size_file = $size_row['total_size'];
                if ($total_size_file < 1) {
                    $formatted_file_size =  '0 KB';
                } elseif ($total_size_file < 1024) {
                    $formatted_file_size = $total_size_file . ' KB';
                } elseif ($total_size_file < 1048576) { // 1024 * 1024
                    $formatted_file_size = round($total_size_file / 1024, 2) . ' MB';
                } elseif ($total_size_file < 1073741824) { // 1024 * 1024 * 1024
                    $formatted_file_size = round($total_size_file / 1048576, 2) . ' GB';
                } else {
                    $formatted_file_size = round($total_size_file / 1073741824, 2) . ' TB'; // Optional for very large files

                }
            } else {
                echo "Error calculating size: " . mysqli_error($conn);
                $formatted_file_size = "0 KB";
            }

            return [$total_files, $formatted_file_size];
        }

        // Example user_id (ensure this is set appropriately in your actual code)
        $user_id = isset($user_id) ? $user_id : 0; // Replace 0 with a default or handle it as needed

        // Get data for different file types
        list($total_application_files, $application_size_mb) = getFileData($conn, 'application', $user_id);
        list($total_image_files, $image_size_mb) = getFileData($conn, 'image', $user_id);
        list($total_video_files, $video_size_mb) = getFileData($conn, 'video', $user_id);
        list($total_text_files, $text_size_mb) = getFileData($conn, 'text', $user_id);

        $remaining_storage = strval(round($remaining_storage, 1)) . " GB";
        $usage_percentage = strval(round($usage_percentage, 2));

        $storage_details = [
            'total_storage' => $package_storage_Gb,
            'storage_used' => $formatted_storage_used,
            'remaining_storage' => $remaining_storage,
            'usage_percentage' => $usage_percentage,
            'total_image_files' => $total_image_files,
            'total_images_size' => $image_size_mb,
            'total_video_files' => $total_video_files,
            'total_video_size' => $video_size_mb,
            'total_text_files' => $total_text_files,
            'total_text_size' => $text_size_mb,
            'total_application_files' => $total_application_files,
            'total_application_size' => $application_size_mb
        ];
        // Combine user data and user details into one response

        $full_data = [
            'user_details' => $row_user,
            'package_details' => $package_details,
            'folder_details' => $folder_details,
            'storage_details' => $storage_details,
            'transaction_details' => $transaction_details
        ];

        // Respond with the combined data
        http_response_code(200); // OK status code
        echo json_encode(["user" => $full_data]);
    } else {
        http_response_code(404); // Bad request status code
        echo json_encode(["status" => false, "error" => "No user found"]);
    }
} else {
    http_response_code(400); // Bad request status code
    echo json_encode(["status" => false, "message" => "Invalid request method"]);
}