<?php
header('Content-Type: application/json'); // Set content type to JSON
require_once('../../parts/db.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get folder_key from GET request
    if (isset($_GET['folder_key']) && is_numeric($_GET['folder_key'])) {
        $folder_key = intval($_GET['folder_key']);
        $user_id = intval($_GET['user_id']);

        // Select top folder
        echo  $select_top_folders = "SELECT * FROM folder WHERE user_id= '$user_id' and folder_key='$folder_key'";
        $run_top_folders = mysqli_query($conn, $select_top_folders);

        if (mysqli_num_rows($run_top_folders) > 0) {
            $row_top_folders = mysqli_fetch_array($run_top_folders);
            $folder_key = $row_top_folders['folder_key'];
            $folder_name = $row_top_folders['folder_name'];

            // Count files in the top folder
            $count_folder_files = "SELECT * FROM file WHERE user_id='$user_id' and folder_key='$folder_key' and file_status='publish' ";
            $run_count_folder_files = mysqli_query($conn, $count_folder_files);
            if (mysqli_num_rows($run_count_folder_files) > 0) {
                $count_folder_files = (string)mysqli_num_rows($run_count_folder_files);

                // Get total folder size
                $select_folder_size = "SELECT SUM(file_size) AS file_size FROM file WHERE user_id='$user_id' and folder_key='$folder_key' and file_status='publish' ";
                $run_folder_size = mysqli_query($conn, $select_folder_size);
                $row_folder_size =  mysqli_fetch_array($run_folder_size);
                $total_folder_size = $row_folder_size['file_size'];

                if ($total_folder_size < 1024) {
                    $formatted_folder_size = $total_folder_size . ' KB';
                } elseif ($total_folder_size < 1048576) { // 1024 * 1024
                    $formatted_folder_size = round($total_folder_size / 1024, 2) . ' MB';
                } elseif ($total_folder_size < 1073741824) { // 1024 * 1024 * 1024
                    $formatted_folder_size = round($total_folder_size / 1048576, 2) . ' GB';
                } else {
                    $formatted_folder_size = round($total_folder_size / 1073741824, 2) . ' TB'; // Optional for very large files
                }
            } else {
                $count_folder_files = 0;
                $formatted_folder_size = 0;
            }
        } else {
            $folder_key = 0;
            $folder_name = "Drive";
        }
    } else {
        // Invalid or missing folder_key
        $folder_key = 0;
    }

    // Select subfolders
    $select_folders = "SELECT * FROM folder WHERE user_id= '$user_id' and parent_id='$folder_key' ";
    $run_folders = mysqli_query($conn, $select_folders);

    $folders_data = [];
    while ($row_folders = mysqli_fetch_assoc($run_folders)) {
        $folder_id = $row_folders['folder_key'];

        // Count files in each folder
        $count_files_query = "SELECT * FROM file WHERE user_id='$user_id' and folder_key='$folder_id' and file_status='publish' ";
        $run_count_files = mysqli_query($conn, $count_files_query);
        $current_folder_files = (string)mysqli_num_rows($run_count_files);

        // Get folder size for each folder
        $select_folder_size = "SELECT SUM(file_size) AS file_size FROM file WHERE user_id='$user_id' and folder_key='$folder_id' and file_status='publish' ";
        $run_folder_size = mysqli_query($conn, $select_folder_size);
        $row_folder_size = mysqli_fetch_array($run_folder_size);
        $current_folder_size = $row_folder_size['file_size'];


        if ($current_folder_size < 1024) {
            $formatted_folders_size = $current_folder_size . ' KB';
        } elseif ($current_folder_size < 1048576) { // 1024 * 1024
            $formatted_folders_size = round($current_folder_size / 1024, 2) . ' MB';
        } elseif ($current_folder_size < 1073741824) { // 1024 * 1024 * 1024
            $formatted_folders_size = round($current_folder_size / 1048576, 2) . ' GB';
        } else {
            $formatted_folders_size = round($current_folder_size / 1073741824, 2) . ' TB'; // Optional for very large files
        }


        // Add data to folders array
        $row_folders['current_folder_files'] = $current_folder_files;
        $row_folders['current_folder_size'] = $formatted_folders_size;


        $folders_data[] = $row_folders; // Append each folder's data
    }


    $files_data = [];
    $select_files = "SELECT * FROM file WHERE folder_key='$folder_key' AND user_id='$user_id' AND file_status='publish' order by file_id DESC limit 20";
    $run_files = mysqli_query($conn, $select_files);

    if (mysqli_num_rows($run_files) > 0) {
        while ($row_files = mysqli_fetch_assoc($run_files)) {

            $file_unique_id = $row_files['file_unique_id'];
            $file_type = $row_files['file_type'];

            


            // Divide file_size by 1024 and store it
            $file_size = $row_files['file_size'];
            $file_size_mb =  round($file_size / 1024);
            
            if ($file_size_mb <= 20 && $file_unique_id != '' && $file_type != 'application') {
                $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
                $url = "https://api.telegram.org/bot$botToken/getFile?file_id=$file_unique_id";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $responseData = json_decode($response, true);
                if (isset($responseData['ok']) && $responseData['ok'] && isset($responseData['result']['file_path'])) {
                    $filePath = $responseData['result']['file_path'];
                    $download_path = "https://api.telegram.org/file/bot$botToken/$filePath";
                } else {
                    echo "Failed to fetch the file path.\n";
                    if (isset($responseData['description'])) {
                        echo "Error: " . $responseData['description'] . "\n";
                    }
                }
            }


            if ($file_size < 1024) {
                $formatted_file_size = $file_size . ' KB';
            } elseif ($file_size < 1048576) { // 1024 * 1024
                $formatted_file_size = round($file_size / 1024, 2) . ' MB';
            } elseif ($file_size < 1073741824) { // 1024 * 1024 * 1024
                $formatted_file_size = round($file_size / 1048576, 2) . ' GB';
            } else {
                $formatted_file_size = round($file_size / 1073741824, 2) . ' TB'; // Optional for very large files
            }

            if ($file_size_mb <= 20 && $file_unique_id != '' && $file_type != 'application') {
                $row_files['file_download_path'] = $download_path;
            }

            $row_files['file_size'] = $formatted_file_size;
            $files_data[] = $row_files;
        }
    } else {
        $files_data = [];
    }




    $data = [
        "folder_name" => $folder_name,
        "total_folder_files" => $count_folder_files,
        "total_folder_size" => $formatted_folder_size
    ];

    $response = [
        "data" => $data,
        "subfolders" => $folders_data, // Send the array of folder data
        "files" => $files_data // Send the array of folder data
    ];

    http_response_code(200); // OK status code
    echo json_encode(["status" => true, "response" => $response]);
}


// Close the database connection
$conn->close();
