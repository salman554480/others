<?php require_once('parts/top.php'); ?>

</head>
<?php 
if(isset($_GET['file_access_key'])){
    $file_access_key = $_GET['file_access_key'];
    $user_id = $_GET['user_id'];
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('parts/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('parts/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
                    <div class="card bg-white p-2">
                         <form action="" method="post" enctype="multipart/form-data">
                            <label for="files">Select files to upload:</label>
                            <input type="file" name="files[]" id="files" multiple required>
                            <input type="hidden" name="user_id" value="<?php echo $user_id;?>"> <!-- Replace with actual user ID -->
                            <input type="hidden" name="file_access_key" value="<?php echo $file_access_key;?>"> <!-- Replace with actual access key -->
                            <input type="submit" name="upload_files" value="Upload">
                        </form>
                        
                        
                        
                        <?php
                        if (isset($_POST['upload_files']) && !empty($_FILES['files'])) {
                            $files = $_FILES['files'];
                            $user_id = $_POST['user_id'];
                            $file_access_key = $_POST['file_access_key'];
                        
                            // Loop through uploaded files
                            for ($i = 0; $i < count($files['name']); $i++) {
                                $file_tmp_path = $files['tmp_name'][$i];
                                $file_name = $files['name'][$i];
                                $file_size = $files['size'][$i];
                        
                                // Define the upload directory
                                $upload_dir = 'chunks/';
                                $file_url = $upload_dir . basename($file_name);
                        
                                // Move the file to the upload directory
                                if (move_uploaded_file($file_tmp_path, $file_url)) {
                                    // Your Telegram Bot Token
                                    $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
                                    $chatId = '-1002230179133'; // Correct chat ID obtained from getUpdates
                        
                                    // Initialize cURL session
                                    $ch = curl_init();
                        
                                    // Set the cURL options
                                    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$botToken/sendDocument");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POST, true);
                        
                                    // Prepare the document to send
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, [
                                        'chat_id' => $chatId,
                                        'document' => new CURLFile($file_url, mime_content_type($file_url), basename($file_url)),
                                        'caption' => "$user_id-$file_access_key" // Define these variables as needed
                                    ]);
                        
                                    // Execute the cURL session and get the response
                                    $response = curl_exec($ch);
                                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                    curl_close($ch);
                        
                                    // Decode the response
                                    $responseData = json_decode($response, true);
                        
                                    // Check if the request was successful
                                    if ($httpCode === 200 && isset($responseData['ok']) && $responseData['ok'] === true) {
                                        $file_id = $responseData['result']['document']['file_id'];
                                        $file_name = $responseData['result']['document']['file_name'];
                                        $file_size = $responseData['result']['document']['file_size'];
                                        $file_type = $responseData['result']['document']['mime_type'];
                        
                                        // Insert data for each file
                                        $insert_data = "INSERT INTO data(file_access_code, data_file_id, data_file_name, data_file_size, user_id) VALUES('$file_access_key','$file_id','$file_name','$file_size','$user_id')";
                                        $run_insert_data = mysqli_query($conn, $insert_data);
                                        if ($run_insert_data === true) {
                                            echo "Data inserted for file: $file_name<br>";
                                        }
                                    } else {
                                        echo "Failed to send file: $file_url. Error: " . $responseData['description'] . "<br>";
                                    }
                                } else {
                                    echo "Error moving the uploaded file: $file_name<br>";
                                }
                            }
                        
                           
                        }
                        ?>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once('parts/footer.php'); ?>