<?php require_once('parts/top.php'); ?>

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
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <form action="" method="post">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:12px">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Message ID</th>
                                            <th>Access Key</th>
                                            <th>Files</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
                                        $apiUrl = "https://api.telegram.org/bot$botToken/getUpdates";
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, $apiUrl);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    
                                         $response = curl_exec($ch);
                    
                                        if (curl_errno($ch)) {
                                            echo 'Error: ' . curl_error($ch);
                                        } else {
                                            $updates = json_decode($response, true);
                    
                                            if ($updates['ok']) {
                                                if (empty($updates['result'])) {
                                                    echo "<p>No updates found.</p>";
                                                } else {
                                                    foreach ($updates['result'] as $update) {
                                                        $updateId = $update['update_id'];
                                                        $messageId = $update['message']['message_id'];
                                                        $fileHtml = '';
                                                        $file_access_key = '';
                                                        $fileId = '';
                    
                                                        if (isset($update['message']['document'])) {
                                                            $date = $update['message']['date'];
                                                            $fileId = $update['message']['document']['file_id'];
                                                            $file_size = $update['message']['document']['file_size'];
                                                            $file_type = $update['message']['document']['mime_type'];
                                                            $fileName = htmlspecialchars($update['message']['document']['file_name']);
                                                            $fileUrl = "https://api.telegram.org/file/bot$botToken/" . $fileId;
                                                            $fileHtml = "<a href='$fileUrl' target='_blank'>Download $fileName</a>";
                    
                                                            $file_sizeKb = round($file_size / 1024);
                                                            $file_sizeMb = number_format($file_sizeKb / 1024, 1);
                                                            $formattedDate = date('Y-m-d H:i:s', $date);
                    
                                                            preg_match('/^(\d+)_/', $fileName, $matches);
                                                            if (isset($matches[1])) {
                                                                $file_access_key = $matches[1];
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="records[]" value="<?php echo htmlspecialchars(json_encode(['fileId' => $fileId, 'fileName' => $fileName, 'fileSize' => $file_sizeKb, 'file_access_key' => $file_access_key])); ?>">
                                                            </td>
                                                            <td><?php echo @$messageId; ?></td>
                                                            <td><?php echo @$file_access_key; ?></td>
                                                            <td><?php echo @$fileName; ?><br><small><?php echo $file_sizeMb; ?> Mb | <?php echo $file_type; ?> | <?php echo $formattedDate;?></small></td>
                                                            
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                echo "<p>Failed to fetch updates.</p>";
                                            }
                                        }
                                        curl_close($ch);
                                        ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Submit Selected Records</button>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                
                <?php
// Database connection
require_once('parts/db.php');

// Check if records were selected
if (isset($_POST['records'])) {
    $records = $_POST['records'];

    foreach ($records as $recordJson) {
        $record = json_decode($recordJson, true);
        $file_access_key = $record['file_access_key'];
        $fileId = $record['fileId'];
        $file_name = $record['fileName'];
        $file_size = $record['fileSize'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO data (file_access_code, data_file_id,data_file_name,data_file_size) VALUES (?, ?, ?, ?)"); // Change to your table name and column names
        $stmt->bind_param("ssss", $file_access_key, $fileId, $file_name, $file_size);

        // Execute the statement
        if ($stmt->execute()) {
            
            $update_file = "UPDATE file SET file_state='upload' WHERE file_access_key='$file_access_key'";
            $run_update_file = mysqli_query($conn,$update_file);
            
        } else {
            echo "Error inserting record with Access Key $file_access_key and File ID $fileId: " . $stmt->error . "<br>";
        }

        // Close the statement
        $stmt->close();
    }
} else {
    echo "No records selected.";
}

// Close connection
$conn->close();
?>



            </div>
            <!-- End of Main Content -->
            <?php require_once('parts/footer.php'); ?>