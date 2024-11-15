<?php require_once('parts/top.php'); ?>
<?php
if(isset($_GET['file_access_key'])){
   $file_access_key =  $_GET['file_access_key'];
     $select_file = "SELECT * FROM file where file_access_key='$file_access_key'";
     $result = mysqli_query($conn, $select_file);
     $row = mysqli_fetch_assoc($result);
     $user_id = $row['user_id'];
     $folder_key = $row['folder_key'];
     $file_id = $row['file_id'];
     $file_name = $row['file_name'];
     $file_access_key = $row['file_access_key'];
     $file_size = $row['file_size'];
     $file_date = $row['file_date'];
     $file_extension = $row['file_extension'];
}


if(isset($_GET['start'])){

 $filePath  = 'upload/'.$file_name; // Change this to your file path
 $zip_file = 'file.zip'; // Change this to your desired ZIP file path

// Create a new ZIP archive
$zip = new ZipArchive();

// Open the ZIP file for creation
if ($zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // Add the file to the ZIP archive
    $zip->addFile($filePath, basename($filePath));
    
    // Close the ZIP archive
    $zip->close();
  //  echo "File compressed to $zip_file";
} else {
    echo "Failed to create ZIP file.";
}


// Step 2: Split the downloaded ZIP file into chunks

$output_dir = "chunks/"; 

// Size of each chunk in bytes (19MB)
$chunk_size = 19 * 1024 * 1024; // 19MB

// Open the downloaded ZIP file for reading
$file = fopen($zip_file, 'rb');
if (!$file) {
    die("Unable to open file: $zip_file");
}else{
    echo "compressed";
}

$chunk_number = 1;
while (!feof($file)) {
    // Format chunk number with leading zeros
    $formatted_chunk_number = str_pad($chunk_number, 3, '0', STR_PAD_LEFT);
    
    // Create chunk file name
    $chunk_file_name = $output_dir . $file_access_key . '_chunk_' . $formatted_chunk_number . '.zip';
    
    // Open chunk file for writing
    $chunk_file = fopen($chunk_file_name, 'wb');
    
    if (!$chunk_file) {
        die("Unable to create chunk file: $chunk_file_name");
    }
    
    // Read a chunk from the original file
    $data = fread($file, $chunk_size);
    
    // Write the chunk to a new file
    fwrite($chunk_file, $data);
    
    // Close the chunk file
    fclose($chunk_file);
    
    $chunk_number++;
}

// Close the original file
fclose($file);

// Optionally, delete the original downloaded file and the ZIP file if no longer needed

 //unlink($zip_file);

echo "File downloaded, compressed, and split into chunks successfully!\n";
}

?>






</head>

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
                    <h1 class="h3 mb-4 text-gray-800"><?php echo $file_name;?> (<?php echo $file_access_key;?>)</h1>
                    <div class="card bg-white p-2">
                        <a href="file_details.php?file_access_key=<?php echo $file_access_key?>&start=1">Start</a>
                        <div class="row">
                            <div class="col-md-5">
                                 <ol class="list-group list-group-numbered">
    <form method="post" action="">
        <div class="form-group">
            <input type="checkbox" id="select-all"> Select All
        </div>
        <?php
        // Set the unique code (this could be dynamically set)
        $uniqueCode = $file_access_key; // Replace with your unique code variable
        $directory = 'chunks';
        
        // Scan the directory for files
        $files = scandir($directory);
        
        // Filter the files to match your pattern
        $filteredFiles = array_filter($files, function($file) use ($uniqueCode) {
            return preg_match('/^' . preg_quote($uniqueCode, '/') . '_.+\.zip$/', $file);
        });
        
        // Sort the filtered files in descending order
        rsort($filteredFiles);
        
        foreach ($filteredFiles as $file) {
            $file = htmlspecialchars($file);
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <input type="checkbox" name="files[]" value="<?php echo $file; ?>" class="file-checkbox">
                <?php echo $file; ?>
            </li>
        <?php
        }
        ?>
        <button type="submit" name="process_files" class="btn btn-primary mt-3">Process Selected Files</button>
    </form>
</ol>

                            </div>    
                            <div class="col-md-7">
                                <?php
if (isset($_POST['process_files']) && !empty($_POST['files'])) {
    $selected_files = $_POST['files'];

    // Loop through selected files and process each one
    foreach ($selected_files as $process_file) {
        $file_url = 'chunks/' . $process_file; // Update this to your actual file path
        
        // Your Telegram Bot Token
        $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
        $chatId = '-1002230179133'; // Correct chat ID obtained from getUpdates
        
        // Initialize cURL session
        $ch = curl_init();
        
        // Check if the file exists
        if (file_exists($file_url)) {
            // Set the cURL options
            curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$botToken/sendDocument");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            
            // Prepare the document to send
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'chat_id' => $chatId,
                'document' => new CURLFile($file_url, mime_content_type($file_url), basename($file_url)),
                'caption' => "$user_id-$folder_key-$file_access_key" // Define these variables as needed
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
            echo "File does not exist: $file_url<br>";
        }
    }
    $update_file_state = "UPDATE file SET file_state='upload' where file_access_key='$file_access_key'";
    $run_update_file_state = mysqli_query($conn,$update_file_state);
    if($run_update_file_state === true){
        echo "<script>window.open('file_details.php?file_access_key=$file_access_key','_self');</script>";
        
        
            
            $directory = 'chunks'; // Specify your directory path
            $uniqueCode = $file_access_key.'_'; // Specify the unique code
            
            // Check if the directory exists
            if (is_dir($directory)) {
                // Open the directory
                if ($handle = opendir($directory)) {
                    // Loop through the directory
                    while (false !== ($file = readdir($handle))) {
                        // Check if the file starts with the unique code
                        if (strpos($file, $uniqueCode) === 0) {
                            $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                            // Delete the file
                            if (is_file($filePath)) {
                                unlink($filePath);
                                echo "Deleted: $filePath\n";
                            }
                        }
                    }
                    // Close the directory handle
                    closedir($handle);
                } else {
                    echo "Failed to open directory: $directory\n";
                }
            } else {
                echo "Directory does not exist: $directory\n";
            }

        
        
        
        
        
    }
}
?>
<script>
// JavaScript to handle "Select All" checkbox
document.getElementById('select-all').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('.file-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});
</script>
                               
                                <div class="table-responsive">
                                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Access Code</th>
                                                <th>Name</th>
                                                <th>ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            require_once('parts/db.php');
                                            $select_file = "SELECT * FROM data where file_access_code='$file_access_key' order by data_file_name DESC";
                                            $result = mysqli_query($conn, $select_file);
                                            while($row = mysqli_fetch_assoc($result)){
                                                $data_id = $row['data_id'];
                                                $data_file_id = $row['data_file_id'];
                                                $data_file_name = $row['data_file_name'];
                                                $data_file_size = $row['data_file_size'];
                                                
                                                $data_file_sizeMb =  number_format($data_file_size / 1024 , 1);
    
                                            ?>
                                            
                                                
                                                <tr>
                                                    <td><?php echo $data_id;?></td>
                                                    <td><?php echo $file_access_key;?></td>
                                                    <td>
                                                        <?php echo $data_file_name;?><br>
                                                        <small><?php echo $data_file_sizeMb;?> MB</small>
                                                    </td>
                                                   <td><?php echo $data_file_id;?></td>
                                                </tr>
                                            
                                            <?php }?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                    
                                

                            </div>    
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once('parts/footer.php'); ?>
